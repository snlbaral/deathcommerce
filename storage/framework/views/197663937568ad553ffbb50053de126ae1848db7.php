<?php
    // $logo = asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    
    $logo_img = \App\Models\Utility::getValByName('company_logo');
    $logo_light = \App\Models\Utility::getValByName('company_light_logo');
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
    // $logo_light = \App\Models\Utility::getValByName('company_logo_light');
    // $logo_dark = \App\Models\Utility::getValByName('company_logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    // $store_logo = asset(Storage::url('uploads/store_logo/'));
    $lang = \App\Models\Utility::getValByName('default_language');
    $company_logo = \App\Models\Utility::GetLogo();
    $metaimage = Utility::get_file('uploads/metaImage/');
    if (Auth::user()->type !== 'super admin') {
        $store_lang = $store_settings->lang;
    }
    
    // storage setting
    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();
    
    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);
    
    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);
    
    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);
    
    $setting = App\Models\Utility::colorset();
    
    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
?>
<?php $__env->startSection('page-title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Settings')); ?>

    <?php else: ?>
        <?php echo e(__('Store Settings')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <?php if(Auth::user()->type == 'super admin'): ?>
            <h5 class="h4 d-inline-block font-weight-bold mb-0 text-white"><?php echo e(__('Settings')); ?></h5>
        <?php else: ?>
            <h5 class="h4 d-inline-block font-weight-bold mb-0 text-white"><?php echo e(__('Store Setting')); ?></h5>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <ul class="nav nav-pills cust-nav   rounded  mb-3" id="pills-tab" role="tablist">

        <?php if(Auth::user()->type == 'super admin'): ?>
            <li class="nav-item">
                <a class="nav-link active" id="site_setting_tab" data-bs-toggle="pill" href="#pills-brand-setting"
                    role="tab" aria-controls="pills-brand-setting" aria-selected="true"><?php echo e(__('Brand Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-payment-setting_tab" data-bs-toggle="pill" href="#pills-payment-setting"
                    role="tab" aria-controls="pills-payment-setting"
                    aria-selected="false"><?php echo e(__('Payment Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-email-settings_tab" data-bs-toggle="pill" href="#pills-email-settings"
                    role="tab" aria-controls="pills-email-settings"
                    aria-selected="false"><?php echo e(__('Email Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recaptcha-settings_tab" data-bs-toggle="pill" href="#pills-recaptcha-settings"
                    role="tab" aria-controls="pills-recaptcha-settings-tab"
                    aria-selected="false"><?php echo e(__('ReCaptcha Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="storage_settings_tab" data-bs-toggle="pill" href="#storage_settings"
                    role="tab" aria-controls="pills-storage_settings-tab"
                    aria-selected="false"><?php echo e(__('Storage Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-cache_settings-tab" data-bs-toggle="pill" href="#pills-cache-settings"
                    role="tab" aria-controls="pills-cache_settings-tab"
                    aria-selected="false"><?php echo e(__('Cache Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-cookie_settings-tab" data-bs-toggle="pill" href="#pills-cookie-settings"
                    role="tab" aria-controls="pills-cookie_settings-tab"
                    aria-selected="false"><?php echo e(__('Cookie Settings')); ?></a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link active" id="pills-brand_setting-tab" data-bs-toggle="pill" href="#pills-brand-setting"
                    role="tab" aria-controls="pills-brandsetting" aria-selected="false"><?php echo e(__('Brand Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-store_setting-tab" data-bs-toggle="pill" href="#pills-store_setting"
                    role="tab" aria-controls="pills-store_setting" aria-selected="false"><?php echo e(__('Store Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-store_payment-setting-tab" data-bs-toggle="pill"
                    href="#pills-store_payment-setting" role="tab" aria-controls="pills-store_payment-setting"
                    aria-selected="false"><?php echo e(__('Payment Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-store_email_setting-tab" data-bs-toggle="pill"
                    href="#pills-store_email_setting" role="tab" aria-controls="pills-store_email_setting"
                    aria-selected="false"><?php echo e(__('Email Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-whatsapp_custom_massage-tab" data-bs-toggle="pill"
                    href="#pills-whatsapp_custom_massage" role="tab" aria-controls="pills-whatsapp_custom_massage"
                    aria-selected="false"><?php echo e(__('Whatsapp Message Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-twilio_setting-tab" data-bs-toggle="pill" href="#pills-twilio_setting"
                    role="tab" aria-controls="pills-twilio_setting"
                    aria-selected="false"><?php echo e(__('Twilio Settings')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-pixel_setting-tab" data-bs-toggle="pill" href="#pixel_settings"
                    role="tab" aria-controls="pixel_settings"
                    aria-selected="false"><?php echo e(__('Pixel Settings')); ?></a>
            </li>
            <?php if($plan->pwa_store == 'on'): ?>
                <li class="nav-item">
                    <a class="nav-link" id="pills-pwa_setting-tab" data-bs-toggle="pill" href="#pwa_settings"
                        role="tab" aria-controls="pwa_settings"
                        aria-selected="false"><?php echo e(__('PWA Settings')); ?></a>
                </li>
            <?php endif; ?>
        <?php endif; ?>

    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,

        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,

        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });
    </script>
    <script>
        function check_theme(color_val) {
            $('.theme-color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).on('change', '[name=storage_setting]', function() {
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
    <script>
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button1', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button2', {
                removeItemButton: true,
            }
        );
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <?php if(Auth::user()->type == 'super admin'): ?>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-brand-setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Brand Settings')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Logo dark')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-4">
                                                                    
                                                                    <a href="<?php echo e($logo.(isset($logo_img) && !empty($logo_img)? $logo_img:'logo-dark.png')); ?>" target="_blank">
                                                                        <img id="logoDark" alt="your image" src="<?php echo e($logo.(isset($logo_img) && !empty($logo_img)? $logo_img:'logo-dark.png')); ?>" width="150px" class="img_setting">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-5">
                                                                    <label for="logo_dark">
                                                                        <div class=" bg-primary full_logo"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" name="logo_dark"
                                                                            id="logo_dark" class="form-control file"
                                                                            data-filename="logo_dark"
                                                                            onchange="document.getElementById('logoDark').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Logo Light')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-4">
                                                                    

                                                                    <a href="<?php echo e($logo.'logo-light.png'); ?>" target="_blank">
                                                                        <img id="adminLogoLight" alt="your image" src="<?php echo e($logo.'logo-light.png'); ?>" width="170px" class="img_setting">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-5">
                                                                    <label for="logo_light">
                                                                        <div class=" bg-primary"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file"
                                                                            name="logo_light" id="logo_light"
                                                                            data-filename="logo_light"
                                                                            onchange="document.getElementById('adminLogoLight').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Favicon')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-3">
                                                                    <a href="<?php echo e($logo . '/' . 'favicon.png'); ?>"
                                                                        target="_blank">
                                                                        <img src="<?php echo e($logo . '/' . 'favicon.png'); ?>"
                                                                            width="50px" height="50px"
                                                                            class="img_setting favicon" id="adminfavicon">
                                                                    </a>
                                                                </div>
                                                                
                                                                <div class="choose-files mt-5">
                                                                    <label for="favicon">
                                                                        <div class=" bg-primary favicon_update"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file"
                                                                            id="favicon" name="favicon"
                                                                            data-filename="favicon_update"
                                                                            onchange="document.getElementById('adminfavicon').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                                    <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-title_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                                    <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-footer_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-label'])); ?>

                                                    <div class="changeLanguage">
                                                        <select name="default_language" id="default_language"
                                                            class="form-control" data-toggle="select">
                                                            <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($lang == $language): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($language); ?>">
                                                                    <?php echo e(Str::upper($language)); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('currency_symbol', __('Currency Symbol*'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('currency_symbol', $settings['currency_symbol'], ['class' => 'form-control'])); ?>

                                                        <small><?php echo e(__('Note: This value will be automatically assigned whenever a new store is created.')); ?></small>
                                                        <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-currency_symbol" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 mb-0">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('currency', __('Currency *'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('currency', $settings['currency'], ['class' => 'form-control font-style'])); ?>

                                                        <small><?php echo e(__('Note: This value will be automatically assigned whenever a new store is created.')); ?></small>
                                                        <small>
                                                            <a href="https://stripe.com/docs/currencies"
                                                                target="_blank"><?php echo e(__('you can find out how to do that here..')); ?></a>
                                                        </small>
                                                        <br>


                                                        <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-currency" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                                    </div>
                                                </div>

                                                <div class="form-group col-6 col-md-3">
                                                    <div class="custom-control form-switch p-0">
                                                        <label class="form-check-label"
                                                            for="display_landing_page"><?php echo e(__('Enable Landing Page')); ?></label><br>
                                                        <input type="checkbox" name="display_landing_page"
                                                            class="form-check-input" id="display_landing_page"
                                                            data-toggle="switchbutton"
                                                            <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>

                                                            data-onstyle="primary">
                                                    </div>
                                                </div>

                                                <div class="form-group col-6 col-md-3">
                                                    <div class="custom-control form-switch p-0">
                                                        <label class="form-check-label"
                                                            for="SITE_RTL"><?php echo e(__('Enable RTL')); ?></label><br>
                                                        <input type="checkbox" class="form-check-input"
                                                            data-toggle="switchbutton" data-onstyle="primary"
                                                            name="SITE_RTL" id="SITE_RTL"
                                                            <?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6 col-md-3">
                                                    <div class="custom-control form-switch p-0">
                                                        <label class="form-check-label"
                                                            for="signup_button"><?php echo e(__('Enable Sign-Up Page')); ?></label><br>
                                                        <input type="checkbox" name="signup_button"
                                                            class="form-check-input" id="signup_button"
                                                            data-toggle="switchbutton"
                                                            <?php echo e(Utility::getValByName('signup_button') == 'on' ? 'checked="checked"' : ''); ?>

                                                            data-onstyle="primary">
                                                    </div>
                                                </div>
                                                <div class="form-group col-6 col-md-3">
                                                    <div class="custom-control form-switch p-0">
                                                        <label class="form-check-label"
                                                            for="email_verification"><?php echo e(__('Enable Email Verification')); ?></label><br>
                                                        <input type="checkbox" name="email_verification"
                                                            class="form-check-input" id="email_verification"
                                                            data-toggle="switchbutton"
                                                            <?php echo e(Utility::getValByName('email_verification') == 'on' ? 'checked="checked"' : ''); ?>

                                                            data-onstyle="primary">
                                                    </div>
                                                </div>
                                                <div class="setting-card setting-logo-box p-3">
                                                    <div class="row">
                                                        <h5><?php echo e(__('Theme Customizer')); ?></h5>
                                                        <div class="col-md-4 my-auto">
                                                            <h6 class="mt-2">
                                                                <i data-feather="credit-card"
                                                                    class="me-2"></i><?php echo e(__('Primary Color Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="theme-color themes-color">
                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-1' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-1"
                                                                    onclick="check_theme('theme-1')"></a>
                                                                <input type="radio" class="theme_color"
                                                                    name="color" value="theme-1"
                                                                    style="display: none;">

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-2' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-2"
                                                                    onclick="check_theme('theme-2')"></a>
                                                                <input type="radio" class="theme_color"
                                                                    name="color" value="theme-2"
                                                                    style="display: none;">

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-3' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-3"
                                                                    onclick="check_theme('theme-3')"></a>
                                                                <input type="radio" class="theme_color"
                                                                    name="color" value="theme-3"
                                                                    style="display: none;">

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-4' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-4"
                                                                    onclick="check_theme('theme-4')"></a>
                                                                <input type="radio" class="theme_color"
                                                                    name="color" value="theme-4"
                                                                    style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-auto mt-2">
                                                            <h6 class="">
                                                                <i data-feather="layout"
                                                                    class="me-2"></i><?php echo e(__('Sidebar Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust-theme-bg" name="cust_theme_bg"
                                                                    <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-auto mt-2">
                                                            <h6 class="">
                                                                <i data-feather="sun"
                                                                    class="me-2"></i><?php echo e(__('Layout Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch mt-2">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust-darklayout" name="cust_darklayout"
                                                                    <?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-footer p-0">
                                                    <div class="col-sm-12 mt-3 px-2">
                                                        <div class="text-end">
                                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                    </div>
                    <div class="tab-pane fade" id="pills-payment-setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e('Payment Setting'); ?></h5>
                                <small><?php echo e(__('These details will be used to collect subscription plan payments. Each subscription plan will have a payment button based on the below configuration.')); ?></small>
                            </div>
                            <div class="card-body">
                                <form id="setting-form" method="post" action="<?php echo e(route('payment.setting')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-12">
                                            
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label class="col-form-label"><?php echo e(__('Currency')); ?></label>
                                                        <input type="text" name="currency" class="form-control"
                                                            id="currency" value="<?php echo e(env('CURRENCY')); ?>" required>
                                                        <small class="text-xs">
                                                            <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                                            <a href="https://stripe.com/docs/currencies"
                                                                target="_blank"><?php echo e(__('you can find out how to do that here..')); ?></a>
                                                                <?php echo e(__('and This value will be automatically assigned whenever a new store is created.')); ?>

                                                        </small>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                        <label for="currency_symbol"
                                                            class="col-form-label"><?php echo e(__('Currency Symbol')); ?></label>
                                                        <input type="text" name="currency_symbol"
                                                            class="form-control" id="currency_symbol"
                                                            value="<?php echo e(env('CURRENCY_SYMBOL')); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="accordion accordion-flush setting-accordion"
                                                id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne"
                                                            aria-expanded="false"
                                                            aria-controls="collapseOne">
                                                            <span class="d-flex align-items-center">
                                                                <?php echo e(__('Stripe')); ?>

                                                            </span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div
                                                                    class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_stripe_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input input-primary" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_stripe_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label'])); ?>

                                                                        <?php echo e(Form::text('stripe_key', isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?>

                                                                        <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-stripe_key" role="alert">
                                                                                <strong
                                                                                    class="text-danger"><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label'])); ?>

                                                                        <?php echo e(Form::text('stripe_secret', isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

                                                                        <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                            <span class="invalid-stripe_secret"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger"><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <span class="d-flex align-items-center"> <?php echo e(__('Paypal')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div
                                                                    class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_paypal_enabled" value="off">
                                                                    <input type="checkbox"  name="is_paypal_enabled" id="is_paypal_enabled" class="form-check-input input-primary" <?php echo e(isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paypal_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="bussiness-hours">
                                                                <div class="row align-items-center gy-4">
                                                                    <div class="col-lg-12">
                                                                        <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                                                                        <br>
                                                                        <div class="d-flex flex-wrap">
                                                                            <div class="mr-2" style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="paypal_mode"
                                                                                                value="sandbox"
                                                                                                class="form-check-input"
                                                                                                <?php echo e(!isset($admin_payment_setting['paypal_mode']) || $admin_payment_setting['paypal_mode'] == '' || $admin_payment_setting['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Sandbox')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="paypal_mode"
                                                                                                value="live"
                                                                                                class="form-check-input"
                                                                                                <?php echo e(isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                            <?php echo e(__('Live')); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                                                                            <input type="text" name="paypal_client_id"
                                                                                id="paypal_client_id" class="form-control"
                                                                                value="<?php echo e(!isset($admin_payment_setting['paypal_client_id']) || is_null($admin_payment_setting['paypal_client_id']) ? '' : $admin_payment_setting['paypal_client_id']); ?>"
                                                                                placeholder="<?php echo e(__('Client ID')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_secret_key"
                                                                                class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="paypal_secret_key"
                                                                                id="paypal_secret_key" class="form-control"
                                                                                value="<?php echo e(!isset($admin_payment_setting['paypal_secret_key']) || is_null($admin_payment_setting['paypal_secret_key']) ? '' : $admin_payment_setting['paypal_secret_key']); ?>"
                                                                                placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('Paystack')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div
                                                                    class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_paystack_enabled" value="off">
                                                                    <input type="checkbox" name="is_paystack_enabled" class="form-check-input input-primary" id="is_paystack_enabled" <?php echo e(isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label" for="is_paystack_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="bussiness-hours">
                                                                <div class="row align-items-center gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                            <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control"
                                                                                value="<?php echo e(!isset($admin_payment_setting['paystack_public_key']) || is_null($admin_payment_setting['paystack_public_key']) ? '' : $admin_payment_setting['paystack_public_key']); ?>"
                                                                                placeholder="<?php echo e(__('Public Key')); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                            <input type="text" name="paystack_secret_key"
                                                                                id="paystack_secret_key"
                                                                                class="form-control"
                                                                                value="<?php echo e(!isset($admin_payment_setting['paystack_secret_key']) || is_null($admin_payment_setting['paystack_secret_key']) ? '' : $admin_payment_setting['paystack_secret_key']); ?>"
                                                                                placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingFour">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFour"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('Flutterwave')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                                    <input type="checkbox" name="is_flutterwave_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_flutterwave_enabled"  <?php echo e(isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_flutterwave_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingFour"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                            <input type="text" name="flutterwave_public_key" id="flutterwave_public_key"
                                                                                class="form-control"
                                                                                value="<?php echo e(!isset($admin_payment_setting['flutterwave_public_key']) || is_null($admin_payment_setting['flutterwave_public_key']) ? '' : $admin_payment_setting['flutterwave_public_key']); ?>"
                                                                                placeholder="Public Key">
                                                                        </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="paystack_secret_key" class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="flutterwave_secret_key"
                                                                            id="flutterwave_secret_key" class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['flutterwave_secret_key']) || is_null($admin_payment_setting['flutterwave_secret_key']) ? '' : $admin_payment_setting['flutterwave_secret_key']); ?>"
                                                                            placeholder="Secret Key">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingFive">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseFive"
                                                            aria-expanded="false"
                                                            aria-controls="collapseFive">
                                                            <span
                                                                class="d-flex align-items-center">  <?php echo e(__('Razorpay')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_razorpay_enabled" value="off"> 
                                                                    <input type="checkbox"
                                                                        class="form-check-input input-primary" 
                                                                        name="is_razorpay_enabled"
                                                                        id="is_razorpay_enabled"  <?php echo e(isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_razorpay_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFive"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingFive"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="paypal_client_id" class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                        <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['razorpay_public_key']) || is_null($admin_payment_setting['razorpay_public_key']) ? '' : $admin_payment_setting['razorpay_public_key']); ?>"
                                                                            placeholder="Public Key">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="paystack_secret_key" class="col-form-label"> <?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e(!isset($admin_payment_setting['razorpay_secret_key']) || is_null($admin_payment_setting['razorpay_secret_key']) ? '' : $admin_payment_setting['razorpay_secret_key']); ?>" placeholder="Secret Key">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingSix">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                            <span
                                                                class="d-flex align-items-center"> <?php echo e(__('Paytm')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_paytm_enabled" value="off">
                                                                    <input type="checkbox" class="form-check-input input-primary"  name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label" for="is_paytm_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-12 pb-4">
                                                                    <label class="paypal-label col-form-label" for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex flex-wrap">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="paytm_mode"
                                                                                            value="local"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(!isset($admin_payment_setting['paytm_mode']) || $admin_payment_setting['paytm_mode'] == '' || $admin_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Local')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="paytm_mode"
                                                                                            value="production"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Production')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_public_key" class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                        <input type="text" name="paytm_merchant_id"
                                                                            id="paytm_merchant_id" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['paytm_merchant_id']) ? $admin_payment_setting['paytm_merchant_id'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                                        <?php if($errors->has('paytm_merchant_id')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_secret_key" class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                        <input type="text" name="paytm_merchant_key"
                                                                            id="paytm_merchant_key" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['paytm_merchant_key']) ? $admin_payment_setting['paytm_merchant_key'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Merchant Key')); ?>" />
                                                                        <?php if($errors->has('paytm_merchant_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="paytm_industry_type" class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                        <input type="text" name="paytm_industry_type"
                                                                            id="paytm_industry_type"
                                                                            class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['paytm_industry_type']) ? $admin_payment_setting['paytm_industry_type'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Industry Type')); ?>" />
                                                                        <?php if($errors->has('paytm_industry_type')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingseven">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('Mercado Pago')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2">On/Off:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_mercado_enabled" value="off">
                                                                    <input type="checkbox"  name="is_mercado_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_mercado_enabled" <?php echo e(isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_mercado_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingseven" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 pb-4">
                                                                    <label class="col-form-label"
                                                                        for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex flex-wrap">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="mercado_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e((isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '') || (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="mercado_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="mercado_access_token"
                                                                            class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                        <input type="text"
                                                                            name="mercado_access_token"
                                                                            id="mercado_access_token"
                                                                            class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Access Token')); ?>" />
                                                                        <?php if($errors->has('mercado_secret_key')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('mercado_access_token')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingeight">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                                                            <span class="d-flex align-items-center"><?php echo e(__('Mollie')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_mollie_enabled" value="off">
                                                                    <input type="checkbox" name="is_mollie_enabled" 
                                                                        class="form-check-input input-primary"
                                                                        id="is_mollie_enabled"  <?php echo e(isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_mollie_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingeight" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_api_key"
                                                                            class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                        <input type="text" name="mollie_api_key"
                                                                            id="mollie_api_key" class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['mollie_api_key']) || is_null($admin_payment_setting['mollie_api_key']) ? '' : $admin_payment_setting['mollie_api_key']); ?>"
                                                                            placeholder="Mollie Api Key">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_profile_id"
                                                                            class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                        <input type="text" name="mollie_profile_id"
                                                                            id="mollie_profile_id" class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['mollie_profile_id']) || is_null($admin_payment_setting['mollie_profile_id']) ? '' : $admin_payment_setting['mollie_profile_id']); ?>"
                                                                            placeholder="Mollie Profile Id">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_partner_id"
                                                                            class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                        <input type="text" name="mollie_partner_id"
                                                                            id="mollie_partner_id" class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['mollie_partner_id']) || is_null($admin_payment_setting['mollie_partner_id']) ? '' : $admin_payment_setting['mollie_partner_id']); ?>"
                                                                            placeholder="Mollie Partner Id">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingnine">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseNine"
                                                            aria-expanded="false"
                                                            aria-controls="collapseNine">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('Skrill')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_skrill_enabled" value="off">
                                                                    <input type="checkbox"
                                                                        class="form-check-input input-primary"
                                                                        name="is_skrill_enabled"
                                                                        id="is_skrill_enabled" <?php echo e(isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_skrill_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseNine"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingnine"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="mollie_api_key"
                                                                            class="col-form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                                        <input type="email" name="skrill_email"
                                                                            id="skrill_email" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['skrill_email']) ? $admin_payment_setting['skrill_email'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Skrill Email')); ?>" />
                                                                        <?php if($errors->has('skrill_email')): ?>
                                                                            <span class="invalid-feedback d-block">
                                                                                <?php echo e($errors->first('skrill_email')); ?>

                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTen">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTen"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTen">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('CoinGate')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_coingate_enabled" value="off">
                                                                    <input type="checkbox" name="is_coingate_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_coingate_enabled"  <?php echo e(isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_coingate_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTen"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingTen"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-12 pb-4">
                                                                    <label class="col-form-label" for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex flex-wrap">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="coingate_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(!isset($admin_payment_setting['coingate_mode']) || $admin_payment_setting['coingate_mode'] == '' || $admin_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="coingate_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="coingate_auth_token"
                                                                            class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                        <input type="text" name="coingate_auth_token"
                                                                            id="coingate_auth_token"
                                                                            class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['coingate_auth_token']) || is_null($admin_payment_setting['coingate_auth_token']) ? '' : $admin_payment_setting['coingate_auth_token']); ?>"
                                                                            placeholder="CoinGate Auth Token">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingEleven">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseEleven"
                                                            aria-expanded="false"
                                                            aria-controls="collapseEleven">
                                                            <span
                                                                class="d-flex align-items-center"><?php echo e(__('PaymentWall')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div
                                                                    class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_paymentwall_enabled" value="off">
                                                                    <input type="checkbox"  name="is_paymentwall_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_paymentwall_enabled" <?php echo e(isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paymentwall_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseEleven"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingEleven"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="paymentwall_public_key"
                                                                            class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                        <input type="text"
                                                                            name="paymentwall_public_key"
                                                                            id="paymentwall_public_key"
                                                                            class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['paymentwall_public_key']) || is_null($admin_payment_setting['paymentwall_public_key']) ? '' : $admin_payment_setting['paymentwall_public_key']); ?>"
                                                                            placeholder="<?php echo e(__('Public Key')); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="paymentwall_private_key"
                                                                            class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                        <input type="text"
                                                                            name="paymentwall_private_key"
                                                                            id="paymentwall_private_key"
                                                                            class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['paymentwall_private_key']) || is_null($admin_payment_setting['paymentwall_private_key']) ? '' : $admin_payment_setting['paymentwall_private_key']); ?>"
                                                                            placeholder="<?php echo e(__('Private Key')); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwelve">
                                                        <button class="accordion-button collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwelve"
                                                            aria-expanded="false"
                                                            aria-controls="collapseTwelve">
                                                            <span class="d-flex align-items-center"><?php echo e(__('Toyyibpay')); ?></span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off')); ?>:</span>
                                                                <div
                                                                    class="form-check form-switch custom-switch-v1">
                                                                    <input type="hidden" name="is_toyyibpay_enabled" value="off">
                                                                    <input type="checkbox"  name="is_toyyibpay_enabled"
                                                                        class="form-check-input input-primary"
                                                                        id="is_toyyibpay_enabled" <?php echo e(isset($admin_payment_setting['is_toyyibpay_enabled']) && $admin_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_toyyibpay_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwelve"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwelve"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row gy-4">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="toyyibpay_category_code"
                                                                            class="col-form-label"><?php echo e(__('Category Code')); ?></label>
                                                                        <input type="text"
                                                                            name="toyyibpay_category_code"
                                                                            id="toyyibpay_category_code"
                                                                            class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['toyyibpay_category_code']) || is_null($admin_payment_setting['toyyibpay_category_code']) ? '' : $admin_payment_setting['toyyibpay_category_code']); ?>"
                                                                            placeholder="<?php echo e(__('category code')); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="toyyibpay_secret_key"
                                                                            class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                        <input type="text"
                                                                            name="toyyibpay_secret_key"
                                                                            id="toyyibpay_secret_key"
                                                                            class="form-control"
                                                                            value="<?php echo e(!isset($admin_payment_setting['toyyibpay_secret_key']) || is_null($admin_payment_setting['toyyibpay_secret_key']) ? '' : $admin_payment_setting['toyyibpay_secret_key']); ?>"
                                                                            placeholder="<?php echo e(__('toyyibpay secret key')); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThirteen">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThirteen"
                                                            aria-expanded="true" aria-controls="collapseThirteen">
                                                            <span class="d-flex align-items-center">
                                                                <?php echo e(__('Payfast')); ?>

                                                            </span>
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-2"><?php echo e(__('On/Off :')); ?></span>
                                                                <div class="form-check form-switch d-inline-block custom-switch-v1">
                                                                    <input type="hidden" name="is_payfast_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="is_payfast_enabled"
                                                                        id="is_payfast_enabled"
                                                                        <?php echo e(isset($admin_payment_setting['is_payfast_enabled']) && $admin_payment_setting['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="custom-control-label form-label"
                                                                        for="is_payfast_enabled"></label>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThirteen" class="accordion-collapse collapse"aria-labelledby="headingThirteen"data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="payfast-label col-form-label"
                                                                        for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="me-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark <?php echo e(isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                                                        <input type="radio"
                                                                                            name="payfast_mode" value="sandbox"
                                                                                            class="form-check-input"
                                                                                            <?php echo e((isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == '') || (isset($admin_payment_setting['payfast_mode']) &&
                                                                                            $admin_payment_setting['payfast_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>><?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="me-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark <?php echo e(isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == 'live' ? 'active' : ''); ?>">
                                                                                        <input type="radio"
                                                                                            name="payfast_mode" value="live"
                                                                                            class="form-check-input"
                                                                                            <?php echo e(isset($admin_payment_setting['payfast_mode']) && $admin_payment_setting['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>><?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="payfast_merchant_id"
                                                                            class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                        <input type="text" name="payfast_merchant_id"
                                                                            id="payfast_merchant_id" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['payfast_merchant_id']) ? $admin_payment_setting['payfast_merchant_id'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Merchant ID')); ?>">
                                                                    </div>
                                                                    <?php if($errors->has('payfast_merchant_id')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('payfast_merchant_id')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="payfast_merchant_key"
                                                                            class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                        <input type="text" name="payfast_merchant_key"
                                                                            id="payfast_merchant_key" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['payfast_merchant_key']) ? $admin_payment_setting['payfast_merchant_key'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Merchant Key')); ?>">
                                                                    </div>
                                                                    <?php if($errors->has('payfast_merchant_key')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('payfast_merchant_key')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="payfast_signature"
                                                                            class="col-form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                                        <input type="text" name="payfast_signature"
                                                                            id="payfast_signature" class="form-control"
                                                                            value="<?php echo e(isset($admin_payment_setting['payfast_signature']) ? $admin_payment_setting['payfast_signature'] : ''); ?>"
                                                                            placeholder="<?php echo e(__('Salt Passphrase')); ?>">
                                                                    </div>
                                                                    <?php if($errors->has('payfast_signature')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('payfast_signature')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <div class="col-sm-12 mt-3 px-2">
                                            <div class="text-end">
                                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-email-settings" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">
                                        <?php echo e(__('Email Settings')); ?>

                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <?php echo e(Form::open(['route' => 'email.setting', 'method' => 'post'])); ?>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'id' => 'mail_driver', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'id' => 'mail_host', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'id' => 'mail_port', 'placeholder' => __('Enter Mail Port')])); ?>

                                            <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'id' => 'mail_username', 'placeholder' => __('Enter Mail Username')])); ?>

                                            <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'id' => 'mail_password', 'placeholder' => __('Enter Mail Password')])); ?>

                                            <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'id' => 'mail_encryption', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                            <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'id' => 'mail_from_address', 'placeholder' => __('Enter Mail From Address')])); ?>

                                            <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-6 form-group">
                                            <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'id' => 'mail_from_name', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                            <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="row">
                                            <div class=" text-end">
                                                <div class="card-footer p-0">
                                                    <div class="col-sm-12 mt-3 px-2">
                                                        <div class="d-flex justify-content-between gap-2 flex-column flex-sm-row">
                                                            <a href="#" 
                                                                data-size="md" data-url="<?php echo e(route('test.mail')); ?>"
                                                                data-title="<?php echo e(__('Send Test Mail')); ?>"
                                                                class="btn btn-xs  btn-primary send_email">
                                                                <?php echo e(__('Send Test Mail')); ?>

                                                            </a>
                                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-recaptcha-settings" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row gy-2">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5 class=""><?php echo e(__('ReCaptcha Settings')); ?></h5><small
                                                    class="text-secondary font-weight-bold"><a
                                                        href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                        target="_blank" class="text-blue">
                                                        <small>(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                                    </a></small>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 text-sm-end">
                                                <div class="col switch-width">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" data-toggle="switchbutton"
                                                            data-onstyle="primary" class="" value="yes"
                                                            name="recaptcha_module" id="recaptcha_module"
                                                            <?php echo e(!empty(env('RECAPTCHA_MODULE')) && env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>>
                                                        <label class="custom-control-label form-control-label px-2"
                                                            for="recaptcha_module "></label><br>
                                                        <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                            target="_blank" class="text-blue">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <?php echo csrf_field(); ?>
                                        <div class="row ">
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="google_recaptcha_key"
                                                    class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                                <input class="form-control"
                                                    placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>"
                                                    name="google_recaptcha_key" type="text"
                                                    value="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>" id="google_recaptcha_key">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="google_recaptcha_secret"
                                                    class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                                <input class="form-control "
                                                    placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>"
                                                    name="google_recaptcha_secret" type="text"
                                                    value="<?php echo e(env('NOCAPTCHA_SECRET')); ?>"
                                                    id="google_recaptcha_secret">
                                            </div>
                                        </div>
                                        <div class="card-footer p-0">
                                            <div class="col-sm-12 mt-3 px-2">
                                                <div class="text-end">
                                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="storage_settings" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <?php echo e(Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data"))); ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 'local'?'checked':''); ?> value="local" checked>
                                            <label class="btn btn-outline-primary" for="local-outlined"><?php echo e(__('Local')); ?></label>
                                        </div>
                                        <div  class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='s3'?'checked':''); ?>  value="s3">
                                            <label class="btn btn-outline-primary" for="s3-outlined"> <?php echo e(__('AWS S3')); ?></label>
                                        </div>

                                        <div  class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='wasabi'?'checked':''); ?> value="wasabi">
                                            <label class="btn btn-outline-primary" for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                                        </div>
                                    </div>
                                    <div  class="mt-2">
                                    <div class="local-setting row <?php echo e($settings['storage_setting']=='local'?' ':'d-none'); ?>">
                                        
                                        <div class="col-lg-6 col-md-11 col-sm-12">
                                            <?php echo e(Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                            <select name="local_storage_validation[]" class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                                                <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                <input type="number" name="local_storage_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size'])) ? '' : $settings['local_storage_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="s3-setting row <?php echo e($settings['storage_setting']=='s3'?' ':'d-none'); ?>">

                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                                    <input type="text" name="s3_key" class="form-control" value="<?php echo e((!isset($settings['s3_key']) || is_null($settings['s3_key'])) ? '' : $settings['s3_key']); ?>" placeholder="<?php echo e(__('S3 Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                                    <input type="text" name="s3_secret" class="form-control" value="<?php echo e((!isset($settings['s3_secret']) || is_null($settings['s3_secret'])) ? '' : $settings['s3_secret']); ?>" placeholder="<?php echo e(__('S3 Secret')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                                    <input type="text" name="s3_region" class="form-control" value="<?php echo e((!isset($settings['s3_region']) || is_null($settings['s3_region'])) ? '' : $settings['s3_region']); ?>" placeholder="<?php echo e(__('S3 Region')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                                    <input type="text" name="s3_bucket" class="form-control" value="<?php echo e((!isset($settings['s3_bucket']) || is_null($settings['s3_bucket'])) ? '' : $settings['s3_bucket']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                                    <input type="text" name="s3_url" class="form-control" value="<?php echo e((!isset($settings['s3_url']) || is_null($settings['s3_url'])) ? '' : $settings['s3_url']); ?>" placeholder="<?php echo e(__('S3 URL')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                                    <input type="text" name="s3_endpoint" class="form-control" value="<?php echo e((!isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint'])) ? '' : $settings['s3_endpoint']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                <?php echo e(Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                                    <select name="s3_storage_validation[]"  class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button1" placeholder="This is a placeholder" multiple>
                                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_max_upload_size"><?php echo e(__('Max upload size (In KB)')); ?></label>
                                                    <input type="number" name="s3_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size'])) ? '' : $settings['s3_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="wasabi-setting row <?php echo e($settings['storage_setting']=='wasabi'?' ':'d-none'); ?>">
                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                                    <input type="text" name="wasabi_key" class="form-control" value="<?php echo e((!isset($settings['wasabi_key']) || is_null($settings['wasabi_key'])) ? '' : $settings['wasabi_key']); ?>" placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                                    <input type="text" name="wasabi_secret" class="form-control" value="<?php echo e((!isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret'])) ? '' : $settings['wasabi_secret']); ?>" placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                                    <input type="text" name="wasabi_region" class="form-control" value="<?php echo e((!isset($settings['wasabi_region']) || is_null($settings['wasabi_region'])) ? '' : $settings['wasabi_region']); ?>" placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                                    <input type="text" name="wasabi_bucket" class="form-control" value="<?php echo e((!isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket'])) ? '' : $settings['wasabi_bucket']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                                    <input type="text" name="wasabi_url" class="form-control" value="<?php echo e((!isset($settings['wasabi_url']) || is_null($settings['wasabi_url'])) ? '' : $settings['wasabi_url']); ?>" placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                                    <input type="text" name="wasabi_root" class="form-control" value="<?php echo e((!isset($settings['wasabi_root']) || is_null($settings['wasabi_root'])) ? '' : $settings['wasabi_root']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                <?php echo e(Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>'form-label'))); ?>


                                                <select name="wasabi_storage_validation[]" class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button2" placeholder="This is a placeholder" multiple>
                                                    <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                    <input type="number" name="wasabi_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size'])) ? '' : $settings['wasabi_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                        </div>
                    </div> 
                    <div class="tab-pane fade" id="pills-cache-settings" role="tabpanel" aria-labelledby="pills-cache_settings-tab">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="h6 md-0"><?php echo e(__('Cache Settings')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p>This is a page meant for more advanced users, simply ignore it if you do not
                                                understand what cache is.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-group search-form">
                                            <input type="text" value="<?php echo e(Utility::GetCacheSize()); ?>" class="form-control" disabled>
                                            <span class="input-group-text bg-transparent"><?php echo e(__('MB')); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href = "<?php echo e(url('config-cache')); ?>" class="btn btn-m btn-primary m-r-10 "><?php echo e(__('Clear Cache')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-cookie-settings" role="tabpanel" aria-labelledby="pills-cookie_settings-tab">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                
                                <?php echo e(Form::model($settings,array('route'=>'cookie.setting','method'=>'post'))); ?>

                                    <div class="card-header flex-column flex-lg-row  d-flex align-items-lg-center gap-2 justify-content-between">
                                        <h5><?php echo e(__('Cookie Settings')); ?></h5>
                                        <div class="d-flex align-items-center">
                                            <?php echo e(Form::label('enable_cookie', __('Enable cookie'), ['class' => 'col-form-label p-0 fw-bold me-3'])); ?>

                                            <div class="custom-control custom-switch"  onclick="enablecookie()">
                                                <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" name="enable_cookie" class="form-check-input input-primary "
                                                    id="enable_cookie" <?php echo e($settings['enable_cookie'] == 'on' ? ' checked ' : ''); ?> >
                                                <label class="custom-control-label mb-1" for="enable_cookie"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body cookieDiv <?php echo e($settings['enable_cookie'] == 'off' ? 'disabledCookie ' : ''); ?>">
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                                                    <input type="checkbox" name="cookie_logging" class="form-check-input input-primary cookie_setting"
                                                        id="cookie_logging"<?php echo e($settings['cookie_logging'] == 'on' ? ' checked ' : ''); ?>>
                                                    <label class="form-check-label" for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                                                </div>
                                                <div class="form-group" >
                                                    <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label' ])); ?>

                                                    <?php echo e(Form::text('cookie_title', null, ['class' => 'form-control cookie_setting'] )); ?>

                                                </div>
                                                <div class="form-group ">
                                                    <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label'])); ?>

                                                    <?php echo Form::textarea('cookie_description', null, ['class' => 'form-control cookie_setting', 'rows' => '3']); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch custom-switch-v1 ">
                                                    <input type="checkbox" name="necessary_cookies" class="form-check-input input-primary"
                                                        id="necessary_cookies" checked onclick="return false">
                                                    <label class="form-check-label" for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                                                </div>
                                                <div class="form-group ">
                                                    <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label'])); ?>

                                                    <?php echo e(Form::text('strictly_cookie_title', null, ['class' => 'form-control cookie_setting'])); ?>

                                                </div>
                                                <div class="form-group ">
                                                    <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                                                    <?php echo Form::textarea('strictly_cookie_description', null, ['class' => 'form-control cookie_setting ', 'rows' => '3']); ?>

                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <h5><?php echo e(__('More Information')); ?></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'col-form-label'])); ?>

                                                    <?php echo e(Form::text('more_information_description', null, ['class' => 'form-control cookie_setting'])); ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'col-form-label'])); ?>

                                                    <?php echo e(Form::text('contactus_url', null, ['class' => 'form-control cookie_setting'])); ?>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex align-items-center gap-2 flex-sm-column flex-lg-row justify-content-between" >
                                        <div>
                                            <?php if(isset($settings['cookie_logging']) && $settings['cookie_logging'] == 'on'): ?>
                                            <label for="file" class="form-label"><?php echo e(__('Download cookie accepted data')); ?></label>
                                                <a href="<?php echo e(asset(Storage::url('uploads/sample')) . '/data.csv'); ?>" class="btn btn-primary mr-2 ">
                                                    <i class="ti ti-download"></i>
                                                </a>
                                                <?php endif; ?>
                                        </div>
                                        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary">
                                    </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
            <?php else: ?>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-brand-setting" role="tabpanel"
                        aria-labelledby="pills-brand_setting-tab">
                        <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Brand Settings')); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Logo dark')); ?></h5>
                                                        </div>

                                                        <div class="card-body pt-0">
                                                            <div class="setting-card">
                                                                <div class="logo-content mt-4">
                                                                    

                                                                    <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
                                                                        <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                                                                            alt="<?php echo e(config('app.name', 'Storego')); ?>"
                                                                            id="adminlogoDark"
                                                                            class="logo logo-lg nav-sidebar-logo">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-5">
                                                                    <label for="company_logo">
                                                                        <div class=" bg-primary company_logo_update">
                                                                            <i
                                                                                class="ti ti-upload "></i><?php echo e(__('Choose file here')); ?>

                                                                            <input type="file" id="company_logo"
                                                                                data-filename="company_logo_update"
                                                                                name="logo_dark" class="form-control file"
                                                                                onchange=" document.getElementById('adminlogoDark').src = window.URL.createObjectURL(this.files[0])">
                                                                        </div>
                                                                        
                                                                    </label>

                                                                </div>
                                                                <?php $__errorArgs = ['company_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Logo Light')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-4">
                                                                    
                                                                    <a href="<?php echo e($logo . 'logo-light.png'); ?>" target="_blank">
                                                                        <img id="logo-light" alt="your image"
                                                                            src="<?php echo e($logo . 'logo-light.png'); ?>" width="170px"
                                                                            class="img_setting">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-5">
                                                                    <label for="company_logo_light">
                                                                        <div class=" bg-primary dark_logo_update"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file"
                                                                            name="logo_light" id="company_logo_light"
                                                                            data-filename="dark_logo_update"
                                                                            onchange=" document.getElementById('logo-light').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Favicon')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-3">
                                                                    <a href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
                                                                        target="_blank">
                                                                        <img src="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
                                                                            width="50px" height="50px"
                                                                            class=" img_setting favicon" id="faviCon">
                                                                    </a>
                                                                    
                                                                </div>
                                                                <div class="choose-files mt-5">
                                                                    <label for="company_favicon">
                                                                        <div class=" bg-primary company_favicon_update"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file"
                                                                            id="company_favicon" name="favicon"
                                                                            data-filename="company_favicon_update"
                                                                            onchange=" document.getElementById('faviCon').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                                    <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-title_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                                    <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-footer_text" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="site_date_format"
                                                        class="form-label"><?php echo e(__('Date Format')); ?></label>
                                                    <select type="text" name="site_date_format" class="form-control"
                                                        data-toggle="select" id="site_date_format">
                                                        <option value="M j, Y"
                                                            <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>
                                                            Jan 1,2015</option>
                                                        <option value="d-m-Y"
                                                            <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>
                                                            d-m-y</option>
                                                        <option value="m-d-Y"
                                                            <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>
                                                            m-d-y</option>
                                                        <option value="Y-m-d"
                                                            <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>
                                                            y-m-d</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="site_time_format"
                                                        class="form-label"><?php echo e(__('Time Format')); ?></label>
                                                    <select type="text" name="site_time_format" class="form-control"
                                                        data-toggle="select" id="site_time_format">
                                                        <option value="g:i A"
                                                            <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>
                                                            10:30 PM</option>
                                                        <option value="g:i a"
                                                            <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>
                                                            10:30 pm</option>
                                                        <option value="H:i"
                                                            <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>
                                                            22:30</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-6 col-md-3">
                                                    <div class="custom-control form-switch p-0">
                                                        <label class="form-check-label"
                                                            for="SITE_RTL"><?php echo e(__('Enable RTL')); ?></label><br>
                                                        <input type="checkbox" class="form-check-input"
                                                            data-toggle="switchbutton" data-onstyle="primary" name="SITE_RTL"
                                                            id="SITE_RTL"
                                                            <?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    </div>
                                                </div>
                                                <div class="setting-card setting-logo-box p-3">
                                                    <div class="row">
                                                        <h5><?php echo e(__('Theme Customizer')); ?></h5>
                                                        <div class="col-md-4 my-auto">
                                                            <h6 class="mt-2">
                                                                <i data-feather="credit-card"
                                                                    class="me-2"></i><?php echo e(__('Primary Color Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="theme-color themes-color">
                                                                
                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-1' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                                <input type="radio" class="theme_color" name="color"
                                                                    value="theme-1" style="display: none;" <?php if($setting['color'] == 'theme-1'): ?> <?php echo e('checked'); ?>  <?php endif; ?>>

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-2' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                                <input type="radio" class="theme_color" name="color"
                                                                    value="theme-2" style="display: none;" <?php if($setting['color'] == 'theme-2'): ?> <?php echo e('checked'); ?>  <?php endif; ?>>

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-3' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                                <input type="radio" class="theme_color" name="color"
                                                                    value="theme-3" style="display: none;" <?php if($setting['color'] == 'theme-3'): ?> <?php echo e('checked'); ?>  <?php endif; ?>>

                                                                <a href="#!"
                                                                    class="<?php echo e($settings['color'] == 'theme-4' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                                <input type="radio" class="theme_color" name="color"
                                                                    value="theme-4" style="display: none;" <?php if($setting['color'] == 'theme-4'): ?> <?php echo e('checked'); ?>  <?php endif; ?>>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-auto mt-2">
                                                            <h6 class="">
                                                                <i data-feather="layout"
                                                                    class="me-2"></i><?php echo e(__('Sidebar Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust-theme-bg" name="cust_theme_bg" 
                                                                    <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                                                <label class="form-check-label f-w-600 pl-1" 
                                                                    for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-auto mt-2">
                                                            <h6 class="">
                                                                <i data-feather="sun"
                                                                    class="me-2"></i><?php echo e(__('Layout Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="form-check form-switch mt-2">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust-darklayout" name="cust_darklayout"
                                                                    <?php echo e($settings['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <div class="col-sm-12 px-2">
                                                <div class="text-end">
                                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                    <div class="tab-pane fade" id="pills-store_setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <?php echo e(Form::model($store_settings, ['route' => ['settings.store', $store_settings['id']], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Store Settings')); ?></h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class=" setting-card">
                                            <div class="row mt-2">
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Store Logo')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-3">
                                                                    
                                                                    <a href="<?php echo e($s_logo . (isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png')); ?>"
                                                                        target="_blank">
                                                                        <img id="StorelogoOwner" alt="your image"
                                                                            src="<?php echo e($s_logo . (isset($store_settings['logo']) && !empty($store_settings['logo']) ? $store_settings['logo'] : 'logo.png')); ?>"
                                                                            class="big-logo invoice_logo img_setting"
                                                                            id="storeLogo">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-4">
                                                                    <label for="logo">
                                                                        <div class=" bg-primary logo_update"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file"
                                                                            name="logo" id="logo"
                                                                            data-filename="logo_update"
                                                                            onchange="document.getElementById('storeLogo').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5><?php echo e(__('Invoice Logo')); ?></h5>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class=" setting-card">
                                                                <div class="logo-content mt-3">
                                                                    
                                                                    <a href="<?php echo e($s_logo . (isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo']) ? $store_settings['invoice_logo'] : 'invoice_logo.png')); ?>"
                                                                        target="_blank">
                                                                        <img id="invoiceOwner" alt="your image"
                                                                            src="<?php echo e($s_logo . (isset($store_settings['invoice_logo']) && !empty($store_settings['invoice_logo']) ? $store_settings['invoice_logo'] : 'invoice_logo.png')); ?>"
                                                                            width="150px"
                                                                            class="big-logo invoice_logo img_setting"
                                                                            id="invoiceLogo">
                                                                    </a>
                                                                </div>
                                                                <div class="choose-files mt-4">
                                                                    <label for="invoice_logo">
                                                                        <div class=" bg-primary logo_update"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" name="invoice_logo"
                                                                            id="invoice_logo" class="form-control file"
                                                                            data-filename="invoice_logo_update"
                                                                            onchange="document.getElementById('invoiceLogo').src = window.URL.createObjectURL(this.files[0])">
                                                                    </label>
                                                                </div>
                                                                <?php $__errorArgs = ['invoice_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="row">
                                                                        <span class="invalid-invoice_logo" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('store_name', __('Store Name'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Store Name')]); ?>

                                                    <?php $__errorArgs = ['store_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-store_name" role="alert">
                                                            <strong class="text-danger">
                                                                <?php echo e($message); ?>

                                                            </strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Email')])); ?>

                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-email" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <?php if($plan->enable_custdomain == 'on' || $plan->enable_custsubdomain == 'on'): ?>
                                                    <div class="col-md-6 py-4">
                                                        <div class="radio-button-group row gy-2 mts">
                                                            <div class="col-sm-4">
                                                                <label
                                                            class="btn btn-outline-primary w-100 <?php echo e($store_settings['enable_storelink'] == 'on' ? 'active' : ''); ?>">
                                                            <input type="radio"
                                                                class="domain_click  radio-button"
                                                                name="enable_domain" value="enable_storelink"
                                                                id="enable_storelink"
                                                                <?php echo e($store_settings['enable_storelink'] == 'on' ? 'checked' : ''); ?>>
                                                            <?php echo e(__('Store Link')); ?>

                                                        </label>
                                                            </div>
                                                
                                                            <div class="col-sm-4">
                                                                <?php if($plan->enable_custdomain == 'on'): ?>
                                                                    <label
                                                                        class="btn btn-outline-primary w-100 <?php echo e($store_settings['enable_domain'] == 'on' ? 'active' : ''); ?>">
                                                                        <input type="radio"
                                                                            class="domain_click radio-button"
                                                                            name="enable_domain" value="enable_domain"
                                                                            id="enable_domain"
                                                                            <?php echo e($store_settings['enable_domain'] == 'on' ? 'checked' : ''); ?>>
                                                                        <?php echo e(__('Domain')); ?>

                                                                    </label>
                                                            <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?php if($plan->enable_custsubdomain == 'on'): ?>
                                                                    <label
                                                                        class="btn btn-outline-primary w-100 <?php echo e($store_settings['enable_subdomain'] == 'on' ? 'active' : ''); ?>">
                                                                        <input type="radio"
                                                                            class="domain_click radio-button"
                                                                            name="enable_domain" value="enable_subdomain"
                                                                            id="enable_subdomain"
                                                                            <?php echo e($store_settings['enable_subdomain'] == 'on' ? 'checked' : ''); ?>>
                                                                        <?php echo e(__('Sub Domain')); ?>

                                                                    </label>
                                                            <?php endif; ?>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="text-sm mt-2" id="domainnote" style="display: none">
                                                            <?php echo e(__('Note : Before add custom domain, your domain A record is pointing to our server IP :')); ?><?php echo e($serverIp); ?>

                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6" id="StoreLink"
                                                        style="<?php echo e($store_settings['enable_storelink'] == 'on' ? 'display: block' : 'display: none'); ?>">
                                                        <?php echo e(Form::label('store_link', __('Store Link'), ['class' => 'form-label'])); ?>

                                                        <div class="input-group">
                                                            <input type="text"
                                                                value="<?php echo e($store_settings['store_url']); ?>"
                                                                id="myInput" class="form-control d-inline-block"
                                                                aria-label="Recipient's username"
                                                                aria-describedby="button-addon2" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-primary" type="button"
                                                                    onclick="myFunction()" id="button-addon2"><i
                                                                        class="far fa-copy"></i>
                                                                    <?php echo e(__('Copy Link')); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 domain"
                                                        style="<?php echo e($store_settings['enable_domain'] == 'on' ? 'display:block' : 'display:none'); ?>">
                                                        <?php echo e(Form::label('store_domain', __('Custom Domain'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('domains', $store_settings['domains'], ['class' => 'form-control', 'placeholder' => __('xyz.com')])); ?>

                                                    </div>
                                                    <?php if($plan->enable_custsubdomain == 'on'): ?>
                                                        <div class="form-group col-md-6 sundomain"
                                                            style="<?php echo e($store_settings['enable_subdomain'] == 'on' ? 'display:block' : 'display:none'); ?>">
                                                            <?php echo e(Form::label('store_subdomain', __('Sub Domain'), ['class' => 'form-label'])); ?>

                                                            <div class="input-group">
                                                                <?php echo e(Form::text('subdomain', $store_settings['slug'], ['class' => 'form-control', 'placeholder' => __('Enter Domain'), 'readonly'])); ?>

                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"
                                                                        id="basic-addon2">.<?php echo e($subdomain_name); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="form-group col-md-6" id="StoreLink">
                                                        <?php echo e(Form::label('store_link', __('Store Link'), ['class' => 'form-label'])); ?>

                                                        <div class="input-group">
                                                            <input type="text"
                                                                value="<?php echo e($store_settings['store_url']); ?>"
                                                                id="myInput" class="form-control d-inline-block"
                                                                aria-label="Recipient's username"
                                                                aria-describedby="button-addon2" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-primary" type="button"
                                                                    onclick="myFunction()" id="button-addon2"><i
                                                                        class="far fa-copy"></i>
                                                                    <?php echo e(__('Copy Link')); ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('tagline', __('Tagline'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('tagline', null, ['class' => 'form-control', 'placeholder' => __('Tagline')])); ?>

                                                    <?php $__errorArgs = ['tagline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-tagline" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('address', __('Address'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Address')])); ?>

                                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-address" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('City')])); ?>

                                                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-city" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('state', __('State'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('State')])); ?>

                                                    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-state" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('zipcode', __('Zipcode'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => __('Zipcode')])); ?>

                                                    <?php $__errorArgs = ['zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-zipcode" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('country', __('Country'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('Country')])); ?>

                                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-country" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('store_default_language', __('Store Default Language'), ['class' => 'form-label'])); ?>

                                                    <div class="changeLanguage">
                                                        <select name="store_default_language" id="store_default_language"
                                                            class="form-control" data-toggle="select">
                                                            <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($store_lang == $language): ?> selected <?php endif; ?>
                                                                    value="<?php echo e($language); ?>">
                                                                    <?php echo e(Str::upper($language)); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('decimal_number_format', __('Decimal Number Format'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::number('decimal_number', isset($store_settings['decimal_number']) ? $store_settings['decimal_number'] : 2, ['class' => 'form-control', 'placeholder' => __('decimal_number')])); ?>

                                                    <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-decimal_number" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="form-group col-md-4 mt-3">
                                                    <label class="form-check-label"
                                                        for="is_checkout_login_required"></label>
                                                    <div class="custom-control form-switch">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="is_checkout_login_required"
                                                            id="is_checkout_login_required"
                                                            <?php if($store_settings['is_checkout_login_required'] == null): ?> <?php if($settings['is_checkout_login_required'] == 'on'): ?>
                                                                <?php echo e('checked=checked'); ?> <?php endif; ?>
                                                        <?php elseif($store_settings['is_checkout_login_required'] == 'on'): ?> <?php echo e('checked=checked'); ?>

                                                        <?php else: ?> <?php echo e(''); ?> <?php endif; ?>
                                                        
                                                        >
                                                        <?php echo e(Form::label('is_checkout_login_required', __('Is Checkout Login Required'), ['class' => 'form-check-label mb-3'])); ?>

                                                    </div>
                                                </div>
                                                <?php if($plan->blog == 'on'): ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-check-label" for="blog_enable"></label>
                                                        <div class="custom-control form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="blog_enable" id="blog_enable"
                                                                <?php echo e($store_settings['blog_enable'] == 'on' ? 'checked=checked' : ''); ?>>
                                                            <?php echo e(Form::label('blog_enable', __('Blog Menu Dispay'), ['class' => 'form-check-label mb-3'])); ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($plan->shipping_method == 'on'): ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="form-check-label" for="enable_shipping"></label>
                                                        <div class="custom-control form-switch">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="enable_shipping" id="enable_shipping"
                                                                <?php echo e($store_settings['enable_shipping'] == 'on' ? 'checked=checked' : ''); ?>>
                                                            <?php echo e(Form::label('enable_shipping', __('Shipping Method Enable'), ['class' => 'form-check-label mb-3'])); ?>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="form-group col-md-4 ">
                                                    <label class="form-check-label" for="enable_rating"></label>
                                                    <div class="custom-control form-switch">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="enable_rating" id="enable_rating"
                                                            <?php echo e($store_settings['enable_rating'] == 'on' ? 'checked=checked' : ''); ?>>
                                                        <?php echo e(Form::label('enable_rating', __('Product Rating Display'), ['class' => 'form-check-label mb-3'])); ?>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <i class="fab fa-google" aria-hidden="true"></i>
                                                        <?php echo e(Form::label('google_analytic', __('Google Analytic'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('google_analytic', null, ['class' => 'form-control', 'placeholder' => 'UA-XXXXXXXXX-X'])); ?>

                                                        <?php $__errorArgs = ['google_analytic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-google_analytic" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                                        <?php echo e(Form::label('facebook_pixel_code', __('Facebook Pixel'), ['class' => 'form-label'])); ?>

                                                        <?php echo e(Form::text('fbpixel_code', null, ['class' => 'form-control', 'placeholder' => 'UA-0000000-0'])); ?>

                                                        <?php $__errorArgs = ['facebook_pixel_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-google_analytic" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo e(Form::label('storejs', __('Store Custom JS'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::textarea('storejs', null, ['class' => 'form-control', 'rows' => 3, 'placehold   er' => __('About')])); ?>

                                                    <?php $__errorArgs = ['storejs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-about" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('metakeyword', __('Meta Keywords'), ['class' => 'form-label'])); ?>

                                                        <?php echo Form::text('metakeyword', null, [
                                                            'class' => 'form-control',
                                                            'rows' => 3,
                                                            'placeholder' => __('Meta Keyword'),
                                                        ]); ?>

                                                        <?php $__errorArgs = ['meta_keywords'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-about" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('metadesc', __('Meta Description'), ['class' => 'form-label'])); ?>

                                                        <?php echo Form::textarea('metadesc', null, [
                                                            'class' => 'form-control',
                                                            'rows' => 3,
                                                            'placeholder' => __('Meta Description'),
                                                        ]); ?>

    
                                                        <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-about" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    
                                                    <div class="form-group pt-0">
                                                        <div class=" setting-card">
                                                            <label for="" class="form-label"><?php echo e(__('Meta Image')); ?></label>
                                                            <div class="logo-content mt-4">
                                                                
                                                                <a href="<?php echo e($metaimage.(isset($store_settings->metaimage) && !empty($store_settings->metaimage)? $store_settings->metaimage:'default.png')); ?>" target="_blank">
                                                                    <img id="meta_image" alt="your image" src="<?php echo e($metaimage.(isset($store_settings->metaimage) && !empty($store_settings->metaimage)? $store_settings->metaimage:'default.png')); ?>" width="150px" class="img_setting">
                                                                </a>
                                                            </div>
                                                            <div class="choose-files mt-5">
                                                                <label for="metaimage">
                                                                    <div class=" bg-primary full_logo"> <i
                                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                    </div>
                                                                    <input type="file" name="metaimage"
                                                                        id="metaimage" class="form-control file"
                                                                        data-filename="metaimage"
                                                                        onchange="document.getElementById('meta_image').src = window.URL.createObjectURL(this.files[0])">
                                                                </label>
                                                            </div>
                                                            <?php $__errorArgs = ['metaimage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <div class="row">
                                                                    <span class="invalid-logo" role="alert">
                                                                        <strong
                                                                            class="text-danger"><?php echo e($message); ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-12 px-2">
                                            <div class="text-end">
                                                <button type="button" class="btn bs-pass-para btn-secondary btn-light"
                                                    data-title="<?php echo e(__('Delete')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                    data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="delete-form-<?php echo e($store_settings->id); ?>">
                                                    <span class="text-black"><?php echo e(__('Delete Store')); ?></span>
                                                </button>
                                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                        <?php echo Form::open([
                            'method' => 'DELETE',
                            'route' => ['ownerstore.destroy', $store_settings->id],
                            'id' => 'delete-form-' . $store_settings->id,
                        ]); ?>

                        <?php echo Form::close(); ?>

                    </div>
                    <div class="tab-pane fade" id="pills-store_payment-setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e('Payment Settings'); ?></h5>
                                <small
                                class="text-dark font-weight-bold"><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                            </div>
                            <div class="card-body">

                                <?php echo e(Form::open(['route' => ['owner.payment.setting', $store_settings->slug], 'method' => 'post', 'novalidate'])); ?>

                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label class="col-form-label"><?php echo e(__('Currency')); ?></label>
                                                <input type="text" name="currency" class="form-control"
                                                    id="currency" value="<?php echo e($store_settings['currency_code']); ?>"
                                                    required>
                                                <small class="text-xs">
                                                    <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                                    <a href="https://stripe.com/docs/currencies"
                                                        target="_blank"><?php echo e(__('You can find out how to do that here..')); ?></a>
                                                        <?php echo e(__(' and this value will be automatically assigned whenever a new store is created.')); ?>

                                                </small>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="currency_symbol"
                                                    class="col-form-label"><?php echo e(__('Currency Symbol')); ?></label>
                                                <input type="text" name="currency_symbol" class="form-control"
                                                    id="currency_symbol" value="<?php echo e($store_settings['currency']); ?>"
                                                    required>
                                            </div>

                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label mb-3"
                                                                for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline mb-3">
                                                                        <input type="radio" id="customRadio5"
                                                                            name="currency_symbol_position" value="pre"
                                                                            class="form-check-input"
                                                                            <?php if($store_settings['currency_symbol_position'] == 'pre' || $store_settings['currency_symbol_position'] == null): ?> checked <?php endif; ?>>
                                                                        <label class="form-check-label"
                                                                            for="customRadio5"><?php echo e(__('Pre')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline mb-3">
                                                                        <input type="radio" id="customRadio6"
                                                                            name="currency_symbol_position" value="post"
                                                                            class="form-check-input"
                                                                            <?php if($store_settings['currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                                                        <label class="form-check-label"
                                                                            for="customRadio6"><?php echo e(__('Post')); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label mb-3"
                                                                for="example3cols3Input"><?php echo e(__('Currency Symbol Space')); ?></label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline mb-3">
                                                                        <input type="radio" id="customRadio7"
                                                                            name="currency_symbol_space" value="with"
                                                                            class="form-check-input"
                                                                            <?php if($store_settings['currency_symbol_space'] == 'with'): ?> checked <?php endif; ?>>
                                                                        <label class="form-check-label"
                                                                            for="customRadio7"><?php echo e(__('With Space')); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline mb-3">
                                                                        <input type="radio" id="customRadio8"
                                                                            name="currency_symbol_space" value="without"
                                                                            class="form-check-input"
                                                                            <?php if($store_settings['currency_symbol_space'] == 'without' || $store_settings['currency_symbol_space'] == null): ?> checked <?php endif; ?>>
                                                                        <label class="form-check-label"
                                                                            for="customRadio8"><?php echo e(__('Without Space')); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6><?php echo e(__('Custom Field For Checkout')); ?></h6>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('custom_field_title_1', __('Custom Field Title'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('custom_field_title_1', !empty($store_payment_setting['custom_field_title_1']) ? $store_payment_setting['custom_field_title_1'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')])); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('custom_field_title_2', __('Custom Field Title'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('custom_field_title_2', !empty($store_payment_setting['custom_field_title_2']) ? $store_payment_setting['custom_field_title_2'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')])); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('custom_field_title_3', __('Custom Field Title'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('custom_field_title_3', !empty($store_payment_setting['custom_field_title_3']) ? $store_payment_setting['custom_field_title_3'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')])); ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('custom_field_title_4', __('Custom Field Title'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('custom_field_title_4', !empty($store_payment_setting['custom_field_title_4']) ? $store_payment_setting['custom_field_title_4'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Custom Field Title')])); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="faq justify-content-center">
                                    <div class="col-sm-12 col-md-10 col-xxl-12">
                                        <div class="accordion accordion-flush" id="accordionExample">

                                            <!-- COD -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse0"
                                                        aria-expanded="true" aria-controls="collapse0">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('COD')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse0" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                                <small>
                                                                    <?php echo e(__('Note : Enable or disable cash on delivery.')); ?></small><br>
                                                                <small>
                                                                    <?php echo e(__('This detail will use for make checkout of shopping cart.')); ?></small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_cod"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_cod" id="enable_cod"
                                                                        <?php echo e($store_settings['enable_cod'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="enable_cod"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Telegram -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse01"
                                                        aria-expanded="true" aria-controls="collapse01">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Telegram')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse01" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                                <small>
                                                                    <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_telegram"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_telegram" id="enable_telegram"
                                                                        <?php echo e($store_settings['enable_telegram'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="enable_telegram"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('telegrambot', __('Telegram Access Token'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('telegrambot', $store_settings['telegrambot'], ['class' => 'form-control active telegrambot', 'placeholder' => '1234567890:AAbbbbccccddddxvGENZCi8Hd4B15M8xHV0'])); ?>

                                                                    <p><?php echo e(__('Get Chat ID')); ?> :
                                                                        https://api.telegram.org/bot-TOKEN-/getUpdates</p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('telegramchatid', __('Telegram Chat Id'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('telegramchatid', $store_settings['telegramchatid'], ['class' => 'form-control active telegramchatid', 'placeholder' => '123456789'])); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Whatsapp -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse02"
                                                        aria-expanded="true" aria-controls="collapse02">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Whatsapp')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse02" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                                <small>
                                                                    <?php echo e(__('Note: This detail will use for make checkout of shopping cart.')); ?></small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_whatsapp"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_whatsapp" id="enable_whatsapp"
                                                                        <?php echo e($store_settings['enable_whatsapp'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="enable_whatsapp"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" name="whatsapp_number"
                                                                        id="whatsapp_number"
                                                                        class="form-control input-mask"
                                                                        data-mask="+00 00000000000"
                                                                        value="<?php echo e($store_settings['whatsapp_number']); ?>"
                                                                        placeholder="+00 00000000000" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bank Transfer -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse03"
                                                        aria-expanded="true" aria-controls="collapse03">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Bank Transfer')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse03" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                                <small>
                                                                    <?php echo e(__('Note: Input your bank details including bank name.')); ?></small>
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="enable_bank"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="enable_bank" id="enable_bank"
                                                                        <?php echo e($store_settings['enable_bank'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="enable_bank"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                        <textarea type="text" name="bank_number" id="bank_number" class="form-control" value=""
                                                                        placeholder="<?php echo e(__('Bank Transfer Number')); ?>"><?php echo e($store_settings['bank_number']); ?>   </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Strip -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-2">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse1"
                                                        aria-expanded="true" aria-controls="collapse1">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Stripe')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse1" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_stripe_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_stripe_enabled" id="is_stripe_enabled"
                                                                        <?php echo e(isset($store_settings['is_stripe_enabled']) && $store_settings['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_stripe_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('stripe_key', isset($store_settings['stripe_key']) ? $store_settings['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?>

                                                                    <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-stripe_key" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label'])); ?>

                                                                    <?php echo e(Form::text('stripe_secret', isset($store_settings['stripe_secret']) ? $store_settings['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

                                                                    <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="invalid-stripe_secret" role="alert">
                                                                            <strong
                                                                                class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paypal -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-3">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse2"
                                                        aria-expanded="true" aria-controls="collapse2">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Paypal')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse2" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-3" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_paypal_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_paypal_enabled" id="is_paypal_enabled"
                                                                        <?php echo e(isset($store_settings['is_paypal_enabled']) && $store_settings['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paypal_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="paypal-label col-form-label"
                                                                    for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                                                                <br>
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="paypal_mode" value="sandbox"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(!isset($store_settings['paypal_mode']) || $store_settings['paypal_mode'] == '' || $store_settings['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="paypal_mode" value="live"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($store_settings['paypal_mode']) && $store_settings['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label"><?php echo e(__('Client ID')); ?></label>
                                                                    <input type="text" name="paypal_client_id"
                                                                        id="paypal_client_id" class="form-control"
                                                                        value="<?php echo e(!isset($store_settings['paypal_client_id']) || is_null($store_settings['paypal_client_id']) ? '' : $store_settings['paypal_client_id']); ?>"
                                                                        placeholder="<?php echo e(__('Client ID')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_secret_key"
                                                                        class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" name="paypal_secret_key"
                                                                        id="paypal_secret_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_settings['paypal_secret_key']) || is_null($store_settings['paypal_secret_key']) ? '' : $store_settings['paypal_secret_key']); ?>"
                                                                        placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paystack -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-4">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse3"
                                                        aria-expanded="true" aria-controls="collapse3">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Paystack')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse3" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-4" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_paystack_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_paystack_enabled"
                                                                        id="is_paystack_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_paystack_enabled']) && $store_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paystack_enabled"><?php echo e(__('Enable')); ?></label>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                    <input type="text" name="paystack_public_key"
                                                                        id="paystack_public_key" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['paystack_public_key']) ? $store_payment_setting['paystack_public_key'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Public Key')); ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" name="paystack_secret_key"
                                                                        id="paystack_secret_key" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['paystack_secret_key']) ? $store_payment_setting['paystack_secret_key'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- FLUTTERWAVE -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-5">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse4"
                                                        aria-expanded="true" aria-controls="collapse4">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Flutterwave')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse4" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-5" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_flutterwave_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_flutterwave_enabled"
                                                                        id="is_flutterwave_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_flutterwave_enabled']) && $store_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_flutterwave_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                    <input type="text" name="flutterwave_public_key"
                                                                        id="flutterwave_public_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['flutterwave_public_key']) || is_null($store_payment_setting['flutterwave_public_key']) ? '' : $store_payment_setting['flutterwave_public_key']); ?>"
                                                                        placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" name="flutterwave_secret_key"
                                                                        id="flutterwave_secret_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['flutterwave_secret_key']) || is_null($store_payment_setting['flutterwave_secret_key']) ? '' : $store_payment_setting['flutterwave_secret_key']); ?>"
                                                                        placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Razorpay -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-6">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse5"
                                                        aria-expanded="true" aria-controls="collapse5">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Razorpay')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse5" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-6" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_razorpay_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_razorpay_enabled"
                                                                        id="is_razorpay_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_razorpay_enabled']) && $store_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_razorpay_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paypal_client_id"
                                                                        class="col-form-label"><?php echo e(__('Public Key')); ?></label>

                                                                    <input type="text" name="razorpay_public_key"
                                                                        id="razorpay_public_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['razorpay_public_key']) || is_null($store_payment_setting['razorpay_public_key']) ? '' : $store_payment_setting['razorpay_public_key']); ?>"
                                                                        placeholder="Public Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paystack_secret_key"
                                                                        class="col-form-label">
                                                                        <?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" name="razorpay_secret_key"
                                                                        id="razorpay_secret_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['razorpay_secret_key']) || is_null($store_payment_setting['razorpay_secret_key']) ? '' : $store_payment_setting['razorpay_secret_key']); ?>"
                                                                        placeholder="Secret Key">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Paytm -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-7">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse6"
                                                        aria-expanded="true" aria-controls="collapse6">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Paytm')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse6" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-7" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_paytm_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_paytm_enabled" id="is_paytm_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_paytm_enabled']) && $store_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paytm_enabled"><?php echo e(__('Enable')); ?></label>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="paypal-label col-form-label"
                                                                    for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                                <br>
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="paytm_mode" value="local"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(!isset($store_payment_setting['paytm_mode']) || $store_payment_setting['paytm_mode'] == '' || $store_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Local')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="paytm_mode"
                                                                                        value="production"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($store_payment_setting['paytm_mode']) && $store_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Production')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_public_key"
                                                                        class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                    <input type="text" name="paytm_merchant_id"
                                                                        id="paytm_merchant_id" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['paytm_merchant_id']) ? $store_payment_setting['paytm_merchant_id'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                                    <?php if($errors->has('paytm_merchant_id')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_secret_key"
                                                                        class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                    <input type="text" name="paytm_merchant_key"
                                                                        id="paytm_merchant_key" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['paytm_merchant_key']) ? $store_payment_setting['paytm_merchant_key'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Merchant Key')); ?>" />
                                                                    <?php if($errors->has('paytm_merchant_key')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="paytm_industry_type"
                                                                        class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                    <input type="text" name="paytm_industry_type"
                                                                        id="paytm_industry_type" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['paytm_industry_type']) ? $store_payment_setting['paytm_industry_type'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Industry Type')); ?>" />
                                                                    <?php if($errors->has('paytm_industry_type')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mercado Pago-->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-8">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse7"
                                                        aria-expanded="true" aria-controls="collapse7">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Mercado Pago')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse7" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-8" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_mercado_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_mercado_enabled"
                                                                        id="is_mercado_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_mercado_enabled']) && $store_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_mercado_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="coingate-label col-form-label"
                                                                    for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                                <br>
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="mercado_mode"
                                                                                        value="sandbox"
                                                                                        class="form-check-input"
                                                                                        <?php echo e((isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == '') || (isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="mercado_mode"
                                                                                        value="live"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($store_payment_setting['mercado_mode']) && $store_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mercado_access_token"
                                                                        class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                    <input type="text" name="mercado_access_token"
                                                                        id="mercado_access_token" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['mercado_access_token']) ? $store_payment_setting['mercado_access_token'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Access Token')); ?>" />
                                                                    <?php if($errors->has('mercado_secret_key')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('mercado_access_token')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mollie -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-9">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse8"
                                                        aria-expanded="true" aria-controls="collapse8">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Mollie')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse8" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-9" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_mollie_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_mollie_enabled" id="is_mollie_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_mollie_enabled']) && $store_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_mollie_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key"
                                                                        class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                    <input type="text" name="mollie_api_key"
                                                                        id="mollie_api_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['mollie_api_key']) || is_null($store_payment_setting['mollie_api_key']) ? '' : $store_payment_setting['mollie_api_key']); ?>"
                                                                        placeholder="Mollie Api Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_profile_id"
                                                                        class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                    <input type="text" name="mollie_profile_id"
                                                                        id="mollie_profile_id" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['mollie_profile_id']) || is_null($store_payment_setting['mollie_profile_id']) ? '' : $store_payment_setting['mollie_profile_id']); ?>"
                                                                        placeholder="Mollie Profile Id">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_partner_id"
                                                                        class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                    <input type="text" name="mollie_partner_id"
                                                                        id="mollie_partner_id" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['mollie_partner_id']) || is_null($store_payment_setting['mollie_partner_id']) ? '' : $store_payment_setting['mollie_partner_id']); ?>"
                                                                        placeholder="Mollie Partner Id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Skrill -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-10">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse9"
                                                        aria-expanded="true" aria-controls="collapse9">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Skrill')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse9" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-10" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_skrill_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_skrill_enabled" id="is_skrill_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_skrill_enabled']) && $store_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_skrill_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="mollie_api_key"
                                                                        class="col-form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                                    <input type="email" name="skrill_email"
                                                                        id="skrill_email" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['skrill_email']) ? $store_payment_setting['skrill_email'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Mollie Api Key')); ?>" />
                                                                    <?php if($errors->has('skrill_email')): ?>
                                                                        <span class="invalid-feedback d-block">
                                                                            <?php echo e($errors->first('skrill_email')); ?>

                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- CoinGate -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-11">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse10"
                                                        aria-expanded="true" aria-controls="collapse10">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('CoinGate')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse10" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-11" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_coingate_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_coingate_enabled"
                                                                        id="is_coingate_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_coingate_enabled']) && $store_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_coingate_enabled"><?php echo e(__('Enable')); ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 pb-4">
                                                                <label class="col-form-label"
                                                                    for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                                <br>
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="coingate_mode"
                                                                                        value="sandbox"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(!isset($store_payment_setting['coingate_mode']) || $store_payment_setting['coingate_mode'] == '' || $store_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label class="form-check-labe text-dark">
                                                                                    <input type="radio"
                                                                                        name="coingate_mode"
                                                                                        value="live"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($store_payment_setting['coingate_mode']) && $store_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="coingate_auth_token"
                                                                        class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                    <input type="text" name="coingate_auth_token"
                                                                        id="coingate_auth_token" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['coingate_auth_token']) || is_null($store_payment_setting['coingate_auth_token']) ? '' : $store_payment_setting['coingate_auth_token']); ?>"
                                                                        placeholder="CoinGate Auth Token">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PaymentWall -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-12">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse11"
                                                        aria-expanded="true" aria-controls="collapse11">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('PaymentWall')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse11" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-12" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_paymentwall_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_paymentwall_enabled"
                                                                        id="is_paymentwall_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_paymentwall_enabled']) && $store_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_paymentwall_enabled"><?php echo e(__('Enable')); ?>

                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_public_key"
                                                                        class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                    <input type="text" name="paymentwall_public_key"
                                                                        id="paymentwall_public_key" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['paymentwall_public_key']) || is_null($store_payment_setting['paymentwall_public_key']) ? '' : $store_payment_setting['paymentwall_public_key']); ?>"
                                                                        placeholder="<?php echo e(__('Public Key')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="paymentwall_private_key"
                                                                        class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                    <input type="text" name="paymentwall_private_key"
                                                                        id="paymentwall_private_key"
                                                                        class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['paymentwall_private_key']) || is_null($store_payment_setting['paymentwall_private_key']) ? '' : $store_payment_setting['paymentwall_private_key']); ?>"
                                                                        placeholder="<?php echo e(__('Private Key')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- toyyibpay -->
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-13">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse12"
                                                        aria-expanded="true" aria-controls="collapse12">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Toyyibpay')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse12" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-13" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_toyyibpay_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_toyyibpay_enabled"
                                                                        id="is_toyyibpay_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_toyyibpay_enabled']) && $store_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_toyyibpay_enabled"><?php echo e(__('Enable')); ?>

                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="toyyibpay_category_code"
                                                                        class="col-form-label"><?php echo e(__('category Code')); ?></label>
                                                                    <input type="text" name="toyyibpay_category_code"
                                                                        id="toyyibpay_category_code" class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['toyyibpay_category_code']) || is_null($store_payment_setting['toyyibpay_category_code']) ? '' : $store_payment_setting['toyyibpay_category_code']); ?>"
                                                                        placeholder="<?php echo e(__('category Code')); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="toyyibpay_secret_key"
                                                                        class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                    <input type="text" name="toyyibpay_secret_key"
                                                                        id="toyyibpay_secret_key"
                                                                        class="form-control"
                                                                        value="<?php echo e(!isset($store_payment_setting['toyyibpay_secret_key']) || is_null($store_payment_setting['toyyibpay_secret_key']) ? '' : $store_payment_setting['toyyibpay_secret_key']); ?>"
                                                                        placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item card">
                                                <h2 class="accordion-header" id="heading-2-14">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse13"
                                                        aria-expanded="true" aria-controls="collapse13">
                                                        <span class="d-flex align-items-center">
                                                            <i class="ti ti-credit-card text-primary"></i>
                                                            <?php echo e(__('Payfast')); ?>

                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse13" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2-14" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6 py-2">
                                                                
                                                            </div>
                                                            <div class="col-6 py-2 text-end">
                                                                <div
                                                                    class="form-check form-switch form-switch-right mb-2">
                                                                    <input type="hidden" name="is_payfast_enabled"
                                                                        value="off">
                                                                    <input type="checkbox" class="form-check-input mx-2"
                                                                        name="is_payfast_enabled"
                                                                        id="is_payfast_enabled"
                                                                        <?php echo e(isset($store_payment_setting['is_payfast_enabled']) && $store_payment_setting['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    <label class="form-check-label"
                                                                        for="is_payfast_enabled"><?php echo e(__('Enable')); ?>

                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="payfast-label col-form-label"
                                                                    for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                                                                <br>
                                                                <div class="d-flex">
                                                                    <div class="me-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label
                                                                                    class="form-check-labe text-dark <?php echo e(isset($store_payment_setting['payfast_mode']) && $store_payment_setting['payfast_mode'] == 'sandbox' ? 'active' : ''); ?>">
                                                                                    <input type="radio"
                                                                                        name="payfast_mode" value="sandbox"
                                                                                        class="form-check-input"
                                                                                        <?php echo e((isset($store_payment_setting['payfast_mode']) && $store_payment_setting['payfast_mode'] == '') || (isset($store_payment_setting['payfast_mode']) &&
                                                                                        $store_payment_setting['payfast_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>><?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="me-2">
                                                                        <div class="border card p-3">
                                                                            <div class="form-check">
                                                                                <label
                                                                                    class="form-check-labe text-dark <?php echo e(isset($store_payment_setting['payfast_mode']) && $store_payment_setting['payfast_mode'] == 'live' ? 'active' : ''); ?>">
                                                                                    <input type="radio"
                                                                                        name="payfast_mode" value="live"
                                                                                        class="form-check-input"
                                                                                        <?php echo e(isset($store_payment_setting['payfast_mode']) && $store_payment_setting['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>><?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="payfast_merchant_id"
                                                                        class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                    <input type="text" name="payfast_merchant_id"
                                                                        id="payfast_merchant_id" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['payfast_merchant_id']) ? $store_payment_setting['payfast_merchant_id'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Merchant ID')); ?>">
                                                                </div>
                                                                <?php if($errors->has('payfast_merchant_id')): ?>
                                                                    <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('payfast_merchant_id')); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="payfast_merchant_key"
                                                                        class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                    <input type="text" name="payfast_merchant_key"
                                                                        id="payfast_merchant_key" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['payfast_merchant_key']) ? $store_payment_setting['payfast_merchant_key'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Merchant Key')); ?>">
                                                                </div>
                                                                <?php if($errors->has('payfast_merchant_key')): ?>
                                                                    <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('payfast_merchant_key')); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="payfast_signature"
                                                                        class="col-form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                                    <input type="text" name="payfast_signature"
                                                                        id="payfast_signature" class="form-control"
                                                                        value="<?php echo e(isset($store_payment_setting['payfast_signature']) ? $store_payment_setting['payfast_signature'] : ''); ?>"
                                                                        placeholder="<?php echo e(__('Salt Passphrase')); ?>">
                                                                </div>
                                                                <?php if($errors->has('payfast_signature')): ?>
                                                                    <span class="invalid-feedback d-block">
                                                                        <?php echo e($errors->first('payfast_signature')); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 px-2">
                                    <div class="text-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-store_email_setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">
                                        <?php echo e(__('Email Settings')); ?>

                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <?php echo e(Form::open(['route' => ['owner.email.setting', $store_settings->slug], 'method' => 'post'])); ?>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_driver', $store_settings->mail_driver, ['class' => 'form-control', 'id' => 'mail_driver', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_host', $store_settings->mail_host, ['class' => 'form-control ', 'id' => 'mail_host', 'placeholder' => __('Enter Mail Host')])); ?>

                                            <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_port', $store_settings->mail_port, ['class' => 'form-control', 'id' => 'mail_port', 'placeholder' => __('Enter Mail Port')])); ?>

                                            <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_username', $store_settings->mail_username, ['class' => 'form-control', 'id' => 'mail_username', 'placeholder' => __('Enter Mail Username')])); ?>

                                            <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_password', $store_settings->mail_password, ['class' => 'form-control', 'id' => 'mail_password', 'placeholder' => __('Enter Mail Password')])); ?>

                                            <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_encryption', $store_settings->mail_encryption, ['class' => 'form-control', 'id' => 'mail_encryption', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                            <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_address', $store_settings->mail_from_address, ['class' => 'form-control', 'id' => 'mail_from_address', 'placeholder' => __('Enter Mail From Address')])); ?>

                                            <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('mail_from_name', $store_settings->mail_from_name, ['class' => 'form-control', 'id' => 'mail_from_name', 'placeholder' => __('Enter Mail From Name')])); ?>

                                            <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <div class="card-footer">
                                            <div class="col-sm-12 px-2">
                                                <div class="d-flex justify-content-between gap-2 flex-column flex-sm-row">
                                                    <a href="#" data-url="<?php echo e(route('test.mail')); ?>"
                                                        data-title="<?php echo e(__('Send Test Mail')); ?>"
                                                        class="btn btn-xs btn-primary send_email">
                                                        <?php echo e(__('Send Test Mail')); ?>

                                                    </a>

                                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-whatsapp_custom_massage" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">
                                        <?php echo e(__('Whatsapp Message Settings')); ?>

                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <?php echo e(Form::model($store_settings, ['route' => ['customMassage', $store_settings->slug], 'method' => 'POST'])); ?>

                                    <div class="row">
                                        <h6 class="font-weight-bold"><?php echo e(__('Order Variable')); ?></h6>
                                        <div class="form-group col-md-6">
                                            <p class="mb-1"><?php echo e(__('Store Name')); ?> : <span
                                                    class="pull-right text-primary">{store_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Order No')); ?> : <span
                                                    class="pull-right text-primary">{order_no}</span></p>
                                            <p class="mb-1"><?php echo e(__('Customer Name')); ?> : <span
                                                    class="pull-right text-primary">{customer_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Billing Address')); ?> : <span
                                                    class="pull-right text-primary">{billing_address}</span></p>
                                            <p class="mb-1"><?php echo e(__('Billing Ccountry')); ?> : <span
                                                    class="pull-right text-primary">{billing_country}</span></p>
                                            <p class="mb-1"><?php echo e(__('Billing City')); ?> : <span
                                                    class="pull-right text-primary">{billing_city}</span></p>
                                            <p class="mb-1"><?php echo e(__('Billing Postalcode')); ?> : <span
                                                    class="pull-right text-primary">{billing_postalcode}</span></p>
                                            <p class="mb-1"><?php echo e(__('Shipping Address')); ?> : <span
                                                    class="pull-right text-primary">{shipping_address}</span></p>
                                            <p class="mb-1"><?php echo e(__('Shipping Country')); ?> : <span
                                                    class="pull-right text-primary">{shipping_country}</span></p>

                                            <p class="mb-1"><?php echo e(__('Shipping City')); ?> : <span
                                                    class="pull-right text-primary">{shipping_city}</span></p>
                                            <p class="mb-1"><?php echo e(__('Shipping Postalcode')); ?> : <span
                                                    class="pull-right text-primary">{shipping_postalcode}</span></p>
                                            <p class="mb-1"><?php echo e(__('Item Variable')); ?> : <span
                                                    class="pull-right text-primary">{item_variable}</span></p>
                                            <p class="mb-1"><?php echo e(__('Qty Total')); ?> : <span
                                                    class="pull-right text-primary">{qty_total}</span></p>
                                            <p class="mb-1"><?php echo e(__('Sub Total')); ?> : <span
                                                    class="pull-right text-primary">{sub_total}</span></p>
                                            <p class="mb-1"><?php echo e(__('Discount Amount')); ?> : <span
                                                    class="pull-right text-primary">{discount_amount}</span></p>
                                            <p class="mb-1"><?php echo e(__('Shipping Amount')); ?> : <span
                                                    class="pull-right text-primary">{shipping_amount}</span></p>
                                            <p class="mb-1"><?php echo e(__('Total Tax')); ?> : <span
                                                    class="pull-right text-primary">{total_tax}</span></p>
                                            <p class="mb-1"><?php echo e(__('Final Total')); ?> : <span
                                                    class="pull-right text-primary">{final_total}</span></p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h6 class="font-weight-bold"><?php echo e(__('Item Variable')); ?></h6>
                                            <p class="mb-1"><?php echo e(__('Sku')); ?> : <span
                                                    class="pull-right text-primary">{sku}</span></p>
                                            <p class="mb-1"><?php echo e(__('Quantity')); ?> : <span
                                                    class="pull-right text-primary">{quantity}</span></p>
                                            <p class="mb-1"><?php echo e(__('Product Name')); ?> : <span
                                                    class="pull-right text-primary">{product_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Variant Name')); ?> : <span
                                                    class="pull-right text-primary">{variant_name}</span></p>
                                            <p class="mb-1"><?php echo e(__('Item Tax')); ?> : <span
                                                    class="pull-right text-primary">{item_tax}</span></p>
                                            <p class="mb-1"><?php echo e(__('Item total')); ?> : <span
                                                    class="pull-right text-primary">{item_total}</span></p>
                                            <div class="form-group">
                                                <label for="storejs" class="col-form-label">{item_variable}</label>
                                                <?php echo e(Form::text('item_variable', null, ['class' => 'form-control', 'placeholder' => '{quantity} x {product_name} - {variant_name} + {item_tax} = {item_total}'])); ?>

                                            </div>
                                            <div class="form-group">
                                                <?php echo e(Form::label('content', __('Whatsapp Message'), ['class' => 'col-form-label'])); ?>

                                                <?php echo e(Form::textarea('content', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-end">
                                        <div class="card-footer">
                                            <div class="col-sm-12 px-2">
                                                <div class="d-flex justify-content-end">
                                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-twilio_setting" role="tabpanel" aria-labelledby="pills-brand_setting-tab">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row ">
                                        <div class="col-6">
                                            <h5><?php echo e(__('Twilio Settings')); ?></h5>
                                            <small><?php echo e(__('Edit Twilio Settings')); ?></small>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <div class="form-check form-switch ">
                                                <input type="checkbox" class="form-check-input off switch"
                                                    data-toggle="switchbutton" name="is_twilio_enabled"
                                                    id="twilio_module"
                                                    <?php echo e($store_settings['is_twilio_enabled'] == 'on' ? 'checked=checked' : ''); ?>>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST"
                                    action="<?php echo e(route('owner.twilio.setting', $store_settings->slug)); ?>"
                                    accept-charset="UTF-8">
                                    <?php echo csrf_field(); ?>
                                    <div class="card-body p-4">
                                        <div class="row">

                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                <label for="twilio_token"
                                                    class="form-label"><?php echo e(__('Twilio SID')); ?></label>
                                                <input class="form-control" name="twilio_sid" type="text"
                                                    value="<?php echo e($store_settings->twilio_sid); ?>" id="twilio_sid">
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                <label for="twilio_token"
                                                    class="form-label"><?php echo e(__('Twilio Token')); ?></label>
                                                <input class="form-control " name="twilio_token" type="text"
                                                    value="<?php echo e($store_settings->twilio_token); ?>" id="twilio_token">
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                <label for="twilio_from"
                                                    class="form-label"><?php echo e(__('Twilio From')); ?></label>
                                                <input class="form-control " name="twilio_from" type="text"
                                                    value="<?php echo e($store_settings->twilio_from); ?>" id="twilio_from">
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                <label for="notification_number"
                                                    class="form-label"><?php echo e(__('Notification Number')); ?></label>
                                                <input class="form-control " name="notification_number"
                                                    type="text"
                                                    value="<?php echo e($store_settings->notification_number); ?>"
                                                    id="notification_number">
                                                <small>* <?php echo e(__('Use country code with your number')); ?> *</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <div class="card-footer">
                                                <div class="col-sm-12 px-2">
                                                    <div class="d-flex justify-content-end">
                                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pixel_settings" role="tabpanel" aria-labelledby="pills-pixel_setting-tab">
                        <div class="card">
                            <div class="custom-fields">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <h5 class=""><?php echo e(__('Pixel Fields Settings')); ?></h5>
                                        <small><?php echo e(__('Enter Your Pixel Fields Settings')); ?></small>
                                    </div>
                                    
                                    <a href="#" class="btn btn-sm btn-icon  btn-primary me-2" data-ajax-popup="true" data-url="<?php echo e(route('owner.pixel.create')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Pixel')); ?>">
                                        <i  data-feather="plus"></i>
                                    </a>
                                </div>
                                <div class="card-body table-border-style">
                                    <div class="datatable-container">
                                    
                                        <div class="table-responsive custom-field-table">
                                            
                                            <table class="table dataTable-table" id="pc-dt-simple" data-repeater-list="fields">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th><?php echo e(__('Platform')); ?></th>
                                                        <th><?php echo e(__('Pixel Id')); ?></th>
                    
                                                        <th class="text-right"><?php echo e(__('Action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $PixelFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $PixelField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td class="text-capitalize"> 
                                                                <?php echo e($PixelField->platform); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e($PixelField->pixel_id); ?>

                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex">
                                                                    <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#" data-title="<?php echo e(__('Delete pixel')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>" data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="pixel-delete-form-<?php echo e($PixelField->id); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash f-20"></i>
                                                                    </a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['pixel.delete', $PixelField->id], 'id' => 'pixel-delete-form-' . $PixelField->id]); ?>

                                                                    <?php echo Form::close(); ?>

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
                    </div>
                    <div class="tab-pane fade" id="pwa_settings" role="tabpanel" aria-labelledby="pills-pwa_setting-tab">
                        <div class="card">
                            <div class="card-header">
                                <div class="row ">
                                    <div class="col-6">
                                        <h5><?php echo e(__('PWA Settings')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if($plan->pwa_store == 'on'): ?>
                                    <?php echo e(Form::model($store_settings, ['route' => ['setting.pwa', $store_settings['id']], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                        <div class="form-group col-md-4 ">
                                            <label class="form-check-label"
                                                for="is_checkout_login_required"></label>
                                            <div class="custom-control form-switch">
                                                <input type="checkbox"
                                                    class="form-check-input enable_pwa_store" name="pwa_store"
                                                    id="pwa_store"
                                                    <?php echo e($store_settings['enable_pwa_store'] == 'on' ? 'checked=checked' : ''); ?>>
                                                <?php echo e(Form::label('pwa_store', __('Progressive Web App (PWA)'), ['class' => 'form-check-label mb-3'])); ?>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 pwa_is_enable">
                                                <?php echo e(Form::label('pwa_app_title', __('App Title'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('pwa_app_title', !empty($pwa_data->name) ? $pwa_data->name : '', ['class' => 'form-control', 'placeholder' => __('App Title')])); ?>

                                            </div>

                                            <div class="form-group col-md-6 pwa_is_enable">
                                                <?php echo e(Form::label('pwa_app_name', __('App Name'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('pwa_app_name', !empty($pwa_data->short_name) ? $pwa_data->short_name : '', ['class' => 'form-control', 'placeholder' => __('App Name')])); ?>

                                            </div>

                                            <div class="form-group col-md-6 pwa_is_enable">
                                                <?php echo e(Form::label('pwa_app_background_color', __('App Background Color'), ['class' => 'form-label'])); ?>

                                                
                                                <?php echo e(Form::color('pwa_app_background_color', !empty($pwa_data->background_color) ? $pwa_data->background_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')])); ?>

                                            </div>

                                            <div class="form-group col-md-6 pwa_is_enable">
                                                <?php echo e(Form::label('pwa_app_theme_color', __('App Theme Color'), ['class' => 'form-label'])); ?>

                                                
                                                <?php echo e(Form::color('pwa_app_theme_color', !empty($pwa_data->theme_color) ? $pwa_data->theme_color : '', ['class' => 'form-control color-picker', 'placeholder' => __('18761234567')])); ?>

                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                                        </div>
                                    <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div> 
            <?php endif; ?>
        </div>
        <!-- [ sample-page ] end -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>

    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', "<?php echo e(__('Link copied')); ?>", 'success');
        }

        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);

            if ($('.enable_pwa_store').is(':checked')) {

                $('.pwa_is_enable').show();
            } else {

                $('.pwa_is_enable').hide();
            }

            $('#pwa_store').on('change', function() {
                if ($('.enable_pwa_store').is(':checked')) {

                    $('.pwa_is_enable').show();
                } else {

                    $('.pwa_is_enable').hide();
                }
            });
        });

        $(".color1").click(function() {
            var dataId = $(this).attr("data-id");
            $('#' + dataId).trigger('click');
            var first_check = $('#' + dataId).find('.color-0').trigger("click");
        });
    </script>

    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');

                $.post(url, {

                    _token: '<?php echo e(csrf_token()); ?>',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),
                }, function(data) {
                    $('#commonModal .modal-body').html(data);
                });
            }
        });

        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                    $('#commonModal').modal('hide');
                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>
    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element==true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/settings/index.blade.php ENDPATH**/ ?>