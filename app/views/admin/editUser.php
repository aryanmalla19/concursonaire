<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Concursonaire/public/css/admin.css"> 
    <title>Edit Admin</title>
</head>
<body>
    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="non-sidebar mt-5 container">
            <form class="form-edit m-auto" method="POST">
                <h2 class="mb-4">Edit Users</h2>
                <?php
                $adminData = $data;
                ?>
                <div class="mb-2">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($adminData['name']); ?>" required>
                </div>
                <div class="mb-2">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($adminData['role']); ?>" required>
                </div>
                <div class="two d-flex justify-content-between">
                    <div class="mb-2 w-25">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($adminData['age']); ?>" required>
                    </div>
                    <div class="mb-2 w-50">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($adminData['phone_num']); ?>" required>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($adminData['username']); ?>" required>
                </div>
                
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($adminData['email']); ?>" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="email" name="password" required>
                </div>

                <!-- Password field can be left blank or not shown for security reasons when editing -->
                <button type="submit" name="editSubmit" class="btn btn-primary">Submit</button>
                <div class="mb-2 form-check">
                    <input type="hidden" name="role" value="admin">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
