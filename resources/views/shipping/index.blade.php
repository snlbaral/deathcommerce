@php
    $defaultDeliveryMethods = getDeliveryMethods();
    // remove already added delivery methods apart from custom-shpping
    $defaultDeliveryMethods = array_filter($defaultDeliveryMethods, function ($item) use ($deliveryMethodsNames) {
        return !in_array($item['slug'], $deliveryMethodsNames) || $item['slug'] === 'custom-shipping';
    });
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
    <li class="breadcrumb-item active" aria-current="page">{{ __('Shipping') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(!$deliveryMethods->isEmpty())
            <div class="card">
                <div class="card-header">
                    <h3>{{__('Added delivery methods')}}</h3>
                    <div class="text-sm text-secondary">{{__('Select how you will deliver your products to customers.')}}</div>
                </div>
                <div class="card-body">
                    @foreach ($deliveryMethods as $delivery)
                    <div class="list-group-item border-1 mb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <div class="d-block h6 mb-0">{{$delivery['name']}} - </div>
                                <div class="text-sm ms-2">{{$delivery['type']}}</div>
                            </div>
                            <div class="d-flex">
                                <div class="col">
                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2" href="{{ route('shipping.edit-delivery',['slug'=>$delivery->type, 'id'=>$delivery->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Add') }}"> 
                                        <i  data-feather="edit"></i>
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="action-btn ms-2">
                                        <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                            data-title="{{ __('Delete Role') }}"
                                            data-confirm="{{ __('Are You Sure?') }}"
                                            data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                            data-confirm-yes="delete-form-{{ $delivery->id }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ __('Delete') }}">
                                            <i  data-feather="trash"></i>
                                        </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['shipping.delete-delivery', $delivery->id], 'id' => 'delete-form-' . $delivery->id]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch ms-3">
                                        {!! Form::open(['method' => 'POST', 'route' => ['shipping.update-delivery-status', $delivery->id], 'id' => 'update-form-' . $delivery->id]) !!}
                                        <input type="hidden" name="active" value="off"/>
                                        <input type="checkbox" class="form-check-input change_delivery_status" name="active" value="{{$delivery->id}}" @if($delivery->active) checked @endif/>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>{{__('Add a new delivery method')}}</h3>
                    <div class="text-sm text-secondary">{{__('Select how you will deliver your products to customers.')}}</div>
                </div>
                <div class="card-body">
                    @foreach ($defaultDeliveryMethods as $delivery)
                    <div class="list-group-item border-1 mb-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="d-block h6 mb-0">{{$delivery['name']}}</div>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-icon bg-light-secondary me-2" href="{{ route('shipping.new-delivery', $delivery['slug']) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Add') }}"> 
                                    <i  data-feather="plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

@push('script-page')
<script>
    $(".change_delivery_status").on('change', function(){
        const id = $(this).val()
        $(`#update-form-${id}`).submit();
    })
</script>
@endpush
@endsection
