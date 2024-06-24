<?php
class Quiz extends Controller{

    public function create(){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $user_id = $_POST['user_id'];
            $title = $_POST['title'];
            $subject = $_POST['subject'];
            $level = $_POST['level'];
            $description = $_POST['description'];

            $quizModel = $this->model('Quizs');
            $quizId = $quizModel->addquiz($user_id,$title,$subject,$level,$description);
            
            $questions = $_POST['questions'];
            
            foreach ($questions as $questionIndex => $questionData) {
                $questionText = $questionData['question'];
                $questionId = $quizModel->addquestion($quizId,$questionText);

                $answers = $questionData['answers'];

                foreach ($answers as $answerIndex => $answerData) {
                    $answerText = $answerData['option'];
                    $isCorrect = $answerData['is_correct_value'];
                    $quizModel->addanswer($questionId,$answerText,$isCorrect);
                }
            }
            Header("Location: /Concursonaire/public/quiz/manage");
        }else{
             
            $this->view('quiz/create');
        }
    }

    public function manage(){
         
        if (!isset($_SESSION['user_id']) || !$_SESSION['role'] == "teacher") {
            header('Location: /Concursonaire/public/auth/index');
            exit();
        }

        $quizModel = $this->model('Quizs');
        $quizzes = $quizModel->getQuizzesByTeacher($_SESSION['user_id']);
        $this->view('quiz/manage', ['quizzes' => $quizzes]);
    }

    public function delete($id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']!='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $quizModel = $this->model('Quizs');
            $result = $quizModel->delete($id);
            
            if(!$result){
                echo $result;
            }else{
            header('Location: /Concursonaire/public/quiz/manage');
            }
        }
    }
    
    public function take($id) {
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']!='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        $quizModel = $this->model('Quizs');

        if(isset($_POST['submit'])){
            $quiz_id = $_POST['quiz_id'];
            $answers = $_POST['answers'];
            $quizModel->submitQuiz($_SESSION['user_id'], $quiz_id, $answers);
            header('Location: /Concursonaire/public/quiz/result/'.$quiz_id);

        }else if(isset($_POST['add'])){
            $quiz_id = $_POST['quiz_id']; 
            $comment = $_POST['comment'];
            $quizModel->addcommment($_SESSION['user_id'],$quiz_id, $comment);
            header('Location: /Concursonaire/public/quiz/take/'.$quiz_id);

        }else if(isset($_POST['delete'])){
            $quiz_id = $_POST['quiz_id']; 
            $commentId = $_POST['comment_id'];
            $quizModel->deletecomment($commentId);
            header('Location: /Concursonaire/public/quiz/take/'.$quiz_id);
        }else if(isset($_POST['edit'])){
            $quiz_id = $_POST['quiz_id']; 
            $commentId = $_POST['comment_id'];
            $text = $_POST['edited_comment'];
            $quizModel->editcomment($commentId,$text);
            header('Location: /Concursonaire/public/quiz/take/'.$quiz_id);
        }
        else{
            $quiz = $quizModel->getQuizById($id);
            $comments = $quizModel->getAllCommentsByQuizId($id);
            $this->view('quiz/take', ['quiz' => $quiz, 'comments' => $comments]);
        }
        $this->view('constant/footer');

    }

    public function edit($id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        $quizModel = $this->model('Quizs');
    
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['update'])){
                $quiz_id = $_POST['quiz_id'];
                $title = $_POST['title'];
                $subject = $_POST['subject'];
                $level = $_POST['level'];
                $description = $_POST['description'];
                $quizModel->updatequiz($quiz_id, $title, $subject, $level, $description);
                
                // Process deletions
                $deletedQuestions = json_decode($_POST['deleted_questions'], true);
                $deletedAnswers = json_decode($_POST['deleted_answers'], true);
    
                if ($deletedQuestions) {
                    foreach ($deletedQuestions as $questionId) {
                        $quizModel->deleteQuestion($questionId);
                    }
                }
    
                if ($deletedAnswers) {
                    foreach ($deletedAnswers as $answerId) {
                        $quizModel->deleteAnswer($answerId);
                    }
                }
    
                $questions = $_POST['questions'];
    
                foreach ($questions as $questionIndex => $questionData) {
                    $questionText = $questionData['question'];
                    $question_id = $questionData['question_id'];
                    if ($question_id) {
                        $quizModel->updatequestion($questionText, $question_id);
                    } else {
                        $question_id = $quizModel->addQuestion($quiz_id, $questionText);
                    }
    
                    $answers = $questionData['answers'];
    
                    foreach ($answers as $answerIndex => $answerData) {
                        $answerText = $answerData['option'];
                        $isCorrect = $answerData['is_correct_value'];
                        $answerid = $answerData['id'];
                        if ($answerid) {
                            $quizModel->updateanswer($answerText, $isCorrect, $answerid);
                        } else {
                            $quizModel->addAnswer($question_id, $answerText, $isCorrect);
                        }
                    }
                }
                header("Location: /Concursonaire/public/manage");
            }
        } else {
            $quiz = $quizModel->getQuizById($id);
            if (!$quiz) {
                header("Location: /Concursonaire/public/manage"); // Redirect to manage page
                exit();
            }
            $this->view('quiz/edit', ['quiz' => $quiz]);
        }
    }

    public function showCorrect($quiz_id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']!='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
    
        $userModel = $this->model('Users');
        $user = $userModel->getUserById($_SESSION['user_id']);
    
        // Check if the user has the required permissions
        if ($user['role'] != 'admin' && $user['role'] != 'teacher' && $user['role'] != 'student') {
            // If the user does not have permission, redirect to an unauthorized page or show an error
            header('Location: /unauthorized');
            exit();
        }
    
        // Load the quiz model
        $quizModel = $this->model('Quizs');
        $data = $quizModel->getQuizById($quiz_id);
    
        // Render the view with the quiz data
        $this->view('quiz/showCorrect', $data);
    }

    public function result($quiz_id=""){
        if (!isset($_SESSION['user_id'])) {
            header("Location: /Concursonaire/public/auth/index");
        }
        if(isset($_POST['submitReview'])){
            $rating = $_POST['rating'];
            $text = $_POST['review_text'];
            $quizModel = $this->model('Quizs');
            $quizModel->addReview($_SESSION['user_id'],$quiz_id,$rating,$text);
            header('Location: /Concursonaire/public/quiz/result');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['delete'])){
                $attempt_id = $_POST['id'];
                $quizModel = $this->model('Quizs');
                $quizModel->deleteattempt($attempt_id);
                header('Location: /Concursonaire/public/quiz/result');
            }else if(isset($_POST['show'])){
                $quiz_id = $_POST['quiz_id'];
                header('Location: /Concursonaire/public/quiz/showCorrect/'.$quiz_id);
            }
        }else{
            $resultsModel = $this->model('Quizs');
            $results = $resultsModel->getResultsByUserId($_SESSION['user_id']);
            $data['results'] = $results;
            if($quiz_id != ""){
                $quizModel = $this->model('Quizs');
                $review = $quizModel->checkReview($quiz_id,$_SESSION['user_id']);
                $this->view('quiz/view',['results'=>$results,'review'=>$review]);
                exit;
            }
            $this->view('quiz/view',['results'=>$results]);
            $this->view('constant/footer');
        }
    }

    public function viewquiz(){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }

        $quizModel = $this->model('Quizs');
        $quizzes = $quizModel->getQuizzesByTeacher($_SESSION['user_id']);
        $this->view('quiz/viewmyquiz', ['quizzes' => $quizzes]);
    }

    public function viewresult($quiz_id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $quizModel = $this->model('Quizs');
            $quizzes = $quizModel->getInfoQuizOfTeacher($quiz_id);
            $this->view('quiz/viewresult', ['results' => $quizzes]);
        }
    }

    public function viewreview($quiz_id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        $quizModel = $this->model('Quizs');
        $review = $quizModel->getReviewInfo($quiz_id);
        $this->view('quiz/viewreview', ['results' => $review]);
    }

    public function viewcomment($quiz_id){
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']=='student') {
            header("Location: /Concursonaire/public/auth/index");
        }
        $quizModel = $this->model('Quizs');
        $review = $quizModel->getCommentInfo($quiz_id);
        $this->view('quiz/viewcomment', ['results' => $review]);
    }

    public function index(){
        if(!isset($_SESSION['user_id'])){
            header("Location: /Concursonaire/public/auth/login");
        }
        if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role']!='student') {
            header("Location: /Concursonaire/public/auth/login");
        }
        $quizModel = $this->model('Quizs');
        if(isset($_GET['trending'])){
            $trending = $quizModel->getAllQuizzes();
            $this->view('users/index',['quizzes'=>$trending,'selected'=>'Trending']);
        }else if(isset($_GET['new'])){
            $new = $quizModel->getNewQuiz();
            $this->view('users/index',['quizzes'=>$new,'selected'=>'New']);
        }else if(isset($_GET['top'])){
            $top = $quizModel->getTopQuiz();
            $this->view('users/index',['quizzes'=>$top,'selected'=>'Top Rated']);
        }else if(isset($_GET['random'])){
            $top = $quizModel->getRandomQuiz();
            $this->view('users/index',['quizzes'=>$top,'selected'=>'Random']);
        }else if(isset($_GET['search'])){
            $search = $_GET['search'];
            $level = $_GET['level'];
            $searchQuiz = $quizModel->getFilteredQuizzes($level, $search);
            $this->view('users/index',['quizzes'=>$searchQuiz,'selected'=>'Trending']);
        }else{
            $all = $quizModel->getAllQuizzes();
            $this->view('users/index',['quizzes'=>$all,'selected'=>'Trending']);
        }
        $this->view('constant/footer');
    }

}
