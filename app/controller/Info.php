<?php
class Info extends Controller{
    public function contact() {
        // Check if the user is logged in and is not a student
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] != 'student') {
            header("Location: /Concursonaire/public/admin/index");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('Users');
    
            // Check if user is logged in
            if (isset($_SESSION['user_id'])) {
                $userData = $userModel->getSingleUser($_SESSION['user_id']);
                $name = $userData['name'];
                $email = $userData['email'];
                $phone = $userData['phone_num'];
            } else {
                $name = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
            }
    
            $message = $_POST['message'];
            $result = $userModel->sendUserMessage($name, $email, $phone, $message);
    
            if ($result) {
                echo '<div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
                        <strong>Message sent successfully!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                        <strong>Could not send message!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
            $this->view('static/contact');
            if(isset($_SESSION['user_id']) && $_SESSION['role'] == "student"){
                $this->view('constant/footer');
            }

        } else {
            $this->view('static/contact');
            if(isset($_SESSION['user_id']) && $_SESSION['role'] == "student"){
                $this->view('constant/footer');
            }
        }
    }
    

public function profile() {
    $userModel = $this->model('Users');
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate input data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_num = $_POST['phone_num'];
        $age = $_POST['age'];
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $user = $userModel->getUserById($user_id);

        if (!empty($new_password) && $new_password === $confirm_password) {
            if (password_verify($password, $user['password'])) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            } else {
                $data['error'] = 'Current password is incorrect';
            }
        } else {
            $hashed_password = $user['password'];
        }

        if (!isset($data['error'])) {
            if ($userModel->updateAnotherUser($user_id, $name, $email, $phone_num, $age, $hashed_password)) {
                $data['success'] = 'Profile updated successfully';
            } else {
                $data['error'] = 'Failed to update profile';
            }
        }
    }

    $data = array_merge($userModel->getUserById($user_id), $data ?? []);
    $this->view('users/profile', $data);
    if(isset($_SESSION['user_id']) && $_SESSION['role'] == "student"){
        $this->view('constant/footer');
    }
    
}

}