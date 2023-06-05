<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\DeliveryMethod;
use App\Imports\ShippingImport;
use App\Exports\ShippingExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Shipping')){
            $user = \Auth::user();
            // $shippings = Shipping::where('store_id', $user->current_store)->where('created_by', \Auth::user()->creatorId())->get();
            // $locations = Location::where('store_id', $user->current_store)->where('created_by', \Auth::user()->creatorId())->get();
            $deliveryMethods = DeliveryMethod::where('store_id', $user->current_store)->get();
            $deliveryMethodsNames = [];
            foreach ($deliveryMethods as $method) {
                array_push($deliveryMethodsNames, $method->type);
            }
            return view('shipping.index', compact('deliveryMethods','deliveryMethodsNames'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Shipping')){
            $user      = \Auth::user()->current_store;
            $locations = Location::where('store_id', $user)->get()->pluck('name', 'id');

            return view('shipping.create', compact('locations'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Shipping')){
            $this->validate(
                $request, [
                            'name' => 'required|max:40',
                            'price' => 'required|numeric',
                        ]
            );

            $shipping              = new Shipping();
            $shipping->name        = $request->name;
            $shipping->price       = $request->price;
            $shipping->location_id = implode(',', $request->location);
            $shipping->store_id    = \Auth::user()->current_store;
            $shipping->created_by  = \Auth::user()->creatorId();
            $shipping->save();

            return redirect()->back()->with('success', __('Shipping added!'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Shipping $shipping
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Shipping $shipping
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        if(\Auth::user()->can('Edit Shipping')){
            $store_id = Auth::user()->current_store;

            $locations = Location::where('store_id', $store_id)->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            
            return view('shipping.edit', compact('shipping', 'locations'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Shipping $shipping
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        if(\Auth::user()->can('Edit Shipping')){
            $this->validate(
                $request, [
                            'name' => 'required|max:40',
                            'price' => 'required|numeric',
                        ]
            );

            $shipping->name        = $request->name;
            $shipping->price       = $request->price;
            $shipping->location_id = implode(',', $request->location);
            $shipping->created_by  = \Auth::user()->creatorId();
            $shipping->save();

            return redirect()->back()->with('success', __('Shipping Updated!'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Shipping $shipping
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        if(\Auth::user()->can('Delete Shipping')){
            $shipping->delete();

            return redirect()->back()->with('success', __('Shipping Deleted!'));
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

     public function fileExport()
    {

        $name = 'Shipping_' . date('Y-m-d i:h:s');
        $data = Excel::download(new ShippingExport(), $name . '.xlsx');


        return $data;
    }

     public function fileImportExport()
    {
        if(\Auth::user()->can('Create Shipping')){
            return view('shipping.import');
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

     public function fileImport(Request $request)
    {
        if(\Auth::user()->can('Create Shipping')){
            $rules = [
                'file' => 'required|mimes:csv,txt,xlsx',
            ];
            $user     = \Auth::user();
            $store_id = Store::where('id', $user->current_store)->first();


            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $shippings = (new ShippingImport())->toArray(request()->file('file'))[0];

            $totalshipping = count($shippings) - 1;

            $locationArray    = [];
            $shippingArray    = [];
            for($i = 1; $i <= count($shippings) - 1; $i++)
            {
                $shipping = $shippings[$i];
                $locationbyname = Location::where('name', $shipping[0])->first();
                $shippingbyname=Shipping::where('name',$shipping[1])->first();

                if(!empty($shippingbyname)&&!empty($locationbyname))
                {
                    $locationData = $locationbyname;
                    $shippingData = $shippingbyname;
                }
                else
                {
                    $locationData = new Location();
                    $shippingData = new Shipping();

                }

                $locationData->name         = $shipping[0];
                $locationData->store_id     = $store_id->id;
                $locationData->created_by    = \Auth::user()->creatorId();

                $shippingData->name         = $shipping[1];
                $shippingData->price          = $shipping[2];
                $shippingData->store_id = $store_id->id;
                $shippingData->created_by        = \Auth::user()->creatorId();



                if(empty($locationData)&& empty($shippingData))
                {
                    $locationArray[] = $locationData;
                    $shippingArray[] = $shippingData;
                }
                else
                {
                    $locationData->save();
                    $shippingData->save();
                }
            }

            $locationRecord = [];
            $shippingRecord = [];
            if(empty($locationArray)&& empty($shippingArray))
            {
                $data['status'] = 'success';
                $data['msg']    = __('Record successfully imported');
            }
            else
            {
                $data['status'] = 'error';
                $data['msg']    = count($locationArray) . ' ' . __('Record imported fail out of' . ' ' . $totalshipping . ' ' . 'record').' and '.count($shippingArray) . ' ' . __('Record imported fail out of' . ' ' . $totalshipping . ' ' . 'record');


                foreach($locationArray as $locationData)
                {

                    $locationRecord[] = implode(',', $locationData);

                }

                foreach($shippingArray as $shippingData)
                {

                    $shippingRecord[] = implode(',', $shippingData);

                }

                \Session::put('locationArray', $locationRecord);
                \Session::put('shippingArray', $shippingRecord);
            }

            return redirect()->back()->with($data['status'], $data['msg']);
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function createNewDelivery($slug) {
        $store = Store::findorfail(\Auth::user()->current_store);
        $deliveryMethod = NULL;
        if($slug!="custom-shipping") {
            $deliveryMethod = DeliveryMethod::where('type', $slug)->first();
            if(!empty($deliveryMethod)) {
                $deliveryMethod = $deliveryMethod->toArray();
                $deliveryMethod['data'] = json_decode($deliveryMethod['data'], true);
            }
        }
        return view("shipping.".$slug, compact('slug', 'store', 'deliveryMethod'));
    }

    public function editDelivery($slug, $id) {
        $store = Store::findorfail(\Auth::user()->current_store);
        $deliveryMethod = DeliveryMethod::findorfail($id);
        $deliveryMethod = $deliveryMethod->toArray();
        $deliveryMethod['data'] = json_decode($deliveryMethod['data'], true);
        return view("shipping.".$slug, compact('slug', 'store', 'deliveryMethod'));
    }

    public function deleteDelivery($id) {
        $deliveryMethod = DeliveryMethod::findorfail($id);
        $deliveryMethod->delete();
        return redirect()->back()->with('success', __('Shipping Deleted!'));
    }

    public function saveNewDelivery(Request $request, $slug) {
        if($slug==="correios") {
            $response = $this->saveCorreiosDeliveryMethod($request);
        } else if($slug==="custom-shipping") {
            $response = $this->saveCustomShippingMethod($request);
        } else if($slug==="pick-up-products") {
            $response = $this->savePickUpProducts($request);
        } else {
            return redirect()->back()->with('error', 'Invalid Method.');
        }

        if($response['status']) {
            return redirect()->route('shipping.index')->with('success', 'Delivery Method Added Succesfully.');
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }


    private function savePickUpProducts($request) {
        $validation = [
            'type'=>'required',
            'pick_up_option_name'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'address'=>'required',
            'zipcode'=>'required',
            'working_hours'=>'required',
            'enable_pick_up_cost'=>'required',
        ];
        if($request->enable_pick_up_cost==="on") {
            $validation['pick_up_cost'] = 'required|numeric';
        }

        $validator = \Validator::make($request->all(), $validation);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return [
                "status"=>false,
                "message"=>$messages->first()
            ];
        }
        $data = $request->all();
        // Remove some data
        $methodKeys = ['_token', 'type'];
        $data = array_diff_key($data, array_flip($methodKeys));

        $create = DeliveryMethod::updateOrCreate([
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
        ],[
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
            'name' => $request->pick_up_option_name,
            'data' => json_encode($data)
        ]);
        if($create) {
            return [
                "status"=>true,
            ];
        }
        return [
            "status"=>false,
            "message"=> "Delivery Method Creation Failed."
        ];
    }


    private function saveCustomShippingMethod($request) {
        $validation = [
            'type'=>'required',
            'shipping_name'=>'required',
            'shipping_zones'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'enable_shipping_cost'=>'required',
            'enable_shipping_deadlines'=>'required',
            'enable_cart_total_weight'=>'required',
            'enable_total_purchase_amount'=>'required',
        ];
        if($request->enable_shipping_cost==="on") {
            $validation['shipping_cost'] = 'required|numeric';
        }
        if($request->enable_shipping_deadlines==="on") {
            $validation['shipping_deadlines_from'] = 'required|numeric';
            $validation['shipping_deadlines_to'] = 'required|numeric';
        }
        if($request->enable_cart_total_weight==="on") {
            $validation['cart_total_weight_from'] = 'required|numeric';
            $validation['cart_total_weight_to'] = 'required|numeric';
        }
        if($request->enable_total_purchase_amount==="on") {
            $validation['total_purchase_amount_from'] = 'required|numeric';
            $validation['total_purchase_amount_to'] = 'required|numeric';
        }
        $validator = \Validator::make($request->all(), $validation);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return [
                "status"=>false,
                "message"=>$messages->first()
            ];
        }
        $data = $request->all();
        // Remove some data
        $methodKeys = ['_token', 'type'];
        $data = array_diff_key($data, array_flip($methodKeys));

        $create = DeliveryMethod::updateOrCreate([
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
            'id' => $request->id,
        ],[
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
            'data' => json_encode($data),
            'name' => $request->shipping_name,
        ]);
        if($create) {
            return [
                "status"=>true,
            ];
        }
        return [
            "status"=>false,
            "message"=> "Delivery Method Creation Failed."
        ];

    }

    private function saveCorreiosDeliveryMethod($request) {
        $validation = [
            'type'=>'required',
            'store_address'=>'required',
            'store_city'=>'required',
            'store_state'=>'required',
            'store_country'=>'required',
            'store_zipcode'=>'required',
            'store_name'=>'required',
            'store_email'=>'required|email',
            'enable_pac'=>'required',
            'enable_sedex'=>'required',
            'enable_mini_envios'=>'required',
            'enable_default_weight_dimensions'=>'required',
            'disable_pac_for_my_city'=>'required',
        ];
        if($request->enable_default_weight_dimensions==="on") {
            $validation['default_weight'] = 'required';
            $validation['default_length'] = 'required';
            $validation['default_height'] = 'required';
            $validation['default_width'] = 'required';
        }
        $validator = \Validator::make($request->all(), $validation);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return [
                "status"=>false,
                "message"=>$messages->first()
            ];
        }
        $data = $request->all();

        // Remove some data
        $methodKeys = ['_token', 'type'];
        $data = array_diff_key($data, array_flip($methodKeys));

    
        $create = DeliveryMethod::updateOrCreate([
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
        ],[
            'store_id' => \Auth::user()->current_store,
            'type' => $request->type,
            'name' => $request->type,
            'data' => json_encode($data)
        ]);
        if($create) {
            return [
                "status"=>true,
            ];
        }
        return [
            "status"=>false,
            "message"=> "Delivery Method Creation Failed."
        ];
    }

    public function updateDeliveryMethodStatus(Request $request, $id) {
        $deliveryMethod = DeliveryMethod::findorfail($id);
        $deliveryMethod->active = $request->active;
        $deliveryMethod->save();
        return redirect()->route('shipping.index')->with('success', 'Delivery Method Updated Succesfully.');
    }
}
