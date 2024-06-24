<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/login.css"> 
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="icon" type="image/png" href="../images/icon.png">

    <title>Login</title>
</head>
<body class="overflow-hidden">

<?php if (isset($data['success'])): ?>
    <div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
        <strong><?php echo htmlspecialchars($data['success']); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php elseif (isset($data['error'])): ?>
    <div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
        <strong><?php echo htmlspecialchars($data['error']); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div id="main" class="">
    <div class="image-login">
        <img class="img" src="../../public/images/1.png" alt="">
        <h4 class="text-center">Quiz Mastery Hub</h4>
        <p class="text-center">Unleash your IQ with Concursonaire's excellent platform</p>
    </div>
    <div class="login-box">
        <h2 class='text-center font-main'>
            <img style="height:60px;position:relative;top:-3px;right:-4px" src="/Concursonaire/public/images/logo.png" alt="Concursonaire logo">oncursonaire
        </h2><br>
        <h4 class='font-main'>Welcome back, Please login </h4><br>
        <form action="../auth/login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="/Concursonaire/public/auth/forgotPassword" class="forget">Forgot Password?</a>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
        <p class="text-center">
            Don't have an account? <a class="green text-center" href="/Concursonaire/public/auth/signup">Create an Account</a>
        </p>
    </div>
</div>
</body>
</html>
