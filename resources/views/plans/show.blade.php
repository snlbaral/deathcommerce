<style>
    .select2-container {
        z-index: 9999;
    }
</style>
@php
$countries = getCountriesList()
@endphp
@extends('layouts.admin')
@section('page-title')
    {{ __('Add Pricing') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('plans.index') }}">{{ __('Plans') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __($plan->name) }}</li>
@endsection

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 ">{{ __('Plans') }}</h5>
    </div>
@endsection

@section('action-btn')
    @can('Manage Plans')
        <!-- Button to trigger the modal -->
        <a class="btn btn-sm btn-icon btn-primary me-2 text-white" data-bs-toggle="modal" data-bs-target="#addPlanModal" data-bs-title="{{ __('Add Plan') }}" data-bs-tooltip="tooltip" data-bs-placement="top" title="{{ __('Add Plan') }}">
            <i data-feather="plus"></i>
        </a>
    @endcan
@endsection
@section('content')
<!-- Modal -->
<div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog" aria-labelledby="addPlanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{ Form::open(['route' => ['plans.price.store', $plan->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="addPlanModalLabel">{{ __('Add '.$plan->name.' Plan Price') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            {{ Form::label('name', __('Plan Name'), ['class' => 'col-form-label']) }}
                            <input class="form-control" type="text" value="{{$plan->name}}" disabled/>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Country</label>
                                <!-- Country select -->
                                <select id="countrySelect" name="country" class="form-control" required>
                                    @foreach ($countries as $country)
                                        <option data-country="{{$country['currency_code']}}" value="{{$country['country']}}">{{$country['country']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label">Currency</label>
                                <!-- Currency select -->
                                <select id="currencySelect" class="form-control" name="currency" required>
                                    @foreach ($countries as $country)
                                        <option data-country="{{$country['country']}}" value="{{$country['currency_code']}}">{{$country['currency_code']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('price', __('Price'), ['class' => 'col-form-label']) }}
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text currency_symbol_monthly">AFN</span>
                                    <input type="number" name="monthly_price" class="form-control" required>
                                    <span class="input-group-text">/ Month</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text currency_symbol_yearly">AFN</span>
                                    <input type="number" name="yearly_price" class="form-control" required>
                                    <span class="input-group-text">/ Year</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('payment_gateways', __('Payment Gateways Available'), ['class' => 'col-form-label']) }}
                            <select class="form-control" id="payment_gateways" name="payment_gateways[]" multiple required>
                            @foreach (getPaymentGateways() as $gateway)
                                <option value="{{$gateway['name']}}">{{$gateway['name']}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{ Form::label('delivery_methods', __('Delivery Methods Available'), ['class' => 'col-form-label']) }}
                            <select class="form-control" id="delivery_methods" name="delivery_methods[]" multiple required>
                            @foreach (getDeliveryMethods() as $delivery)
                                <option value="{{$delivery['name']}}">{{$delivery['name']}}</option>
                            @endforeach
                            </select>
                        </div>


                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group col-12 d-flex justify-content-end col-form-label">
                    <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
                    <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable ">
                            <thead>
                            <tr>
                                <th> {{ __('Country') }}</th>
                                <th>{{ __('Currency') }}</th>
                                <th>{{ __('Montly Price') }}</th>
                                <th> {{ __('Yearly Price') }}</th>
                                <th> {{ __('Payment Gateways') }}</th>
                                <th> {{ __('Delivery Methods') }}</th>
                                <th> {{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pricing as $planPrice)
                                <tr>
                                    <td>{{$planPrice->country}}</td>
                                    <td>{{$planPrice->currency}}</td>
                                    <td>{{number_format($planPrice->monthly, 2, '.', '')}}</td>
                                    <td>{{number_format($planPrice->yearly, 2, '.', '')}}</td>
                                    <td style="white-space: inherit">
                                        @if($planPrice->payment_gateways)
                                        @foreach (json_decode($planPrice->payment_gateways) as $gateway)
                                            <span class="badge rounded p-2 m-1 px-3 bg-primary ">
                                                <a href="#" class="text-white">{{ $gateway }}</a>
                                            </span>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td style="white-space: inherit">
                                        @if($planPrice->delivery_methods)
                                        @foreach (json_decode($planPrice->delivery_methods) as $delivery)
                                            <span class="badge rounded p-2 m-1 px-3 bg-primary ">
                                                <a href="#" class="text-white">{{ $delivery }}</a>
                                            </span>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if($planPrice->country!=="Default")
                                            <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                                data-title="{{ __('Delete Lead') }}"
                                                data-confirm="{{ __('Are You Sure?') }}"
                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                data-confirm-yes="delete-form-{{ $planPrice->id }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ __('Delete') }}">
                                                <i class="ti ti-trash f-20"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['plans.price.delete', $planPrice->id], 'id' => 'delete-form-' . $planPrice->id]) !!}
                                            {!! Form::close() !!}
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

<script>
        // Get the select elements
        const countrySelect = document.getElementById('countrySelect');
        const currencySelect = document.getElementById('currencySelect');

        // countrySelect.addEventListener('change', function() {
        //     var selectedOption = this.options[this.selectedIndex];
        //     // Set the selected option based on data-currency
        //     for (var i = 0; i < currencySelect.options.length; i++) {
        //         var option = currencySelect.options[i];
        //         if (option.getAttribute('data-country') === selectedOption.value) {
        //             option.selected = true;
        //             document.querySelector(".currency_symbol_monthly").innerText = option.value
        //             document.querySelector(".currency_symbol_yearly").innerText = option.value
        //             break;
        //         }
        //     } 
        // });
        currencySelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            document.querySelector(".currency_symbol_monthly").innerText = selectedOption.value
            document.querySelector(".currency_symbol_yearly").innerText = selectedOption.value
            // Set the selected option based on data-currency
            // for (var i = 0; i < countrySelect.options.length; i++) {
            //     var option = countrySelect.options[i];
            //     if (option.value === selectedOption.getAttribute('data-country')) {
            //         option.selected = true;
            //         break;
            //     }
            // }
        });

        document.querySelector("input[name='monthly_price']").addEventListener("keyup", function() {
            const value = parseFloat(this.value);
            if (!isNaN(value)) {
                document.querySelector("input[name='yearly_price']").value = value * 12;
            }
        });


</script>

@push('script-page')
<script>
    $(document).ready(function() {
        $('#payment_gateways').select2({
            placeholder: "{{__('Select Payment Gateways')}}",
            search: true
        })
        $('#delivery_methods').select2({
            placeholder: "{{__('Select Delivery Methods')}}",
            search: true
        })
        // $('#countrySelect').select2({
        //     placeholder: "{{__('Select Country')}}",
        //     search: true,
        // })
        // $('#currencySelect').select2({
        //     placeholder: "{{__('Select Currency')}}",
        //     search: true,
        // })
    });
</script>
@endpush
@endsection

