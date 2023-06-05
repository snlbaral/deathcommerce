@php
    $countries = getCountriesList();
    $requiredFields = ['country','state','city','zipcode','address'];
    $remainingFields = [];
    foreach ($requiredFields as $key => $field) {
        if(!$store[$field]) {
            array_push($remainingFields, $field);
        }
    }
@endphp
<style>
    /*Hide all except first fieldset*/
    #deliveryForm fieldset:not(:first-of-type) {
        display: none;
    }
</style>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{__('Store and shipping origin address')}}</h3>
                        <a class="btn btn-sm btn-icon bg-light-secondary me-2" href="{{ route('settings')}}" title="{{ __('Edit Address') }}"><i  data-feather="edit"></i></a>
                    </div>
                    <div class="text-sm text-secondary">{{__('This is the address from which you ship your orders and is used to retrieve calculated shipping rates in real time.')}}</div>
                </div>
                @if($remainingFields)
                <div class="card-body">
                    <div class="alert alert-danger font-bold">
                        {{__('Please add the missing details to your store address by going to settings > store settings or click the icon below.')}}
                        <div class="mt-4">
                            <a class="btn btn-sm btn-icon bg-light-secondary text-center me-2" href="{{ route('settings')}}" title="{{ __('Add Address') }}"><i  data-feather="plus"></i></a>
                        </div>
                        <h6 class="mt-4">{{__('Missing Details:')}}</h6>
                        <ul>
                            @foreach ($remainingFields as $field)
                                <li>{{$field}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <div class="card-body">
                    {{ Form::open(['route' => ['shipping.new-delivery.store', $slug], 'method' => 'post', 'enctype' => 'multipart/form-data', 'id'=>'deliveryForm']) }}
                    <input type="hidden" name="type" value="{{$slug}}"/>
                    <fieldset>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col">
                                        {{Form::label('store_country',__('Country'),array('class'=>'col-form-label')) }}
                                        <input type="text" class="form-control" name="store_country" value="{{$store->country}}" readonly/>
                                        {{-- <select class="form-control country_select" name="store_country" required>
                                            @foreach ($countries as $country)
                                            <option  data-id="{{$country['id']}}" value="{{$country['country']}}"
                                            @if(strtolower($country['country'])==strtolower($store->country)) selected @endif>{{$country['country']}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    <div class="col">
                                        {{Form::label('store_state',__('State/Province/Region'),array('class'=>'col-form-label')) }}
                                        <input type="text" class="form-control" name="store_state" value="{{$store->state}}" readonly/>
                                        {{-- <select class="form-control state_select" name="store_state" required></select> --}}
                                    </div>
                                    <div class="col">
                                        {{Form::label('store_city',__('City'),array('class'=>'col-form-label')) }}
                                        <input type="text" class="form-control" name="store_city" value="{{$store->city}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col">
                                        {{Form::label('store_zipcode',__('Postal Code'),array('class'=>'col-form-label')) }}
                                        <input type="text" class="form-control" name="store_zipcode" value="{{$store->zipcode}}" readonly/>
                                        {{-- {{Form::number('store_zipcode', $deliveryMethod['data']['store_zipcode'] ?? old('store_zipcode'),array('class'=>'form-control','placeholder'=>__('Postal Code'),'required'=>'required'))}} --}}
                                    </div>
                                    <div class="col">
                                        {{Form::label('store_address',__('Address'),array('class'=>'col-form-label')) }}
                                        <input type="text" class="form-control" name="store_address" value="{{$store->address}}" readonly/>
                                        {{-- {{Form::text('store_address', $deliveryMethod['data']['store_address'] ?? old('store_address'),array('class'=>'form-control','placeholder'=>__('Enter Address'),'required'=>'required'))}} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-6">
                                        {{Form::label('store_name',__('Store Name'),array('class'=>'col-form-label')) }}
                                        {{Form::text('store_name', $deliveryMethod['data']['store_name'] ?? $store->name,array('class'=>'form-control','placeholder'=>__('Enter Store Name'),'required'=>'required', 'readonly'=>'readonly'))}}
                                    </div>
                                    <div class="col-6">
                                        {{Form::label('store_email',__('Email'),array('class'=>'col-form-label')) }}
                                        {{Form::email('store_email', $deliveryMethod['data']['store_email'] ?? $store->email,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required', 'readonly'=>'readonly'))}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 d-flex justify-content-end col-form-label">
                                <input type="button" value="{{ __('Next') }}" class="btn btn-danger ms-2 next">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    @foreach (getCorreiosMethods() as $method)
                                        <div class="list-group-item border-1 mb-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-block h6 mb-0">{{$method['name']}}</div>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input type="hidden" name="enable_{{$method['slug']}}" value="off"/>
                                                    <input type="checkbox" class="form-check-input enable_method"
                                                        name="enable_{{$method['slug']}}" data-method="{{$method['slug']}}" @if($deliveryMethod && $deliveryMethod['data']['enable_'.$method['slug']]=="on") checked @endif/>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-2 mb-2" id="{{$method['slug']}}_additional_fields" @if($deliveryMethod && $deliveryMethod['data']['enable_'.$method['slug']]=="on") style="display:flex" @else style="display: none" @endif>
                                                <div class="col">
                                                    <label class="col-form-label text-sm">Additional Cost (optional)</label>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                                        <input type="number" name="{{$method['slug']}}_additional_cost" class="form-control" value="{{$deliveryMethod['data'][$method['slug'].'_additional_cost'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label class="col-form-label text-sm">Additional days (optional)</label>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <input type="number" name="{{$method['slug']}}_additional_days" class="form-control" placeholder="Days" value="{{$deliveryMethod['data'][$method['slug'].'_additional_days'] ?? ''}}">
                                                        <span class="input-group-text" id="inputGroup-sizing-sm">Days</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <div class="alert alert-danger text-sm">Remember: Products that do not have weight and dimensions information cannot have the shipping cost calculated.</div>
                                <div class="form-group mt-4">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enable_default_weight_dimensions" value="off"/>
                                        <input type="checkbox" class="form-check-input"
                                            name="enable_default_weight_dimensions" @if($deliveryMethod && $deliveryMethod['data']['enable_default_weight_dimensions']=="on") checked @endif/>
                                        {{ Form::label('enable_default_weight_dimensions', __('Default Weight and Dimensions'), ['class' => 'form-check-label mb-3']) }}
                                    </div>
                                    <small>Enter a default weight and dimensions below, which can be used if any of your products are missing weight or dimensions information</small>
                                </div>
                                <div class="form-group mt-4 row">
                                    @foreach (getWeightDimensionsInput() as $input)
                                        <div class="col defaultWeightDimensions" @if($deliveryMethod && $deliveryMethod['data']['enable_default_weight_dimensions']=="on") style="display:block" @else style="display: none" @endif>
                                            <label class="col-form-label text-sm">{{$input['name']}}</label>
                                            <div class="input-group input-group-sm mb-3">
                                                <input type="number" name="default_{{$input['slug']}}" class="form-control" placeholder="{{$input['measurement']}}" value="{{$deliveryMethod['data']['default_'.$input['slug']] ?? ''}}">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">{{$input['measurement']}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="defaultWeightDimensionsAlerts mt-4" @if($deliveryMethod && $deliveryMethod['data']['enable_default_weight_dimensions']=="on") style="display:block" @else style="display: none" @endif>
                                        <div class="alert alert-danger text-sm">The weight is added in kilograms, so if you want to add the weight of 100 grams, you must enter the value “0.100”</div>
                                        <div class="alert alert-danger text-sm">Ideally, you should enter the weight and dimensions of the product and not the packaging, because if you have more than 1 product in your cart, the weight and dimensions will be added together.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="disable_pac_for_my_city" value="off"/>
                                        <input type="checkbox" class="form-check-input"
                                            name="disable_pac_for_my_city"  @if($deliveryMethod && $deliveryMethod['data']['disable_pac_for_my_city']=="on") checked @endif/>
                                        {{ Form::label('disable_pac_for_my_city', __('Disable PAC for my city'), ['class' => 'form-check-label mb-3']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 d-flex justify-content-end col-form-label">
                                <input type="button" value="{{ __('Previous') }}" class="btn btn-warning ms-2 previous">
                                <input type="submit" value="{{ __('Save') }}" class="btn btn-success ms-2 submit">
                            </div>
                        </div>
                    </fieldset>
                    {{Form::close()}}
                </div>
                @endif
            </div>
        </div>
    </div>

@push('script-page')
    <script>
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
                                var isSelected = delivery_method && delivery_method?.data?.store_state==state.name ? true : false
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
                            if(delivery_method && delivery_method?.data?.store_city) {
                                var fromTheList = data.find(city=>city.name==delivery_method?.data?.store_city)
                                if(!fromTheList) {
                                    var newOption = new Option(delivery_method?.data?.store_city, delivery_method?.data?.store_city, true, true);
                                    $('.city_select').append(newOption).trigger('change');
                                }
                            }
                            data.forEach(city => {
                                var isSelected = delivery_method && delivery_method?.data?.store_city==city.name ? true : false
                                var newOption = new Option(city.name, city.name, isSelected, isSelected);
                                $('.city_select').append(newOption).trigger('change');
                            });
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
        })
        $(".city_select").select2({
            search: true,
            placeholder: "{{__('Enter Your City')}}",
            tags: true,
        })
        
         $('.enable_method').change(function() {
             var method = $(this).data('method');
            if($(this).prop('checked')) {
                $(`#${method}_additional_fields`).show()
            } else {
                $(`#${method}_additional_fields`).hide()
            }
        });
        $("input[name='enable_default_weight_dimensions']").on("change", function(){
            if($(this).prop('checked')) {
                $(".defaultWeightDimensions").show()
                $(".defaultWeightDimensionsAlerts").show()
                $('.defaultWeightDimensions > div > input').prop('required', true);
            } else {
                $(".defaultWeightDimensions").hide()
                $(".defaultWeightDimensionsAlerts").hide()
                $('.defaultWeightDimensions > div > input').prop('required', false);
            }
        })
        // form validation
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
        function checkFormValidation() {
            var form = document.getElementById("deliveryForm");
            var invalidInput = null;
            var formValid = true;
            var fieldset = document.querySelector("fieldset");
            var inputs = fieldset.getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i]
                if (input.value === "") {
                    formValid = false;
                    invalidInput = input
                    break;
                }
                if (input.hasAttribute("type") && input.getAttribute("type").toLowerCase() === "email") {
                    if (!validateEmail(input.value)) {
                        if (!invalidInput) {
                            formValid = false;
                            invalidInput = input;
                            break;
                        }
                    }
                }
            }
            if (formValid) {
                return true;
            } else {
                if(invalidInput) {
                    invalidInput.focus()
                    invalidInput.reportValidity();
                }
                return false;
            }
        }


        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(!checkFormValidation()) {
                return false;
            }
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent().parent().parent();
            next_fs = $(current_fs).next();
            
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    next_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                },
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                    //show the next fieldset
                    next_fs.show(); 
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent().parent().parent();
            previous_fs = $(current_fs).prev();

            
            //show the previous fieldset
            previous_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

       
</script>
@endpush
@endsection