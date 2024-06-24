<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="stylesheet" href="../../public/css/list.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/footer.css">
    <link rel="icon" type="image/png" href="../images/icon.png">
    <title><?php echo $data['selected']?> Quiz</title>
</head>
<body>
    <?php $activePages = [$data['selected'], 'latest']; ?>
    <?php include 'line.php'; ?>
    <div class="container-fluid main up my-1 d-flex justify-content-between align-items-center">
        <div clsas="d-flex align-items-center">
            <h1 class="mt-0"><?php echo $activePages[0]; ?></h1>
        </div>
        <form class="d-flex form w-25">
            <input class="form-control me-2" name="search" type="search" placeholder="Search for quizzes" aria-label="Search">
            <select class="form-control me-2 w-50" name="level">
                <option value="">Level</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <!-- Page-specific content goes here -->
    <ul class="list-group">
        <?php foreach ($data['quizzes'] as $quiz): ?>
            <li class="list-group-item quiz-list-item">
                <a href="/Concursonaire/public/quiz/take/<?php echo $quiz['id']; ?>">
                    <?php echo htmlspecialchars($quiz['title']); ?>
                </a>
                <p class="quiz-description"><?php echo htmlspecialchars($quiz['description']); ?></p>
                <p>
                    <span>Subject: <?php echo htmlspecialchars($quiz['subject']); ?></span> 
                </p>
                <p>
                    <span>Level: <?php echo htmlspecialchars($quiz['level']); ?></span>
                </p>
                <p class="quiz-meta">
                    <span>Created at: <?php echo htmlspecialchars(date("F j, Y", strtotime($quiz['created_at']))); ?></span>
                    <span>Updated at: <?php echo htmlspecialchars(date("F j, Y", strtotime($quiz['updated_at']))); ?></span>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
