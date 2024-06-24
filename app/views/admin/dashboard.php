<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css"> 
    <link rel="stylesheet" href="css/admin.css"> 
    <link rel="icon" type="image/png" href="../images/icon.png">

    <title>Dashboard</title>
</head>
<body>

    <div class="d-flex main">
        <?php include "sidebar.php"; ?>
        <div class="non-sidebar mt-5 container">
            <?php
            // Define an array of data to be displayed in each dashboard box
            $dashboardData = [
                ['title' => "Today's Users", 'value' => $data['todays_users'], 'percentageChange' => 'Total new users today', 'iconClass' => 'fa-solid fa-users', 'backgroundColor' => '#ffcccb'],
                ['title' => "New Registrations", 'value' => $data['new_registrations'], 'percentageChange' => 'Total new users this week', 'iconClass' => 'fa-solid fa-user-plus', 'backgroundColor' => '#b0e57c'],
                ['title' => "Today's Attempt", 'value' => $data['today_attempt'], 'percentageChange' => 'Total new attempt today', 'iconClass' => 'fa-solid fa-dollar-sign', 'backgroundColor' => '#add8e6'],
                ['title' => "Active Users", 'value' => $data['active_users'], 'percentageChange' => 'Active users this month', 'iconClass' => 'fa-solid fa-user-check', 'backgroundColor' => '#f0e68c'],
                ['title' => "Today's Comment", 'value' => $data['comment_today'], 'percentageChange' => 'Total new comments today', 'iconClass' => 'fa-solid fa-comment', 'backgroundColor' => '#ffa07a'],
                ['title' => "Today's Review", 'value' => $data['review_today'], 'percentageChange' => 'Total new reviews today', 'iconClass' => 'fa-solid fa-star', 'backgroundColor' => '#98fb98'],
                ['title' => "Today's Message", 'value' => $data['message_today'], 'percentageChange' => 'Total new message today', 'iconClass' => 'fa-solid fa-star', 'backgroundColor' => '#98nb48'],
                ['title' => "Today's new Quiz", 'value' => $data['quiz_today'], 'percentageChange' => 'Total new quizzies today', 'iconClass' => 'fa-solid fa-question-circle', 'backgroundColor' => '#afeeee']
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
</body>
</html>
