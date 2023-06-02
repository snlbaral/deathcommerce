@extends('layouts.admin')
@section('page-title')
    {{ __('Plans') }}
@endsection
@php
    $dir = asset(Storage::url('uploads/plan'));
@endphp
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Plans') }}</li>
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 ">{{ __('Plans') }}</h5>
    </div>
@endsection
@section('action-btn')

    @if (Auth::user()->type == 'super admin')
    @if ((isset($admin_payments_setting['is_stripe_enabled']) && $admin_payments_setting['is_stripe_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_paypal_enabled']) && $admin_payments_setting['is_paypal_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_paystack_enabled']) && $admin_payments_setting['is_paystack_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_flutterwave_enabled']) && $admin_payments_setting['is_flutterwave_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_razorpay_enabled']) && $admin_payments_setting['is_razorpay_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_mercado_enabled']) && $admin_payments_setting['is_mercado_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_paytm_enabled']) && $admin_payments_setting['is_paytm_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_mollie_enabled']) && $admin_payments_setting['is_mollie_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_skrill_enabled']) && $admin_payments_setting['is_skrill_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_coingate_enabled']) && $admin_payments_setting['is_coingate_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_paymentwall_enabled']) && $admin_payments_setting['is_paymentwall_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_toyyibpay_enabled']) && $admin_payments_setting['is_toyyibpay_enabled'] == 'on') ||
    (isset($admin_payments_setting['is_payfast_enabled']) && $admin_payments_setting['is_payfast_enabled'] == 'on')
    )
            @can('Create Plans')
                <a class="btn btn-sm btn-icon  btn-primary me-2 text-white" data-url="{{ route('plans.create') }}" data-title="{{ __('Add Plan') }}" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Add Plan') }}">
                    <i  data-feather="plus"></i>
                </a>
            @endcan
        @endif
    @endif
@endsection
@section('content')


@if( \Auth::user()->type !== 'super admin')
    <div class="row">
        @foreach ($plans as $plan)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="plan_card">
                    <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                                        visibility: visible;
                                        animation-delay: 0.2s;
                                        animation-name: fadeInUp;
                                      ">
                        <div class="card-body">
                            <span class="price-badge bg-primary">{{ $plan->name }}</span>
                            @if (\Auth::user()->type !== 'super admin' && \Auth::user()->plan == $plan->id)
                                <div class="d-flex flex-row-reverse m-0 p-0 plan-active-status">
                                    <span class="d-flex align-items-center ">
                                        <i class="f-10 lh-1 fas fa-circle text-primary"></i>
                                        <span class="ms-2">{{ __('Active') }}</span>
                                    </span>
                                </div>
                            @endif
    
                            <div class="text-end">
                                <div class="">
                                    @if( \Auth::user()->type == 'super admin')
                                        @can('Edit Plans')
                                            <div class="d-inline-flex align-items-center">
                                                <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-url="{{ route('plans.edit',$plan->id) }}" data-title="{{__('Edit Plan')}}" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit') }}">
                                                    <i  class="ti ti-edit f-20"></i>
                                                </a>
                                            </div>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                            <h3 class="mb-4 f-w-600">
                                {{ env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$' }}{{ $plan->price . ' / ' . __(\App\Models\Plan::$arrDuration[$plan->duration]) }}</small>
                            </h3>
                            <div class="plan-card-detail text-center">
                                <p class="mb-0">
                                    {{ __('Trial : ') . $plan->trial_days . __(' Days') }}<br />
                                </p>
    
                                <ul class="list-unstyled d-inline-block my-4">
                                    @if ($plan->enable_custdomain == 'on')
                                        <li class="d-flex align-items-center">
                                            <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>{{ __('Custom Domain') }}
                                        </li>
                                    @else
                                        <li class="text-danger d-flex align-items-center">
                                                <span class="theme-avtar">
                                                <i class="text-danger ti ti-circle-plus"></i></span>{{ __('Custom Domain') }}
                                        </li>
                                    @endif
                                    @if ($plan->enable_custsubdomain == 'on')
                                        <li class="d-flex align-items-center">
                                                <span class="theme-avtar">
                                                <i class="text-primary ti ti-circle-plus"></i></span>{{ __('Sub Domain') }}
                                        </li>
                                    @else
                                        <li class="text-danger d-flex align-items-center">
                                                    <span class="theme-avtar">
                                                <i class="text-danger ti ti-circle-plus"></i></span>{{ __('Sub Domain') }}
                                        </li>
                                    @endif
                                    @if ($plan->shipping_method == 'on')
                                        <li class="d-flex align-items-center">
                                                <span class="theme-avtar">
                                                    <i class="text-primary ti ti-circle-plus"></i></span>{{ __('Shipping Method') }}
                                        </li>
                                    @else
                                        <li class="text-danger d-flex align-items-center">
                                                <span class="theme-avtar">
                                                    <i class="text-danger ti ti-circle-plus"></i></span>{{ __('Shipping Method') }}
                                        </li>
                                    @endif
    
                                    @if ($plan->additional_page == 'on')
                                        <li class="d-flex align-items-center">
                                                <span class="theme-avtar">
                                                    <i class="text-primary ti ti-circle-plus"></i></span>{{ __('Additional Page') }}
                                        </li>
                                    @else
                                        <li class="text-danger d-flex align-items-center">
                                                <span class="theme-avtar">
                                                <i class="text-danger ti ti-circle-plus"></i></span>{{ __('Additional Page') }}
                                        </li>
                                    @endif
                                    @if ($plan->blog == 'on')
                                        <li class="d-flex align-items-center">
                                                <span class="theme-avtar">
                                                    <i class="text-primary ti ti-circle-plus"></i></span>{{ __('Blog') }}
                                        </li>
                                    @else
                                        <li class="text-danger d-flex align-items-center">
                                                <span class="theme-avtar">
                                                    <i class="text-danger ti ti-circle-plus"></i></span>{{ __('Blog') }}
                                        </li>
    
                                    @endif
                                     <li class="d-flex align-items-center">
                                        @if ($plan->pwa_store == 'on')
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i
                                        ></span>
                                            {{ __('Progressive Web App (PWA)') }}
                                        @else
                                            <span class="theme-avtar">
                                            <i class="text-danger ti ti-circle-plus"></i
                                            ></span>
                                        {{ __('Progressive Web App (PWA)') }}
    
                                        @endif
                                    </li>
                                </ul>
                                @if ($plan->description)
                                    <p>
                                        {{ $plan->description }}<br />
                                    </p>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 text-center">
                                    @if ($plan->max_products == '-1')
                                        <span class="h5 mb-0">{{ __('Lifetime') }}</span>
                                    @else
                                        <span class="h5 mb-0">{{ $plan->max_products }}</span>
                                    @endif
                                    <span class="d-block text-sm">{{ __('Products') }}</span>
                                </div>
                                <div class="col-4 text-center">
                                        <span class="h5 mb-0">
                                            @if ($plan->max_stores == '-1')
                                                <span class="h5 mb-0">{{ __('Lifetime') }}</span>
                                            @else
                                                <span class="h5 mb-0">{{ $plan->max_stores }}</span>
                                            @endif
                                        </span>
                                    <span class="d-block text-sm">{{ __('Store') }}</span>
                                </div>
                                <div class="col-4 text-center">
                                    <span class="h5 mb-0">
                                        @if ($plan->max_users == '-1')
                                            <span class="h5 mb-0">{{ __('Lifetime') }}</span>
                                        @else
                                            <span class="h5 mb-0">{{ $plan->max_users }}</span>
                                        @endif
                                    </span>
                                    <span class="d-block text-sm">{{ __('Users') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                @if (\Auth::user()->type != 'super admin')
                                    @if($plan->price <= 0)
                                        <div class="col-12">
                                            <p class="server-plan font-bold text-center mx-sm-5 mt-4">
                                                {{ __('Lifetime') }}
                                            </p>
                                        </div>
                                    @elseif (\Auth::user()->plan == $plan->id && date('Y-m-d') < \Auth::user()->plan_expire_date && \Auth::user()->is_trial_done != 1)
                                        <h5 class="h6 my-4">
                                            {{ __('Expired : ') }}
                                            {{ \Auth::user()->plan_expire_date? \App\Models\Utility::dateFormat(\Auth::user()->plan_expire_date): __('Lifetime') }}
                                        </h5>
                                    @elseif(\Auth::user()->plan == $plan->id && !empty(\Auth::user()->plan_expire_date) && \Auth::user()->plan_expire_date < date('Y-m-d'))
                                        <div class="col-12">
                                            <p class="server-plan font-weight-bold text-center mx-sm-5">
                                                {{ __('Expired') }}
                                            </p>
                                        </div>
                                    @else
                                        <div class="{{ $plan->id == 1 ? 'col-12' : 'col-8' }}">
                                            <a href="{{ route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)) }}"
                                               class="btn  btn-primary d-flex justify-content-center align-items-center ">{{ __('Subscribe') }}
                                                <i class="fas fa-arrow-right m-1"></i></a>
                                            <p></p>
                                        </div>
                                    @endif
                                @endif
                                @if (\Auth::user()->type != 'super admin' && \Auth::user()->plan != $plan->id)
                                    @if ($plan->id != 1)
                                        @if (\Auth::user()->requested_plan != $plan->id)
                                            <div class="col-4">
                                                <a href="{{ route('send.request',[\Illuminate\Support\Facades\Crypt::encrypt($plan->id)]) }}"
                                                   class="btn btn-primary btn-icon"
                                                   data-title="{{ __('Send Request') }}"  data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="{{ __('Send Request') }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-share"></i></span>
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-4">
                                                <a href="{{  route('request.cancel',\Auth::user()->id) }} }}"
                                                   class="btn btn-icon m-1 btn-danger"
                                                   data-title="{{ __('Cancle Request') }}"  data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title="{{ __('Cancel Request') }}">
                                                    <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable ">
                            <thead>
                            <tr>
                                <th> {{ __('Name') }}</th>
                                <th>{{ __('Order') }}</th>
                                <th>{{ __('Users') }}</th>
                                <th> {{ __('Status') }}</th>
                                <th> {{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                <tr>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->get_plan_orders_count() }}</td>
                                    <td>{{ $plan->get_plan_users_count() }}</td>
                                    <td>{{$plan->getPlanStatus()}}</td>
                                    <td>
                                        @if( \Auth::user()->type == 'super admin')
                                            @can('Edit Plans')
                                                <div class="d-inline-flex align-items-center">
                                                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-url="{{ route('plans.edit',$plan->id) }}" data-title="{{__('Edit Plan')}}" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Edit') }}">
                                                        <i  class="ti ti-edit f-20"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('Manage Plans')
                                                <div class="d-inline-flex align-items-center">
                                                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="{{route('plans.show', $plan->id)}}" title="{{ __('Add Pricing') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 320 512"><path d="M160 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3c-16.1-7.2-23.4-26.1-16.2-42.2s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C119.4 279.3 84.4 270 58.4 253c-14.2-9.3-27.5-22-35.8-39.6c-8.4-17.9-10.1-37.9-6.1-59.2C23.7 116 52.3 91.2 84.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z"/></svg>
                                                    </a>
                                                </div>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable ">
                            <thead>
                            <tr>
                                <th> {{ __('Order Id') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Plan Name') }}</th>
                                <th> {{ __('Price') }}</th>
                                <th> {{ __('Payment Type') }}</th>
                                <th> {{ __('Status') }}</th>
                                <th> {{ __('Coupon') }}</th>
                                <th> {{ __('Invoice') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->plan_name }}</td>
                                    <td>{{ env('CURRENCY_SYMBOL') . $order->price }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>
                                        @if ($order->payment_status == 'succeeded')
                                            <i class="mdi mdi-circle text-primary"></i>
                                            {{ ucfirst($order->payment_status) }}
                                        @else
                                            <i class="mdi mdi-circle text-danger"></i>
                                            {{ ucfirst($order->payment_status) }}
                                        @endif
                                    </td>

                                    <td>{{ !empty($order->total_coupon_used)? (!empty($order->total_coupon_used->coupon_detail)? $order->total_coupon_used->coupon_detail->code: '-'): '-' }}
                                    </td>

                                    <td class="text-center">
                                        @if ($order->receipt != 'free coupon' && $order->payment_type == 'STRIPE')
                                            <a href="{{ $order->receipt }}" title="Invoice" target="_blank"
                                               class="btn btn-sm btn-icon  bg-light-secondary "><i class="fas fa-download"></i> </a>
                                        @elseif($order->receipt == 'free coupon')
                                            <p>{{ __('Used') . '100 %' . __('discount coupon code.') }}</p>
                                        @elseif($order->payment_type == 'Manually')
                                            <p>{{ __('Manually plan upgraded by super admin') }}</p>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                var tohref = '';
                @if (Auth::user()->is_register_trial == 1)
                    tohref = $('#trial_{{ Auth::user()->interested_plan_id }}').attr("href");
                @elseif(Auth::user()->interested_plan_id != 0)
                    tohref = $('#interested_plan_{{ Auth::user()->interested_plan_id }}').attr("href");
                @endif
    
                if (tohref != '') {
                    window.location = tohref;
                }
            });
        </script>
    @endpush
@endsection

