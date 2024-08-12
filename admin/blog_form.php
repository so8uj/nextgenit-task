<div class="row">

    <div class="col-lg-8">

        <input type="hidden" name="user_id" value="<?= $admin_data['id'] ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Blog Title<span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="<?= $from_type == 'add' ? '' : $single_blog['title']; ?>" id="title">
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Blog Description<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" id="description" rows="5"><?= $from_type == 'add' ? '' :  $single_blog['description']; ?></textarea>
        </div>
    </div>

    <div class="col-lg-4">
        <?php if($from_type == 'update'){ ?> 
            <img src="../uploads/<?= $single_blog['cover_image']; ?>" alt="Blog Image" width="100%" class="img-thumbnail mb-3">
            <input type="hidden" name="blog_id" value="<?= $single_blog['id'] ?>">
            <input type="hidden" name="old_image" value="<?= $single_blog['cover_image'] ?>">
            
        <?php } ?>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Blog Cover Image<span class="text-danger">*</span></label>
            <input type="file" name="cover_image" class="form-control" id="cover_image">
        </div>
        <?php if($from_type == 'add'){ ?> 
        <div class="mb-3">
            <label for="featured_images" class="form-label">Blog Feature Images</label>
            <input type="file" name="featured_images[]" class="form-control" id="featured_images" multiple>
            <strong>You can add Multiple Featured Image</strong>
        </div>
        <?php } ?>
    </div>

    <div class="col-lg-12">
        <div class="d-grid">
            <button type="submit" class="btn <?= $from_type == 'add' ? 'btn-primary' : 'btn-warning'; ?>"><?= $from_type == 'add' ? 'Add' : 'Update'; ?> Blog</button>
        </div>
    </div>

</div>
