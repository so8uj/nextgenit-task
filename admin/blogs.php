<?php 

    require_once('header.php'); 
    require_once('core/db.php');
    $all_blogs_query = mysqli_query($db_connet,"SELECT * FROM `blogs` ORDER BY `id` DESC");
    
    function slug($str) { 
    
        $str = strtolower($str); 
        $str = str_replace(' ', '-', $str); 
        $str = trim($str, '-'); 
        return $str; 
    } 
    
?>


    <div class="main-content">
        <div class="container">
            <div class="row">

                <?php require_once('sidebar.php'); ?>

                <div class="col-lg-10">

                    <?php if(isset($_GET['blogUpdated'])){ ?> 
                        <div class="alert alert-success">Blog Updated!</div>
                    <?php } ?>
                    <?php if(isset($_GET['blogAdded'])){ ?> 
                        <div class="alert alert-success">Blog Added!</div>
                    <?php } ?>

                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Manage Blog</h2>
                        <a href="add_blog.php" class="btn btn-primary">Add Blogs</a>
                    </div>

                    <div class="blogs-conainer">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Cover Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Feature Images</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $i=1; while($all_blog = mysqli_fetch_assoc($all_blogs_query)) { ?> 
                                    <tr class="row<?= $all_blog['id']; ?>">
                                        
                                        <td><?= $i; ?></td>
                                        <td><img src="../uploads/<?= $all_blog['cover_image']; ?>" alt="Blog Image" width="100px" class="img-thumbnail"></td>
                                        <td>
                                            <?= mb_strimwidth($all_blog['title'], 0, 50, "..."); ?> 
                                            <p class="mb-0">Upload Date: <?= date('d M, Y',strtotime($all_blog['created_at'])) ?></p>
                                        </td>
                                        <td>
                                            <button onclick="load_modal(<?= $all_blog['id']; ?>)" class="btn btn-success btn-sm">Featured Images</button>
                                        </td>
                                        <td>
                                            <a href="../blog_detail.php?blog_name=<?= slug($all_blog['title']); ?>&blog_id=<?= $all_blog['id']; ?>" class="btn btn-sm btn-primary" target="_blank">View</a>
                                            <a href="edit_blog.php?id=<?= $all_blog['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a data-delete-id="<?= $all_blog['id']; ?>" data-cover-image="<?= $all_blog['cover_image']; ?>" class="btn btn-sm btn-danger delete_blog">Delete</a>
                                        </td>

                                    </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>

                </div>


                <!-- Modal -->
                <div class="modal fade" id="featuredImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Featured Images</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body modal_body">
                                
                            </div>
                        
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function load_modal(blog_id){
            $('.modal_body').load('core/featuredImages.php?blog_id='+blog_id);
            $('#featuredImageModal').modal('show'); 
        }

        $('.btn-close').click(function(){
            $('.modal_body').html('')
        });

        $(document).ready(function(){

            $(document).on('click','.submitFrom',function(e){
                e.preventDefault();
                $('#'+$(this).data('form-target')).submit();
            });


            $(document).on('submit','.featuredImageForm',function(e){
                e.preventDefault();
                var form = new FormData(this);
                if($(this).children('#feature_image').val() == ''){
                    alert('Please Select a Image for Fretured Image Update')
                }else{
                    $('.loadding-container').toggleClass('show-loader');
                    $.ajax({
                        type: "POST",
                        url: 'core/coreFeaturedImage.php',
                        data: form,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            $(this).children('#feature_image').val('');
                            var img_id = response.split('_');
                            $('#image'+img_id[0]).attr("src", "../uploads/"+img_id[1]);
                            $('.loadding-container').toggleClass('show-loader');
                        }
                    });
                }
            });

            $(document).on('submit','#addFeaturedImage',function(e){
                e.preventDefault();
                var form = new FormData(this);
                if($('#featured_images').val() == ''){
                    alert('Please Select a Image for Add Fretured Image')
                }else{
                    $('.loadding-container').toggleClass('show-loader');
                    $.ajax({
                        type: "POST",
                        url: 'core/coreFeaturedImage.php',
                        data: form,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            $('#featured_images').val('');
                            $('.dynamic-added-image').append(response);
                            $('.loadding-container').toggleClass('show-loader');
                        }
                    });
                }
            });

            $(document).on('click','.delete_image',function(){
                var img_id = $(this).data('img-delete');
                if(confirm('Are you want to delete the Image!')){
                    $('.loadding-container').toggleClass('show-loader');
                    $.ajax({
                        type: "POST",
                        url: 'core/coreFeaturedImage.php',
                        data: {img_id:img_id},
                        success: function(response){
                            $('#main'+response).remove();
                            $('.loadding-container').toggleClass('show-loader');
                        }
                    });
                }

            });


            $('.delete_blog').click(function(){
                var blog_id = $(this).data('delete-id');
                var cover_image = $(this).data('cover-image');
                if(confirm('Are you want to delete the Blog!')){
                    $('.loadding-container').toggleClass('show-loader');
                    $.ajax({
                        type: "POST",
                        url: 'core/deleteBlog.php',
                        data: {blog_id:blog_id,cover_image:cover_image},
                        success: function(response){
                            $('.row'+response).remove();
                            $('.loadding-container').toggleClass('show-loader');
                        }
                    });
                }
            });

        });
        
    </script>

<?php require_once('footer.php'); ?>