<?php $__env->startSection('page-title'); ?>
        <?php echo e(__('Manage Themes')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-bold mb-0 text-white"><?php echo e(__('Manage Themes')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Themes')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="tab-pane" id="pills-theme_setting" role="tabpanel" aria-labelledby="pills-theme_setting">
        <?php echo e(Form::open(['route' => ['store.changetheme', $store_settings->id], 'method' => 'POST'])); ?>

        <div class="d-flex mb-3 align-items-center justify-content-between">
            <h3><?php echo e(__('Themes')); ?></h3>
            <?php echo e(Form::hidden('themefile', null, ['id' => 'themefile'])); ?>

            <button type="submit" class="btn  btn-primary"> <i data-feather="check-circle"
                    class="me-2"></i><?php echo e(__('Save Changes')); ?></button>

        </div>
        <?php
            $themeImg = \App\Models\Utility::get_file('uploads/store_theme/');
        ?>
        <div class="border border-primary rounded p-3">
            <div class="row gy-4 ">
                <?php $__currentLoopData = \App\Models\Utility::themeOne(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="theme-card border-primary <?php echo e($key); ?> <?php echo e($store_settings['theme_dir'] == $key ? 'selected' : ''); ?>">
                            <div class="theme-card-inner">
                                <div class="theme-image border  rounded">
                                    <img src="<?php echo e(asset(Storage::url('uploads/store_theme/' . $key . '/Home.png'))); ?>"
                                        class="color1 img-center pro_max_width pro_max_height <?php echo e($key); ?>_img"
                                        data-id="<?php echo e($key); ?>">
                                </div>
                                <div class="theme-content mt-3">
                                    <p class="mb-0"><?php echo e(__('Select Sub-Color')); ?></p>
                                    <div class="d-flex mt-2 justify-content-between align-items-center <?php echo e($key == 'theme10' ? 'theme10box' : ''); ?>"
                                        id="<?php echo e($key); ?>">
                                        <div class="color-inputs">
                                            <?php $__currentLoopData = $v; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $css => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="colorinput">
                                                    <input name="theme_color" id="color1-theme4" type="radio"
                                                        value="<?php echo e($css); ?>" data-theme="<?php echo e($key); ?>"
                                                        data-imgpath="<?php echo e($val['img_path']); ?>"
                                                        class="colorinput-input color-<?php echo e($loop->index++); ?>"
                                                        <?php echo e(isset($store_settings['store_theme']) && $store_settings['store_theme'] == $css && $store_settings['theme_dir'] == $key ? 'checked' : ''); ?>>
                                                    <span class="border-box">
                                                        <span class="colorinput-color"
                                                            style="background: #<?php echo e($val['color']); ?>"></span>
                                                    </span>
                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php if(isset($store_settings['theme_dir']) && $store_settings['theme_dir'] == $key): ?>
                                            <a href="<?php echo e(route('store.editproducts', [$store_settings->slug, $key])); ?>"
                                                class="btn btn-primary" id="button-addon2"> <i data-feather="edit"></i>
                                                <?php echo e(__('Edit')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            $('#themefile').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });
        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });
        $(".color1").click(function() {
            var dataId = $(this).attr("data-id");
            $('#' + dataId).trigger('click');
            var first_check = $('#' + dataId).find('.color-0').trigger("click");
            $( ".theme-card" ).each(function() {
                $(".theme-card").removeClass('selected');     
            });
           $('.' +dataId).addClass('selected');
           
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/themes/themes.blade.php ENDPATH**/ ?>