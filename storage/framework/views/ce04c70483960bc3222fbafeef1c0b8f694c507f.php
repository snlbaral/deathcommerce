    
    <?php $__env->startSection('page-title'); ?>
        <?php echo e(__('Orders')); ?>

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('title'); ?>
        <div class="d-inline-block">
            <h5 class="h4 d-inline-block text-white font-weight-bold mb-0"><?php echo e(__('Orders')); ?></h5>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('breadcrumb'); ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Orders')); ?></li>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('action-btn'); ?>
        <a class="btn btn-sm btn-icon  bg-light-secondary me-2" href="<?php echo e(route('order.export')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Export')); ?>"> 
            <i  data-feather="download"></i>
        </a>
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
                                        <th scope="col"><?php echo e(__('Orders')); ?></th>
                                        <th scope="col" class="sort"><?php echo e(__('Date')); ?></th>
                                        <th scope="col" class="sort"><?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort"><?php echo e(__('Value')); ?></th>
                                        <th scope="col" class="sort text-end"><?php echo e(__('Payment Type')); ?></th>
                                        <th scope="col" class="sort text-end"><?php echo e(__('Reciept')); ?></th>
                                        <th scope="col" class="sort text-center"><?php echo e(__('Status')); ?></th>
                                        <th scope="col" class="text-center"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row">
                                                <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>"
                                                class="btn btn-sm btn-white btn-icon btn-outline-primary order2_badge" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Details')); ?>"
                                                data-toggle="tooltip">
                                                    <span class="btn-inner--text"><?php echo e($order->order_id[0] == '#' ?  $order->order_id : '#' .$order->order_id); ?></span>
                                                </a>
                                            </th>
                                            <td class="order">
                                                <span
                                                    class="h6 text-sm font-weight-bold mb-0"><?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?></span>
                                            </td>
                                            <td>
                                                <span class="client"><?php echo e($order->name); ?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="value text-sm mb-0"><?php echo e(\App\Models\Utility::priceFormat($order->price)); ?></span>
                                            </td>
                                            <td class="text-end">
                                                <span class="taxes text-sm mb-0"><?php echo e($order->payment_type); ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php if($order->payment_type == 'Bank Transfer'): ?>
                                                    <a href="<?php echo e(asset(Storage::url($order->receipt))); ?>" title="Invoice"
                                                        download>
                                                        <i class="fas fa-file-invoice"></i>
                                                    </a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex row justify-content-center">
                                                    <div class="col-auto">
                                                        <?php if($order->status != 'Cancel Order'): ?>
                                                        <button type="button"
                                                            class="btn btn-sm <?php echo e($order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success'); ?> btn-icon rounded-pill">
                                                            <span class="btn-inner--icon">
                                                                <?php if($order->status == 'pending'): ?>
                                                                    <i class="fas fa-check soft-success"></i>
                                                                <?php else: ?>
                                                                    <i class="fa fa-check-double soft-success"></i>
                                                                <?php endif; ?>
                                                            </span>
                                                            <?php if($order->status == 'pending'): ?>
                                                                <span class="btn-inner--text">
                                                                    <?php echo e(__('Pending')); ?>:
                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                                </span>
                                                            <?php else: ?>
                                                                <span class="btn-inner--text">
                                                                    <?php echo e(__('Delivered')); ?>:
                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->updated_at)); ?>

                                                                </span>
                                                            <?php endif; ?>
                                                        </button>
                                                        <?php else: ?>
                                                            <button type="button"
                                                                class="btn btn-sm btn-soft-danger btn-icon rounded-pill">
                                                                <span class="btn-inner--icon">
                                                                    <?php if($order->status == 'pending'): ?>
                                                                        <i class="fas fa-check soft-success"></i>
                                                                    <?php else: ?>
                                                                        <i class="fa fa-check-double soft-success"></i>
                                                                    <?php endif; ?>
                                                                </span>
                                                                <span class="btn-inner--text">
                                                                    <?php echo e(__('Cancel Order')); ?>:
                                                                    <?php echo e(\App\Models\Utility::dateFormat($order->created_at)); ?>

                                                                </span>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>


                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Orders')): ?>
                                                        <a href="<?php echo e(route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id))); ?>" class="btn btn-sm btn-icon  bg-light-secondary me-2" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('View')); ?>" data-tooltip="View">
                                                            <i  class="ti ti-eye f-20"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Orders')): ?>
                                                        <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                                            data-title="<?php echo e(__('Delete Lead')); ?>"
                                                            data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                            data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                            data-confirm-yes="delete-form-<?php echo e($order->id); ?>"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="<?php echo e(__('Delete')); ?>">
                                                            <i class="ti ti-trash f-20"></i>
                                                        </a>
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id], 'id' => 'delete-form-' . $order->id]); ?>

                                                        <?php echo Form::close(); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/orders/index.blade.php ENDPATH**/ ?>