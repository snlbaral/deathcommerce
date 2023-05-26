<?php echo e(Form::open(array('url'=>'product_categorie','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),array('class'=>'col-form-label'))); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Product Category'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <label for="categorie_img" class="col-form-label"><?php echo e(__('Upload Category Image')); ?></label>
            
            <input type="file" name="categorie_img" id="categorie_img" class="form-control" onchange="document.getElementById('catImg').src = window.URL.createObjectURL(this.files[0])" multiple>
            <img id="catImg" src="" width="20%" class="mt-2"/>
        </div>
    </div>
    <div class="form-group col-12 d-flex justify-content-end col-form-label">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home1/chacom32/deathcommerce.com/resources/views/product_category/create.blade.php ENDPATH**/ ?>