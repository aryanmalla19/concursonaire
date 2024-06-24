<?php if ($_SESSION['role'] == "teacher"): ?>
    <div class="d-flex dash-side">
        <nav class="d-none d-md-block">
            <a href="/Concursonaire/public/auth/dashboard"><button type="button" class="dash-btn py-2 btn-primary"> <i class="fa-solid fa-house"></i>Dashboard</button></a>
            <a href="/Concursonaire/public/quiz/create"><button type="button" class="dash-btn py-2 btn-primary"><i class="fa-solid fa-plus"></i>Create Quiz</button></a>
            <a href="/Concursonaire/public/quiz/manage"><button type="button" class="dash-btn py-2 btn-primary"><i class="fa-solid fa-list-check"></i>Manage Quizzes</button></a>
            <a href="/Concursonaire/public/quiz/viewquiz"><button type="button" class="dash-btn py-2 btn-primary"><i class="fa-solid fa-eye"></i>View My Quizzes</button></a>
            <a href="/Concursonaire/public/info/profile"><button type="button" class="dash-btn py-2 btn-primary"><i class="fa-solid fa-user"></i>Profile</button></a>
            <a href="/Concursonaire/public/auth/logout"><button type="button" class="dash-btn py-2 btn-primary"><i class="fa-solid fa-right-from-bracket"></i>Logout</button></a>
        </nav>
    </div>

    <!-- Hamburger Menu for Mobile -->
    <nav class="navbar navbar-dark bg-dark d-md-none">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileSidebarLabel"><img src="../images/logo.png" style="height:30px;" alt="" srcset="">oncursonaire</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <a href="/Concursonaire/public/auth/dashboard"><button type="button" class="dash-btn py-2 btn-primary">Dashboard</button></a>
            <a href="/Concursonaire/public/quiz/create"><button type="button" class="dash-btn py-2 btn-primary">Create Quiz</button></a>
            <a href="/Concursonaire/public/quiz/manage"><button type="button" class="dash-btn py-2 btn-primary">Manage Quizzes</button></a>
            <a href="/Concursonaire/public/quiz/viewquiz"><button type="button" class="dash-btn py-2 btn-primary">View My Quizzes</button></a>
            <a href="/Concursonaire/public/info/profile"><button type="button" class="dash-btn py-2 btn-primary">Profile</button></a>
            <a href="/Concursonaire/public/auth/logout"><button type="button" class="dash-btn py-2 btn-primary">Logout</button></a>
        </div>
    </div>
<?php endif; ?>

<script>
    document.querySelectorAll('nav a').forEach(function(element) {
        if (element.href === window.location.href) {
            element.querySelector('button').classList.add('active-btn');
        }
    });
</script>
