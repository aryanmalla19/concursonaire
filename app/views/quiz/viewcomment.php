<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/style.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/dashboard.css"> 
    <title>Quiz Comment</title>
</head>
<body>
<div class="d-flex main">
    <?php include "../app/views/dashboard/sidebar.php"; ?>
    <div class="container">
        <h1 class="text-center my-3">Comments </h1>
        <?php if (isset($data['results']) && count($data['results']) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Student Name</th>
                        <th>Comment</th>
                        <th>Date Taken</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data['results'] as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['title']); ?></td>
                        <td><?php echo htmlspecialchars($result['name']); ?></td>
                        <td><?php echo htmlspecialchars($result['text']);?></td>
                        <td><?php echo htmlspecialchars($result['created_at']); ?></td>
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
