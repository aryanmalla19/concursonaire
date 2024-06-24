<div class="d-md-none">
    <!-- Hamburger Menu for Mobile -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Offcanvas Sidebar for Mobile -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileSidebarLabel"><img style="height:40px;position:relative;right:-10px;top:-3px" src="../images/logo.png" alt="" srcset="">oncursonaire</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body sidebarr">
            <h4 class="text-white text-center px-2 py-4"><img style="height:35px;" src="/Concursonaire/public/images/logo_white.png" alt="" srcset="">oncursonaire</h4>
            <a class="active a" href="/Concursonaire/public/admin/dashboard">Dashboard</a>
            <a class="a" href="/Concursonaire/public/admin/managequiz">Manage Quizzes</a>
            <a class="a" href="/Concursonaire/public/admin/manageadmin">Manage Admin</a>
            <a class="a" href="/Concursonaire/public/admin/manageusers">Manage Users</a>
            <a class="a" href="/Concursonaire/public/admin/viewmessage">View Message</a>
            <a class="a" href="/Concursonaire/public/admin/logout">Logout</a>
        </div>
    </div>
</div>

<div class="sidebar d-none d-md-flex flex-column">
    <h4 class="text-white text-center px-2 py-4"><img style="height:50px;position:relative;right:-8px;top:-3px" src="/Concursonaire/public/images/logo_white.png" alt="" srcset="">oncursonaire</h4>
    <a class="a a" class="active" href="/Concursonaire/public/admin/dashboard">Dashboard</a>
    <a class="a" href="/Concursonaire/public/admin/managequiz">Manage Quizzes</a>
    <a class="a" href="/Concursonaire/public/admin/manageadmin">Manage Admin</a>
    <a class="a" href="/Concursonaire/public/admin/manageusers">Manage Users</a>
    <a class="a" href="/Concursonaire/public/admin/viewmessage">View Message</a>
    <a class="a" href="/Concursonaire/public/admin/logout">Logout</a>
</div>
<script>
    document.querySelectorAll('.sidebar a').forEach(function(element) {
        if (element.href === window.location.href) {
            element.classList.add('active');
        }
    });
</script>