<?php require_once('header.php'); ?>


    <div class="main-content mb-5">
        <div class="container">
            <div class="row">

                <?php require_once('sidebar.php'); ?>

                <div class="col-lg-10">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Add Blog</h2>
                        <a href="blogs.php" class="btn btn-primary">Manage Blogs</a>
                    </div>

                    <div class="alert-container"></div>
                    
                    <div class="blog-form-conainer mt-3">
                        <form id="addFrom" enctype="multipart/form-data">
                            <?php $from_type='add'; include 'blog_form.php'; ?>
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
                var title = $("#title").val();
                var description = $("#description").val();
                var cover_image = $("#cover_image").val();
                var required_err = 0;
                if(title == '' || description == '' || cover_image == ''){
                    alert('Please fill all fields! All Fields are required');
                    required_err = 1;
                }
                if(required_err != 1){
                    $('.loadding-container').toggleClass('show-loader');
                    $.ajax({
                        type: "POST",
                        url: 'core/addBlog.php',
                        data: form,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            // console.log(response);
                            if(response != ''){
                                $('.alert-container').html("<div class='alert alert-danger'>"+response+"</div>");
                                $('.loadding-container').toggleClass('show-loader');
                            }else{
                                window.location.href = 'blogs.php?blogAdded=success';
                            }
                        }
                    });
                }
            });

        });
    </script>

<?php require_once('footer.php'); ?>