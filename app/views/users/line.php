<?php
function isActive($page, $activePages) {
    return in_array($page, $activePages) ? 'active-line-btn' : '';
}
?>
<form method="GET">
    
        <div class="container-fluid heading-list d-flex line justify-content-between">
            <div class="first d-flex ">
                <div class="child-first  d-flex justify-content-between align-items-center">
                    <button name="trending" class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('Trending', $activePages); ?>">
                        <i class="fa-solid fa-fire"></i><p class="m-0 px-2">Trending</p>
                    </button>
                    <button name="new" class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('New', $activePages); ?>">
                        <i class="fa-solid fa-newspaper"></i><p class="m-0 px-2">New</p>
                    </button>
                    <button name="top" class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('Top Rated', $activePages); ?>">
                        <i class="fa-solid fa-star"></i><p class="m-0 px-2">Top Rated</p>
                    </button>
                    <button name="random" class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('Random', $activePages); ?>">
                        <i class="fa-solid fa-shuffle"></i><p class="m-0 px-2">Random</p>
                    </button>
                </div>
            </div>
            
            <div class="second d-flex justify-content-between">
                <button class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex mr-5 justify-content-center align-items-center <?php echo isActive('latest', $activePages); ?>">Latest</button>
                <button class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('week', $activePages); ?>">Week</button>
                <button class="rounded-4 mx-1 my-2 text-white btn-secondary btn d-flex justify-content-center align-items-center <?php echo isActive('month', $activePages); ?>">Month</button>
            </div>
</form>
</div>
