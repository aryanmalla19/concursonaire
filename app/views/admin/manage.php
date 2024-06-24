<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css"> 
    <title>Dashboard</title>
</head>
<body>
    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="non-sidebar mt-4 container">
        
<div class="container">
    <h1 class="mb-4">View Quizzes</h1>
    <ul class="list-group">
        <?php foreach ($data['quizzes'] as $quiz): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?php echo $quiz['title']; ?></h5>
                    <h6><?php echo $quiz['subject']; ?></h6>
                    <small>Level <?php echo $quiz['level']; ?></small>
                </div>
                <div class="btn-flex">
                    
                    <!-- View Quiz Result Link -->
                    <a href="/Concursonaire/public/quiz/viewcomment/<?php echo $quiz['id']; ?>" class="btn btn-danger text-white btn-sm mr-2">View Comments</a>
                    <a href="/Concursonaire/public/quiz/viewresult/<?php echo $quiz['id']; ?>" class="btn btn-secondary text-white btn-sm mr-2">View Results</a>
                    <a href="/Concursonaire/public/quiz/viewreview/<?php echo $quiz['id']; ?>" class="btn btn-primary text-white btn-sm mr-2">View Reviews</a>
                    <!-- Edit Quiz Link -->
<a href="/Concursonaire/public/quiz/edit/<?php echo $quiz['id']; ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                    <!-- Delete Quiz Form -->
                    <form action="/Concursonaire/public/quiz/delete/<?php echo $quiz['id']; ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                    </form>


                </div>
                
            </li>
        <?php endforeach; ?>
    </ul>
</div>

        </div>
    </div>
</body>
</html>

