<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\User;
use App\Models\PlanOrder;
use App\Models\UserCoupon;
use App\Models\Utility;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('Manage Coupans')){
            if(\Auth::user()->type == 'super admin')
            {
                $coupons = Coupon::get();
    
                return view('coupon.index', compact('coupons'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
       
    }


    public function create()
    {
        if(\Auth::user()->can('Create Coupans')){
            if(\Auth::user()->type == 'super admin')
            {
                $plans = Plan::get();
                $planOptions = [];
                foreach ($plans as $plan) {
                    $planOptions[$plan->id] = $plan->name;
                }
                return view('coupon.create', compact("planOptions"));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else{
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Coupans')){
            if(\Auth::user()->type == 'super admin')
            {

                $validation = [];
                $validation['name'] = 'required';
                $validation['limit'] = 'required|numeric';
                $validation['code'] = 'required';
                $validation['plans'] = 'required';
                $validation['type'] = 'required';
                if($request->type && $request->type==="discount") {
                    $validation['discount'] = 'required|numeric';
                }
                if($request->type && $request->type==="redeemable") {
                    $validation['duration'] = 'required|numeric';
                }
                $validator = \Validator::make(
                    $request->all(), $validation
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $coupon           = new Coupon();
                $coupon->name     = $request->name;
                $coupon->type = $request->type;
                $coupon->discount = $request->type==="discount" ? $request->discount : 0;
                $coupon->limit    = $request->limit;
                $coupon->code     = strtoupper($request->code);
                $coupon->plans = json_encode($request->plans);
                $coupon->duration = $request->type==="redeemable" ? $request->duration : 0;

                $coupon->save();

                return redirect()->route('coupons.index')->with('success', __('Coupon successfully created.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(Coupon $coupon)
    {
        if(\Auth::user()->can('Show Coupans')){
            $userCoupons = UserCoupon::where('coupon', $coupon->id)->get();

            return view('coupon.view', compact('userCoupons', 'coupon'));
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
      
    }


    public function edit(Coupon $coupon)
    {
        if(\Auth::user()->can('Edit Coupans')){
            if(\Auth::user()->type == 'super admin')
            {
                $plans = Plan::get();
                $planOptions = [];
                foreach ($plans as $plan) {
                    $planOptions[$plan->id] = $plan->name;
                }
                $coupon->plans = json_decode($coupon->plans);
                return view('coupon.edit', compact('coupon','planOptions'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        
    }


    public function update(Request $request, Coupon $coupon)
    {
        if(\Auth::user()->can('Edit Coupans')){
            if(\Auth::user()->type == 'super admin')
            {
                $validation = [];
                $validation['name'] = 'required';
                $validation['limit'] = 'required|numeric';
                $validation['code'] = 'required';
                $validation['plans'] = 'required';
                $validation['type'] = 'required';
                if($request->type && $request->type==="discount") {
                    $validation['discount'] = 'required|numeric';
                }
                if($request->type && $request->type==="redeemable") {
                    $validation['duration'] = 'required|numeric';
                }
                 $validator = \Validator::make(
                    $request->all(), $validation
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $coupon           = Coupon::find($coupon->id);
                $coupon->name     = $request->name;
                $coupon->type = $request->type;
                $coupon->discount = $request->type==="discount" ? $request->discount : 0;
                $coupon->limit    = $request->limit;
                $coupon->code     = strtoupper($request->code);
                $coupon->plans = json_encode($request->plans);
                $coupon->duration = $request->type==="redeemable" ? $request->duration : 0;

                $coupon->save();

                return redirect()->route('coupons.index')->with('success', __('Coupon successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(Coupon $coupon)
    {
        if(\Auth::user()->can('Delete Coupans')){
            if(\Auth::user()->type == 'super admin')
            {
                $coupon->delete();
    
                return redirect()->route('coupons.index')->with('success', __('Coupon successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else{
            return redirect()->back()->with('error', __('Permission denied.'));
        }
       
    }


    public function payWithRedeemCoupon(Request $request) {
        $plan = Plan::find(\Illuminate\Support\Facades\Crypt::decrypt($request->plan_id));
        if($plan && $request->coupon != '')
        {
            $original_price = self::formatPrice($plan->price);
            $coupons        = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
            if(empty($coupons)) {
                return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
            }
            // If coupon is redeem coupon
            if($coupons->type!=="redeemable") {
                return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
            }
            // if coupon is not valid for this plan
            if(!in_array($plan->id, json_decode($coupons->plans))) {
                return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
            }

            $usedCoupun = $coupons->used_coupon();
            if($coupons->limit == $usedCoupun)
            {
                return redirect()->back()->with('error', __('This coupon code has expired.'));
            }

            // Valid coupon
            $user = User::find(\Auth::user()->id);
            $assignPlan = $user->assignPlan($plan->id, $coupons->duration);
            if ($assignPlan['is_success'] == true) {
                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                PlanOrder::create(
                    [
                        'order_id' => $orderID,
                        'name' => null,
                        'card_number' => null,
                        'card_exp_month' => null,
                        'card_exp_year' => null,
                        'plan_name' => $plan->name,
                        'plan_id' => $plan->id,
                        'price' => $plan->price,
                        'price_currency' => Utility::getValByName('site_currency'),
                        'txn_id' => '',
                        'payment_status' => 'succeeded',
                        'receipt' => null,
                        'payment_type' => __('Redeemable'),
                        'user_id' => $user->id,
                    ]
                );
                $userCoupon         = new UserCoupon();
                $userCoupon->user   = $user->id;
                $userCoupon->coupon = $coupons->id;
                $userCoupon->order  = $orderID;
                $userCoupon->save();
                if($coupons->limit <= $usedCoupun)
                {
                    $coupons->is_active = 0;
                    $coupons->save();
                }
                redirect()->route('plans.index')->with('success', __('Plan successfully upgraded.'));
            } else {
                return redirect()->back()->with('error', __('Plan fail to upgrade.'));
            }
        } else {
            return redirect()->back()->with('error', __('Invalid Coupon or Plan.'));
        }
    }

    public function applyCoupon(Request $request)
    {
        $plan = Plan::find(\Illuminate\Support\Facades\Crypt::decrypt($request->plan_id));
        if($plan && $request->coupon != '')
        {
            $original_price = self::formatPrice($plan->price);
            $coupons        = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();

            if(!empty($coupons))
            {
                // If coupon is redeem coupon
                if($coupons->type!=="discount") {
                    return response()->json(
                        [
                            'is_success' => false,
                            'final_price' => $original_price,
                            'price' => number_format($plan->price, \Utility::getValByName('decimal_number')),
                            'message' => __('This coupon code is invalid.'),
                        ]
                    );   
                }
                // if coupon is not valid for this plan
                if(!in_array($plan->id, json_decode($coupons->plans))) {
                    return response()->json(
                        [
                            'is_success' => false,
                            'final_price' => $original_price,
                            'price' => number_format($plan->price, \Utility::getValByName('decimal_number')),
                            'message' => __('This coupon code is not valid for this plan.'),
                        ]
                    );
                }
                $usedCoupun = $coupons->used_coupon();
                if($coupons->limit == $usedCoupun)
                {
                    return response()->json(
                        [
                            'is_success' => false,
                            'final_price' => $original_price,
                            'price' => number_format($plan->price, \Utility::getValByName('decimal_number')),
                            'message' => __('This coupon code has expired.'),
                        ]
                    );
                }
                else
                {

                    $discount_value = ($plan->price / 100) * $coupons->discount;
                    $plan_price     = $plan->price - $discount_value;
                    $price          = self::formatPrice($plan->price - $discount_value);
                    $discount_value = '-' . self::formatPrice($discount_value);

                    return response()->json(
                        [
                            'is_success' => true,
                            'discount_price' => $discount_value,
                            'final_price' => $price,
                            'price' => number_format($plan_price, Utility::getValByName('decimal_number')),
                            'message' => __('Coupon code has applied successfully.'),
                        ]
                    );
                }
            }
            else
            {
                return response()->json(
                    [
                        'is_success' => false,
                        'final_price' => $original_price,
                        'price' => number_format($plan->price, Utility::getValByName('decimal_number')),
                        'message' => __('This coupon code is invalid or has expired.'),
                    ]
                );
            }
        }
    }

    public function formatPrice($price){
        return env('CURRENCY_SYMBOL') . number_format($price);
    }
}
