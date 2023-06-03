<style>
    .select2-container {
        z-index: 9999;
    }
</style>
<form method="post" action="{{ route('coupons.update', $coupon->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('type',__('Type'),array('class'=>'col-form-label'))}}
            {{ Form::select('type', ['discount'=>'Discount','redeemable'=>'Redeemable'], $coupon->type, array('class' => 'form-control', 'id'=>'type', 'required' => 'required')) }}
        </div>

        <div class="form-group col-md-12">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control" required value="{{ $coupon->name }}">
        </div>

        <div class="form-group col-md-6" id="discount">
            {{Form::label('discount',__('Discount') ,array('class'=>'col-form-label')) }}
            {{Form::number('discount',$coupon->discount,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Discount')))}}
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>


        <div class="form-group col-md-6" id="redeemable">
            {{Form::label('duration',__('Duration') ,array('class'=>'col-form-label')) }}
            <div class="input-group">
                {{Form::number('duration',$coupon->duration,array('class'=>'form-control','step'=>'1','placeholder'=>__('Enter Duration')))}}
                <div class="input-group-append">
                    <span class="input-group-text">{{ __("Days") }}</span>
                </div>
            </div>
            <span class="small">{{__('Note: Plan Duration')}}</span>
        </div>

       
        <div class="form-group col-md-6">
            <label for="limit" class="form-label">{{ __('Limit') }}</label>
            <input type="number" name="limit" class="form-control" required value="{{ $coupon->limit }}">
        </div>
        <div class="form-group col-md-12" id="auto">
            <label for="code" class="form-label">{{ __('Code') }}</label>
            <div class="input-group">

                <input class="form-control" name="code" type="text" id="auto-code" value="{{ $coupon->code }}">
                <button type="button" class="btn btn-outline-secondary" id="code-generate"><i class="fa fa-history pr-1"></i>
                    {{ __('Generate') }}</button>

            </div>
        </div>


        <div class="form-group col-md-12">
            {{ Form::label('plans', __('Plans'), array('class' => 'col-form-label')) }}
            {{ Form::select('plans[]', $planOptions, $coupon->plans, array('class' => 'form-select select2', 'multiple' => 'multiple', 'required' => 'required')) }}
        </div>


        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="{{ __('Cancel') }}" class="btn btn-secondary btn-light"
                data-bs-dismiss="modal">
            <input type="submit" value="{{ __('Update') }}" class="btn btn-primary ms-2">
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{__('Select Plan')}}",
            search: true
        })
        // toggle type
        const type = "{{$coupon->type}}"
        if(type==="redeemable") {
            $("#discount").hide();
            $("#redeemable").show();
        } else {
            $("#discount").show();
            $("#redeemable").hide();
        }

        $("#type").on("change", function() {
            const type = $(this).val()
            if(type==="discount") {
                $("#discount").show();
                $("#redeemable").hide();
            }
            if(type==="redeemable") {
                $("#discount").hide();
                $("#redeemable").show();
            }
        })
    });
</script>