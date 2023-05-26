<?php
// ($store_logo = asset(Storage::url('uploads/product_image/')))
$store_logo=\App\Models\Utility::get_file('uploads/product_image/');
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Product Category')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="pr-2">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Product category')): ?>
        <a href="#" class="btn btn-sm btn-icon  btn-primary me-2" data-ajax-popup="true" data-url="<?php echo e(route('product_categorie.create')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Product Category')); ?>">
            <i  data-feather="plus"></i>
        </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body pb-0 table-border-style">
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Product Image')); ?></th>
                                <th><?php echo e(__('Category Name')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $product_categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-name="<?php echo e($product_category->name); ?>">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($product_category->categorie_img): ?>
                                                <img src="<?php echo e($store_logo); ?>/<?php echo e($product_category->categorie_img); ?>" alt="" class="theme-avtar">
                                            <?php else: ?>
                                                <img src="<?php echo e($store_logo); ?>/default.jpg" alt="" class="theme-avtar">
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td><?php echo e($product_category->name); ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Product category')): ?>
                                                <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-url="<?php echo e(route('product_categorie.edit', $product_category->id)); ?>"  data-ajax-popup="true" data-title="<?php echo e(__('Edit Category')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>" data-tooltip="Edit">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Product category')): ?>
                                                <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" data-title="<?php echo e(__('Delete Lead')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>"  data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="delete-form-<?php echo e($product_category->id); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['product_categorie.destroy', $product_category->id], 'id' => 'delete-form-' . $product_category->id]); ?>

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
    <!-- [ sample-page ] end -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('keyup', '.search-user', function() {
                var value = $(this).val();
                $('.employee_tableese tbody>tr').each(function(index) {
                    var name = $(this).attr('data-name').toLowerCase();
                    if (name.includes(value.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product_category/index.blade.php ENDPATH**/ ?>