<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('product.index')); ?>"><?php echo e(__('Product')); ?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Create')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2">
        <a href="<?php echo e(route('product.index')); ?>" class="btn btn-light-secondary me-3"> <i data-feather="x-circle"
                class="me-2"></i><?php echo e(__('Cancel')); ?></a>
        <a type="submit" id="submit-all" class="btn btn-primary"> <i data-feather="check-circle"
                class="me-2"></i><?php echo e(__('Save')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/tinymce/tinymce.min.js')); ?>"></script>
    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: 'textarea.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        var Dropzones = function() {
            var e = $('[data-toggle="dropzone1"]'),
                t = $(".dz-preview");
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            e.length && (Dropzone.autoDiscover = !1, e.each(function() {
                var e, a, n, o, i;
                e = $(this), a = void 0 !== e.data("dropzone-multiple"), n = e.find(t), o = void 0, i = {
                    url: "<?php echo e(route('product.store')); ?>",
                    headers: {
                        'x-csrf-token': CSRF_TOKEN,
                    },
                    thumbnailWidth: null,
                    thumbnailHeight: null,
                    previewsContainer: n.get(0),
                    previewTemplate: n.html(),
                    maxFiles: 10,
                    parallelUploads: 10,
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    acceptedFiles: a ? null : "image/*",
                    success: function(file, response) {
                        if (response.flag == "success") {
                            show_toastr('success', response.msg, 'success');
                            window.location.href = "<?php echo e(route('product.index')); ?>";
                        } else {
                            show_toastr('Error', response.msg, 'error');
                        }
                    },
                    error: function(file, response) {
                        // Dropzones.removeFile(file);
                        if (response.error) {
                            show_toastr('Error', response.error, 'error');
                        } else {
                            show_toastr('Error', response, 'error');
                        }
                    },
                    init: function() {
                        var myDropzone = this;

                        this.on("addedfile", function(e) {
                            !a && o && this.removeFile(o), o = e
                        })
                    }
                }, n.html(""), e.dropzone(i)
            }))
        }()

        $('#submit-all').on('click', function() {
            $('#submit-all').attr('disabled', true);
            var fd = new FormData();
            var file = document.getElementById('is_cover_image').files[0];
            var downloadable_prodcutfile = document.getElementById('downloadable_prodcut').files[0];
            if (file) {
                fd.append('is_cover_image', file);
            }
            if (downloadable_prodcutfile) {
                fd.append('downloadable_prodcut', downloadable_prodcutfile);
            }

            var files = $('[data-toggle="dropzone1"]').get(0).dropzone.getAcceptedFiles();
            $.each(files, function(key, file) {
                fd.append('multiple_files[' + key + ']', $('[data-toggle="dropzone1"]')[0].dropzone
                    .getAcceptedFiles()[key]); // attach dropzone image element
            });
            $('#description').val(tinyMCE.get("description").getContent())
            $('#specification').val(tinyMCE.get("specification").getContent())
            $('#detail').val(tinyMCE.get("detail").getContent())
            var other_data = $('#frmTarget').serializeArray();
            $.each(other_data, function(key, input) {
                fd.append(input.name, input.value);
            });
            $.ajax({
                url: "<?php echo e(route('product.store')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: fd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    if (data.flag == "success") {
                        $('#submit-all').attr('disabled', true);
                        show_toastr('success', data.msg, 'success');
                        window.location.href = "<?php echo e(route('product.index')); ?>";
                    } else {
                        show_toastr('Error', data.msg, 'error');
                        $('#submit-all').attr('disabled', false);
                    }
                },
                error: function(data) {
                    $('#submit-all').attr('disabled', false);
                    // Dropzones.removeFile(file);
                    if (data.error) {
                        show_toastr('Error', data.error, 'error');
                    } else {
                        show_toastr('Error', data, 'error');
                    }
                },
            });
        });

        $(document).on('click', '.get-variants', function(e) {

            $("#commonModal .modal-title").html('<?php echo e(__('Add Variants')); ?>');
            $("#commonModal .modal-dialog").addClass('modal-md');
            $("#commonModal").modal('show');

            $.get('<?php echo e(route('product.variants.create')); ?>', {}, function(data) {
                $('#commonModal .modal-body').html(data);
            });
        });

        $(document).on('click', '.add-variants', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            var variantNameEle = $('#variant_name');
            var variantOptionsEle = $('#variant_options');
            var isValid = true;

            if (variantNameEle.val() == '') {
                variantNameEle.focus();
                isValid = false;
            } else if (variantOptionsEle.val() == '') {
                variantOptionsEle.focus();
                isValid = false;
            }

            if (isValid) {
                $.ajax({
                    url: form.attr('action'),
                    datType: 'json',
                    data: {
                        variant_name: variantNameEle.val(),
                        variant_options: variantOptionsEle.val(),
                        hiddenVariantOptions: $('#hiddenVariantOptions').val()
                    },
                    success: function(data) {
                        $('#hiddenVariantOptions').val(data.hiddenVariantOptions);
                        $('.variant-table').html(data.varitantHTML);
                        $("#commonModal").modal('hide');
                    }
                })
            }
        });

        $('#cost').trigger('keyup');

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <?php echo e(Form::open(['method' => 'POST', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data'])); ?>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class=" col-lg-6 col-md-6">
                            <h5><?php echo e(__('Main Informations')); ?></h5>
                            <div class="card shadow-none border border-primary">
                                <div class="card-body ">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('product_categorie', __('Product Categories'), ['class' => 'form-label'])); ?>

                                        <?php echo Form::select('product_categorie[]', $product_categorie, null, [
                                            'class' => 'form-control multi-select',
                                            'id' => 'choices-multiple',
                                            'multiple',
                                        ]); ?>

                                        <?php if(count($product_categorie) == 0): ?>
                                            <?php echo e(__('Add product category')); ?>

                                            <a href="<?php echo e(route('product_categorie.index')); ?>">
                                                <?php echo e(__('Click here')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('SKU', __('SKU'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('SKU', null, ['class' => 'form-control', 'placeholder' => __('Enter SKU')])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('product_tax', __('Product Tax'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::select('product_tax[]', $product_tax, null, ['class' => 'form-control multi-select', 'id' => 'choices-multiple1', 'multiple'])); ?>

                                        <?php if(count($product_tax) == 0): ?>
                                            <?php echo e(__('Add product tax')); ?>

                                            <a href="<?php echo e(route('product_tax.index')); ?>">
                                                <?php echo e(__('Click here')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group proprice">
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::number('price', null, ['step' => 'any', 'class' => 'form-control'])); ?>

                                            </div>
                                            <div class="col-md-6">
                                                <?php echo e(Form::label('last_price', __('Last Price'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::number('last_price', null, ['step' => 'any', 'class' => 'form-control'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group proprice">
                                        <?php echo e(Form::label('quantity', __('Stock Quantity'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => __('Enter Stock Quantity'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <label for="attachment" class="form-label"
                                            onchange="loadImg()"><?php echo e(__('Attachment')); ?></label>
                                        <input type="file" name="attachment" id="attachment" class="form-control"
                                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                        <img id="blah" src="" width="20%" class="mt-2" />
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="downloadable_prodcut"
                                            class="form-label"><?php echo e(__('Downloadable Product')); ?></label>
                                        <input type="file" name="downloadable_prodcut" id="downloadable_prodcut"
                                            class="form-control"
                                            onchange="document.getElementById('down_product').src = window.URL.createObjectURL(this.files[0])">
                                        <img id="down_product" src="" width="20%" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-6 col-md-6">
                            <h5><?php echo e(__('Custom Field')); ?></h5>
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_field_1', __('Custom Field'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_field_1', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_value_1', __('Custom Value'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_value_1', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_field_2', __('Custom Field'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_field_2', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_value_2', __('Custom Value'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_value_2', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_field_3', __('Custom Field'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_field_3', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_value_3', __('Custom Value'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_value_3', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_field_4', __('Custom Field'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_field_4', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Field'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('custom_value_4', __('Custom Value'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('custom_value_4', null, ['class' => 'form-control', 'placeholder' => __('Enter Custom Value'), 'required' => 'required'])); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="card shadow-none border">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="form-group mb-0">
                                                <div class="row gy-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-check form-switch custom-switch-v1">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="enable_product_variant" id="enable_product_variant">
                                                            <label class="form-check-label"
                                                                for="enable_product_variant"><?php echo e(__('Display Variants')); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-check form-switch custom-switch-v1">
                                                            <input type="checkbox" name="product_display" class="form-check-input"
                                                                id="product_display">
                                                            <?php echo e(Form::label('product_display', __('Product Display'), ['class' => 'form-check-label'])); ?>

                                                        </div>
                                                        <?php $__errorArgs = ['product_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-product_display" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
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
                            </div>
                        </div>
                        <div id="productVariant" class="col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card shadow-none border my-3">
                                        <div class="card-header">
                                            <div class="row flex-grow-1">
                                                <div class="col-md d-flex align-items-center">
                                                    <h5 class="card-header-title">
                                                        <?php echo e(__('Product Variants')); ?>

                                                    </h5>
                                                </div>
                                                <div class="col-md-auto">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Variants')): ?>
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary get-variants"><i
                                                                class="fas fa-plus"></i>
                                                            <?php echo e(__('Add Variant')); ?></button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" id="hiddenVariantOptions"
                                                name="hiddenVariantOptions" value="{}">
                                            <div class="variant-table">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <h5><?php echo e(__('Product Image')); ?></h5>
                    <div class="card shadow-none border">
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo e(Form::label('sub_images', __('Upload Product Images'), ['class' => 'form-label'])); ?>

                                <div class="dropzone dropzone-multiple" data-toggle="dropzone1"
                                    data-dropzone-url="http://" data-dropzone-multiple>
                                    <div class="fallback">
                                        <div class="custom-file">
                                            
                                            <input type="file" name="file" id="dropzone-1"
                                                class="fcustom-file-input"
                                                onchange="document.getElementById('dropzone').src = window.URL.createObjectURL(this.files[0])"
                                                multiple>
                                            <img id="dropzone"src="" width="20%" class="mt-2" />
                                            <label class="custom-file-label"
                                                for="customFileUpload"><?php echo e(__('Choose file')); ?></label>
                                        </div>
                                    </div>
                                    <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img class="rounded" src="" alt="Image placeholder"
                                                            data-dz-thumbnail>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h6 class="text-sm mb-1" data-dz-name>...</h6>
                                                    <p class="small text-muted mb-0" data-dz-size>
                                                    </p>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#" class="dropdown-item" data-dz-remove>
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_cover_image" class="col-form-label"><?php echo e(__('Upload Cover Image')); ?></label>
                                <input type="file" name="is_cover_image" id="is_cover_image" class="form-control custom-input-file" onchange="document.getElementById('upcoverImg').src = window.URL.createObjectURL(this.files[0]);" multiple>
                                <img id="upcoverImg" src="" width="20%" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <h5><?php echo e(__('About product')); ?></h5>
                    <div class="card shadow-none border">
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo e(Form::label('description', __('Product Description'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::textarea('description', null, ['class' => 'form-control pc-tinymce-2','rows' => 1,'placeholder' => __('Product Description'),'id'=>'description'])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('specification', __('Product Specification'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::textarea('specification', null, ['class' => 'form-control pc-tinymce-2','rows' => 1,'placeholder' => __('Product Specification'),'id'=>'specification'])); ?>

                            </div>
                            <div class="form-group">
                                <?php echo e(Form::label('detail', __('Product Details'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::textarea('detail', null, ['class' => 'form-control pc-tinymce-2','rows' => 1,'placeholder' => __('Product Details'),'id'=>'detail'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product/create.blade.php ENDPATH**/ ?>