<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/login.css"> 
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <title>Forgot Password</title>
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
        <h2 class='text-center font-main'>Forgot Password</h2><br>
        <form action="/Concursonaire/public/auth/verifyReset" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pet_name" class="form-label">Favorite Pet Name</label>
                <input type="text" class="form-control" id="pet_name" name="pet_name" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <button class="btn btn-primary" type="submit">Verify</button>
        </form>
    </div>
</div>
</body>
</html>
