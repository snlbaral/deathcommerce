<?php
    $data = DB::table('settings');
    $data = $data
        ->where('created_by', '>', 1)
        ->where('store_id', $store->id)
        ->where('name', 'SITE_RTL')
        ->first();
?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e(empty($data) ? '' : ($data->value == 'on' ? 'rtl' : '')); ?>">
<?php
    $userstore = \App\Models\UserStore::where('store_id', $store->id)->first();
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
    $setting = DB::table('settings')
        ->where('name', 'company_favicon')
        ->where('store_id', $store->id)
        ->first();
    $settings = Utility::settings();
    $getStoreThemeSetting = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
    $getStoreThemeSetting1 = [];
    $themeClass = $store->store_theme;
    if (!empty($getStoreThemeSetting['dashboard'])) {
        $getStoreThemeSetting = json_decode($getStoreThemeSetting['dashboard'], true);
        $getStoreThemeSetting1 = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
    }
    
    if (empty($getStoreThemeSetting)) {
        $path = storage_path() . '/uploads/' . $store->theme_dir . '/' . $store->theme_dir . '.json';
        $getStoreThemeSetting = json_decode(file_get_contents($path), true);
    }
    $imgpath = \App\Models\Utility::get_file('uploads/');
    $metaImage = \App\Models\Utility::get_file('uploads/metaImage');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('page-title'); ?> - <?php echo e($store->tagline ? $store->tagline : env('APP_NAME', ucfirst($store->name))); ?> </title>
    <!-- Primary Meta Tags -->
    <meta name="title" content="<?php echo e($store->metakeyword); ?>">
    <meta name="description" content="<?php echo e(ucfirst($store->metadesc)); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($store->metakeyword); ?>">
    <meta property="og:description" content="<?php echo e(ucfirst($store->metadesc)); ?>">
    <meta property="og:image" content="<?php echo e($metaImage .'/'. $store->metaimage); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($store->metakeyword); ?>">
    <meta property="twitter:description" content="<?php echo e(ucfirst($store->metadesc)); ?>">
    <meta property="twitter:image" content="<?php echo e($metaImage .'/'. $store->metaimage); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/theme1/images/favicon.png')); ?>">
    <link rel="icon"
        href="<?php echo e(asset(Storage::url('uploads/logo/') . (!empty($setting->value) ? $setting->value : 'favicon.png'))); ?>"
        type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('assets/theme1/fonts/fontawesome-free/css/all.min.css')); ?>">

    <?php if(isset($data->value) && $data->value == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/theme1/css/rtl-main-style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/theme1/css/rtl-responsive.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/theme1/css/main-style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/theme1/css/responsive.css')); ?>">
    <?php endif; ?>

    
    <meta name="mobile-wep-app-capable" content="yes">
    <meta name="apple-mobile-wep-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <link rel="apple-touch-icon"
        href="<?php echo e(asset(Storage::url('uploads/logo/') . (!empty($setting->value) ? $setting->value : 'favicon.png'))); ?>" />
    <?php if($store->enable_pwa_store == 'on'): ?>
        <link rel="manifest" href="<?php echo e(asset('storage/uploads/customer_app/store_' . $store->id . '/manifest.json')); ?>" />
    <?php endif; ?>
    <?php if(!empty($store->pwa_store($store->slug)->theme_color)): ?>
        <meta name="theme-color" content="<?php echo e($store->pwa_store($store->slug)->theme_color); ?>" />
    <?php endif; ?>
    <?php if(!empty($store->pwa_store($store->slug)->background_color)): ?>
        <meta name="apple-mobile-web-app-status-bar"
            content="<?php echo e($store->pwa_store($store->slug)->background_color); ?>" />
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('css-page'); ?>
</head>

<body class="<?php echo e(!empty($themeClass) ? $themeClass : 'theme1-v1'); ?>">
    <style>
        .whatsapp-link {
          position: fixed;
          bottom: 20px;
          right: 20px;
          z-index: 9999;
        }
    </style>

    <?php
        if (!empty(session()->get('lang'))) {
            $currantLang = session()->get('lang');
        } else {
            $currantLang = $store->lang;
        }
        $languages = \App\Models\Utility::languages();
        $storethemesetting = \App\Models\Utility::demoStoreThemeSetting($store->id, $store->theme_dir);
        
    ?>
    <!--header start here-->
    <header class="site-header">
        <?php if($storethemesetting['enable_top_bar'] == 'on'): ?>
            <div class="header-top">
                <div class="container">
                    <div class="header-top-info">
                        <div class="header-top-left">
                            <p><i class="fas fa-bell"></i>
                                <?php echo e(!empty($storethemesetting['top_bar_title']) ? $storethemesetting['top_bar_title'] : ''); ?>

                            </p>
                        </div>
                        <div class="header-top-right">
                            <ul>
                                <li>
                                    <a
                                        href="tel:<?php echo e(!empty($storethemesetting['top_bar_number']) ? $storethemesetting['top_bar_number'] : '2123081220'); ?>">
                                        <i class="fas fa-phone-volume"></i>
                                        <b><?php echo e(!empty($storethemesetting['top_bar_number']) ? $storethemesetting['top_bar_number'] : '(212) 308-1220'); ?></b>
                                        <?php echo e(__('Request a call')); ?></a>
                                </li>
                                <?php if(!empty($storethemesetting['top_bar_whatsapp'])): ?>
                                    <li>
                                        <a href="https://wa.me/<?php echo e($storethemesetting['top_bar_whatsapp']); ?>"
                                            target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($storethemesetting['top_bar_instagram'])): ?>
                                    <li>
                                        <a href="<?php echo e($storethemesetting['top_bar_instagram']); ?>" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($storethemesetting['top_bar_twitter'])): ?>
                                    <li>
                                        <a href="<?php echo e($storethemesetting['top_bar_twitter']); ?>" target="_blank">
                                            <i class="fab fa-twitter-square"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($storethemesetting['top_bar_messenger'])): ?>
                                    <li>
                                        <a href="<?php echo e($storethemesetting['top_bar_messenger']); ?>" target="_blank">
                                            <i class="far fa-envelope"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="container" id="navbar-main">
            <div class="main-navigationbar">
                <div class="logo-col">
                    <a href="<?php echo e(route('store.slug', $store->slug)); ?>">
                        <img src="<?php echo e($s_logo . (!empty($store->logo) ? $store->logo : 'logo.png')); ?>"
                            style="height: 40px;" id="navbar-logo">
                    </a>
                </div>
                <div class="right-side-header">
                    <div class="main-nav">
                        <ul>
                            <li class="menu-link">
                                <a href="<?php echo e(route('store.slug', $store->slug)); ?>"><?php echo e(ucfirst($store->name)); ?></a>
                            </li>
                            <?php if(!empty($page_slug_urls)): ?>
                                <?php $__currentLoopData = $page_slug_urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $page_slug_url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($page_slug_url->enable_page_header == 'on'): ?>
                                        <li class="menu-link">
                                            <a
                                                href="<?php echo e(env('APP_URL') . 'page/' . $page_slug_url->slug); ?>"><?php echo e(ucfirst($page_slug_url->name)); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            
                            <?php if($store['blog_enable'] == 'on' && !empty($blog)): ?>
                                <li class="menu-link">
                                    <a href="<?php echo e(route('store.blog', $store->slug)); ?>"><?php echo e(__('Blog')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="header-search">
                        <form action="<?php echo e(route('store.categorie.product', [$store->slug, 'Start shopping'])); ?>"
                            method="get">
                            <?php echo csrf_field(); ?>
                            <input type="text" name="search_data" placeholder="Type your product...">
                            <button type="submit" class="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                    viewBox="0 0 13 13" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.47487 10.5131C8.48031 11.2863 7.23058 11.7466 5.87332 11.7466C2.62957 11.7466 0 9.11706 0 5.87332C0 2.62957 2.62957 0 5.87332 0C9.11706 0 11.7466 2.62957 11.7466 5.87332C11.7466 7.23058 11.2863 8.48031 10.5131 9.47487L12.785 11.7465C13.0717 12.0332 13.0717 12.4981 12.785 12.7848C12.4983 13.0715 12.0334 13.0715 11.7467 12.7848L9.47487 10.5131ZM10.2783 5.87332C10.2783 8.30612 8.30612 10.2783 5.87332 10.2783C3.44051 10.2783 1.46833 8.30612 1.46833 5.87332C1.46833 3.44051 3.44051 1.46833 5.87332 1.46833C8.30612 1.46833 10.2783 3.44051 10.2783 5.87332Z"
                                        fill="#545454"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="main-menu-right">
                        <ul class="menu-right d-flex  justify-content-end align-items-center">
                            <li class="search-header">
                                <a href="javascript:;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                        viewBox="0 0 13 13" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.47487 10.5131C8.48031 11.2863 7.23058 11.7466 5.87332 11.7466C2.62957 11.7466 0 9.11706 0 5.87332C0 2.62957 2.62957 0 5.87332 0C9.11706 0 11.7466 2.62957 11.7466 5.87332C11.7466 7.23058 11.2863 8.48031 10.5131 9.47487L12.785 11.7465C13.0717 12.0332 13.0717 12.4981 12.785 12.7848C12.4983 13.0715 12.0334 13.0715 11.7467 12.7848L9.47487 10.5131ZM10.2783 5.87332C10.2783 8.30612 8.30612 10.2783 5.87332 10.2783C3.44051 10.2783 1.46833 8.30612 1.46833 5.87332C1.46833 3.44051 3.44051 1.46833 5.87332 1.46833C8.30612 1.46833 10.2783 3.44051 10.2783 5.87332Z"
                                            fill="#545454"></path>
                                    </svg>
                                </a>
                            </li>
                            <?php if(Utility::CustomerAuthCheck($store->slug) == true): ?>
                                <li class="wishlist-btn">
                                    <a href="<?php echo e(route('store.wishlist', $store->slug)); ?>">
                                        <i class="fas fa-heart"></i>
                                        <span
                                            class="count wishlist_count"><?php echo e(!empty($wishlist) ? count($wishlist) : '0'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <li class="cart-header">
                                <a href="<?php echo e(route('store.cart', $store->slug)); ?>">
                                    <i class="fas fa-shopping-basket"></i>
                                    <span class="count shoping_counts"
                                        id="shoping_counts"><?php echo e(!empty($total_item) ? $total_item : '0'); ?></span>
                                </a>
                            </li>

                            <?php if(Utility::CustomerAuthCheck($store->slug) == true): ?>
                                <li class="login-btn-header set has-children">
                                    <a class="acnav-label">
                                        <span class="login-text"
                                            style="display: block;"><?php echo e(ucFirst(Auth::guard('customers')->user()->name)); ?></span>
                                    </a>
                                    <div class="menu-dropdown acnav-list">
                                        <ul>
                                            <li data-name="profile">
                                                <a
                                                    href="<?php echo e(route('store.slug', $store->slug)); ?>"><?php echo e(__('My Dashboard')); ?></a>
                                            </li>
                                            <li data-name="activity">
                                                
                                                <a href="#" data-size="lg"
                                                    data-url="<?php echo e(route('customer.profile', [$store->slug, \Illuminate\Support\Facades\Crypt::encrypt(Auth::guard('customers')->user()->id)])); ?>"
                                                    data-ajax-popup="true" data-title="<?php echo e(__('Edit Profile')); ?>"
                                                    data-toggle="modal">
                                                    <?php echo e(__('My Profile')); ?>

                                                </a>
                                            </li>
                                            <li data-name="activity">
                                                <a
                                                    href="<?php echo e(route('customer.home', $store->slug)); ?>"><?php echo e(__('My Orders')); ?></a>
                                            </li>
                                            <li>
                                                <?php if(Utility::CustomerAuthCheck($store->slug) == false): ?>
                                                    <a href="<?php echo e(route('customer.login', $store->slug)); ?>">
                                                        <?php echo e(__('Sign in')); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('customer-frm-logout').submit();"
                                                        class="nav-link">
                                                        <?php echo e(__('Logout')); ?>

                                                    </a>
                                                    <form id="customer-frm-logout"
                                                        action="<?php echo e(route('customer.logout', $store->slug)); ?>"
                                                        method="POST" class="d-none">
                                                        <?php echo e(csrf_field()); ?>

                                                    </form>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?php else: ?>
                                <li class="login-btn-header set has-children">
                                    <a href="<?php echo e(route('customer.login', $store->slug)); ?>" class="acnav-label">
                                        <span class="login-text" style="display: block;"><?php echo e(__('Log in')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                </div>
                <div class="mobile-menu mobile-only">
                    <button class="mobile-menu-button" id="menu">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </button>
                </div>
            </div>

            <div class="mobile-menu-bottom">
                <ul>
                    <?php if(Utility::CustomerAuthCheck($store->slug) == true): ?>
                        <li class="login-btn-header set has-children login-btn-header-2">
                            <a href="javascript:void(0)" class="acnav-label">
                                <span class="login-text"
                                    style="display: block;"><?php echo e(ucFirst(Auth::guard('customers')->user()->name)); ?></span>
                            </a>
                            <div class="menu-dropdown acnav-list">
                                <ul>
                                    <li data-name="profile">
                                        <a
                                            href="<?php echo e(route('store.slug', $store->slug)); ?>"><?php echo e(__('My Dashboard')); ?></a>
                                    </li>
                                    <li data-name="activity">
                                        <a href="#" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Edit Profile')); ?>" data-toggle="modal"
                                            data-url="<?php echo e(route('customer.profile', [$store->slug, \Illuminate\Support\Facades\Crypt::encrypt(Auth::guard('customers')->user()->id)])); ?>"
                                            class="modal-target" data-modal="Myaccount"><?php echo e(__('Edit Profile')); ?></a>
                                    </li>
                                    <li data-name="activity">
                                        <a
                                            href="<?php echo e(route('customer.home', $store->slug)); ?>"><?php echo e(__('My Orders')); ?></a>
                                    </li>
                                    <li>
                                        <?php if(Utility::CustomerAuthCheck($store->slug) == false): ?>
                                            <a href="<?php echo e(route('customer.login', $store->slug)); ?>">
                                                <?php echo e(__('Sign in')); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('customer-frm-logout').submit();"
                                                class="nav-link">
                                                <?php echo e(__('Logout')); ?>

                                            </a>
                                            <form id="customer-frm-logout"
                                                action="<?php echo e(route('customer.logout', $store->slug)); ?>" method="POST"
                                                class="d-none">
                                                <?php echo e(csrf_field()); ?>

                                            </form>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="login-btn-header set has-children login-btn-header-2">
                            <a href="<?php echo e(route('customer.login', $store->slug)); ?>" class="acnav-label">
                                <span class="login-text" style="display: block;"><?php echo e(__('Log in')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                </ul>
            </div>

        </div>
    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <footer class="footer">
        <div class="container">
            <div class="row footer-top">

                <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyy => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($theme['field_slug'] == 'homepage-footer-logo'): ?>
                            <?php if($storethemesetting['section_enable'] == 'on'): ?>
                                <div class="col-lg-4 col-12 footer-link-1" style="position: relative;">
                                    <div class="image-top" style="position: absolute; top: 0;">
                                        <a href="<?php echo e(route('store.slug', $store->slug)); ?>">
                                        <img src="<?php echo e($imgpath . $getStoreThemeSetting[7]['inner-list'][0]['field_default_text']); ?>"
                                            alt="Footer logo">
                                        </a>
                                    </div>
                                    
                                    <div class="image-bottom" style="position: absolute; bottom: 0;">
                                        <img src="<?php echo e(asset('assets/theme1/images/death.png')); ?>" alt="Your Image" width="300" height="70">
                                    </div>
                                </div>
                                <?php if($getStoreThemeSetting[8]['inner-list'][0]['field_default_text'] == 'on'): ?>
                                    <div class="col-lg-2 col-md-3 col-12 footer-link-2">
                                        <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyy => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($theme['field_name'] == 'Enable Quick Link 1'): ?>
                                                    <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($kk == 1): ?>
                                                            <h6>
                                                                <?php echo e(__($title['field_default_text'])); ?>

                                                            </h6>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <?php if(
                                                    !empty($theme['field_slug'] == 'homepage-header-quick-link-name-1') &&
                                                        !empty($storethemesetting['homepage-header-quick-link-name-1'])): ?>
                                                    <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-name-1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $storethemesettinglink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($keys == $link_key): ?>
                                                                <ul>
                                                                    <li class="menu-link">
                                                                        <a href="<?php echo e($storethemesettinglink); ?>"
                                                                            target="_blank"><?php echo e($th); ?></a>
                                                                    </li>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php if($theme['field_slug'] == 'homepage-header-quick-link-name-1'): ?>
                                                        <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($kk == 0): ?>
                                                                    <ul>
                                                                        <li class="menu-link">
                                                                            <a href="<?php echo e($kk == 1 ? $title['field_default_text'] : ''); ?>"
                                                                                target="_blank"><?php echo e(__($title['field_default_text'])); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($getStoreThemeSetting[10]['inner-list'][0]['field_default_text'] == 'on'): ?>
                                    <div class="col-lg-2 col-md-3 col-12 footer-link-2">
                                        <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyy => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($theme['field_name'] == 'Enable Quick Link 2'): ?>
                                                    <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($kk == 1): ?>
                                                            <h6><?php echo e(__($title['field_default_text'])); ?></h6>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                                <?php if(
                                                    !empty($theme['field_slug'] == 'homepage-header-quick-link-name-2') &&
                                                        !empty($storethemesetting['homepage-header-quick-link-name-2'])): ?>
                                                    <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-name-2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $storethemesettinglink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($keys == $link_key): ?>
                                                                <ul>
                                                                    <li>
                                                                        <a target="_blank"
                                                                            href="<?php echo e($storethemesettinglink); ?>"><?php echo e($th); ?></a>
                                                                    </li>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php if($theme['field_slug'] == 'homepage-header-quick-link-name-2'): ?>
                                                        <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($kk == 0): ?>
                                                                    <ul>
                                                                        <li>
                                                                            <a target="_blank"
                                                                                href="<?php echo e($kk == 1 ? $title['field_default_text'] : ''); ?>"><?php echo e(__($title['field_default_text'])); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($getStoreThemeSetting[12]['inner-list'][1]['field_default_text'] == 'on'): ?>
                                    <div class="col-lg-2 col-md-3 col-12 footer-link-2">

                                        <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyy => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($theme['field_name'] == 'Enable Quick Link 3'): ?>
                                                    <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($kk == 0): ?>
                                                            <h6>
                                                                <?php echo e(__($title['field_default_text'])); ?>

                                                            </h6>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                                <?php if(
                                                    !empty($theme['field_slug'] == 'homepage-header-quick-link-name-3') &&
                                                        !empty($storethemesetting['homepage-header-quick-link-name-3'])): ?>
                                                    <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-name-3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $storethemesettinglink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($keys == $link_key): ?>
                                                                <ul>
                                                                    <li>
                                                                        <a target="_blank"
                                                                            href="<?php echo e($storethemesettinglink); ?>"><?php echo e($th); ?></a>
                                                                    </li>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php if($theme['field_slug'] == 'homepage-header-quick-link-name-3'): ?>
                                                        <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($kk == 0): ?>
                                                                    <ul>
                                                                        <li>
                                                                            <a target="_blank"
                                                                                href="<?php echo e($kk == 1 ? $title['field_default_text'] : ''); ?>"><?php echo e(__($title['field_default_text'])); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if($getStoreThemeSetting[14]['inner-list'][1]['field_default_text'] == 'on'): ?>
                                    <div class="col-lg-2 col-md-3 col-12 footer-link-2">
                                        <?php $__currentLoopData = $getStoreThemeSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $storethemesetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyy => $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($theme['field_name'] == 'Enable Quick Link 3'): ?>
                                                    <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($kk == 0): ?>
                                                            <h6>
                                                                <?php echo e(__($title['field_default_text'])); ?>

                                                            </h6>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>

                                                <?php if(
                                                    !empty($theme['field_slug'] == 'homepage-header-quick-link-name-4') &&
                                                        !empty($storethemesetting['homepage-header-quick-link-name-4'])): ?>
                                                    <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-name-4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $__currentLoopData = $storethemesetting['homepage-header-quick-link-4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $storethemesettinglink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($keys == $link_key): ?>
                                                                <ul>
                                                                    <li>
                                                                        <a target="_blank"
                                                                            href="<?php echo e($storethemesettinglink); ?>"><?php echo e($th); ?></a>
                                                                    </li>
                                                                </ul>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php if($theme['field_slug'] == 'homepage-header-quick-link-name-4'): ?>
                                                        <?php for($i = 0; $i < $storethemesetting['loop_number']; $i++): ?>
                                                            <?php $__currentLoopData = $storethemesetting['inner-list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($kk == 0): ?>
                                                                    <ul>
                                                                        <li>
                                                                            <a target="_blank"
                                                                                href="<?php echo e($kk == 1 ? $title['field_default_text'] : ''); ?>"><?php echo e(__($title['field_default_text'])); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($getStoreThemeSetting[16]['section_enable'] == 'on'): ?>
                <div class="row align-items-center justify-content-md-between py-2 delimiter-top">
                    <?php if($getStoreThemeSetting[16]['section_enable'] == 'on'): ?>
                        <div class="col-md-6">
                            <p><?php echo e($getStoreThemeSetting[16]['inner-list'][0]['field_default_text']); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <ul class="social-link">
                            <li>
                                <p><?php echo e(__('Follow us on :')); ?></p>
                            </li>
                            <?php if(isset($getStoreThemeSetting[17]['homepage-footer-2-social-icon']) ||
                                    isset($getStoreThemeSetting[17]['homepage-footer-2-social-link'])): ?>
                                <?php if(isset($getStoreThemeSetting[17]['inner-list'][1]['field_default_text']) &&
                                        isset($getStoreThemeSetting[17]['inner-list'][0]['field_default_text'])): ?>
                                    <?php $__currentLoopData = $getStoreThemeSetting[17]['homepage-footer-2-social-icon']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon_key => $storethemesettingicon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $getStoreThemeSetting[17]['homepage-footer-2-social-link']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link_key => $storethemesettinglink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($icon_key == $link_key): ?>
                                                <li>
                                                    <a target="_blank" href="<?php echo e($storethemesettinglink); ?>">
                                                        <?php echo $storethemesettingicon; ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php for($i = 0; $i < $getStoreThemeSetting[17]['loop_number']; $i++): ?>
                                    <?php if(isset($getStoreThemeSetting[17]['inner-list'][1]['field_default_text']) &&
                                            isset($getStoreThemeSetting[17]['inner-list'][0]['field_default_text'])): ?>
                                        <li>
                                            <a target="_blank"
                                                href="<?php echo e($getStoreThemeSetting[17]['inner-list'][1]['field_default_text']); ?>">
                                                <?php echo $getStoreThemeSetting[17]['inner-list'][0]['field_default_text']; ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            <?php endif; ?>

                        </ul>
                    </div>

                </div>
            <?php endif; ?>
        </div>
    </footer>
    <?php if($getStoreThemeSetting[16]['section_enable'] == 'on'): ?>
        <script>
            <?php echo $getStoreThemeSetting[18]['inner-list'][0]['field_default_text']; ?>

        </script>
    <?php endif; ?>
    <div class="modal fade modal-popup" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-inner lg-dialog" role="document">
            <div class="modal-content">
                <div class="popup-content">
                    <div class="modal-header  popup-header align-items-center">
                        <div class="modal-title">
                            <h6 class="mb-0" id="modelCommanModelLabel"></h6>
                        </div>
                        <button type="button" class="close close-button" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mask-body mask-body-home mask-body-dark"></div>
    <div class="mobile-menu-wrapper">
        <div class="menu-close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                    d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
            </svg>
        </div>
        <div class="mobile-menu-bar">
            <ul>
                <li class="menu-lnk">
                    <a href="<?php echo e(route('store.slug', $store->slug)); ?>"><?php echo e(ucfirst($store->name)); ?></a>
                </li>

                <?php if(!empty($page_slug_urls)): ?>
                    <?php $__currentLoopData = $page_slug_urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $page_slug_url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page_slug_url->enable_page_header == 'on'): ?>
                            <li class="menu-lnk">
                                <a
                                    href="<?php echo e(env('APP_URL') . 'page/' . $page_slug_url->slug); ?>"><?php echo e(ucfirst($page_slug_url->name)); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if($store['blog_enable'] == 'on' && !empty($blog)): ?>
                    <li class="menu-lnk">
                        <a href="<?php echo e(route('store.blog', $store->slug)); ?>"><?php echo e(__('Blog')); ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div id="omnisearch" class="omnisearch">
        <div class="serch-close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                    d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
            </svg>
        </div>
        <div class="container">
            <!-- Search form -->
            <form class="omnisearch-form"
                action="<?php echo e(route('store.categorie.product', [$store->slug, 'Start shopping'])); ?>" method="get">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="_token" value="">
                <div class="form-group focused">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" name="search_data" class="form-control form-control-flush"
                            placeholder="Type your product...">

                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal-popup top-center" id="Checkout">
        <div class="modal-dialog-inner modal-md">
            <div class="popup-content">
                <div class="popup-header">
                    <h4><?php echo e(__('Checkout As Guest Or Login')); ?></h4>
                    <div class="close-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"
                            fill="none">
                            <path
                                d="M27.7618 25.0008L49.4275 3.33503C50.1903 2.57224 50.1903 1.33552 49.4275 0.572826C48.6647 -0.189868 47.428 -0.189965 46.6653 0.572826L24.9995 22.2386L3.33381 0.572826C2.57102 -0.189965 1.3343 -0.189965 0.571605 0.572826C-0.191089 1.33562 -0.191186 2.57233 0.571605 3.33503L22.2373 25.0007L0.571605 46.6665C-0.191186 47.4293 -0.191186 48.666 0.571605 49.4287C0.952952 49.81 1.45285 50.0007 1.95275 50.0007C2.45266 50.0007 2.95246 49.81 3.3339 49.4287L24.9995 27.763L46.6652 49.4287C47.0465 49.81 47.5464 50.0007 48.0463 50.0007C48.5462 50.0007 49.046 49.81 49.4275 49.4287C50.1903 48.6659 50.1903 47.4292 49.4275 46.6665L27.7618 25.0008Z"
                                fill="white"></path>
                        </svg>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="btn-group checkout-btns">
                        <a href="<?php echo e(route('customer.login', $store->slug)); ?>"
                            class="btn"><?php echo e(__('Countinue to sign in')); ?></a>
                        <a href="<?php echo e(route('user-address.useraddress', $store->slug)); ?>"
                            class="btn"><?php echo e(__('Countinue as guest')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($settings['enable_cookie'] == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!--scripts start here-->
    
    <script src="<?php echo e(asset('custom/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('custom/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/theme1/js/slick.min.js')); ?>" defer="defer"></script>
    <script src="<?php echo e(asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>

    
    <?php if($store->enable_pwa_store == 'on'): ?>
        <script type="text/javascript">
            const container = document.querySelector("body")

            const coffees = [];

            if ("serviceWorker" in navigator) {

                window.addEventListener("load", function() {
                    navigator.serviceWorker
                        .register("<?php echo e(asset('serviceWorker.js')); ?>")
                        .then(res => console.log(""))
                        .catch(err => console.log("service worker not registered", err))

                })
            }
        </script>
    <?php endif; ?>
    <?php if(isset($data->value) && $data->value == 'on'): ?>
        <script src="<?php echo e(asset('assets/theme1/js/rtl-custom.js')); ?>"></script>
    <?php else: ?>
        <script src="<?php echo e(asset('assets/theme1/js/custom.js')); ?>" defer="defer"></script>
    <?php endif; ?>
    <script>
        var dataTabelLang = {
            paginate: {
                previous: "<?php echo e('Previous'); ?>",
                next: "<?php echo e('Next'); ?>"
            },
            lengthMenu: "<?php echo e('Show'); ?> MENU <?php echo e('entries'); ?>",
            zeroRecords: "<?php echo e('No data available in table'); ?>",
            info: "<?php echo e('Showing'); ?> START <?php echo e('to'); ?> END <?php echo e('of'); ?> TOTAL <?php echo e('entries'); ?>",
            infoEmpty: " ",
            search: "<?php echo e('Search:'); ?>"
        }
    </script>
    <script src="<?php echo e(asset('custom/js/custom.js')); ?>"></script>

    <?php if(App\Models\Utility::getValByName('gdpr_cookie') == 'on'): ?>
        <script type="text/javascript">
            var defaults = {
                'messageLocales': {
                    /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                    'en': "<?php echo e(App\Models\Utility::getValByName('cookie_text')); ?>"
                },
                'buttonLocales': {
                    'en': 'Ok'
                },
                'cookieNoticePosition': 'bottom',
                'learnMoreLinkEnabled': false,
                'learnMoreLinkHref': '/cookie-banner-information.html',
                'learnMoreLinkText': {
                    'it': 'Saperne di più',
                    'en': 'Learn more',
                    'de': 'Mehr erfahren',
                    'fr': 'En savoir plus'
                },
                'buttonLocales': {
                    'en': 'Ok'
                },
                'expiresIn': 30,
                'buttonBgColor': '#d35400',
                'buttonTextColor': '#fff',
                'noticeBgColor': '#000',
                'noticeTextColor': '#fff',
                'linkColor': '#009fdd'
            };
        </script>
        <script src="<?php echo e(asset('custom/js/cookie.notice.js')); ?>"></script>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('script-page'); ?>
    <?php if(Session::has('success')): ?>
        <script>
            show_toastr('<?php echo e(__('Success')); ?>', '<?php echo session('success'); ?>', 'success');
        </script>
        <?php echo e(Session::forget('success')); ?>

    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <script>
            show_toastr('<?php echo e(__('Error')); ?>', '<?php echo session('error'); ?>', 'error');
        </script>
        <?php echo e(Session::forget('error')); ?>

    <?php endif; ?>
    <?php
        $store_settings = \App\Models\Store::where('slug', $store->slug)->first();
    ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($store_settings->google_analytic); ?>"></script>
    <?php echo $store_settings->storejs; ?>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '<?php echo e($store_settings->google_analytic); ?>');
    </script>

    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo e($store_settings->fbpixel_code); ?>');
        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=0000&ev=PageView&noscript=<?php echo e($store_settings->fbpixel_code); ?>" /></noscript>
    <script type="text/javascript">
        $(function() {
            $(".drop-down__button ").on("click", function(e) {
                $(".drop-down").addClass("drop-down--active");
                e.stopPropagation()
            });
            $(document).on("click", function(e) {
                if ($(e.target).is(".drop-down") === false) {
                    $(".drop-down").removeClass("drop-down--active");
                }
            });
        });
    </script>
    <!--scripts end here-->
<a class="whatsapp-link" href="https://wa.me/1234567890" target="_blank">
  <img src="<?php echo e(asset('assets/theme1/images/whatsappicon.png')); ?>" alt="WhatsApp Icon" width="50" height="50">
</a>
</body>

</html>
<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/storefront/layout/theme1.blade.php ENDPATH**/ ?>