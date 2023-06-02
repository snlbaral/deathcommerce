@php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
@endphp
@extends('layouts.admin')
@section('page-title')
    {{ __('Plan Expired') }}
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                    alt="{{ config('app.name', 'Storego') }}" class="logo logo-lg" height="40px" />
                    <h4 class="mt-4 w-75 mx-auto">Your trial is over, so it is not possible to access the dashboard.</h4>
                    <div class="text-seconday w-50 mx-auto mt-2 text-sm">Your trial period has ended. Choose a plan to continue using {{ config('app.name') }}.</div>

                    <select class="custom-select mt-4">
                        <option selected disabled value="">Choose a plan</option>
                        @foreach($plans as $plan)
                            <option value="{{$plan->id}}">{{$plan->name}}</option>
                        @endforeach
                        
                    </select>
            </div>
        </div>
    </div>
</div>
@endsection