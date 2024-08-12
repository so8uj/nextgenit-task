<?php 
    session_start();
    if(isset($_SESSION['admin_data'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Jquery CDN -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
    </head>
    <body>
    

        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto mt-5">

                    <div class="alert-container"></div>

                    <div class="card mt-2">
                        
                        <div class="card-body">
                            
                            <h3>Admin Login</h3>

                            <form id="loginForm">

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" value="user@gmail.com" placeholder="user@gmail.com">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" id="password" value="1234">
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery CDN -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $('#loginForm').submit(function(e){
                    e.preventDefault();
                    var form = $(this);
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var required_err = 0;

                    if(email == '' || password == ''){
                        alert('Please fill all fields! All Fields are required');
                        required_err = 1;
                    }

                    if(required_err != 1){
                        $.ajax({
                            type: "POST",
                            url: 'core/loginCore.php',
                            data: form.serialize(),
                            success: function(response){
                                if(response != ''){
                                    $('.alert-container').html("<div class='alert alert-danger'>"+response+"</div>");
                                }else{
                                    $('.alert-container').html("<div class='alert alert-success'>Login Successfull</div>");
                                    window.location.href = 'index.php';
                                }
                            }
                        });
                    }

                });
            });
        </script>


</body>
</html>
