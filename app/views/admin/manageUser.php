<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Concursonaire/public/css/admin.css"> 
    <title>Manage Admin</title>
</head>
<body>
    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="non-sidebar mt-5 container">
            <div class="mb-3 w-100 d-flex justify-content-end">
                <form method="get" class="d-flex align-self-end">
                    <input type="text" class="form-control me-2" name="search" placeholder="Search by Username">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>

            <?php if (isset($data['results']) && count($data['results']) > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Age</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['results'] as $result): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($result['name']); ?></td>
                                <td><?php echo htmlspecialchars($result['username']); ?></td>
                                <td><?php echo htmlspecialchars($result['role']); ?></td>
                                <td><?php echo htmlspecialchars($result['email']); ?></td>
                                <td><?php echo htmlspecialchars($result['age']); ?></td>
                                <td><?php echo htmlspecialchars($result['phone_num']); ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                                        <button type="submit" class="btn btn-primary" name="edit">EDIT</button>
                                        <button type="submit" class="btn btn-danger" name="delete">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
