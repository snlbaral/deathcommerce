<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Products')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="pr-2">
    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="<?php echo e(route('product.export')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Export')); ?>"> 
        <i  data-feather="download"></i>
    </a>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Products')): ?>
        <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Import')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Import Product CSV File')); ?>" data-url="<?php echo e(route('product.file.import')); ?>">
            <i  data-feather="upload"></i>
        </a>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Products')): ?>
        <a class="btn btn-sm btn-icon  btn-primary me-2" href="<?php echo e(route('product.create')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>">
            <i  data-feather="plus"></i>
        </a>
    <?php endif; ?>
    <a class="btn btn-sm btn-icon  bg-light-secondary" href="<?php echo e(route('product.grid')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Grid View')); ?>">
        <i  class="ti ti-grid-dots f-30"></i>
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php
    $logo=\App\Models\Utility::get_file('uploads/is_cover_image/');
?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table dataTable" id="pc-dt-satetime-sorting">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Products')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Stock')); ?></th>
                                <th><?php echo e(__('Created at')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if(!empty($product->is_cover)): ?>
                                                <img src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" alt="" class="theme-avtar">
                                            <?php else: ?>
                                                <img src="<?php echo e($logo.(isset($product->is_cover) && !empty($product->is_cover)?$product->is_cover:'is_cover_image.png')); ?>" alt="" class="theme-avtar">
                                            <?php endif; ?>
                                            <div class="ms-3">
                                                <a href="<?php echo e(route('product.show', $product->id)); ?>" class="text-dark f-w-700"><?php echo e($product->name); ?></a>
                                                <div class="mt-2 d-flex align-items-center">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <?php
                                                            $icon = 'fa-star';
                                                            $color = '';
                                                            $newVal1 = $i - 0.5;
                                                            if ($product->product_rating() < $i && $product->product_rating() >= $newVal1) {
                                                                $icon = 'fa-star-half-alt';
                                                            }
                                                            if ($product->product_rating() >= $newVal1) {
                                                                $color = 'text-success';
                                                            }
                                                        ?>
                                                        <i class="fa fa-solid  <?php echo e($icon . ' ' . (!empty($color) ? $color : 'text-secondary')); ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e(!empty($product->product_category()) ? $product->product_category() : '-'); ?></td>
                                    <td>
                                        <?php if($product->enable_product_variant == 'on'): ?>
                                            <?php echo e(__('In Variant')); ?>

                                        <?php else: ?>
                                            <?php echo e(\App\Models\Utility::priceFormat($product->price)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($product->enable_product_variant == 'on'): ?>
                                            <?php echo e(__('In Variant')); ?>

                                        <?php else: ?>
                                            <?php echo e($product->quantity); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($product->enable_product_variant == 'on'): ?>
                                        <span class="badge rounded p-2 f-w-600  bg-light-primary"><?php echo e(__('In Variant')); ?></span>
                                        <?php else: ?>
                                            <?php if($product->quantity == 0): ?>
                                                <span class="badge rounded p-2 f-w-600  bg-light-danger">  <?php echo e(__('Out of stock')); ?></span>
                                            <?php else: ?>
                                                <span class="badge rounded p-2 f-w-600  bg-light-primary"> <?php echo e(__('In stock')); ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        
                                    </td>
                                    <td>
                                        <?php echo e(\App\Models\Utility::dateFormat($product->created_at)); ?>

                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Products')): ?>
                                                <a href="<?php echo e(route('product.show', $product->id)); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>" data-tooltip="View">
                                                    <i  class="ti ti-eye f-20"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Products')): ?>
                                                <a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="<?php echo e(route('product.edit', $product->id)); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>">
                                                    <i  class="ti ti-edit f-20"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Products')): ?>
                                                <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                                    data-title="<?php echo e(__('Delete Lead')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($product->id); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('Delete')); ?>">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['product.destroy', $product->id], 'id' => 'delete-form-' . $product->id]); ?>

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
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product/index.blade.php ENDPATH**/ ?>