<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Language')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-400 mb-0">   <?php echo e(__('Language')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Language')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="pr-2">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Language')): ?>
        <a href="#" data-url="<?php echo e(route('create.language')); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>" class="btn btn-sm btn-icon  btn-primary me-2 text-white" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Create New Language')); ?>"><i  data-feather="plus"></i></a>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Language')): ?>
        <?php if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en')): ?>
            <a href="#!" class="bs-pass-para btn-sm bg-light-secondary btn-icon me-2"
                data-title="<?php echo e(__('Delete Lead')); ?>"
                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                data-confirm-yes="delete-form-<?php echo e($currantLang); ?>"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('Delete ')); ?>">
                <i class="ti ti-trash"></i>
            </a>
            <?php echo Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang],'id'=>'delete-form-'.$currantLang]); ?>

            <?php echo Form::close(); ?>


        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('manage.language',[$lang])); ?>" class="nav-link text-sm font-weight-bold <?php if($currantLang == $lang): ?> active <?php endif; ?>">
                                <i class="d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block"><?php echo e(Str::upper($lang)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="p-3 card">
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-user-tab-1" data-bs-toggle="pill"
                        data-bs-target="#home" type="button"><?php echo e(__('Labels')); ?></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-user-tab-2" data-bs-toggle="pill"
                        data-bs-target="#profile" type="button"><?php echo e(__('Messages')); ?></button>
                </li>

            </ul>
        </div>


        <div class="col-xl-12 col-md-12">
            <div class="card card-fluid">
                <div class="card-body" style="position: relative;">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="lang1" role="tabpanel" aria-labelledby="home-tab4">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="post" action="<?php echo e(route('store.language.data',[$currantLang])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <?php $__currentLoopData = $arrLabel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="example3cols1Input"><?php echo e($label); ?> </label>
                                                        <input type="text" class="form-control" name="label[<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <div class="d-flex justify-content-end">
                                                            <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-xs btn-primary'))); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form method="post" action="<?php echo e(route('store.language.data',[$currantLang])); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <?php $__currentLoopData = $arrMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileName => $fileValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-lg-12">
                                                    <h5><?php echo e(ucfirst($fileName)); ?></h5>
                                                </div>
                                                <?php $__currentLoopData = $fileValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_array($value)): ?>
                                                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(is_array($value2)): ?>
                                                                <?php $__currentLoopData = $value2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_array($value3)): ?>
                                                                        <?php $__currentLoopData = $value3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(is_array($value4)): ?>
                                                                                <?php $__currentLoopData = $value4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label5 => $value5): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label class="form-label"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?>.<?php echo e($label5); ?></label>
                                                                                            <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>][<?php echo e($label5); ?>]" value="<?php echo e($value5); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php else: ?>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?></label>
                                                                                        <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>]" value="<?php echo e($value4); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?></label>
                                                                                <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>]" value="<?php echo e($value3); ?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label"><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?></label>
                                                                        <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>]" value="<?php echo e($value2); ?>">
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label"><?php echo e($fileName); ?>.<?php echo e($label); ?></label>
                                                                <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <div class="d-flex justify-content-end">
                                                        <?php echo e(Form::submit(__('Save Changes'),array('class'=>'btn btn-xs btn-primary'))); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/lang/index.blade.php ENDPATH**/ ?>