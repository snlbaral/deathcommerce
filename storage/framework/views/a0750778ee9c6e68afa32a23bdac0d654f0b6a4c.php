<?php echo e(Form::open(array('url'=>'store-resource','method'=>'post'))); ?>

<div class="row">
   <!--  <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('store_enable',__('Store Display'),array('class'=>'form-label'))); ?>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" name="is_store_enabled" id="is_store_enabled">
                    <label class="custom-control-label form-control-label" for="is_store_enabled"></label>
                </div>
            </div>
        </div>
    <?php endif; ?> -->
   
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('store_name',__('Store Name'),array('class'=>'form-label'))); ?>


            <?php echo e(Form::text('store_name',null,array('class'=>'form-control','placeholder'=>__('Enter Store Name'),'required'=>'required'))); ?>

        </div>

        <?php
        $themeImg = \App\Models\Utility::get_file('uploads/store_theme/');
        ?>
        <?php if(\Auth::user()->type !== 'super admin'): ?>
            <div class="form-group">
                <?php echo e(Form::label('store_name',__('Store Theme'),array('class'=>'form-label'))); ?>

            </div>
            <div class="border border-primary rounded p-3">
                <div class="row gy-4 ">
                    <?php echo e(Form::hidden('themefile', null, ['id' => 'themefile1'])); ?>

                    <?php $__currentLoopData = \App\Models\Utility::themeOne(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="theme-card border-primary s_<?php echo e($key); ?>  <?php echo e($store_settings['theme_dir'] == $key ? 'selected' : ''); ?>">
                                <div class="theme-card-inner">
                                    <div class="theme-image border  rounded">
                                        <img src="<?php echo e(asset(Storage::url('uploads/store_theme/' . $key . '/Home.png'))); ?>"
                                            class="color img-center pro_max_width pro_max_height <?php echo e($key); ?>_img"
                                            data-id="<?php echo e($key); ?>">
                                    </div>
                                    <div class="theme-content mt-3">
                                        <p class="mb-0"><?php echo e(__('Select Sub-Color')); ?></p>
                                        <div class="d-flex mt-2 justify-content-between align-items-center <?php echo e($key == 'theme10' ? 'theme10box' : ''); ?>"
                                            id="radio_<?php echo e($key); ?>">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('email',__('Email'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::email('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('password',__('Password'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Password'),'required'=>'required'))); ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="form-group col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
    </div>
    <script>
        $('body').on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            $('#themefile1').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });
        $('body').ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile1').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);
        });
        $(".color").click(function() {
            var dataId = $(this).attr("data-id");
            $('#radio_' + dataId).trigger('click');
            var first_check = $('#radio_' + dataId).find('.color-0').trigger("click");
            $( ".theme-card" ).each(function() {
                $(".theme-card").removeClass('selected');     
            });
            $('.s_' +dataId ).addClass('selected');
        });
    </script>
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/admin_store/create.blade.php ENDPATH**/ ?>