<?php echo e(Form::open(array('url'=>'shipping','method'=>'post'))); ?>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('price',__('Price'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::text('price',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Location',__('Location'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::select('location[]', $locations,null, array('class' => 'form-control multi-select','id'=>'choices-multiple','multiple'=>''))); ?>

        </div>

    </div>
    <div class="form-group col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/shipping/create.blade.php ENDPATH**/ ?>