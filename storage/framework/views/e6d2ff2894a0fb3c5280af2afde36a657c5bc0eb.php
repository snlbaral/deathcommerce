<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <style>
        .product-box .product-price {
            justify-content: unset;
        }

        .p-tablist .nav-tabs .nav-item .nav-link.active {
            background-color: #fff !important;
            border-radius: 25px;
            padding: 10px;
        }

        .p-tablist .nav-tabs .nav-item .nav-link {
            border-radius: 25px;
            padding: 10px;
        }
        .nav-tabs {
            border-bottom: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php
$imgpath=\App\Models\Utility::get_file('uploads/');
$productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
$catimg = \App\Models\Utility::get_file('uploads/product_image/');
$default =\App\Models\Utility::get_file('uploads/theme2/header/storego-image.png');
$s_logo = \App\Models\Utility::get_file('uploads/blog_cover_image/');

?>
<?php $__env->startSection('content'); ?> 
<div class="wrapper">
    <?php $__currentLoopData = $pixelScript; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $script): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?= $script; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <section class="main-home-first-section">
        <div class="offset-container offset-left">
            <div class="row justify-content-end">
                <?php if($theme3_product != null): ?>
                    <div class="col-lg-6 col-12">
                        <div class="home-banner-product padding-top">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <div class="banner-title">
                                        <h1><?php echo e($theme3_product->name); ?></h1>
                                    </div>
                                    <div class="banner-links">
                                        <ul class="banner-list">
                                            <li><a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product->id])); ?>" class="text-dark"><?php echo e(__('DESCRIPTION')); ?></a></li>
                                            <li><a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product->id])); ?>" class="text-dark"><?php echo e(__('SPECIFICATION')); ?></a></li>
                                            <li><a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product->id])); ?>" class="text-dark"><?php echo e(__('DETAILS')); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="product-img">
                                        
                                        <?php if($theme3_product_image != null &&  $theme3_product_image->count()>0): ?>
                                            <img src="<?php echo e($catimg.$theme3_product_image[0]['product_images']); ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <?php if($theme3_product_image != null ): ?>
                                        <?php if($theme3_product['enable_product_variant'] == 'on'): ?>
                                            <div class="price justify-content-center">
                                                <ins><span class="currency-type"></span> <?php echo e(__('In variant')); ?></ins>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product->id])); ?>" class="btn"><?php echo e(__('ADD TO CART')); ?><i class="fas fa-shopping-basket"></i></a>
                                                <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                                    <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                        <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                    <?php else: ?>
                                                        <a class="btn-secondary wish-btn"><i class="fas fa-heart" data-id="<?php echo e($theme3_product->id); ?>"></i></a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="price justify-content-center">
                                                <ins><?php echo e(\App\Models\Utility::priceFormat($theme3_product->price)); ?></ins>
                                            </div>
                                            <div class="cart-btns">
                                                <a class="btn add_to_cart" data-id="<?php echo e($theme3_product->id); ?>"><?php echo e(__('ADD TO CART')); ?><i class="fas fa-shopping-basket"></i></a>
                                                <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                                    <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                        <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                    <?php else: ?>
                                                        <a class="btn-secondary wish-btn"><i class="fas fa-heart" data-id="<?php echo e($theme3_product->id); ?>"></i></a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-6 col-12">
                    <?php if($getStoreThemeSetting[0]['section_enable'] == 'on'): ?>
                        <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($storethemesetting['section_name'] == 'Banner-Image'): ?>
                                <div class="main-banner-img">
                                    <img src="<?php echo e($imgpath.(!empty($storethemesetting['inner-list'][0]['field_default_text'])?$storethemesetting['inner-list'][0]['field_default_text']:'theme3/header/header_img_3.png')); ?>" alt="">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="store-promotions-section">
        <?php if($getStoreThemeSetting[1]['section_enable'] == 'on'): ?>
            <div class="container">
                <div class="row justify-content-center">
                    <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($storethemesetting['section_name'] == 'Home-Promotions'): ?>
                            <?php if(isset($storethemesetting['homepage-promotions-font-icon']) || isset($storethemesetting['homepage-promotions-title']) || isset($storethemesetting['homepage-promotions-description'])): ?>
                                <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="about-promotions">
                                            <h3><?php echo $storethemesetting['homepage-promotions-font-icon'][$i]; ?> <?php echo e($storethemesetting['homepage-promotions-title'][$i]); ?></h3>
                                            <p> <?php echo e($storethemesetting['homepage-promotions-description'][$i]); ?></p>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php else: ?>
                                <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="about-promotions">
                                            <h3><?php echo $storethemesetting['inner-list'][0]['field_default_text']; ?> <?php echo e($storethemesetting['inner-list'][1]['field_default_text']); ?></h3>
                                            <p> <?php echo e($storethemesetting['inner-list'][2]['field_default_text']); ?></p>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <?php if($store->blog_enable == 'on'): ?>
        <section class="new-collection-section padding-bottom">
            <div class="container">
                <div class="row collection-row">
                    <div class="col-lg-8 col-12">
                        <div class="new-collection-item">
                            <div class="new-collection-inner">
                                <?php if($blogs->count()>0): ?>

                                    <div class="collection-img">
                                            <img src="<?php echo e($s_logo.($blogs[0]['blog_cover_image'])); ?>" alt="">
                                    </div>
                                    <div class="collection-desk">
                                        <h2><?php echo e($blogs[0]['title']); ?></h2>
                                        <a href="<?php echo e(route('store.store_blog_view',[$store->slug,$blogs[0]['id']])); ?>" class="btn btn-white"><?php echo e(__('Show More')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 right-side">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                                <div class="new-collection-item style-two">
                                    <div class="new-collection-inner">
                                        <?php if($blogs->count()>1): ?>
                                            <div class="collection-img">
                                                <img src="<?php echo e($s_logo.($blogs[1]['blog_cover_image'])); ?>" alt="">
                                            </div>
                                            <div class="collection-desk">
                                                <h3><?php echo e($blogs[1]['title']); ?></h3>
                                                <a href="<?php echo e(route('store.store_blog_view',[$store->slug,$blogs[1]['id']])); ?>" class="btn-link"><?php echo e(__('SHOW MORE')); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-6 col-12">
                                <div class="new-collection-item style-two">
                                    <div class="new-collection-inner">
                                        <?php if($blogs->count()>2): ?>
                                            <div class="collection-img">
                                                <img src="<?php echo e($s_logo.($blogs[2]['blog_cover_image'])); ?>" alt="">
                                            </div>
                                            <div class="collection-desk">
                                                <h3><?php echo e($blogs[2]['title']); ?></h3>
                                                <a href="<?php echo e(route('store.store_blog_view',[$store->slug,$blogs[2]['id']])); ?>" class="btn-link"><?php echo e(__('SHOW MORE')); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if($theme3_product_random != null && $theme3_product_random->count()>0): ?>
        <section class="your-time-section padding-bottom ">
            <div class="container">
                <div class="row  align-items-center ">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="rightside-img">
                            <?php if(!empty($theme3_product_random->is_cover)): ?>
                                <img src="<?php echo e($productImg.(!empty($theme3_product_random->is_cover)?$theme3_product_random->is_cover:'')); ?>" title="<?php echo e($theme3_product_random->name); ?>" alt="">
                            <?php else: ?>
                                <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>" alt="" title="<?php echo e($theme3_product_random->name); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="product-desk">
                            <div class="title-inner">
                                <h2><a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product_random->id])); ?>"><?php echo e($theme3_product_random->name); ?></a></h2>
                            </div>
                            <p><?php echo $theme3_product_random->detail; ?></p>
                            <?php if($theme3_product_random['enable_product_variant'] == 'on'): ?>
                                <div class="cart-btn align-items-center">
                                    <a href="<?php echo e(route('store.product.product_view',[$store->slug,$theme3_product_random->id])); ?>" class="btn"><i class="fas fa-shopping-basket"></i></a>
                                    <?php if(Auth::guard('customers')->check()): ?>
                                        <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                            <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                            <?php else: ?>
                                                <a class="btn-secondary wish-btn"><i class="fas fa-heart" data-id="<?php echo e($theme3_product->id); ?>"></i></a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="price">
                                        <h6><?php echo e(__('In variant')); ?></h6>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="cart-btn align-items-center">
                                    <a class="btn add_to_cart" data-id="<?php echo e($theme3_product_random->id); ?>"><?php echo e(__('Add to cart')); ?><i class="fas fa-shopping-basket"></i></a>
                                    <?php if(Auth::guard('customers')->check()): ?>
                                        <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                            <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                            <?php else: ?>
                                                <a class="btn-secondary wish-btn"><i class="fas fa-heart" data-id="<?php echo e($theme3_product->id); ?>"></i></a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="price">
                                        <ins><?php echo e(\App\Models\Utility::priceFormat($theme3_product_random->price)); ?></ins>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="bestsellers-section  padding-bottom ">
        <?php if($products['Start shopping']->count() > 0): ?>
            <div class="container">
                <div class="tabs-wrapper">
                    <div class="section-title-bg section-title d-flex align-items-center justify-content-between">
                        <h2><?php echo e(__('Products')); ?></h2>
                        <ul class="d-flex tabs">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="tab-link <?php echo e($key == 0 ? 'active' : ''); ?>" data-tab="tab-<?php echo preg_replace('/[^A-Za-z0-9\-]/', '_', $category); ?>">
                                    <a> <?php echo e(__($category)); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="tabs-container">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-content <?php echo e(($key=='Start shopping')?'active show':''); ?>" id="tab-<?php echo preg_replace('/[^A-Za-z0-9\-]/', '_', $key); ?>">
                                <div class="row product-row ">
                                    <?php if($items->count() > 0): ?>
                                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 product-card">
                                                <div class="product-card-inner">
                                                    <div class="product-img">
                                                        <a href="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>">
                                                            <?php if(!empty($product->is_cover) ): ?>
                                                                <img src="<?php echo e($productImg.$product->is_cover); ?>" alt="">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>" alt="">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-rating">
                                                            <?php if($store->enable_rating == 'on'): ?>
                                                                <?php for($i =1;$i<=5;$i++): ?>
                                                                    <?php
                                                                        $icon = 'fa-star';
                                                                        $color = '';
                                                                        $newVal1 = ($i-0.5);
                                                                        if($product->product_rating() < $i && $product->product_rating() >= $newVal1)
                                                                        {
                                                                            $icon = 'fa-star-half-alt';
                                                                        }
                                                                        if($product->product_rating() >= $newVal1)
                                                                        {
                                                                            $color = 'text-warning';
                                                                        }
                                                                    ?>
                                                                    <i class="star fas <?php echo e($icon .' '. $color); ?>"></i>
                                                                <?php endfor; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <h5>
                                                            <a href="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>"><?php echo e($product->name); ?></a>
                                                        </h5>
                                                        <p><?php echo e(__('Category')); ?>: <?php echo e($product->product_category()); ?></p>
                                                        <div class="product-content-bottom">
                                                            <?php if($product['enable_product_variant'] == 'on'): ?>
                                                                <div class="price">
                                                                    <ins><?php echo e(__('In variant')); ?></ins>
                                                                </div>
                                                                <a href="<?php echo e(route('store.product.product_view',[$store->slug,$product->id])); ?>" class="btn cart-btn"><i class="fas fa-shopping-basket"></i></a>
                                                                <?php if(Auth::guard('customers')->check()): ?>
                                                                    <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                                                        <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                                            <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                                        <?php else: ?>
                                                                            <a class="btn-secondary wish-btn " data-id="<?php echo e($theme3_product->id); ?>"><i class="fas fa-heart"></i></a>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <div class="price">
                                                                    <ins><?php echo e(\App\Models\Utility::priceFormat($product->price)); ?></ins>
                                                                </div>
                                                                <a class="btn cart-btn add_to_cart" data-id="<?php echo e($product->id); ?>"><?php echo e(__('Add to cart')); ?><i class="fas fa-shopping-basket"></i></a>
                                                                <?php if(Auth::guard('customers')->check()): ?>
                                                                    <?php if(!empty($wishlist) && isset($wishlist[$theme3_product->id]['product_id'])): ?>
                                                                        <?php if($wishlist[$theme3_product->id]['product_id'] != $theme3_product->id): ?>
                                                                            <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                                        <?php else: ?>
                                                                            <a class="btn-secondary wish-btn"><i class="fas fa-heart" data-id="<?php echo e($theme3_product->id); ?>"></i></a>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <a class="btn-secondary wish-btn add_to_wishlist wishlist_<?php echo e($theme3_product->id); ?>" data-id="<?php echo e($theme3_product->id); ?>"><i class="far fa-heart"></i></a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?> 
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 product-card">
                                            <h6 class="no_record"><i class="fas fa-ban"></i> <?php echo e(__('No Record Found')); ?></h6>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($storethemesetting['section_name']) && $storethemesetting['section_name'] == 'Home-Categories' && $storethemesetting['section_enable'] == 'on' && !empty($pro_categories)): ?>
            <?php
                // dd($storethemesetting);
                $Titlekey = array_search('Title', array_column($storethemesetting['inner-list'], 'field_name'));
                $Title = $storethemesetting['inner-list'][$Titlekey]['field_default_text'];

                $Description_key = array_search('Description', array_column($storethemesetting['inner-list'], 'field_name'));
                $Description = $storethemesetting['inner-list'][$Description_key]['field_default_text'];
            ?>
            <section class="category-section padding-bottom">
                <div class="container">
                    <div class="section-title text-center">
                        <h2><?php echo e($Title); ?></h2>
                        <p><?php echo e($Description); ?></p>
                    </div>
                    <div class="row category-row">
                        <?php $__currentLoopData = $pro_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$pro_categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($product_count[$key] > 0): ?>
                                <div class="col-md-6 col-lg-4 col-12 category-card">
                                    <div class="category-card-inner">
                                        <div class="category-card-img">
                                            <a href="<?php echo e(route('store.categorie.product',[$store->slug,$pro_categorie->name])); ?>">
                                                <?php if(!empty($pro_categorie->categorie_img)): ?>
                                                    <img src="<?php echo e($catimg .(!empty($pro_categorie->categorie_img)?$pro_categorie->categorie_img:'default.jpg')); ?>" alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset(Storage::url('uploads/product_image/default.jpg'))); ?>" alt="">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="category-content">
                                            <h4>
                                                <a href="#"><?php echo e($pro_categorie->name); ?></a>
                                            </h4>
                                            <a href="<?php echo e(route('store.categorie.product',[$store->slug,$pro_categorie->name])); ?>" class="btn-link"><?php echo e(__('SHOW MORE')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(count($topRatedProducts) > 0): ?>
        <section class="total-rated-product padding-bottom">
            <div class="container">
                <div class="section-title d-flex align-items-center justify-content-between">
                    <h2 class="h1"><?php echo e(__('Top rated products')); ?></h2>
                    <a href="<?php echo e(route('store.categorie.product', $store->slug)); ?>" class="btn cart-btn"><?php echo e(__('Show more products')); ?></a>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $topRatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $topRatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 product-card">
                            <div class="product-card-inner">
                                <div class="product-img">
                                    <a href="<?php echo e(route('store.product.product_view', [$store->slug, $topRatedProduct->product_id])); ?>">
                                        <?php if(!empty($topRatedProduct->product->is_cover)): ?>
                                            <img src="<?php echo e($productImg . $topRatedProduct->product->is_cover); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset(Storage::url('uploads/is_cover_image/default.jpg'))); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
                                        <?php if($store->enable_rating == 'on'): ?>
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php
                                                    $icon = 'fa-star';
                                                    $color = '';
                                                    $newVal1 = $i - 0.5;
                                                    if ($topRatedProduct->product->product_rating() < $i && $topRatedProduct->product->product_rating() >= $newVal1) {
                                                        $icon = 'fa-star-half-alt';
                                                    }
                                                    if ($topRatedProduct->product->product_rating() >= $newVal1) {
    
                                                        $color = 'text-warning';
    
                                                    }
                                                ?>
    
                                            <i class="star fas <?php echo e($icon . ' ' . $color); ?>"></i>
                                            <?php endfor; ?>
                                        <?php endif; ?>
                                    </div>
                                    <h5>
                                        <a href="<?php echo e(route('store.product.product_view', [$store->slug, $topRatedProduct->product_id])); ?>"><?php echo e($topRatedProduct->product->name); ?></a>
                                    </h5>
                                    <p><?php echo e(__('Category')); ?>:  <?php echo e($topRatedProduct->product->product_category()); ?></p>
                                    <div class="product-content-bottom">
                                        <div class="price">
                                            <ins>
                                               
                                                <?php if($topRatedProduct->product->enable_product_variant == 'on'): ?>
                                                    <?php echo e(__('In variant')); ?>

                                                <?php else: ?>
                                                    <?php echo e(\App\Models\Utility::priceFormat($topRatedProduct->product->price)); ?>

                                                <?php endif; ?>
                                            </ins>
                                        </div>
                                        <?php if($topRatedProduct->product->enable_product_variant == 'on'): ?>
                                            <a href="<?php echo e(route('store.product.product_view', [$store->slug, $topRatedProduct->product->id])); ?>" class="btn cart-btn"><i class="fas fa-shopping-basket"></i></a>
                                        <?php else: ?>
                                            <a href="#" class="btn cart-btn add_to_cart" data-id="<?php echo e($topRatedProduct->product->id); ?>"><?php echo e(__('Add to cart')); ?> <i class="fas fa-shopping-basket"></i></a>
                                        <?php endif; ?>
                                        <?php if(Auth::guard('customers')->check()): ?>
                                            <?php if(!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id'])): ?>
                                                <?php if($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id): ?>
                                                    <a href="#" class="btn wishlist-btn add_to_wishlist wishlist_<?php echo e($topRatedProduct->product->id); ?>" data-id="<?php echo e($topRatedProduct->product->id); ?>"><i class="far fa-heart"></i></a>
                                                <?php else: ?>
                                                    <a href="#" class="btn wishlist-btn" data-id="<?php echo e($topRatedProduct->product->id); ?>" disabled><i class="far fa-heart"></i></a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="#" class="btn wishlist-btn add_to_wishlist wishlist_<?php echo e($topRatedProduct->product->id); ?>" data-id="<?php echo e($topRatedProduct->product->id); ?>"><i class="far fa-heart"></i></a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="#" class="btn wishlist-btn add_to_wishlist wishlist_<?php echo e($topRatedProduct->product->id); ?>" data-id="<?php echo e($topRatedProduct->product->id); ?>"><i class="far fa-heart"></i></a>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($getStoreThemeSetting[3]['section_enable'] == 'on'): ?>
        <section class="testimonial-section padding-bottom">
            <div class="container">
                <div class="testimonial-slider">
                    <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($storethemesetting['section_name']) && $storethemesetting['section_name'] == 'Home-Testimonial' && $storethemesetting['array_type'] == 'multi-inner-list'): ?> 
                            <?php if(isset($storethemesetting['homepage-testimonial-card-image']) || isset($storethemesetting['homepage-testimonial-card-title']) || isset($storethemesetting['homepage-testimonial-card-sub-text']) || isset($storethemesetting['homepage-testimonial-card-description']) || isset($storethemesetting['homepage-testimonial-card-enable'])): ?>
                                <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                    <?php if($storethemesetting['homepage-testimonial-card-enable'][$i] == 'on'): ?>
                                        
                                            <div class="testimonial-card">
                                                <div class="testimonial-content">
                                                    <div class="title-inner">
                                                        <div class="subtitle"><?php echo e($getStoreThemeSetting[3]['inner-list'][1]['field_default_text']); ?></div>
                                                        <h2><?php echo e($getStoreThemeSetting[3]['inner-list'][0]['field_default_text']); ?></h2>
                                                    </div>
                                                    <p><?php echo e($storethemesetting['homepage-testimonial-card-description'][$i]); ?></p>
                                                    <div class="abt-user">
                                                        <p><?php echo e($storethemesetting['homepage-testimonial-card-title'][$i]); ?></p>
                                                        <small> <?php echo e($storethemesetting['homepage-testimonial-card-sub-text'][$i]); ?></small>
                                                    </div>
                                                </div>
                                                <div class="testimonial-img">
                                                    <img src="<?php echo e($imgpath. (!empty($storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text']) ? $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] : 'theme3/header/header_img_3.png')); ?>" alt="">
                                                </div>
                                            </div>
                                        
                                    <?php endif; ?>
                                <?php endfor; ?>
                            <?php else: ?>
                                <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                
                                        <div class="testimonial-card">
                                            <div class="testimonial-content">
                                                <div class="title-inner">
                                                    <?php for($k=0;$k<=count($getStoreThemeSetting);$k++): ?>
                                                        <?php if(isset($getStoreThemeSetting[$k]['section_name']) && $getStoreThemeSetting[$k]['section_name'] == 'Home-Testimonial' && $getStoreThemeSetting[$k]['array_type'] == 'inner-list' && $getStoreThemeSetting[$k]['section_enable'] == 'on'): ?>
                                                            <?php
                                                                $Heading_key = array_search('Main Heading', array_column($getStoreThemeSetting[$k]['inner-list'], 'field_name'));
                                                                $Heading = $getStoreThemeSetting[$k]['inner-list'][$Heading_key]['field_default_text'];

                                                                $HeadingSubText_key = array_search('Main Heading Title', array_column($getStoreThemeSetting[$k]['inner-list'], 'field_name'));
                                                                $HeadingSubText = $getStoreThemeSetting[$k]['inner-list'][$HeadingSubText_key]['field_default_text'];
                                                            ?>
                                                            <div class="subtitle"><?php echo e($HeadingSubText); ?></div>
                                                            <h2><?php echo e($Heading); ?></h2>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <?php for($a=0;$a<=count($getStoreThemeSetting);$a++): ?>
                                                    <?php if(isset($getStoreThemeSetting[$a]['section_name']) && $getStoreThemeSetting[$a]['section_name'] == 'Home-Testimonial' && $getStoreThemeSetting[$a]['array_type'] == 'multi-inner-list'): ?>
                                                        <p><?php echo e($getStoreThemeSetting[$a]['inner-list'][4]['field_default_text']); ?></p>
                                                        <div class="abt-user">
                                                            <p><?php echo e($getStoreThemeSetting[$a]['inner-list'][2]['field_default_text']); ?></p>
                                                            <small> <?php echo e($getStoreThemeSetting[$a]['inner-list'][3]['field_default_text']); ?></small>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="testimonial-img">
                                                <img src="<?php echo e($imgpath.(!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'theme3/header/header_img_3.png')); ?>" alt="">
                                            </div>
                                        </div>
                                
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>                
            </div>  
        </section>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('storefront.layout.theme3', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/storefront/theme3/index.blade.php ENDPATH**/ ?>