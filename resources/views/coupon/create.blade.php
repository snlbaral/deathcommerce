<style>
    .select2-container {
        z-index: 9999;
    }
</style>
<form method="post" action="{{ route('coupons.store') }}">
    @csrf
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('type',__('Type'),array('class'=>'col-form-label'))}}
            {{ Form::select('type', ['discount'=>'Discount','redeemable'=>'Redeemable'], null, array('class' => 'form-control', 'id'=>'type', 'required' => 'required')) }}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'col-form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>

        <div class="form-group col-md-6" id="discount">
            {{Form::label('discount',__('Discount') ,array('class'=>'col-form-label')) }}
            {{Form::number('discount',null,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Discount')))}}
            <span class="small">{{__('Note: Discount in Percentage')}}</span>
        </div>

        <div class="form-group col-md-6" id="redeemable">
            {{Form::label('duration',__('Duration') ,array('class'=>'col-form-label')) }}
            <div class="input-group">
                {{Form::number('duration',null,array('class'=>'form-control','step'=>'1','placeholder'=>__('Enter Duration')))}}
                <div class="input-group-append">
                    <span class="input-group-text">{{ __("Days") }}</span>
                </div>
            </div>
            <span class="small">{{__('Note: Plan Duration')}}</span>
        </div>
        

        <div class="form-group col-md-6">
            {{Form::label('limit',__('Limit') ,array('class'=>'col-form-label'))}}
            {{Form::number('limit',null,array('class'=>'form-control','placeholder'=>__('Enter Limit'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-12" id="auto">
            {{Form::label('limit',__('Code') ,array('class'=>'col-form-label'))}}
            <div class="input-group">
                {{Form::text('code',null,array('class'=>'form-control','id'=>'auto-code','required'=>'required'))}}
                <button class="btn btn-outline-secondary" type="button" id="code-generate"><i class="fa fa-history pr-1"></i>{{__(' Generate')}}</button>
            </div>
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('plans', __('Plans'), array('class' => 'col-form-label')) }}
            {{ Form::select('plans[]', $planOptions, null, array('class' => 'form-select select2', 'multiple' => 'multiple', 'required' => 'required')) }}
        </div>
           
           

        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <input type="submit" value="{{__('Save')}}" class="btn btn-primary ms-2">
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
        $("#redeemable").hide();
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
