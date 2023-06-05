@php
    $countries = getCountriesList();
@endphp
@extends('layouts.admin')
@section('page-title')
    {{ __('Shipping') }}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-2">{{ __('Shipping') }}</h5>
    </div>
@endsection
@push('css-page')
    <style>
        .btn-sm {
            padding: 0.5rem 0.5rem;
        }
    </style>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('shipping.index') }}">{{ __('Shipping') }}</a></li>
    <li class="breadcrumb-item active text-capitalize" aria-current="page">{{ __($slug) }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if($deliveryMethod)
                <h3>{{__('Edit Custom Shipping')}}</h3>
                @else
                <h3>{{__('Add Custom Shipping')}}</h3>
                @endif
            </div>
            <div class="card-body">
                {{ Form::open(['route' => ['shipping.new-delivery.store', $slug], 'method' => 'post', 'enctype' => 'multipart/form-data', 'id'=>'deliveryForm']) }}
                    <input type="hidden" name="type" value="{{$slug}}"/>
                    <input type="hidden" name="id" value="{{$deliveryMethod['id'] ?? 0}}"/>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('shipping_name',__('Shipping Option Name'),array('class'=>'col-form-label')) }}
                                {{Form::text('shipping_name', $deliveryMethod['data']['shipping_name'] ?? old('shipping_name'),array('class'=>'form-control','placeholder'=>__('Name'),'required'=>'required'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('shipping_zones',__('Shipping Zones'),array('class'=>'col-form-label')) }}
                                <div class="form-check form-switch">
                                    <input type="hidden" name="shipping_zones" value="limit_by_city_and_states"/>
                                    <input type="checkbox" name="shipping_zones" class="form-check-input"
                                        name="shipping_zones" checked disabled/>
                                    <label class="form-check-label mb-3">Limit by City and States</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            {{Form::label('country',__('Country'),array('class'=>'col-form-label')) }}
                                <select class="form-control country_select" name="country" required>
                                    @foreach ($countries as $country)
                                        @if($deliveryMethod)
                                            <option data-id="{{$country['id']}}" value="{{$country['country']}}" @if(strtolower($country['country'])==strtolower($deliveryMethod['data']['country'])) selected @endif>{{$country['country']}}</option>
                                        @else
                                            <option data-id="{{$country['id']}}" value="{{$country['country']}}" @if(strtolower($country['country'])==strtolower($store->country)) selected @endif>{{$country['country']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                            {{Form::label('state',__('State'),array('class'=>'col-form-label')) }}
                                <select class="form-control state_select" name="state[]" required multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('city',__('City'),array('class'=>'col-form-label')) }}
                                <select class="form-control city_select" name="city[]" required multiple>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="enable_shipping_cost" value="off"/>
                                    <input type="checkbox" class="form-check-input"
                                        name="enable_shipping_cost" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_cost']=="on") checked @endif/>
                                    {{ Form::label('enable_shipping_cost', __('Shipping Cost'), ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group col shippingCost" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_cost']=="on")  style="display:block" @else style="display: none" @endif>
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">{{$store['currency'] ?? env("STORE_CURRENCY")}}</span>
                                    <input type="number" name="shipping_cost" class="form-control" placeholder="{{$store['currency'] ?? env("STORE_CURRENCY")}}" value="{{$deliveryMethod['data']['shipping_cost'] ?? ''}}">
                                </div>
                                <small class="text-secondary">If the shipping value is R$0, then it will be displayed as free in your store.</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="enable_shipping_deadlines" value="off"/>
                                    <input type="checkbox" class="form-check-input"
                                        name="enable_shipping_deadlines" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_deadlines']=="on") checked @endif/>
                                    {{ Form::label('enable_shipping_deadlines', __('Shipping deadlines'), ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col shippingDeadlines" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_deadlines']=="on") style="display:block" @else style="display: none" @endif>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="col-form-label text-sm me-2">From</label>
                                            <input type="number" name="shipping_deadlines_from" class="form-control" placeholder="Ex: 1" value="{{$deliveryMethod['data']['shipping_deadlines_from'] ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col shippingDeadlines" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_deadlines']=="on") style="display:block" @else style="display: none" @endif>
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="col-form-label text-sm me-2">To</label>
                                            <input type="number" name="shipping_deadlines_to" class="form-control" placeholder="Ex: 3" value="{{$deliveryMethod['data']['shipping_deadlines_to'] ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col shippingDeadlines" @if($deliveryMethod && $deliveryMethod['data']['enable_shipping_deadlines']=="on") style="display:block" @else style="display: none" @endif>
                                        <button class="btn btn-sm" disabled>Working Days</button>
                                    </div>
                                </div>
                                <small class="text-secondary">If it is disabled, the shipping deadlines will not appear.</small>
                            </div>
                        </div>

                        <h4 class="my-4">Limit this option by</h4>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="enable_cart_total_weight" value="off"/>
                                    <input type="checkbox" class="form-check-input"
                                        name="enable_cart_total_weight" @if($deliveryMethod && $deliveryMethod['data']['enable_cart_total_weight']=="on") checked @endif/>
                                    {{ Form::label('enable_cart_total_weight', __('Cart total weight'), ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col cartTotalWeight" @if($deliveryMethod && $deliveryMethod['data']['enable_cart_total_weight']=="on") style="display:block" @else style="display: none" @endif>
                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-form-label text-sm me-2">From</label>
                                        <input type="number" name="cart_total_weight_from" class="form-control" placeholder="Kg" value="{{$deliveryMethod['data']['cart_total_weight_from'] ?? ''}}">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Kg</span>
                                    </div>
                                </div>
                                <div class="col cartTotalWeight" @if($deliveryMethod && $deliveryMethod['data']['enable_cart_total_weight']=="on") style="display:block" @else style="display: none" @endif>
                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-form-label text-sm me-2">To</label>
                                        <input type="number" name="cart_total_weight_to" class="form-control" placeholder="Kg" value="{{$deliveryMethod['data']['cart_total_weight_to'] ?? ''}}">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Kg</span>
                                    </div>
                                </div>
                             </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="enable_total_purchase_amount" value="off"/>
                                    <input type="checkbox" class="form-check-input"
                                        name="enable_total_purchase_amount" @if($deliveryMethod && $deliveryMethod['data']['enable_total_purchase_amount']=="on") checked @endif/>
                                    {{ Form::label('enable_total_purchase_amount', __('Total purchase amount'), ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col totalPurchaseAmount" @if($deliveryMethod && $deliveryMethod['data']['enable_total_purchase_amount']=="on") style="display:block" @else style="display: none" @endif>
                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-form-label text-sm me-2">From</label>
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{$store['currency'] ?? env("STORE_CURRENCY")}}</span>
                                        <input type="number" name="total_purchase_amount_from" class="form-control" placeholder="{{$store['currency'] ?? env("STORE_CURRENCY")}}" value="{{$deliveryMethod['data']['total_purchase_amount_from'] ?? ''}}">
                                    </div>
                                </div>
                                <div class="col totalPurchaseAmount"  @if($deliveryMethod && $deliveryMethod['data']['enable_total_purchase_amount']=="on") style="display:block" @else style="display: none" @endif>
                                    <div class="input-group input-group-sm mb-3">
                                        <label class="col-form-label text-sm me-2">To</label>
                                        <span class="input-group-text" id="inputGroup-sizing-sm">{{$store['currency'] ?? env("STORE_CURRENCY")}}</span>
                                        <input type="number" name="total_purchase_amount_to" class="form-control" placeholder="{{$store['currency'] ?? env("STORE_CURRENCY")}}" value="{{$deliveryMethod['data']['total_purchase_amount_to'] ?? ''}}">
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group col-12 d-flex justify-content-end col-form-label">
                                <input type="submit" value="{{ __('Save') }}" class="btn btn-success ms-2 submit">
                            </div>
                        </div>
                    </div>


                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

@push("script-page")
    <script>
        $(document).ready(function(){
            const countires = {!! json_encode($countries) !!};
            const store_country = "{{$store->country}}"
            const store_state = "{{$store->state}}"
            const delivery_method = {!! json_encode($deliveryMethod) !!}
            function getStates(countryId) {
                $.ajax({
                    url: "/api/states/"+countryId,
                    success: function ({status, data}) {
                        if(status) {
                            var newOption = new Option("Select State", "", false, false);
                            $('.state_select').append(newOption).trigger('change');
                            var state_ids = []
                            data.forEach(state => {
                                var isSelected = delivery_method && delivery_method?.data?.state?.includes(state.name) ? true : false
                                if(isSelected) {
                                    state_ids.push(state.id)
                                }
                                var newOption = new Option(state.name, state.name, isSelected, isSelected);
                                $(newOption).data('id', state.id);
                                $('.state_select').append(newOption).trigger('change');
                            });
                            if(state_ids && state_ids.length) {
                                getCities(countryId, state_ids)
                            }
                        } else {
                            show_toastr('Error', '{{ __('Some Error Occurred.') }}', 'error')
                        }
                    },
                    error: function (error) {
                        show_toastr('Error', '{{ __('Some Error Occurred.') }}', 'error')
                    }
                });
            }

            function getCities(countryId, stateIds) {
                $.ajax({
                    url: "/api/cities/"+countryId,
                    method: "POST",
                    data: { 
                        state_ids:stateIds
                    },
                    success: function ({status, data}) {
                        if(status) {
                            var newOption = new Option("Select City", "", false, false);
                            $('.city_select').append(newOption).trigger('change');
                            var selectedCities = delivery_method && delivery_method?.data?.city ? delivery_method?.data?.city : []
                            data.forEach(city => {
                                var isSelected = delivery_method && delivery_method?.data?.city?.includes(city.name) ? true : false
                                if(isSelected) {
                                    selectedCities = selectedCities.filter(c=>c!=city.name)
                                }
                                var newOption = new Option(city.name, city.name, isSelected, isSelected);
                                $('.city_select').append(newOption).trigger('change');
                            });
                            if(selectedCities && selectedCities.length) {
                                selectedCities.forEach(c=>{
                                    var newOption = new Option(c, c, true, true);
                                    $('.city_select').append(newOption).trigger('change');
                                })
                            }
                        } else {
                            show_toastr('Error', '{{ __('Some Error Occurred.') }}', 'error')
                        }
                    },
                    error: function (error) {
                        show_toastr('Error', '{{ __('Some Error Occurred.') }}', 'error')
                    }
                });
            }


            $(".country_select").on("select2:select", function(){
                const id = $(this).find(':selected').data('id')
                $('.state_select').empty().trigger("change");
                $('.city_select').empty().trigger("change");
                getStates(id)
            })

            $('.state_select').on('select2:select', function (e) {
                // Do something
                var state_ids = [];
                // Loop through the selected option elements
                $(this).find("option:selected").each(function () {
                    var dataId = $(this).data("id");
                    state_ids.push(dataId);
                });
                const countryId = $(".country_select").find(':selected').data('id')
                $('.city_select').empty().trigger("change");
                getCities(countryId, state_ids)
            });

        
            function updateCountrySelect(countryCode) {
                var country = countires.find(c=>c.code===countryCode)
                if(country) {
                    getStates(country.id)
                    $('.country_select').val(country.country);
                    $('.country_select').trigger('change');
                    localStorage.setItem('country_code', countryCode)
                }
            }
            
            if(!store_country) {
                var country_code = localStorage.getItem("country_code")
                if(!country_code) {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        updateCountrySelect(countryCode)
                    })
                } else {
                    updateCountrySelect(country_code)
                }
            } else {
                var country = countires.find(c=>c.country.toLowerCase()===store_country.toLowerCase())
                getStates(country.id)
            }

            $(".country_select").select2({
                search: true,
                placeholder: "{{__('Enter Your Country')}}"
            })
            $(".state_select").select2({
                search: true,
                placeholder: "{{__('Enter Your State')}}",
                multiple: true,
            })
            $(".city_select").select2({
                search: true,
                placeholder: "{{__('Enter Your City')}}",
                multiple: true,
                tags: true,
            })

            $("input[name='enable_shipping_cost']").on("change", function(){
                if($(this).prop('checked')) {
                    $(".shippingCost").show()
                    $("input[name='shipping_cost']").prop('required', true);
                } else {
                    $(".shippingCost").hide()
                    $("input[name='shipping_cost']").prop('required', false);
                }
            })
            $("input[name='enable_shipping_deadlines']").on("change", function(){
                if($(this).prop('checked')) {
                    $(".shippingDeadlines").show()
                    $("input[name='shipping_deadlines_from']").prop('required', true);
                    $("input[name='shipping_deadlines_to']").prop('required', true);
                } else {
                    $(".shippingDeadlines").hide()
                    $("input[name='shipping_deadlines_from']").prop('required', false);
                    $("input[name='shipping_deadlines_to']").prop('required', false);
                }
            })
            $("input[name='enable_cart_total_weight']").on("change", function(){
                if($(this).prop('checked')) {
                    $(".cartTotalWeight").show()
                    $("input[name='cart_total_weight_from']").prop('required', true);
                    $("input[name='cart_total_weight_to']").prop('required', true);
                } else {
                    $(".cartTotalWeight").hide()
                    $("input[name='cart_total_weight_from']").prop('required', false);
                    $("input[name='cart_total_weight_to']").prop('required', false);
                }
            })
            $("input[name='enable_total_purchase_amount']").on("change", function(){
                if($(this).prop('checked')) {
                    $(".totalPurchaseAmount").show()
                    $("input[name='total_purchase_amount_from']").prop('required', true);
                    $("input[name='total_purchase_amount_to']").prop('required', true);
                } else {
                    $(".totalPurchaseAmount").hide()
                    $("input[name='total_purchase_amount_from']").prop('required', false);
                    $("input[name='total_purchase_amount_to']").prop('required', false);
                }
            })
        })
    </script>
@endpush
@endsection