<form method="post" action="<?php echo e(route('product-coupon.store')); ?>" id="product-coupon-store">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" name="enable_flat" id="enable_flat">
                <?php echo e(Form::label('enable_flat',__('Flat Discount'),array('class'=>'form-check-label mb-3'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6 nonflat_discount">
            <?php echo e(Form::label('discount',__('Discount') ,array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::number('discount',null,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Discount')))); ?>

            <span class="small"><?php echo e(__('Note: Discount in Percentage')); ?></span>
        </div>
        <div class="form-group col-md-6 flat_discount" style="display: none;">
            <?php echo e(Form::label('pro_flat_discount',__('Flat Discount') ,array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::number('pro_flat_discount',null,array('class'=>'form-control','step'=>'0.01','placeholder'=>__('Enter Flat Discount')))); ?>

            <span class="small"><?php echo e(__('Note: Discount in Value')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('limit',__('Limit') ,array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::number('limit',null,array('class'=>'form-control','placeholder'=>__('Enter Limit'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12" id="auto">
            <?php echo e(Form::label('limit',__('Code') ,array('class'=>'col-form-label'))); ?>

            <div class="input-group">
                <?php echo e(Form::text('code',null,array('class'=>'form-control','id'=>'auto-code','required'=>'required'))); ?>

                <button class="btn btn-outline-secondary" type="button" id="code-generate"><i class="fa fa-history pr-1"></i><?php echo e(__(' Generate')); ?></button>
            </div>
        </div>
        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
        </div>
    </div>
</form>
<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product-coupon/create.blade.php ENDPATH**/ ?>