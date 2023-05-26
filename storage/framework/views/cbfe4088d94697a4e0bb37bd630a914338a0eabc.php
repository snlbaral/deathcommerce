<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-2"><?php echo e(__('Product Coupons')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Coupons')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="<?php echo e(route('productcoupon.export')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Export')); ?>"> 
        <i  data-feather="download"></i>
    </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Product Coupan')): ?>
        <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Import')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Import Product-coupan CSV File')); ?>" data-url="<?php echo e(route('productcoupon.file.import')); ?>">
            <i  data-feather="upload"></i>
        </a>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Product Coupan')): ?>
        <a class="btn btn-sm btn-icon  btn-primary me-2 text-white" data-url="<?php echo e(route('product-coupon.create')); ?>" data-title="<?php echo e(__('Add Coupon')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>">
            <i  data-feather="plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#code-generate', function() {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Code')); ?></th>
                                    <th> <?php echo e(__('Discount (%)')); ?></th>
                                    <th> <?php echo e(__('Limit')); ?></th>
                                    <th> <?php echo e(__('Used')); ?></th>
                                    <th class="text-right"> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $productcoupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($coupon->name); ?></td>
                                        <td><?php echo e($coupon->code); ?></td>
                                        <?php if($coupon->enable_flat == 'off'): ?>
                                            <td><?php echo e($coupon->discount . '%'); ?></td>
                                        <?php endif; ?>
                                        <?php if($coupon->enable_flat == 'on'): ?>
                                            <td><?php echo e($coupon->flat_discount . ' ' . '(Flat)'); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($coupon->limit); ?></td>
                                        <td><?php echo e($coupon->product_coupon()); ?></td>
                                        <td class="Action">
                                            <div class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Product Coupan')): ?>
                                                    <a href="<?php echo e(route('product-coupon.show', $coupon->id)); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-tooltip="view" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View Coupon')); ?>" data-tooltip="View">
                                                        <i  class="ti ti-eye f-20"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Product Coupan')): ?>
                                                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-title="<?php echo e(__('Edit Coupon')); ?>" data-url="<?php echo e(route('product-coupon.edit', $coupon->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>">
                                                        <i  class="ti ti-edit f-20"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Product Coupan')): ?>
                                                    <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                                        data-title="<?php echo e(__('Delete Lead')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($coupon->id); ?>"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['product-coupon.destroy', $coupon->id], 'id' => 'delete-form-' . $coupon->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product-coupon/index.blade.php ENDPATH**/ ?>