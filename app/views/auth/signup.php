<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/signup.css">
    <link rel="stylesheet" href="../../public/css/style.css"> 

    <title>Register</title>
</head>
<body>
<!-- <?php include_once "../app/views/constant/header.php"; ?> -->
    <div id="main" class="">
        <div class="image-login">
            <!-- <img class="logo" src="../../public/images/logo_white.png" alt=""> -->
            <div class="container pt-5">
                <h1 id="space" class="font-main text-white">Find best quiz, test your IQ and increase your domain of education</h1>
            </div>
            <img class="img" src="../../public/images/robot.png" alt="">
        </div>
        <div class="login-box">
        <h2 class="my-3 font-main text-center">Create Account</h2>
        <form action="/Concursonaire/public/auth/signup" method="POST">
        <div class="mb-4">
                <input type="text" placeholder="Full Name" class="form-control" id="name" name="name" aria-describedby="emailHelp" required>
            </div>
            <div class="two">
                <div class="mb-4">
                    <input type="text" placeholder="Age" class="form-control" id="age" name="age" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-4">
                    <input type="text" placeholder="Phone Number" class="form-control" id="phone" name="phone" aria-describedby="emailHelp" required>
                </div>
            </div>
            <div class="mb-4">
                <input type="text" placeholder="Username" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-4">
                <input type="email" placeholder="Email" class="form-control mb-3" id="email" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-4">
                <input type="password" placeholder="Password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <input type="text" placeholder="What is your favourite pet name?" class="form-control" id="pet_name" name="pet_name" required>
            </div>
            <div class="mb-3 form-check">
                <input type="hidden" name="role" value="student">
                <input type="checkbox" class="form-check-input" name="role" id="role" value="teacher">
                <label class="form-check-label" for="is_teacher">Are you a Teacher?</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <p>Already have an account? 
            <a href="../auth/login">Login Here</a>
        </p>
        </div>
        

    </div>
</body>
</html>
