<?php 

    require_once('header.php'); 

    require_once('core/db.php');
    $blog_id = $_GET['id'];
    $single_query = mysqli_query($db_connet,"SELECT * FROM `blogs` WHERE `id` = '$blog_id'");
    $single_blog = mysqli_fetch_assoc($single_query);


?>


    <div class="main-content mb-5">
        <div class="container">
            <div class="row">

                <?php require_once('sidebar.php'); ?>

                <div class="col-lg-10">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Edit Blog</h2>
                        <div>
                            <a href="add_blog.php" class="btn btn-primary">Add Blog</a>
                            <a href="blogs.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>

                    <div class="alert-container"></div>
                    
                    <div class="blog-form-conainer mt-3">
                        <form id="addFrom" enctype="multipart/form-data">
                            <?php $from_type='update'; include 'blog_form.php'; ?>
                        </form>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            

            $('#addFrom').submit(function(e){
                e.preventDefault();
                var form = new FormData(this);
                $('.loadding-container').toggleClass('show-loader');
                $.ajax({
                    type: "POST",
                    url: 'core/addEdit.php',
                    data: form,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != ''){
                            $('.alert-container').html("<div class='alert alert-danger'>"+response+"</div>");
                            $('.loadding-container').toggleClass('show-loader');
                        }else{
                            window.location.href = 'blogs.php?blogUpdated=success';
                        }
                    }
                });
            });

        });
    </script>

<?php require_once('footer.php'); ?>