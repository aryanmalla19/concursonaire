<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="stylesheet" href="../../public/css/dashboard.css"> 
    <link rel="stylesheet" href="../../public/css/admin.css"> 
    <title>Dashboard</title>
</head>
<body>
    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="dashboard-main my-4">
            <h2 class="text-center">Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['name']); ?> !</h2>
            <p class="text-center">You are logged in as <?php echo htmlspecialchars($_SESSION['role']); ?>!</p>
            <div class="non-sidebar mt-5 container">
            <?php
            // Define an array of data to be displayed in each dashboard box
            $dashboardData = [
                ['title' => "Today's Attempt", 'value' => $data['today_attempt'], 'percentageChange' => 'Total attempts in all quizzes today', 'iconClass' => 'fa-solid fa-dollar-sign', 'backgroundColor' => '#ffcccb'],
                ['title' => "Today's Comment", 'value' => $data['comment_today'], 'percentageChange' => 'Total comments in all quizzes today', 'iconClass' => 'fa-solid fa-dollar-sign', 'backgroundColor' => '#b0e57c'],
                ['title' => "Today's Review", 'value' => $data['review_today'], 'percentageChange' => 'Total reviews in all quizzes today', 'iconClass' => 'fa-solid fa-dollar-sign', 'backgroundColor' => '#add8e6'],
            ];

            // Loop through the data and include the dashboardBox.php file with different values each time
            foreach ($dashboardData as $data) {
                $title = $data['title'];
                $value = $data['value'];
                $percentageChange = $data['percentageChange'];
                $iconClass = $data['iconClass'];
                $backgroundColor = $data['backgroundColor'];
                include "dashboardBox.php";
            }
            ?>
        </div>
        </div>
        
    </div>
    <script src="https://kit.fontawesome.com/e654d60097.js" crossorigin="anonymous"></script>
</body>
</html>
