<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Customer Home')); ?>

<?php $__env->stopSection(); ?>

<?php
if (!empty(session()->get('lang'))) {
    $currantLang = session()->get('lang');
} else {
    $currantLang = $store->lang;
}
\App::setLocale($currantLang);
?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('head-title'); ?>
    <?php echo e(__('Welcome').', '.\Illuminate\Support\Facades\Auth::guard('customers')->user()->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper">
    <section class="main-home-first-section" style="background-image:url(<?php echo e(asset(Storage::url('uploads/store_logo/'.(!empty($storethemesetting['header_img'])?$storethemesetting['header_img']:'home-banner.png')))); ?>); background-position: center center;">
        <div class="container">
            <div class="banner-content">
                <h1><?php echo e(__('Products you purchased')); ?></h1>
               
                <a href="<?php echo e(route('store.slug',$store->slug)); ?>" class="btn"><?php echo e(__('Back to home')); ?>

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 492.004 492.004"  xml:space="preserve">
                        <g>
                            <g>
                                <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12    c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028    c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265    c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                            </g>
                        </g>
                     </svg>
                </a>
            </div>
        </div>
    </section>
    <section class="order-section padding-top">
        <div class="container">
            <?php if(!empty($orders) && count($orders) > 0): ?>
                <div class="order-table">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Order')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Value')); ?></th>
                                    <th><?php echo e(__('Payment Type')); ?></th>
                                    <th class="text-right"><?php echo e(__("Action")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                   
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('customer.order',[$store->slug,Crypt::encrypt($order->id)])); ?>" class="">
                                                <span><?php echo e('#'.$order->order_id); ?></span>
                                            </a>
                                        </td>
                                        <td>
                                            <span><?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e(\App\Models\Utility::priceFormat($order->price)); ?></span>
                                        </td>
                                        <td>
                                            <span><?php echo e($order->payment_type); ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-end">
                                                <?php if($order->status != 'Cancel Order'): ?>
                                                    <button type="button" class="table-btn">
                                                        <?php if($order->status == 'pending'): ?>
                                                            <i class="fas fa-check soft-success"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-check-double soft-success"></i>
                                                        <?php endif; ?>
                                                        <?php if($order->status == 'pending'): ?>
                                                            <span>
                                                                <?php echo e(__('Pending')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                            </span>
                                                        <?php else: ?>
                                                            <span>
                                                                <?php echo e(__('Delivered')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order->updated_at)); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="table-btn">
                                                        <?php if($order->status == 'pending'): ?>
                                                            <i class="fas fa-check soft-success"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-check-double soft-success"></i>
                                                        <?php endif; ?>
                                                        <span>
                                                            <?php echo e(__('Cancel Order')); ?>: <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                        </span>
                                                    </button>
                                                <?php endif; ?>
                                                <!-- Actions -->
                                                <div class="eye-btn">
                                                    <a href="<?php echo e(route('customer.order',[$store->slug,Crypt::encrypt($order->id)])); ?>" class="" data-toggle="tooltip" data-title="<?php echo e(__('Details')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
            <tr>
                <td colspan="7">
                    <div class="text-center">
                        <i class="fas fa-folder-open text-gray" style="font-size: 48px;"></i>
                        <h2><?php echo e(__('Opps...')); ?></h2>
                        <h6> <?php echo __('No data Found.'); ?> </h6>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(".add_to_cart").click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var variants = [];
            $(".variant-selection").each(function (index, element) {
                variants.push(element.value);
            });

            if (jQuery.inArray('', variants) != -1) {
                show_toastr('Error', "<?php echo e(__('Please select all option.')); ?>", 'error');
                return false;
            }
            var variation_ids = $('#variant_id').val();

            $.ajax({
                url: '<?php echo e(route('user.addToCart', ['__product_id',$store->slug,'variation_id'])); ?>'.replace('__product_id', id).replace('variation_id', variation_ids ?? 0),
                type: "POST",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    variants: variants.join(' : '),
                },
                success: function (response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        $("#shoping_counts").html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (result) {
                    console.log('error');
                }
            });
        });

        $(document).on('click', '.add_to_wishlist', function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('store.addtowishlist', [$store->slug,'__product_id'])); ?>'.replace('__product_id', id),
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (response) {

                    if (response.status == "Success") {

                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).removeClass('add_to_wishlist');
                        $('.wishlist_' + response.id).html('<i class="fas fa-heart"></i>');
                        $('.wishlist_count').html(response.count);
                    } else {
                        console.log(response.status);
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (result) {
                }
            });
        });

        $(".productTab").click(function (e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });

        $("#pro_scroll").click(function () {
            $('html, body').animate({
                scrollTop: $("#pro_items").offset().top
            }, 1000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('storefront.layout.theme1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/storefront/theme1/customer/index.blade.php ENDPATH**/ ?>