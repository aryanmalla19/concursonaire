<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$current_path = $_SERVER['REQUEST_URI'];
if (strpos($current_path, 'admin/login') !== false) {
}else{

if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Concursonaire/public/auth/login">
            <img src="/Concursonaire/public/images/logo.png" style="height:60px;" class="header-logo" alt="logo">
            oncursonaire
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header text-black border-bottom">
                <a href="/Concursonaire/public/auth/login">
                    <h5 class="offcanvas-title text-black" id="offcanvasNavbarLabel">
                        <img style="height:30px" src="/Concursonaire/public/images/logo.png" class="header-logo" alt="logo"> oncursonaire
                    </h5>
                </a>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-4 flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav head-top justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="/Concursonaire/public/quiz/index">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/Concursonaire/public/info/profile">Profile</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/Concursonaire/public/quiz/result">My results</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/Concursonaire/public/info/contact">Contact</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link logout" href="/Concursonaire/public/auth/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php
} else if (!isset($_SESSION['role'])){
?>
<nav class="navbar position-fixed w-100 navbar-expand-lg navbar-light bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand" href="/Concursonaire/public/auth/login">
            <img src="/Concursonaire/public/images/logo.png" style="height:60px;" class="header-logo" alt="logo">
            oncursonaire
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="signup" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4 signupBtn">SignUp</a>
                </li>
                <li class="nav-item">
                    <a href="login" class="text-black text-decoration-none px-3 py-1">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
}
}
?>
