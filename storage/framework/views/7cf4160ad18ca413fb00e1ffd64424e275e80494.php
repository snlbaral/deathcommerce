<?php ($customer_avatar = \App\Models\Utility::get_file('uploads/customerprofile/')); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Store Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h5 d-inline-block text-white font-weight-bold mb-0 "><?php echo e(__('Store Customers')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Store Customers')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="<?php echo e(route('customer.export')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Export')); ?>"> 
    <i  data-feather="download"></i>
</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Customer Avatar')); ?></th>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Email')); ?></th>
                                    <th> <?php echo e(__('Phone No')); ?></th>
                                    <th class="text-right"> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td>
                                            <div class="media align-items-center">
                                                <div>
                                                    <a href="<?php echo e($customer_avatar); ?>/<?php echo e($customer->avatar); ?>" target="_blank">
                                                    <img alt="Image placeholder" src="<?php echo e($customer_avatar); ?>/<?php echo e($customer->avatar); ?>" class="rounded-circle">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($customer->name); ?></td>
                                        <td><?php echo e($customer->email); ?></td>
                                        <td><?php echo e($customer->phone_number); ?></td>
                                        <td class="Action">
                                            <div class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Customers')): ?>
                                                    <a href="<?php echo e(route('customer.show', $customer->id)); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-tooltip="View" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>" data-tooltip="View">
                                                        <i  class="ti ti-eye f-20"></i>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/customer/index.blade.php ENDPATH**/ ?>