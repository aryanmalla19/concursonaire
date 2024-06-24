<?php
class Auth extends Controller {

    public function index(){
        Header("Location: /Concursonaire/public/auth/login");
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = $_POST['role'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $pet_name = $_POST['pet_name'];
            $usersModel = $this->model('Users');
            $result = $usersModel->signup($age, $name, $username, $password, $phone, $role, $email,$pet_name);
    
            if (!$result['success']) {
                echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                    <strong>Could not signup!</strong> ' . htmlspecialchars($result['error']) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                $this->view('auth/signup');
            } else {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['name'] = $result['name'];
                $_SESSION['role'] = $result['role'];
                header("Location: /Concursonaire/public/auth/dashboard");
            }
        } else {
            $this->view('auth/signup');
        }
    }
    
    public function login() {
        if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
            header("Location: /Concursonaire/public/admin");
            exit();
        } 
        if (isset($_SESSION['user_id'])) {
            header("Location: /Concursonaire/public/auth/dashboard");
            exit(); // Ensure no further code is executed
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $usersModel = $this->model('Users');
            $result = $usersModel->login($email, $password);
    
            if (!$result['success']) {
                echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . htmlspecialchars($result['error']) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                $this->view('auth/login');
            } else {
                $_SESSION['user_id'] = $result['user']['id'];
                $_SESSION['name'] = $result['user']['name'];
                $_SESSION['role'] = $result['user']['role'];

                header("Location: /Concursonaire/public/auth/dashboard");
                exit(); // Ensure no further code is executed
            }
        } else {
            $this->view('auth/login');
        }
    }
    

    public function dashboard() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: /Concursonaire/public/auth/index");
            exit();
        }
        if($_SESSION['role']=="student"){
            header('Location: /Concursonaire/public/quiz/index');
            exit();
            }
        // Load the dashboard view
        $quizModel = $this->model('Quizs');
        $data = $quizModel->getTeacherDashboardInfo($_SESSION['user_id']);
        $this->view('dashboard/index',$data);
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /Concursonaire/public/auth/login');
    }

    public function verifyReset() {
        $email = $_POST['email'];
        $petName = $_POST['pet_name'];
        $phoneNumber = $_POST['phone_number'];

        $userModel = $this->model('Users');
        $user = $userModel->verifyUserInfo($email, $petName, $phoneNumber);

        if ($user) {
            $_SESSION['reset_email'] = $email; // Store the email in session for password reset
            $this->view('auth/resetPassword');
        } else {
            $error = "Verification failed. Please check your details and try again.";
            $this->view('auth/forgotPassword', ['error' => $error]);
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['reset_email'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword === $confirmPassword) {
                $userModel = $this->model('Users');
                $userModel->updatePassword($email, $newPassword);
                unset($_SESSION['reset_email']);
                echo('');
                $this->view('auth/login', ['success' => 'Password updated successfully.']);
            } else {
                $this->view('auth/resetPassword', ['error' => 'Passwords do not match.']);
            }
        } else {
            $this->view('auth/resetPassword');
        }
    }

    public function forgotPassword() {
            $this->view('auth/forgotPassword');
        
    }
    
}
?>
