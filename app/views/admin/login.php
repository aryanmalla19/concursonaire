<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Concursonaire/public/css/admin.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/style.css"> 
    <title>Admin - Login</title>
    <style>
        body{
    background-color: #fafafa;
}
    </style>
</head>
<body>
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?php echo htmlspecialchars($data['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container admin-form w-100 d-flex justify-content-between align-items-center">
        <form method="POST" class="m-auto ">
            <h3 class="mb-3 text-white text-center font-main"><img src="/Concursonaire/public/images/logo_white.png" style="height:50px" alt="">oncursonaire</h3>
            <div class="w-100 border-top-0 border border-light bg-white">
            </div>
            <h3 class="my-3 text-white text-center">Admin Panel</h3>
            <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label text-white">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
