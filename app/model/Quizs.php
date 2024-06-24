<?php
class Quizs extends Model {

    public function addquiz($user_id, $title, $subject, $level,$description) {
        $stmt = $this->db->prepare("INSERT INTO quiz (user_id, title, subject, level, description, created_at, updated_at) VALUES (?, ?, ?, ?,?, NOW(), NOW())");

        if ($stmt === false) {
            error_log($this->db->error);
            return false;
        }

        $stmt->bind_param("issis", $user_id, $title, $subject, $level,$description);

        $result = $stmt->execute();
        if ($result === false) {
            error_log($stmt->error);
            return false;
        }

        return $this->db->insert_id;
    }
    
    public function addquestion($quizId,$questionText){
        $stmt = $this->db->prepare("INSERT INTO question (quiz_id, questionText) VALUES(?,?)");

        if ($stmt === false) {
            error_log($this->db->error);
            return false;
        }

        $stmt->bind_param("is", $quizId, $questionText);

        $result = $stmt->execute();
        if ($result === false) {
            error_log($stmt->error);
            return false;
        }

        return $this->db->insert_id;
    }

    public function addanswer($questionId,$answerText,$isCorrect){
        $stmt = $this->db->prepare("INSERT INTO answer (question_id, options, is_correct) VALUES(?,?,?)");

        if ($stmt === false) {
            error_log($this->db->error);
            return false;
        }

        $stmt->bind_param("isi",$questionId,$answerText,$isCorrect);

        $result = $stmt->execute();
        if ($result === false) {
            error_log($stmt->error);
            return false;
        }

        return true;
    }

    public function delete($id) {
            // Prepare and execute the SELECT statement
            $stmt = $this->db->prepare("SELECT user_id FROM quiz WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            // Check if the user_id matches the session user_id
            if ($row && $row['user_id'] == $_SESSION['user_id']) {
                // Delete answers for all questions associated with the given quiz_id
                $stmt = $this->db->prepare("DELETE answer FROM answer 
                                            INNER JOIN question ON answer.question_id = question.id 
                                            WHERE question.quiz_id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
    
                // Delete questions associated with the given quiz_id
                $stmt = $this->db->prepare("DELETE FROM question WHERE quiz_id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
    
                // Delete the quiz itself
                $stmt = $this->db->prepare("DELETE FROM quiz WHERE id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
                return true;
            }else{
                return "You can't delete other teacher's quiz";
            }
            
    }
    
    public function getAllQuizzes() {
        $result = $this->db->query("SELECT * FROM quiz");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuizzesByTeacher($teacher_id) {
        $stmt = $this->db->prepare("SELECT * FROM quiz WHERE user_id = ?");
        $stmt->bind_param('i', $teacher_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuizById($quiz_id) {
        $stmt = $this->db->prepare("SELECT * FROM quiz WHERE id = ?");
        $stmt->bind_param('i', $quiz_id);
        $stmt->execute();
        $quiz = $stmt->get_result()->fetch_assoc();

        $stmt = $this->db->prepare("SELECT * FROM question WHERE quiz_id = ?");
        $stmt->bind_param('i', $quiz_id);
        $stmt->execute();
        $questions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($questions as &$question) {
            $stmt = $this->db->prepare("SELECT * FROM answer WHERE question_id = ?");
            $stmt->bind_param('i', $question['id']);
            $stmt->execute();
            $question['answers'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $quiz['questions'] = $questions;
        return $quiz;
    }

    public function submitQuiz($student_id, $quiz_id, $answers) {
        $marks = 0;
    
        foreach ($answers as $key => $value) {
            $stmt = $this->db->prepare("SELECT id FROM answer WHERE question_id = ? AND is_correct = 1 ");
            $stmt->bind_param("i",$key);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->fetch_assoc()['id'] == $value){
                $marks += 1;
            }
        }
        $stmt = $this->db->prepare("INSERT INTO attempt (student_id, quiz_id, created_at,marks) VALUES (?, ?, NOW(),?)");
        $stmt->bind_param('iii', $student_id, $quiz_id,$marks);
        $stmt->execute();
    
    }

    public function getResultsByUserId($user_id) {
        $stmt = $this->db->prepare("
            SELECT 
                q.title,
                q.level,
                q.id AS quiz_id,
                a.marks AS score, 
                a.created_at AS date_taken,
                a.id as id,
                COUNT(ques.id) AS total_questions
            FROM 
                attempt a
            JOIN 
                quiz q ON a.quiz_id = q.id
            JOIN 
                question ques ON q.id = ques.quiz_id
            WHERE 
                a.student_id = ?
            GROUP BY 
                q.title, a.marks, a.created_at
            ORDER BY 
                a.created_at DESC
        ");
        
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }
    
        $stmt->bind_param('i', $user_id);
    
        if (!$stmt->execute()) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }
    
        $result = $stmt->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
    
        return $results;
    }
    
    
    public function addcommment($user_id,$quiz_id,$commment){
        $stmt = $this->db->prepare("INSERT INTO comment (user_id,quiz_id,text,created_at) VALUES(?,?,?,NOW())");
        $stmt->bind_param('iis',$user_id,$quiz_id,$commment);
        return $stmt->execute();
    }
    
    public function getAllCommentsByQuizId($id){
        $stmt = $this->db->prepare("SELECT comment.id as comment_id, comment.text, comment.created_at, users.id as user_id, users.name 
                                    FROM comment 
                                    INNER JOIN users ON comment.user_id = users.id 
                                    WHERE quiz_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    
        return $results;
    }
    
    public function editcomment($commment_id,$text){
        $stmt = $this->db->prepare("UPDATE comment SET text = ? WHERE id = ?");
        $stmt->bind_param('si',$text,$commment_id);
        $stmt->execute();        
    }

    public function deleteattempt($attempt_id){
        $stmt = $this->db->prepare("DELETE FROM attempt WHERE id = ?");
        $stmt->bind_param('i',$attempt_id);
        $stmt->execute(); 
    }

    public function deletecomment($commment_id){
        $stmt = $this->db->prepare("DELETE FROM comment WHERE id = ?");
        $stmt->bind_param('i',$commment_id);
        $stmt->execute();
    }

    public function updatequiz($quiz_id,$title,$subject,$level, $description){
        $stmt = $this->db->prepare("UPDATE quiz SET title = ?, subject = ?, level = ?, description = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("ssisi",$title,$subject,$level, $description,$quiz_id);
        $stmt->execute();
    }

    public function updateanswer($answerText,$isCorrect,$id){
        $stmt = $this->db->prepare("UPDATE answer SET options = ?, is_correct = ? WHERE id = ?");

        if ($stmt === false) {
            error_log($this->db->error);
            return false;
        }

        $stmt->bind_param("sii",$answerText,$isCorrect,$id);

        $result = $stmt->execute();
        if ($result === false) {
            error_log($stmt->error);
            return false;
        }

        return true;
    }

    public function updatequestion($questionText,$id){
        $stmt = $this->db->prepare("UPDATE question SET questionText = ? WHERE id = ?");

        if ($stmt === false) {
            error_log($this->db->error);
            return false;
        }

        $stmt->bind_param("si",$questionText, $id);

        $result = $stmt->execute();
        if ($result === false) {
            error_log($stmt->error);
            return false;
        }

        return $this->db->insert_id;
    }

    public function deleteQuestion($questionId) {
        // Delete all answers associated with the question
        $stmt = $this->db->prepare("DELETE FROM answer WHERE question_id = ?");
        $stmt->bind_param('i', $questionId);
        $stmt->execute();
        
        // Then delete the question itself
        $stmt = $this->db->prepare("DELETE FROM question WHERE id = ?");
        $stmt->bind_param('i', $questionId);
        $stmt->execute();
    }
    
    public function deleteAnswer($answerId) {
        $stmt = $this->db->prepare("DELETE FROM answer WHERE id = ?");
        $stmt->bind_param('i', $answerId);
        $stmt->execute();
    }
    
    public function getFilteredQuizzes($level, $search) {
        $query = "SELECT * FROM quiz WHERE 1=1";
        $params = [];
        $types = '';
    
        // Add level filter if provided
        if (!empty($level)) {
            $query .= " AND level = ?";
            $params[] = $level;
            $types .= 'i';
        }
    
        // Add search filter if provided
        if (!empty($search)) {
            $query .= " AND (title LIKE ? OR description LIKE ?)";
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $types .= 'ss';
        }
    
        $stmt = $this->db->prepare($query);
        
        // Bind parameters if there are any
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
    
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        return $results;
    }

    
    public function getInfoQuizOfTeacher($quiz_id){
        // Query to fetch quiz information, attempt details, and user information
        $stmt = $this->db->prepare("
            SELECT 
                quiz.title AS title,
                quiz.level AS quiz_level,
                attempt.marks AS marks,
                attempt.created_at AS created_at,
                users.name AS name
            FROM 
                quiz
            INNER JOIN 
                attempt ON attempt.quiz_id = quiz.id
            INNER JOIN 
                users ON attempt.student_id = users.id
            WHERE 
                quiz.id = ?
        ");
        $stmt->bind_param('i', $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $info = $result->fetch_all(MYSQLI_ASSOC);
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM question INNER JOIN quiz ON question.quiz_id = quiz.id WHERE quiz.id = ?");
        $stmt->bind_param("i",$quiz_id);
        $stmt->execute();
        $count =  $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $info['count'] = $count[0]['count'];
        
        return $info;
    }
    
    public function checkReview($quiz_id, $user_id) {
        $stmt = $this->db->prepare("SELECT * FROM reviews WHERE quiz_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $quiz_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function addReview($user_id,$quiz_id,$rating,$text){
        $stmt = $this->db->prepare("INSERT INTO reviews (user_id,quiz_id,rating,text,created_at) VALUES (?,?,?,?,NOW());");
        $stmt->bind_param("iiis",$user_id,$quiz_id,$rating,$text);
        $stmt->execute();
    }

    public function getNewQuiz(){
        $stmt = $this->db->prepare("SELECT * FROM quiz ORDER BY updated_at DESC");
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    public function getTopQuiz() {
        // Join the quiz table with the attempt table and count the number of attempts for each quiz
        $stmt = $this->db->prepare("
            SELECT quiz.*, COUNT(attempt.quiz_id) as attempts_count 
            FROM quiz
            LEFT JOIN attempt ON quiz.id = attempt.quiz_id
            GROUP BY quiz.id
            ORDER BY attempts_count DESC
        ");
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    
    public function getRandomQuiz() {
        $stmt = $this->db->prepare("SELECT * FROM quiz ORDER BY RAND()");
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    public function getReviewInfo($quiz_id){
        $stmt = $this->db->prepare("
            SELECT 
                reviews.rating AS rating,
                reviews.text AS text,
                quiz.title AS title,
                users.name AS name,
                reviews.created_at as created_at
            FROM 
                reviews
            INNER JOIN 
                quiz ON reviews.quiz_id = quiz.id
            INNER JOIN 
                users ON reviews.user_id = users.id
            WHERE 
                reviews.quiz_id = ?
        ");
        $stmt->bind_param('i', $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $results = $result->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    

    public function getDashboardInfo() {
        $stmt = $this->db->prepare("
            SELECT
                (SELECT COUNT(*) FROM users WHERE DATE(created_at) = CURDATE()) AS todays_users,
                (SELECT COUNT(*) FROM attempt WHERE DATE(created_at) = CURDATE()) AS today_attempt,
                (SELECT COUNT(*) FROM quiz WHERE DATE(created_at) = CURDATE()) AS quiz_today,
                (SELECT COUNT(*) FROM comment WHERE DATE(created_at) = CURDATE()) AS comment_today,
                (SELECT COUNT(*) FROM reviews WHERE DATE(created_at) = CURDATE()) AS review_today,
                (SELECT COUNT(*) FROM message WHERE DATE(created_at) = CURDATE()) AS message_today,
                (SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AS new_registrations,
                (SELECT COUNT(DISTINCT user_id) FROM quiz WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)) AS active_users
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data;
    }

    public function getTeacherDashboardInfo($user_id) {
        // Prepare the SQL statement with user_id filter
        $stmt = $this->db->prepare("
            SELECT
                (SELECT COUNT(*) FROM attempt a JOIN quiz q ON a.quiz_id = q.id WHERE DATE(a.created_at) = CURDATE() AND q.user_id = ?) AS today_attempt,
                (SELECT COUNT(*) FROM comment c JOIN quiz q ON c.quiz_id = q.id WHERE DATE(c.created_at) = CURDATE() AND q.user_id = ?) AS comment_today,
                (SELECT COUNT(*) FROM reviews r JOIN quiz q ON r.quiz_id = q.id WHERE DATE(r.created_at) = CURDATE() AND q.user_id = ?) AS review_today
        ");
        
        // Bind the user_id parameter to the query
        $stmt->bind_param('iii', $user_id, $user_id, $user_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the result
        $result = $stmt->get_result();
        
        // Fetch associative array
        $data = $result->fetch_assoc();
        
        return $data;
    }

    public function getCommentInfo($quiz_id){
        // Query to fetch comment information, quiz details, and user information
        $stmt = $this->db->prepare("
            SELECT 
                comment.text AS text,
                comment.created_at AS created_at,
                quiz.title AS title,
                users.name AS name
            FROM 
                comment
            INNER JOIN 
                quiz ON comment.quiz_id = quiz.id
            INNER JOIN 
                users ON comment.user_id = users.id
            WHERE 
                quiz.id = ?
        ");
        $stmt->bind_param('i', $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        
        return $comments;
    }
    
}