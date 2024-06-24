<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Concursonaire/public/css/admin.css"> 
<link rel="icon" type="image/png" href="../images/icon.png">
    
    <title>Dashboard</title>
</head>
<body>
    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="non-sidebar mt-5 container">
            <form class="form-add m-auto" method="POST">
                <h2 class="mb-4">Add New Admin</h2>
    <div class="mb-2">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="two d-flex justify-content-between">
        <div class="mb-2 w-25">
            <label for="age" class="form-label">Age</label>
            <input type="text" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-2 w-50">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
    </div>
    <div class="mb-2">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-2">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <div class="mb-2 form-check">
        <input type="hidden" name="role" value="admin">
    </div>
</form>

        </div>
    </div>
</body>
</html>
