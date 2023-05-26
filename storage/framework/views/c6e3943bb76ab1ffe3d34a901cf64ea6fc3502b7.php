<?php echo e(Form::model($plan, ['route' => ['plans.update', $plan->id],'method' => 'PUT','enctype' => 'multipart/form-data'])); ?>

<?php echo csrf_field(); ?>
<?php echo method_field('put'); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name')]); ?>

        </div>
    </div>
    <?php if($plan->price > 0): ?>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('price', __('Price'), ['class' => 'col-form-label'])); ?>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span
                            class="input-group-text"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?></span>
                    </div>
                    <?php echo Form::number('price', null, ['class' => 'form-control', 'id' => 'monthly_price', 'min' => '0', 'placeholder' => __('Enter Price')]); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <?php echo e(Form::label('duration', __('Duration'), ['class' => 'col-form-label'])); ?>

        <?php echo Form::select('duration', $arrDuration, null, ['class' => 'form-control ', 'required' => 'required']); ?>

    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('max_stores', __('Maximum stores'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::text('max_stores', null, ['class' => 'form-control', 'id' => 'max_stores', 'placeholder' => __('Enter Max Stores')]); ?>

            <span><small><?php echo e(__("Note: '-1' for Unlimited")); ?></small></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('max_products', __('Maximum Product Per Store'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::text('max_products', null, ['class' => 'form-control', 'id' => 'max_products', 'placeholder' => __('Enter Products Per Store')]); ?>

            <span><small><?php echo e(__("Note: '-1' for Unlimited")); ?></small></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('max_users', __('Maximum Users Per Store'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::text('max_users', null, ['class' => 'form-control', 'id' => 'max_users', 'placeholder' => __('Enter Max Users')]); ?>

            <span><small><?php echo e(__("Note: '-1' for Unlimited")); ?></small></span>
        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="enable_custdomain" id="enable_custdomain"
                <?php echo e($plan['enable_custdomain'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="enable_custdomain"><?php echo e(__('Enable Domain')); ?></label>
        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="enable_custsubdomain" id="enable_custsubdomain"
                <?php echo e($plan['enable_custsubdomain'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="enable_custsubdomain"><?php echo e(__('Enable Sub Domain')); ?></label>
        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="additional_page" id="additional_page"
                <?php echo e($plan['additional_page'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="additional_page"><?php echo e(__('Enable Additional Page')); ?></label>
        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="blog" id="blog"
                <?php echo e($plan['blog'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label" for="blog"><?php echo e(__('Enable Blog')); ?></label>
        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="shipping_method" id="shipping_method"
                <?php echo e($plan['shipping_method'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="shipping_method"><?php echo e(__('Enable Shipping Method')); ?></label>
        </div>
    </div>
     <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="pwa_store" id="pwa_store" <?php echo e($plan['pwa_store'] == 'on' ? 'checked=checked' : ''); ?>>
            <label class="custom-control-label form-check-label"
                for="pwa_store"><?php echo e(__('Progressive Web App (PWA)')); ?></label>
        </div>
        </div>

    <div class="col-12 pt-2">
        <div class="custom-control">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'rows' => 2, 'placeholder' => __('Enter Description')]); ?>

        </div>
    </div>
</div>
<div class="form-group col-12 d-flex justify-content-end col-form-label">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary ms-2">
</div>
</form>
<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/plans/edit.blade.php ENDPATH**/ ?>