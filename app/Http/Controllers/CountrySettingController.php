<?php

namespace App\Http\Controllers;

use App\Models\CountrySetting;
use Illuminate\Http\Request;
use App\Models\Utility;
use Artisan;
use Illuminate\Support\Facades\Auth;


class CountrySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Manage Settings')){
            $validator = \Validator::make(
                $request->all(), [
                    'country'=>'required',
                    'stripe_currency'=>'required',
                    'store_currency'=>'required',
                    'system_language'=>'required',
                    'store_language'=>'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            CountrySetting::create([
                'name'=>$request->country,
                'stripe_currency'=>$request->stripe_currency,
                'store_currency'=>$request->store_currency,
                'system_language'=>$request->system_language,
                'store_language'=>$request->store_language,
            ]);
            return redirect()->back()->with('success', __('Custom Country setting successfully created.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountrySetting  $countrySetting
     * @return \Illuminate\Http\Response
     */
    public function show(CountrySetting $countrySetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountrySetting  $countrySetting
     * @return \Illuminate\Http\Response
     */
    public function edit(CountrySetting $countrySetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CountrySetting  $countrySetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CountrySetting $countrySetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountrySetting  $countrySetting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->can('Manage Settings')){
            $countrySetting = CountrySetting::findorfail($id);
            $countrySetting->delete();
            return redirect()->back()->with('success', __('Custom Country setting deleted succesfully.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveDefaultCountrySetting(Request $request) {
        if(\Auth::user()->can('Manage Settings')) {
            $validator = \Validator::make(
                $request->all(), [
                    'stripe_currency'=>'required',
                    'store_currency'=>'required',
                    'system_language'=>'required',
                    'store_language'=>'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $request->user = Auth::user()->creatorId();

            $arrEnv = [
                'STRIPE_CURRENCY' => $request->stripe_currency,
                'STORE_CURRENCY' => $request->store_currency,
                'SYSTEM_LANGUAGE' => $request->system_language,
                'STORE_LANGUAGE' => $request->store_language,
            ];
            Artisan::call('config:cache');
            Artisan::call('config:clear');
            Utility::setEnvironmentValue($arrEnv);
            $post = $request->all();
            foreach ($post as $key => $data) {
                $settings = Utility::settings();
                if (in_array($key, array_keys($settings))) {
                    \DB::insert(
                        'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                            $data,
                            $key,
                            $request->user,
                            date('Y-m-d H:i:s'),
                            date('Y-m-d H:i:s'),
                        ]
                    );
                }
            }
            return redirect()->back()->with('success', __('Country setting successfully saved.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
