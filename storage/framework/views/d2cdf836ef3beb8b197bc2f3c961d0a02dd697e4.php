<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 "><?php echo e(__('Product')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Product')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="d-flex align-items-center justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Ratting')): ?>
            <a class="btn btn-primary me-3 text-white" data-bs-toggle="tooltip" data-size="md" data-toggle="modal" data-url="<?php echo e(route('rating', [$store->slug, $product->id])); ?>"  data-ajax-popup="true" data-title="<?php echo e(__('Create New Rating')); ?>" data-bs-placement="top" title="<?php echo e(__('Create New Rating')); ?>"> 
                <i data-feather="star" class="me-2"></i> <?php echo e(__('Add Ratting')); ?>

            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Products')): ?>
            <a href="<?php echo e(route('product.edit', $product->id)); ?>" class="btn btn-primary"> 
                <i data-feather="edit" class="me-2"></i> <?php echo e(__('Edit Product')); ?>

            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php
    $logo=\App\Models\Utility::get_file('uploads/is_cover_image/');
    $p_logo=\App\Models\Utility::get_file('uploads/product_image/');
?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="card border border-primary shadow-none">
                    <div class="card-body">
                        <div class="d-flex mb-3 align-items-center gap-2 flex-sm-row flex-column justify-content-between">
                            <h4><?php echo e($product->name); ?></h4>
                            <div class="ps-3 d-flex align-items-center ">
                                    <?php if($product->enable_product_variant =='on'): ?>
                                    <span class="badge rounded p-2 bg-light-primary "><span class="variant_qty">0</span>  <?php echo e(__('Total Avl.Quantity')); ?></span>
                                    <?php else: ?>
                                    <span class="badge rounded p-2 bg-light-primary"> <?php echo e($product->quantity); ?>  <?php echo e(__('Total Avl.Quantity')); ?></span>
                                    <?php endif; ?>
                                <div class="text-end ms-3">
                                    <span><?php echo e(__('Price')); ?>:</span>
                                    <h5 class="variasion_price">
                                    <?php if($product->enable_product_variant == 'on'): ?>
                                        <?php echo e(\App\Models\Utility::priceFormat(0)); ?>

                                    <?php else: ?>
                                        <?php echo e(\App\Models\Utility::priceFormat($product->price)); ?>

                                    <?php endif; ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-lg-row flex-column align-items-center justify-content-between ">
                            <p><b><?php echo e(__('Categories')); ?>:<?php echo e($product->categories->name ?? ''); ?> </b></p> <p><b><?php echo e(__('SKU')); ?>: <?php echo e($product->SKU); ?></b></p>
                            <p class="d-inline-flex align-items-center">
                             
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?php
                                        $icon = 'fa-star';
                                        $color = 'text-secondary';
                                        $newVal1 = $i - 0.5;
                                        if ($avg_rating < $i && $avg_rating >= $newVal1) {
                                            $icon = 'fa-star-half-alt';
                                        }
                                        if ($avg_rating >= $newVal1) {

                                            $color = 'text-success';

                                        }
                                    ?>

                                    <i class="fas <?php echo e($icon . ' ' . $color); ?>"></i>
                                <?php endfor; ?>
                                <span class="ms-2 d-block"><?php echo e(__('Rating')); ?>: <?php echo e($avg_rating); ?> (<?php echo e($user_count); ?> <?php echo e(__('reviews')); ?>)</span>
                               
                            </p>
                        </div>
                        <div class="border mb-4 rounded border-primary product_image">
                            <?php if(!empty($product->is_cover)): ?>
                                <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/' . $product->is_cover))); ?>" alt="" class="w-100">
                            <?php else: ?>
                                <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>" alt="" class="w-100">
                            <?php endif; ?>
                        </div>
                        <p class="mb-2"><?php echo e(__('Description')); ?>:</p>
                        <p><?php echo $product->description; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <?php if($product->enable_product_variant == 'on'): ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <input type="hidden" id="product_id" value="<?php echo e($product->id); ?>">
                                <input type="hidden" id="variant_id" value="">
                                <input type="hidden" id="variant_qty" value="">
                                <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 mb-4 mb-sm-0">
                                        <span class="d-block h6 mb-0">
                                            <th>
                                                <label for="" class="col-form-label"> <?php echo e(ucfirst($variant->variant_name)); ?></label>

                                            </th>
                                            <select name="product[<?php echo e($key); ?>]" id='choices-multiple-<?php echo e($key); ?>'  class="form-control multi-select  pro_variants_name<?php echo e($key); ?> change_price">
                                            <option value=""><?php echo e(__('Select')); ?></option>
                                                <?php $__currentLoopData = $variant->variant_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($values); ?>"><?php echo e($values); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="d-flex justify-content-between">
                    <h4><?php echo e(__('Ratings')); ?></h4>
                </div>
               
                <div class="card border shadow-none">
                    <div class="card-body p-0">
                        <?php $__currentLoopData = $product_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_key => $product_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h3 class="mb-0"><?php echo e($product_rating->title); ?></h3>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check form-switch mb-0">
                                            <input type="checkbox" class="form-check-input rating_view" name="rating_view" id="enable_rating<?php echo e($product_key); ?>" data-id="<?php echo e($product_rating['id']); ?>" <?php echo e($product_rating->rating_view == 'on' ? 'checked' : ''); ?>>
                                            <label class="form-check-label f-w-600 pl-1" for="enable_rating<?php echo e($product_key); ?>"></label>
                                        </div>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Ratting')): ?>
                                            <a href="#!" class="btn btn-icon btn-sm btn-light-secondary me-2"  data-url="<?php echo e(route('rating.edit', $product_rating->id)); ?>"  data-ajax-popup="true" data-title="<?php echo e(__('Edit Rating')); ?>"  data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit Rating ')); ?>">
                                                <i data-feather="edit"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Ratting')): ?>
                                            <a href="#!" class="bs-pass-para btn-icon btn-sm btn-light-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>" data-title="<?php echo e(__('Delete Lead')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="delete-form-<?php echo e($product_rating->id); ?>">
                                                <i data-feather="trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['rating.destroy', $product_rating->id],'id'=>'delete-form-'.$product_rating->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p><?php echo e($product_rating->description); ?></p>
                                <div class="d-flex align-items-center">
                                    <div class="ps-2">
                                        <div class="d-flex">
                                            <?php for($i = 0; $i < 5; $i++): ?>
                                                <i class="fas fa-star <?php echo e($product_rating->ratting > $i ? 'text-success' : 'text-secondary'); ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <small>by <?php echo e($product_rating->name); ?> : <?php echo e($product_rating->created_at->diffForHumans()); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-6">
                <h4><?php echo e(__('Gallery')); ?></h4>
                <div class="card border  shadow-none">
                    <div class="card-body ">
                        <div class="row gy-3 gx-3">
                            <?php $__currentLoopData = $product_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-6">
                                    <div class="p-2 border border-primary rounded">
                                        <?php if(!empty($product_image[$key]->product_images)): ?>
                                            <img src="<?php echo e($p_logo.(isset($product_image[$key]->product_images) && !empty($product_image[$key]->product_images)?$product_image[$key]->product_images:'is_cover_image.png')); ?>" alt="" class="w-100">
                                        <?php else: ?>
                                            <img src="<?php echo e($p_logo.(isset($product_image[$key]->product_images) && !empty($product_image[$key]->product_images)?$product_image[$key]->product_images:'is_cover_image.png')); ?>" alt="" class="w-100">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '.rating_view', function() {
            var id = $(this).attr('data-id');
            var status = 'off';
            if ($(this).is(":checked")) {
                status = 'on';
            }
            var data = {
                id: id,
                status: status
            }

            $.ajax({
                url: '<?php echo e(route('rating.rating_view')); ?>',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    show_toastr('success', data.success, 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });


        $(document).on('change', '.change_price', function () {
            var variants = [];
            $(".change_price").each(function (index, element) {
                variants.push(element.value);
            });
            if (variants.length > 0) {
                $.ajax({
                    url: '<?php echo e(route('get.products.variant.quantity')); ?>',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: $('#product_id').val()
                    },

                    success: function (data) {
                        console.log(data);
                        $('.variasion_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('.variant_qty').html(data.quantity);
                    }
                });
            }
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product/view.blade.php ENDPATH**/ ?>