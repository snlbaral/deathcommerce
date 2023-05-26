<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Store')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-2"><?php echo e(__('Store')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Store')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2">
        <a href="<?php echo e(route('store.subDomain')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Sub Domain')); ?>"><?php echo e(__('Sub Domain')); ?></a>

        <a href="<?php echo e(route('store.customDomain')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Custom Domain')); ?>"><?php echo e(__('Custom Domain')); ?></a>

        <a href="<?php echo e(route('store.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
            data-bs-placement="top" title="<?php echo e(__('Grid View')); ?>"><i class="ti ti-grid-dots"></i></a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Store')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('store-resource.create')); ?>" data-ajax-popup="true"
                data-title="<?php echo e(__('Create New Store')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
                data-bs-placement="top" title="<?php echo e(__('Create')); ?>"><i class="ti ti-plus"></i></a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('User Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Stores')); ?></th>
                                    <th><?php echo e(__('Plan')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <th><?php echo e(__('Store Display')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($usr->name); ?></td>
                                        <td><?php echo e($usr->email); ?></td>
                                        <td><?php echo e($usr->stores->count()); ?></td>
                                        <td><?php echo e(!empty($usr->currentPlan->name) ? $usr->currentPlan->name : '-'); ?></td>
                                        <td><?php echo e(\App\Models\Utility::dateFormat($usr->created_at)); ?></td>
                                        <td>
                                            <div class="form-switch disabled-form-switch">
                                               
                                                    <a href="#" data-size="md"
                                                        data-url="<?php echo e(route('store-resource.edit.display', $usr->id)); ?>"
                                                        data-ajax-popup="true" class="action-item"
                                                        data-title="<?php echo e(__('Are You Sure?')); ?>" data-toggle="tooltip" title="Edit"
                                                        data-original-title="<?php echo e($usr->store_display == 1 ? 'Store disable' : 'Store enable'); ?>">
                                                        <input type="checkbox" class="form-check-input" disabled="disabled"
                                                            name="store_display" id="<?php echo e($usr->id); ?>"
                                                            <?php echo e($usr->store_display == 1 ? 'checked' : ''); ?>>
                                                        <label class="form-check-label" for="<?php echo e($usr->id); ?>"></label>
                                                    </a>
                                                
                                            </div>
                                        </td>
                                        <td class="Action">
                                            <div class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Store')): ?>
                                                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-url="<?php echo e(route('store-resource.edit', $usr->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Store')); ?>">
                                                        <i  class="ti ti-edit f-20"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Upgrade Plans')): ?>
                                                    <a data-url="<?php echo e(route('plan.upgrade', $usr->id)); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-tooltip="Edit" data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Upgrade Plan')); ?>" data-tooltip="View">
                                                        <i   class="ti ti-trophy f-20"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Store')): ?>
                                                    <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary me-2" href="#"
                                                        data-title="<?php echo e(__('Delete Lead')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($usr->id); ?>"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['store-resource.destroy', $usr->id], 'id' => 'delete-form-' . $usr->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Reset Password')): ?>
                                                    <a data-url="<?php echo e(route('user.reset', \Crypt::encrypt($usr->id))); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-tooltip="Edit" data-ajax-popup="true" data-title="<?php echo e(__('Reset Password')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Reset Password')); ?>" data-tooltip="View">
                                                        <i   class="fas fa-key f-20"></i>
                                                    </a>
                                                <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/admin_store/index.blade.php ENDPATH**/ ?>