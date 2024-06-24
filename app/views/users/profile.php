<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="stylesheet" href="../../public/css/dashboard.css"> 
    <link rel="stylesheet" href="../../public/css/footer.css"> 
    <title><?php echo htmlspecialchars($data['username']); ?>'s Profile</title>
    <style>
        .profile-header {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .profile-header .fa-user {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            font-size: 150px;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info .info-item {
            margin-bottom: 10px;
        }
        .btn-edit, .btn-cancel, .btn-save {
            margin-top: 20px;
        }
    </style>
</head>
<body>
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

    <div class="container mb-5">
        <div class="profile-header">
            <i class="fa-solid fa-user"></i>
            <h2><?php echo htmlspecialchars($data['name']); ?></h2>
            <p>@<?php echo htmlspecialchars($data['username']); ?></p>
            <p><?php echo htmlspecialchars($data['role']); ?></p>
        </div>
        <div class="profile-info">
            <form id="profileForm" method="POST" style="display: none;">
                <div class="form-group info-item">
                    <label for="name"><strong>Name:</strong></label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($data['name']); ?>" required>
                </div>
                <div class="form-group info-item">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                </div>
                <div class="form-group info-item">
                    <label for="phone_num"><strong>Phone Number:</strong></label>
                    <input type="text" class="form-control" name="phone_num" id="phone_num" value="<?php echo htmlspecialchars($data['phone_num']); ?>" required>
                </div>
                <div class="form-group info-item">
                    <label for="age"><strong>Age:</strong></label>
                    <input type="number" class="form-control" name="age" id="age" value="<?php echo htmlspecialchars($data['age']); ?>" required>
                </div>
                <div class="form-group info-item">
                    <label for="password"><strong>Current Password:</strong></label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group info-item">
                    <label for="new_password"><strong>New Password:</strong></label>
                    <input type="password" class="form-control" name="new_password" id="new_password">
                </div>
                <div class="form-group info-item">
                    <label for="confirm_password"><strong>Confirm New Password:</strong></label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
                <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
            </form>
            <div id="profileDisplay">
                <div class="info-item">
                    <strong>Name:</strong> <span id="displayName"><?php echo htmlspecialchars($data['name']); ?></span>
                </div>
                <div class="info-item">
                    <strong>Email:</strong> <span id="displayEmail"><?php echo htmlspecialchars($data['email']); ?></span>
                </div>
                <div class="info-item">
                    <strong>Phone Number:</strong> <span id="displayPhone"><?php echo htmlspecialchars($data['phone_num']); ?></span>
                </div>
                <div class="info-item">
                    <strong>Age:</strong> <span id="displayAge"><?php echo htmlspecialchars($data['age']); ?></span>
                </div>
                <button type="button" class="btn btn-primary btn-edit">Edit Profile</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                $('#profileDisplay').hide();
                $('#profileForm').show();
            });
            $('.btn-cancel').on('click', function() {
                $('#profileForm').hide();
                $('#profileDisplay').show();
            });
        });
    </script>
</body>
</html>
