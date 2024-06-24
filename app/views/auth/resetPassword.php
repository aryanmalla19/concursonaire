<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/login.css"> 
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <title>Reset Password</title>
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
    <div class="login-box">
        <h2 class='text-center font-main'>Reset Password</h2><br>
        <form action="/Concursonaire/public/auth/resetPassword" method="POST">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button class="btn btn-primary" type="submit">Reset Password</button>
        </form>
    </div>
</div>
</body>
</html>
