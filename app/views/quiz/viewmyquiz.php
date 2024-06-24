<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View My Quizzes</title>
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="stylesheet" href="../../public/css/dashboard.css"> 
</head>
<body>
<div class="d-flex main">
<?php include "../app/views/dashboard/sidebar.php"; ?>
<div class="container mt-5">
    <h1 class="mb-4 font-main text-center">View Quizzes</h1>
    <ul class="list-group">
        <?php foreach ($data['quizzes'] as $quiz): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?php echo $quiz['title']; ?></h5>
                    <small><?php echo $quiz['subject']; ?></small>
                </div>
                <div>
                    <!-- View Quiz Result Link -->
                    <a href="/Concursonaire/public/quiz/viewcomment/<?php echo $quiz['id']; ?>" class="btn btn-danger text-white btn-sm mr-2">View Comments</a>
                    <a href="/Concursonaire/public/quiz/viewresult/<?php echo $quiz['id']; ?>" class="btn btn-secondary text-white btn-sm mr-2">View Results</a>
                    <a href="/Concursonaire/public/quiz/viewreview/<?php echo $quiz['id']; ?>" class="btn btn-primary text-white btn-sm mr-2">View Reviews</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
        </div>

</html>
