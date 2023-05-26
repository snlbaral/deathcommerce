<?php
// $profile = asset(Storage::url('uploads/profile/'));
$profile=\App\Models\Utility::get_file('uploads/profile/');
    $users = \Auth::user();
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-400 mb-0"> <?php echo e(__('Profile')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Profile')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#Personal_Info" id="Personal_Info_tab"
                                class="list-group-item list-group-item-action"><?php echo e(__('Personal Info')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#Change_Password" id="Change_Password_tab"
                                class="list-group-item list-group-item-action"><?php echo e(__('Change Password')); ?><div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                    <div class="active" id="Personal_Info">
                        <?php echo e(Form::model($userDetail,array('route' => array('update.account'), 'method' => 'put', 'enctype' => "multipart/form-data"))); ?>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Personal Info')); ?></h5>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class=" setting-card">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card-body pt-0 text-center">
                                                            <div class=" setting-card">
                                                                <h4><?php echo e(__('Picture')); ?></h4>
                                                                <div class="logo-content mt-4 d-flex justify-content-center">
                                                                    
                                                                        <img src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>" id="blah" width="100px" class="rounded-circle-avatar"/>
                                                                </div>
                                                                <div class="choose-files mt-4">
                                                                    <label for="file-1">
                                                                        <div class=" bg-primary profile_update" style="max-width: 100% !important;"> <i
                                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                        </div>
                                                                        <input type="file" class="form-control file" name="profile" id="file-1"
                                                                            data-filename="profile_update">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-lg-8 col-sm-6 col-md-6">
                                                        <div class="card-body pt-0">
                                                            <?php if(\Auth::user()->type=='client'): ?>
                                                            <?php $client=$userDetail->clientDetail; ?>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

                                                                    <?php echo e(Form::text('name',null,array('class'=>'form-control font-style'))); ?>

                                                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-name" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('email',__('Email'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

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

                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('mobile',__('Mobile'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::number('mobile',$client->mobile,array('class'=>'form-control'))); ?>

                                                                <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-mobile" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('address_1',__('Address 1'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::textarea('address_1', $client->address_1, ['class'=>'form-control','rows'=>'4'])); ?>

                                                                <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-address_1" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('address_2',__('Address 2'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::textarea('address_2', $client->address_2, ['class'=>'form-control','rows'=>'4'])); ?>

                                                                <?php $__errorArgs = ['address_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-address_2" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('city',__('City'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('city',$client->city,array('class'=>'form-control'))); ?>

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
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('state',__('State'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('state',$client->state,array('class'=>'form-control'))); ?>

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
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('country',__('Country'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('country',$client->country,array('class'=>'form-control'))); ?>

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
                                                            <div class="col-md-4">
                                                                <?php echo e(Form::label('zip_code',__('Zip Code'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('zip_code',$client->zip_code,array('class'=>'form-control'))); ?>

                                                                <?php $__errorArgs = ['zip_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-zip_code" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

                                                                    <?php echo e(Form::text('name',null,array('class'=>'form-control font-style'))); ?>

                                                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <span class="invalid-name" role="alert">
                                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                        </span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <?php echo e(Form::label('email',__('Email'),array('class'=>'col-form-label'))); ?>

                                                                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

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
                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-12 ">
                                            <div class="text-end">
                                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div class="" id="Change_Password">
                        <?php echo e(Form::model($userDetail,array('route' => array('update.password',$userDetail->id), 'method' => 'put'))); ?>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Change Password')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('current_password',__('Current Password'),array('class'=>'col-form-label'))); ?>

                                                    <?php echo e(Form::password('current_password',array('class'=>'form-control','placeholder'=>__('Enter Current Password')))); ?>

                                                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-current_password" role="alert">
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
                                                    <?php echo e(Form::label('new_password',__('New Password'),array('class'=>'col-form-label'))); ?>

                                                    <?php echo e(Form::password('new_password',array('class'=>'form-control','placeholder'=>__('Enter New Password')))); ?>

                                                    <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-new_password" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo e(Form::label('confirm_password',__('Re-type New Password'),array('class'=>'col-form-label'))); ?>

                                                <?php echo e(Form::password('confirm_password',array('class'=>'form-control','placeholder'=>__('Enter Re-type New Password')))); ?>

                                                <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-confirm_password" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-sm-12 ">
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
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.list-group-item', function() {
            $('.list-group-item').removeClass('active');
            $('.list-group-item').removeClass('text-primary');
            setTimeout(() => {
                $(this).addClass('active').removeClass('text-primary');
            }, 10);
        });

        var type = window.location.hash.substr(1);
        $('.list-group-item').removeClass('active');
        $('.list-group-item').removeClass('text-primary');
        if (type != '') {
            $('a[href="#' + type + '"]').addClass('active').removeClass('text-primary');
        } else {
            $('.list-group-item:eq(0)').addClass('active').removeClass('text-primary');
        }




        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/profile.blade.php ENDPATH**/ ?>