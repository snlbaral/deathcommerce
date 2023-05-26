<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Details')); ?>

<?php $__env->stopSection(); ?>
<?php
$imgpath=\App\Models\Utility::get_file('uploads/product_image/');
$proimg=\App\Models\Utility::get_file('uploads/is_cover_image/');
?>
<?php $__env->startSection('content'); ?>
<div class="wrapper">
    <section class="product-detail-section padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="product-slider">
                        <div class="pdp-det-slider">
                            <?php $__currentLoopData = $products_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pdp-main-itm <?php echo e($key == 0 ? 'active' : ''); ?>"  data-slide-number="<?php echo e($key); ?>">
                                    <?php if(!empty($products_image[$key]->product_images)): ?>
                                    <div class="pdp-itm-inner">
                                        <img src="<?php echo e($imgpath. $products_image[$key]->product_images); ?>"  data-remote="<?php echo e($imgpath. $products_image[$key]->product_images); ?>" data-type="image" data-toggle="lightbox" data-gallery="example-gallery" alt="product">
                                    </div>    
                                    <?php else: ?>
                                    <div class="pdp-itm-inner">
                                        <img src="<?php echo e(asset(Storage::url('uploads/product_image/default.jpg'))); ?>"  data-remote="<?php echo e($imgpath. $products_image[$key]->product_images); ?>" data-type="image" data-toggle="lightbox" data-gallery="example-gallery" alt="product">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="pdp-thumb-slider">
                            <?php $__currentLoopData = $products_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $productss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="pdp-thumb-itm" data-slide-to="<?php echo e($key); ?>">
                                    <div class="pdp-thumb-inner">
                                        <?php if(!empty($products_image[$key]->product_images)): ?>
                                            <img src="<?php echo e($imgpath. $products_image[$key]->product_images); ?>" alt="...">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset(Storage::url('uploads/product_image/default.jpg'))); ?>" alt="...">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="review-box-2">
                        <h5><?php echo e(__('Reviews')); ?>:
                            <b><?php echo e($avg_rating); ?>/5</b>
                            <span> (<?php echo e(__('reviews')); ?>) </span>
                        </h5>
                        <div class="review-star">
                            <div class="product-rating">
                                <?php if($store_setting->enable_rating == 'on'): ?>
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php
                                            $icon = 'fa-star';
                                            $color = '';
                                            $newVal1 = $i - 0.5;
                                            if ($avg_rating < $i && $avg_rating >= $newVal1) {
                                                $icon = 'fa-star-half-alt';
                                            }
                                            if ($avg_rating >= $newVal1) {
                                                $color = 'text-primary';
                                            }
                                        ?>
                                        <i class="star fas <?php echo e($icon . ' ' . $color); ?>"></i>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </div>
                            <?php if(Auth::guard('customers')->check()): ?>
                                
                                <a href="#"
                                        class="btn btn-sm btn-primary btn-icon-only rounded-circle float-right text-white"
                                        data-size="lg" data-toggle="modal"
                                        data-url="<?php echo e(route('rating', [$store->slug, $products->id])); ?>"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Create New Rating')); ?>">
                                        <i class="fas fa-plus"></i>
                                    </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="review-scroll">
                        <?php $__currentLoopData = $product_ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_key => $product_rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($product_rating->rating_view == 'on'): ?>
                  
                            <div class="review-top d-flex">
                                <p><?php echo e($product_rating->name); ?> :</p>
                                <span><?php echo e($product_rating->title); ?></span>
                            </div>
                            <div class="review-box-bottom">
                                <div class="rating-pdp">
                                    <span>
                                        <?php for($i = 0; $i < 5; $i++): ?>
                                        <i class="star fas fa-star <?php echo e($product_rating->ratting > $i ? 'text-primary' : ''); ?>"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <p><?php echo e($avg_rating); ?>/5 (<?php echo e($user_count); ?> <?php echo e(__('reviews')); ?>)</p>
                                </div>
                                <p><?php echo e($product_rating->description); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="pdp-summery">
                        <div class="customer-product-review">
                            <div class="product-rating d-flex align-items-center">
                                <div class="rating-pdp">
                                    <?php if($store_setting->enable_rating == 'on'): ?>
                                        <span>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php
                                                    $icon = 'fa-star';
                                                    $color = '';
                                                    $newVal1 = $i - 0.5;
                                                    if ($avg_rating < $i && $avg_rating >= $newVal1) {
                                                        $icon = 'fa-star-half-alt';
                                                    }
                                                    if ($avg_rating >= $newVal1) {
                                                        $color = 'text-primary';
                                                    }
                                                ?>
                                                <i class="star fas <?php echo e($icon . ' ' . $color); ?>"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <p><?php echo e($avg_rating); ?>/5 (<?php echo e($user_count); ?> <?php echo e(__('reviews')); ?>)</p>
                                    <?php endif; ?>
                                </div>
                                <div class="wish-btn-wrap">
                                    <?php if(Auth::guard('customers')->check()): ?>
                                        <?php if(!empty($wishlist) && isset($wishlist[$products->id]['product_id'])): ?>
                                            <?php if($wishlist[$products->id]['product_id'] != $products->id): ?>
                                                <a href="#" class="btn-icon add_to_wishlist wishlist_<?php echo e($products->id); ?>" data-id="<?php echo e($products->id); ?>">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn-icon">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="#" class="btn-icon add_to_wishlist wishlist_<?php echo e($products->id); ?>" data-id="<?php echo e($products->id); ?>">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="#" class="btn-icon add_to_wishlist wishlist_<?php echo e($products->id); ?>" data-id="<?php echo e($products->id); ?>">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <h2><?php echo e($products->name); ?></h2>
                            <p><?php echo $products->detail; ?>

                            </p>
                            
                            <?php if($products->enable_product_variant == 'on'): ?>
                                <input type="hidden" id="product_id" value="<?php echo e($products->id); ?>">
                                <input type="hidden" id="variant_id" value="">
                                <input type="hidden" id="variant_qty" value="">
                                <div class="p-color mt-3">
                                    <p class="mb-0"><?php echo e(__('VARIATION:')); ?></p>
                                    <?php $__currentLoopData = $product_variant_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-sm-6 mb-4 mb-sm-0">
                                            <p class="d-block h6 mb-0">
                                            <p class="mb-0 variant_name"><?php echo e(empty($variant->variant_name) ? $variant['variant_name'] :  $variant->variant_name); ?></p>
        
                                            <select name="product[<?php echo e($key); ?>]"  id="pro_variants_name"
                                                class="form-control variant-selection  pro_variants_name<?php echo e($key); ?> pro_variants_name variant_loop variant_val">
                                                
                                                <?php $__currentLoopData = $variant->variant_options ?? $variant['variant_options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($values); ?>" id="<?php echo e($values); ?>_varient_option"><?php echo e($values); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                             <?php endif; ?>
                            <div class="price product-price">
                                <span class="variation_price">
                                    <?php if($products->enable_product_variant == 'on'): ?>
                                     <?php echo e(\App\Models\Utility::priceFormat(0)); ?> 
                                    <?php else: ?>
                                       <?php echo e(\App\Models\Utility::priceFormat($products->price)); ?>

                                    <?php endif; ?>
                                </span>
                                <del><?php echo e(\App\Models\Utility::priceFormat($products->last_price)); ?></del>
                            </div>
                            <span class=" mb-0 text-danger product-price-error"></span>
                        </div>
                        <div class="addcart-btn">
                            <a href="#" class="btn add_to_cart" data-id="<?php echo e($products->id); ?>"><?php echo e(__('Add to cart')); ?>

                                <i class="fas fa-shopping-basket"></i>
                            </a>
                            <p><?php echo e(__('Category')); ?>:<span>  <?php echo e($products->product_category()); ?></span></p>
                            <p><?php echo e(__('ID')); ?>:<span> <?php echo e($products->SKU); ?></span></p>
                        </div>
                        <ul class="product-variables">
                            <?php if(!empty($products->custom_field_1) && !empty($products->custom_value_1)): ?>
                                <li>
                                    <span class="var-left"><b><?php echo e($products->custom_field_1); ?> :</b></span>
                                    <span class="var-right"><?php echo e($products->custom_value_1); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($products->custom_field_2) && !empty($products->custom_value_2)): ?>
                                <li>
                                    <span class="var-left"><b><?php echo e($products->custom_field_2); ?> : </b> </span>
                                    <span class="var-right"><?php echo e($products->custom_value_2); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($products->custom_field_3) && !empty($products->custom_value_3)): ?>
                                <li>
                                    <span class="var-left"><b><?php echo e($products->custom_field_3); ?> :</b> </span>
                                    <span class="var-right"> <?php echo e($products->custom_value_3); ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty($products->custom_field_4) && !empty($products->custom_value_4)): ?>
                                <li>
                                    <span class="var-left"><b><?php echo e($products->custom_field_4); ?> : </b> </span>
                                    <span class="var-right"> <?php echo e($products->custom_value_4); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="description-accordion">
                            <?php if(!empty($products->description)): ?>
                                <div class="set has-children">
                                    <a href="javascript:;" class="acnav-label">
                                        <span><?php echo e(__('DESCRIPTION')); ?></span> 
                                    </a>
                                    <div class="acnav-list">
                                    <p> <?php echo $products->description; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($products->specification)): ?>
                                <div class="set has-children">
                                    <a href="javascript:;" class="acnav-label">
                                        <span><?php echo e(__('SPECIFICATION')); ?></span> 
                                    </a>
                                    <div class="acnav-list">
                                    <p><?php echo $products->specification; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($products->detail)): ?>
                                <div class="set has-children">
                                    <a href="javascript:;" class="acnav-label">
                                        <span><?php echo e(__('DETAILS')); ?></span> 
                                    </a>
                                    <div class="acnav-list">
                                    <p> <?php echo $products->detail; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($products->attachment)): ?>
                                <div class="set has-children">
                                    <a href="javascript:;" class="acnav-label">
                                        <span> <?php echo e(__('Download instruction ')); ?></span>
                                    </a>
                                    <div class="acnav-list">
                                        <div class="btn">
                                            <a href="<?php echo e(asset(Storage::url('uploads/is_cover_image/'.$products->attachment))); ?>" class="btn-instruction" download="<?php echo e($products->attachment); ?>">
                                                <span class="btn-inner--icon">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </span>
                                                <?php echo e(__('Download instruction .pdf')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-product-section padding-top">
        <div class="container">
            <div class="section-title">
                <h2><?php echo e(__('Related products')); ?></h2>
            </div>
            <div class="row product-row">
                <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($product->id != $products->id): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-card">
                                <div class="card-img">
                                    <a href="<?php echo e(route('store.product.product_view', [$store->slug, $product->id])); ?>">
                                        <?php if(!empty($product->is_cover) ): ?>
                                            <img alt="Image placeholder" src="<?php echo e($proimg. $product->is_cover); ?>">
                                        <?php else: ?>
                                            <img alt="Image placeholder" src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>">
                                        <?php endif; ?>
                                    </a>
                                    
                                        <?php if(!empty($wishlist) && isset($wishlist[$product->id]['product_id'])): ?>
                                            <?php if($wishlist[$product->id]['product_id'] != $product->id): ?>
                                                <a  class="heart-icon action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            <?php else: ?>
                                                <a class="heart-icon action-item wishlist-icon bg-light-gray" data-id="<?php echo e($product->id); ?>" disabled>
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a class="heart-icon action-item wishlist-icon bg-light-gray add_to_wishlist wishlist_<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        <?php endif; ?>
                                    
                                </div>
                                <div class="card-content">
                                    <div class="rating">
                                        <?php if($store->enable_rating == 'on'): ?>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php
                                                    $icon = 'fa-star';
                                                    $color = '';
                                                    $newVal1 = $i - 0.5;
                                                    if ($product->product_rating() < $i && $product->product_rating() >= $newVal1) {
                                                        $icon = 'fa-star-half-alt';
                                                    }
                                                    if ($product->product_rating() >= $newVal1) {
                                                        $color = 'text-warning';
                                                    }
                                                    
                                                ?>
                                                <i class="star fas <?php echo e($icon . ' ' . $color); ?>"></i>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                    <h6>
                                        <a href="<?php echo e(route('store.product.product_view', [$store->slug, $product->id])); ?>"><?php echo e($product->name); ?></a>
                                    </h6>
                                <p><?php echo e(__('Category')); ?>: <?php echo e($product->product_category()); ?></p>
                                    
                                    <div class="last-btn">
                                        <div class="price">
                                            <?php if($product->enable_product_variant == 'on'): ?>
                                                <ins><?php echo e(__('In variant')); ?></ins>
                                            <?php else: ?>
                                                <ins><?php echo e(\App\Models\Utility::priceFormat($product->price)); ?></ins> 
                                            <?php endif; ?>
                                           
                                        </div>
                                        <?php if($product->enable_product_variant == 'on'): ?>
                                        <a href="<?php echo e(route('store.product.product_view', [$store->slug, $product->id])); ?>" class="cart-btn add_to_cart" data-id="<?php echo e($product->id); ?>"> <i class="fas fa-shopping-basket"></i></a>
                                        <?php else: ?>
                                        <a href="<?php echo e(route('store.product.product_view', [$store->slug, $product->id])); ?>" class="cart-btn add_to_cart" data-id="<?php echo e($product->id); ?>"> <i class="fas fa-shopping-basket"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            set_variant_price();
        });

        $(document).on('click', '.add_to_wishlist', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('store.addtowishlist', [$store->slug, '__product_id'])); ?>'.replace(
                    '__product_id', id),
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).removeClass('add_to_wishlist');
                        $('.wishlist_' + response.id).html('<i class="fas fa-heart"></i>');
                        $('.wishlist_count').html(response.count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {}
            });
        });
        $(".add_to_cart").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });

            if (jQuery.inArray('', variants) != -1) {
                show_toastr('Error', "<?php echo e(__('Please select all option.')); ?>", 'error');
                return false;
            }
            var variation_ids = $('#variant_id').val();

            $.ajax({
                url: '<?php echo e(route('user.addToCart', ['__product_id', $store->slug, 'variation_id'])); ?>'.replace(
                    '__product_id', id).replace('variation_id', variation_ids ?? 0),
                type: "POST",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    variants: variants.join(' : '),
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        $("#shoping_counts").html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {
                    console.log('error');
                }
            });
        });

        $(document).on('change', '#pro_variants_name', function() {
            set_variant_price();
        });

        function set_variant_price() {
            var variants = [];
            $(".variant-selection").each(function(index, element) {
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
                    
                    success: function(data) {
                        $('.product-price-error').hide();
                        $('.product-price').show();

                        $('.variation_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);


                        var variant_message_array = [];
                        $( ".variant_loop" ).each(function( index ) {
                                var variant_name = $(this).prev().text();
                                var variant_val = $(this).val();
                                variant_message_array.push(variant_val+" "+variant_name);
                        });
                        var variant_message = variant_message_array.join(" and ");

                        if(data.variant_id == 0) {
                            $('.add_to_cart').hide();

                            $('.product-price').hide();
                            $('.product-price-error').show();
                            var message =  '<span class=" mb-0 text-danger">This product is not available with '+variant_message+'.</span>';
                            $('.product-price-error').html(message);
                        }else{
                            $('.add_to_cart').show();
                        }
                    }
                });
            }
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('storefront.layout.theme1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/storefront/theme1/view.blade.php ENDPATH**/ ?>