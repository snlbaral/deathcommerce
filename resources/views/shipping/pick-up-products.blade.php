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
                <h3>{{__('Edit the pick up product option')}}</h3>
                @else
                <h3>{{__('Add the pick up product option')}}</h3>
                @endif
                <small class="text-secondary">{{__('Customers will see this information at checkout.')}}</small>
            </div>
            <div class="card-body">
                {{ Form::open(['route' => ['shipping.new-delivery.store', $slug], 'method' => 'post', 'enctype' => 'multipart/form-data', 'id'=>'deliveryForm']) }}
                    <input type="hidden" name="type" value="{{$slug}}"/>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('pick_up_option_name',__('Pick up option name'),array('class'=>'col-form-label')) }}
                                {{Form::text('pick_up_option_name', $deliveryMethod['data']['pick_up_option_name'] ?? old('pick_up_option_name'),array('class'=>'form-control','placeholder'=>__('Name'),'required'=>'required'))}}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col">
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
                                <div class="col">
                                    {{Form::label('state',__('State'),array('class'=>'col-form-label')) }}
                                    <select class="form-control state_select" name="state" required>
                                    </select>
                                </div>
                                <div class="col">
                                    {{Form::label('city',__('City'),array('class'=>'col-form-label')) }}
                                    <select class="form-control city_select" name="city" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col">
                                    {{Form::label('zipcode',__('Postal Code'),array('class'=>'col-form-label')) }}
                                    {{Form::number('zipcode', $deliveryMethod['data']['zipcode'] ?? old('zipcode'),array('class'=>'form-control','placeholder'=>__('Postal Code'),'required'=>'required'))}}
                                </div>
                                <div class="col">
                                    {{Form::label('address',__('Address'),array('class'=>'col-form-label')) }}
                                    {{Form::text('address', $deliveryMethod['data']['address'] ?? old('address'),array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('working_hours',__('Working hours'),array('class'=>'col-form-label')) }}
                                {{Form::text('working_hours', $deliveryMethod['data']['working_hours'] ?? old('working_hours'),array('class'=>'form-control','placeholder'=>__('Ex: From 8:00am to 5:30pm from Monday to Thursday'),'required'=>'required'))}}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="enable_pick_up_cost" value="off"/>
                                    <input type="checkbox" class="form-check-input"
                                        name="enable_pick_up_cost" @if($deliveryMethod && $deliveryMethod['data']['enable_pick_up_cost']=="on") checked @endif/>
                                    {{ Form::label('enable_pick_up_cost', __('Add pick up cost'), ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group col pickupCost" @if($deliveryMethod && $deliveryMethod['data']['enable_pick_up_cost']=="on") style="display:block" @else style="display: none" @endif>
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">{{$store['currency'] ?? env("STORE_CURRENCY")}}</span>
                                    <input type="number" name="pick_up_cost" class="form-control" placeholder="{{$store['currency'] ?? env("STORE_CURRENCY")}}" value="{{$deliveryMethod['data']['pick_up_cost'] ?? 0}}">
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
                                var isSelected = delivery_method && delivery_method?.data?.state==state.name ? true : false
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
                            if(delivery_method && delivery_method?.data?.city) {
                                var fromTheList = data.find(city=>city.name==delivery_method?.data?.city)
                                if(!fromTheList) {
                                    var newOption = new Option(delivery_method?.data?.city, delivery_method?.data?.city, true, true);
                                    $('.city_select').append(newOption).trigger('change');
                                }
                            }
                            data.forEach(city => {
                                var isSelected = delivery_method && delivery_method?.data?.city==city.name ? true : false
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

            $("input[name='enable_pick_up_cost']").on("change", function(){
                if($(this).prop('checked')) {
                    $(".pickupCost").show()
                    $("input[name='pick_up_cost']").prop('required', true);
                } else {
                    $(".pickupCost").hide()
                    $("input[name='pick_up_cost']").prop('required', false);
                }
            })

            
        })
    </script>
@endpush

@endsection