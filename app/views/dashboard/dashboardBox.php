<!-- dashboardBox.php -->
<div class="dash-box" style="background-color: <?php echo htmlspecialchars($backgroundColor); ?>">
    <div class="d-flex justify-content-between">
        <div class="i">
            <i class="<?php echo htmlspecialchars($iconClass); ?>"></i>
        </div>
        <div class="d-flex flex-column">
            <p class="mb-0"><?php echo htmlspecialchars($title); ?></p>
            <h3 class="text-end"><?php echo htmlspecialchars($value); ?></h3>
        </div>
    </div>
    <p class="mb-0 mt-2"><?php echo htmlspecialchars($percentageChange); ?></p>
</div>