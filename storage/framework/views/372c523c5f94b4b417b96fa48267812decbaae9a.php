
<?php echo e(Form::model($users, array('route' => array('store-resource.display', $users->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>
<div>
	<p>This action can not be undone. Do you want to continue?</p>
	</div>
<div class="form-group text-right">
</div>
<div class="form-group col-12 d-flex justify-content-end col-form-label">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <button class="btn btn-primary ms-2" value="<?php echo e($users->store_display); ?>" type="submit"><?php echo e(__('Yes')); ?></button>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/admin_store/storeenabled.blade.php ENDPATH**/ ?>