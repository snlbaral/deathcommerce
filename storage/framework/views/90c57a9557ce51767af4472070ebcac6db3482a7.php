<?php
    $currantLang = $users->currentLanguages();
    $profile = \App\Models\Utility::get_file('uploads/profile/');
    if ($currantLang == null) {
        $currantLang = 'en';
    }
    $user = \Auth::user();
    $current_store = \App\Models\Store::where('id', $user->current_store)->first();
?>
<!-- [ Header ] start -->
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
    <?php else: ?>
        <header class="dash-header">
<?php endif; ?>
<div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
        <ul class="list-unstyled">
            <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="dropdown dash-h-item drp-company">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="theme-avtar">
                        <img class="theme-avtar" alt="#" style="width:30px;"
                            src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>">
                    </span>
                    <span class="hide-mob ms-2"><?php echo e('Hi,'); ?><?php echo e(Auth::user()->name); ?>!</span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown">

                    <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                        <i class="ti ti-user"></i>
                        <span><?php echo e(__('My Profile')); ?></span>
                    </a>
                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                        <i class="ti ti-power"></i>
                        <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="ms-auto">
    
        <ul class="list-unstyled">
            <?php if(auth()->guard('web')->check()): ?>
                <?php if(Auth::user()->type !== 'super admin'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Store')): ?>
                    
                        <li class="dropdown dash-h-item drp-language">
                            <a href="#!" class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn" data-size="lg" data-url="<?php echo e(route('store-resource.create')); ?>"
                                data-ajax-popup="true" data-title="<?php echo e(__('Create New Store')); ?>">
                                <i class="ti ti-circle-plus"></i>
                                <span class="hide-mob"><?php echo e(__('Create New Store')); ?></span>
                            </a>
                        </a>
                        </li>
                    
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(Auth::user()->type !== 'super admin'): ?>
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0 cust-btn"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom"   data-bs-original-title="Select your bussiness">
                        <i class="ti ti-building-store"></i>
                        <span class="hide-mob"><?php echo e(__(ucfirst($current_store->name))); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                    <?php
                        $user = App\Models\User::find(\Auth::user()->creatorId());
                    ?>
                    <?php $__currentLoopData = $user->stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($store->is_active): ?>
                            <a href="<?php if(Auth::user()->current_store == $store->id): ?> # <?php else: ?> <?php echo e(route('change_store', $store->id)); ?> <?php endif; ?>"
                                class="dropdown-item">
                                <?php if(Auth::user()->current_store == $store->id): ?>
                                    <i class="ti ti-checks text-primary"></i>
                                <?php endif; ?>
                                <span><?php echo e($store->name); ?></span>
                            </a>
                        <?php else: ?>
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-lock"></i>
                                <span><?php echo e($store->name); ?></span>
                                <?php if(isset($store->pivot->permission)): ?>
                                    <?php if($store->pivot->permission == 'Owner'): ?>
                                        <span class="badge bg-dark"><?php echo e(__($store->pivot->permission)); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-dark"><?php echo e(__('Shared')); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="dropdown-divider m-0"></div>
                </div>
                </li>
            <?php endif; ?>
            <li class="dropdown dash-h-item drp-language">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-world nocolor"></i>
                    <span class="drp-text"><?php echo e(Str::upper($currantLang)); ?></span>
                    <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                    <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('change.language', $lang)); ?>"
                            class="dropdown-item <?php echo e($currantLang == $lang ? 'text-primary' : ''); ?>">
                            <span><?php echo e(Str::upper($lang)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->type == 'super admin'): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Language')): ?>
                            <a href="<?php echo e(route('manage.language', [$currantLang])); ?>"
                                class="dropdown-item border-top py-1 text-primary"><?php echo e(__('Manage Languages')); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</div>
</header>
<!-- [ Header ] end -->
<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/partials/admin/header.blade.php ENDPATH**/ ?>