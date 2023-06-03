@foreach($plans as $plan)
    @php
        $planPrice = $plan->getPlanPrice();
    @endphp
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col ml-n2">
                <a href="#!" class="d-block h6 mb-0">{{$plan->name}}</a>
                @if($planPrice)
                <div>
                    <span class="text-sm">{!! getCurrencySymbol($planPrice->currency) !!}{{\App\Models\Utility::simplePriceFormat($planPrice->monthly)}} {{' / '. __(\App\Models\Plan::$arrDuration['Month'])}}</span>
                </div>
                <div>
                    <span class="text-sm">{!! getCurrencySymbol($planPrice->currency) !!}{{\App\Models\Utility::simplePriceFormat($planPrice->yearly)}} {{' / '. __(\App\Models\Plan::$arrDuration['Year'])}}</span>
                </div>
                @else
                <div>
                    <span class="text-sm">{{\App\Models\Utility::priceFormat($plan->price)}} {{' / '. __(\App\Models\Plan::$arrDuration[$plan->duration])}}</span>
                </div>
                @endif
            </div>
            <div class="col ml-n2">
                <a href="#!" class="d-block h6 mb-0">{{__('Stores')}}</a>
                <div>
                    <span class="text-sm">{{$plan->max_stores}}</span>
                </div>
            </div>
            <div class="col ml-n2">
                <a href="#!" class="d-block h6 mb-0">{{__('Products')}}</a>
                <div>
                    <span class="text-sm">{{$plan->max_products}}</span>
                </div>
            </div>
            <div class="col-auto">
                @if($user->plan==$plan->id)
                <span class="d-flex align-items-center ">
                    <i class="f-10 lh-1 fas fa-circle text-primary"></i>
                    <span class="ms-2">{{ __('Active')}}</span>
                </span>
                @else
                <div class="btn-group card-option">
                    <button title="{{__('Click to Upgrade Plan')}}" type="button" class="btn btn-xs btn-primary btn-icon" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="btn-inner--icon"><i class="fas fa-cart-plus"></i></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <a href="{{route('plan.active',[$user->id,$plan->id,'month'])}}" data-size="md" class="dropdown-item"><i
                                class="ti ti-trophy"></i>
                            <span>{{ __('Upgrade for a Month') }}</span></a>

                        <a href="{{route('plan.active',[$user->id,$plan->id,'year'])}}" data-size="md"  class="dropdown-item"><i class="ti ti-trophy"></i>
                            <span>{{ __('Upgrade for a Year') }}</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @if($user->plan==$plan->id)
        <div class="form-group mt-4 form-group-sm">
            <label class="col-form-label text-sm">Plan Expiration Date</label>
            <input class="form-control  form-control-sm" value="{{$user->plan_expire_date}}" disabled/>
        </div>

        @endif
    </div>
@endforeach
