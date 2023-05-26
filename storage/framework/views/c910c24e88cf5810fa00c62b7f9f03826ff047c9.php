<form method="post" action="<?php echo e(route('users.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('Email',__('Email'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::email('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('Password',__('Password'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Password'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('User Role',__('User Role'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::select('role',$roles,null,array('class'=>'form-control','placeholder'=>__('Select Role'),'required'=>'required'))); ?>

        </div>
        <div class="form-group col-12 d-flex justify-content-end col-form-label">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
        </div>
    </div>
</form>
<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/users/create.blade.php ENDPATH**/ ?>