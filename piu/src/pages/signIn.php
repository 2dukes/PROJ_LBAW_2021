<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Auth - https://developers.google.com/identity/sign-in/web/sign-in -->
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    
    <link href="signIn.css" rel="stylesheet">
    <link href="../components/inputIcon.css" rel="stylesheet">
    <link href="../components/footer.css" rel="stylesheet">
    <title>Sign In</title>
</head>
<body>
    <div class="container mb-2">
        <div class="row mt-5">
            <div class="col-xl-6 signIn-img">
                <div class="d-grid gap-2 col-6 mx-auto mt-5 signIn-left-text w-100 text-center">
                    <div class="welcome-msg">
                        <h1><strong>Welcome Back,</strong></h1>
                        <h3>Sign in to continue</h3>
                        <button type="button" class="btn btn-dark w-100 mx-auto mt-4">Go Home</button>     
                    </div>
                </div>
            </div>
            <div class="col-xl-6 signIn-form mt-3">
                <h1>Sign In</h1>
                <h3>Please enter your account details.</h3>
                
                <?php
                    include_once "../components/inputIcon.php";
                    echo "<span class='d-block mt-4'>Email Address</span>";
                    inputIconLeft('envelope'); 
                    echo "<span class='d-block mt-4'>Password</span>";
                    inputIconLeft('lock'); 
                ?>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="button" class="btn btn-dark d-block">Sign In</button>     
                </div>
                <span class="d-block text-center mt-3">Don't have an account? &nbsp;<a href="#" class="signUp-a">Sign Up</a></span>
                <div class="separator mt-3">or</div>
                
                <div class="g-signin2" data-width="200"></div>                

            </div>
        </div>
    </div>
    <?php include_once "../components/footer.php"; ?>
</body>