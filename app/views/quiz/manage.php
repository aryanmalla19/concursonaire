<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Quizzes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/dashboard.css"> 

</head>
<body>
    
<div class="d-flex main">
<?php include "../app/views/dashboard/sidebar.php"; ?>
<div class="container mt-5">
    <h1 class="mb-4 text-center font-main">Manage Quizzes</h1>
    <ul class="list-group">
        <?php foreach ($data['quizzes'] as $quiz): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?php echo $quiz['title']; ?></h5>
                    <small><?php echo $quiz['subject']; ?></small>
                </div>
                <div>
                    <!-- Edit Quiz Link -->
                    <a href="/Concursonaire/public/quiz/edit/<?php echo $quiz['id']; ?>" class="btn text-white btn-primary btn-sm mr-2">Edit</a>
                    <!-- Delete Quiz Form -->
                    <form action="/Concursonaire/public/quiz/delete/<?php echo $quiz['id']; ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/Concursonaire/public/quiz/create" class="btn text-white btn-success mt-4">Create a new Quiz</a>
</div>
        </div>
</body>
</html>
