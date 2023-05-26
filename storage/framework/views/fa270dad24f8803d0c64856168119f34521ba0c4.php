<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Custom Page')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-bold mb-0 "><?php echo e(__('Custom Page')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Custom Page')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Custom Page')): ?>
    <a class="btn btn-sm btn-icon  btn-primary me-2 text-white" data-url="<?php echo e(route('custom-page.create')); ?>" data-title="<?php echo e(__('Create New Page')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>">
        <i  data-feather="plus"></i>
    </a>
<?php endif; ?>
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
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Page Slug')); ?></th>
                                    <th><?php echo e(__('Header')); ?></th>
                                    <th class="text-right"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pageoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pageoption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-name="<?php echo e($pageoption->name); ?>">
                                        <td><?php echo e($pageoption->name); ?></td>
                                        <?php if($store && $store->enable_domain == 'on'): ?>
                                            <td>
                                                <?php echo e($store->domains . 'page/' . $pageoption->slug); ?>

                                            </td>
                                        <?php elseif($sub_store && $sub_store->enable_subdomain == 'on'): ?>
                                            <td>
                                                <?php echo e($sub_store->subdomain . 'page/' . $pageoption->slug); ?></td>
                                        <?php else: ?>
                                            <td>
                                                <?php echo e(env('APP_URL') . 'page/' . $pageoption->slug); ?>

                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php echo e(ucfirst($pageoption->enable_page_header == 'on' ? $pageoption->enable_page_header : 'Off')); ?>

                                        </td>
                                        <td class="Action">
                                            <div class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Custom Page')): ?>
                                                    <a class="btn btn-sm btn-icon  bg-light-secondary me-2" data-title="<?php echo e(__('Edit Page')); ?>" data-url="<?php echo e(route('custom-page.edit', $pageoption->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Edit')); ?>">
                                                        <i  class="ti ti-edit f-20"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Custom Page')): ?>
                                                    <a class="bs-pass-para btn btn-sm btn-icon bg-light-secondary" href="#"
                                                        data-title="<?php echo e(__('Delete Lead')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                        data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="delete-form-<?php echo e($pageoption->id); ?>"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash f-20"></i>
                                                    </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['custom-page.destroy', $pageoption->id], 'id' => 'delete-form-' . $pageoption->id]); ?>

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
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('keyup', '.search-user', function() {
                var value = $(this).val();
                $('.employee_tableese tbody>tr').each(function(index) {
                    var name = $(this).attr('data-name').toLowerCase();
                    if (name.includes(value.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    <script src="<?php echo e(asset('assets/js/plugins/tinymce/tinymce.min.js')); ?>"></script>
  
    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: '.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
   
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/pageoption/index.blade.php ENDPATH**/ ?>