<?php
class Admin extends Controller {
    public function index() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $quizModel = $this->model('Quizs');
            $data = $quizModel->getDashboardInfo();
            $this->view('admin/dashboard',$data);
        } else {
            header("Location: /Concursonaire/public/admin/login");
            exit();
        }
    }

    public function login() {
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            header("Location: /Concursonaire/public/admin/index");
            exit();
        }

        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $cookie_username = $_COOKIE['username'];
            $cookie_password = $_COOKIE['password'];
            $admin = $this->model('Users');
            $result = $admin->loginAdmin($cookie_username, $cookie_password);
            if ($result['success']) {
                $_SESSION['user_id'] = $result['user']['id'];
                $_SESSION['name'] = $result['user']['name'];
                $_SESSION['role'] = $result['user']['role'];
                header("Location: /Concursonaire/public/admin/index");
                exit();
            }
        }
        
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin = $this->model('Users');
            $result = $admin->loginAdmin($username, $password);
            if ($result['success']) {
                $_SESSION['user_id'] = $result['user']['id'];
                $_SESSION['name'] = $result['user']['name'];
                $_SESSION['role'] = $result['user']['role'];
                if(isset($_POST['remember'])){
                if (!empty($_POST['remember'])) {
                    setcookie("username", $username, time() + (86400 * 3), "/"); // 86400 = 1 day, so 86400 * 3 = 3 days
                    setcookie("password", $password, time() + (86400 * 3), "/");
                } else {
                    setcookie("username", "", time() - 3600, "/");
                    setcookie("password", "", time() - 3600, "/");;
                }
            }
            
                header("Location: /Concursonaire/public/admin/index");
                exit();
            } else {
                $error = $result['error']; 
                $this->view('admin/login', ['error' => $error]); // Pass the error message to the view
                exit();
            }
        } else {
            $this->view('admin/login');
        }
    }
    
    public function managequiz(){
        if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {

            $quizModel = $this->model('Quizs');
            $quizzes = $quizModel->getAllQuizzes();
            $this->view('admin/manage', ['quizzes' => $quizzes]);
        
        }else{
            header("Location: /Concursonaire/public/admin/login");
        }
    }

    public function viewprofile(){
        $this->view('admin/adminProfile');      
    }

    public function logout() {
        $_SESSION = array();
    
        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        // Destroy the session
        session_destroy();
    
        // Clear any stored cookies for username and password
        setcookie("username", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
    
        // Redirect to login page or any other desired page after logout
        header("Location: /Concursonaire/public/auth/login");
        exit();
    }

    public function manageadmin(){
        if (!isset($_SESSION['user_id']) || !$_SESSION['role'] == "admin") {
            header('Location: /Concursonaire/public/admin/index');
            exit();
        }
        
        $quizModel = $this->model('Users');
        if(isset($_POST['delete'])){
            $id= $_POST['id'];
            $quizModel->deleteUser($id);
        }else if(isset($_POST['edit'])){
            $id= $_POST['id'];
            $data = $quizModel->getSingleUser($id);
            $this->view('admin/EditAdmin', $data);
            exit;
        }else if(isset($_POST['editSubmit'])){
            $id= $_POST['id'];
            $role = $_POST['role'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $result = $quizModel->updateUser($id,$age, $name, $username, $password, $phone, $role, $email);
            if($result){
                $adminData = $quizModel->getAllAdmin();
                $this->view('admin/manageAdmin', ['results' => $adminData]);
            }
        }

            $adminData = $quizModel->getAllAdmin();
            $this->view('admin/manageAdmin', ['results' => $adminData]);
        

    }
    
    public function addadmin(){
        if (isset($_SESSION['role']) && $_SESSION['role']!='admin') {
            header("Location: /Concursonaire/public/admin/index");
        }
        if(isset($_POST['submit'])){
            $userModel = $this->model('Users');
            $role = $_POST['role'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $result = $userModel->signup($age, $name, $username, $password, $phone, $role, $email);
            if (!$result['success']) {
                echo '<div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
                    <strong>Could not signup!</strong> ' . htmlspecialchars($result['error']) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                $adminData = $userModel->getAllAdmin();
                $this->view('admin/manageAdmin', ['results' => $adminData]);
        }else{
            $this->view('admin/addAdmin');
        }
    }
    
    public function manageusers(){
        if (!isset($_SESSION['user_id']) || !$_SESSION['role'] == "admin") {
            header('Location: /Concursonaire/public/auth');
            exit();
        }
        
        $quizModel = $this->model('Users');
        if(isset($_POST['delete'])){
            $id= $_POST['id'];
            $quizModel->deleteUser($id);
        }else if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $data = $quizModel->searchUsersByUsername($searchTerm);
            $this->view('admin/manageUser', ['results' => $data]);
            exit;
        }
        else if(isset($_POST['edit'])){
            $id= $_POST['id'];
            $data = $quizModel->getSingleUser($id);
            $this->view('admin/editUser', $data);
            exit;
        }else if(isset($_POST['editSubmit'])){
            $id= $_POST['id'];
            $role = $_POST['role'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $result = $quizModel->updateUser($id,$age, $name, $username, $password, $phone, $role, $email);
            if($result){
                $usersData = $quizModel->getAllUsers();
                $this->view('admin/manageUser', ['results' => $usersData]);
            }
        }
            $usersData = $quizModel->getAllUsers();
            $this->view('admin/manageUser', ['results' => $usersData]);
        
        }

    
        public function viewmessage(){
            if (isset($_SESSION['user_id']) && $_SESSION['role'] != "admin") {
                header('Location: /Concursonaire/public/auth');
                exit();
            }
            $messageModel = $this->model('Users');
            $message = $messageModel->getAllMessage();
            $this->view('admin/viewMessage', ['results' => $message]);
            
        }
}
