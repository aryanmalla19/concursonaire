<?php
class Users extends Model {

    public function login($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            if ($stmt === false) {
                throw new Exception($this->db->error);
            }

            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $stmt->close();
                    return ['success' => true, 'error' => null, 'user' => $user];
                } else {
                    $stmt->close();
                    return ['success' => false, 'error' => 'Invalid password'];
                }
            } else {
                $stmt->close();
                return ['success' => false, 'error' => 'Email not found'];
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function getSingleUser($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function signup($age, $name, $username, $password, $phone, $role, $email,$pet_name) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO users (age, name, username, password, phone_num, role, email,pet_name) VALUES (?, ?, ?, ?, ?, ?, ?,?)");

            if ($stmt === false) {
                throw new Exception($this->db->error);
            }

            $stmt->bind_param("isssssss", $age, $name, $username, $hashedPassword, $phone, $role, $email, $pet_name);

            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }

            $id = $this->db->insert_id;
            $stmt->close();

            return ['success' => true, 'error' => null, 'id' => $id, 'name' => $name, 'role' => $role, 'pet_name'=> $pet_name];
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role != 'admin'");
        if ($stmt === false) {
            throw new Exception($this->db->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $admins = [];
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
        $stmt->close();
        return $admins;
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $user = $result->fetch_assoc();
        
        // Close the statement
        $stmt->close();
        
        return $user;
    }

    public function getAllAdmin() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role='admin'");
        if ($stmt === false) {
            throw new Exception($this->db->error);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $admins = [];
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
        $stmt->close();
        return $admins;
    }

    public function loginAdmin($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
            if ($stmt === false) {
                throw new Exception($this->db->error);
            }

            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    $stmt->close();
                    return ['success' => true, 'error' => null, 'user' => $user];
                } else {
                    $stmt->close();
                    return ['success' => false, 'error' => 'Invalid password'];
                }
            } else {
                $stmt->close();
                return ['success' => false, 'error' => 'Username not found'];
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function deleteUser($id){
        // Begin a transaction
        $this->db->begin_transaction();
    
        // Delete from attempt table where student_id = $id
        $stmt_attempt = $this->db->prepare("DELETE FROM attempt WHERE student_id = ?");
        $stmt_attempt->bind_param('i', $id);
        $stmt_attempt->execute();
        $stmt_attempt->close();
    
        // Delete from comment table where user_id = $id
        $stmt_comment = $this->db->prepare("DELETE FROM comment WHERE user_id = ?");
        $stmt_comment->bind_param('i', $id);
        $stmt_comment->execute();
        $stmt_comment->close();
    
        // Delete from reviews table where user_id = $id
        $stmt_reviews = $this->db->prepare("DELETE FROM reviews WHERE user_id = ?");
        $stmt_reviews->bind_param('i', $id);
        $stmt_reviews->execute();
        $stmt_reviews->close();
    
        // Delete from answer table where question_id in (select id from question where quiz_id in (select id from quiz where user_id = $id))
        $stmt_answer = $this->db->prepare("
            DELETE FROM answer 
            WHERE question_id IN (
                SELECT id 
                FROM question 
                WHERE quiz_id IN (
                    SELECT id 
                    FROM quiz 
                    WHERE user_id = ?
                )
            )
        ");
        $stmt_answer->bind_param('i', $id);
        $stmt_answer->execute();
        $stmt_answer->close();
    
        // Delete from question table where quiz_id in (select id from quiz where user_id = $id)
        $stmt_question = $this->db->prepare("
            DELETE FROM question 
            WHERE quiz_id IN (
                SELECT id 
                FROM quiz 
                WHERE user_id = ?
            )
        ");
        $stmt_question->bind_param('i', $id);
        $stmt_question->execute();
        $stmt_question->close();
    
        // Delete from quiz table where user_id = $id
        $stmt_quiz = $this->db->prepare("DELETE FROM quiz WHERE user_id = ?");
        $stmt_quiz->bind_param('i', $id);
        $stmt_quiz->execute();
        $stmt_quiz->close();
    
        // Delete from users table where id = $id
        $stmt_users = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt_users->bind_param('i', $id);
        $stmt_users->execute();
        $stmt_users->close();
    
        // Commit the transaction
        $this->db->commit();
    
        return true;
    }
    
    public function searchUsersByUsername($username) {
        // Search users by username
        $sql = "SELECT * FROM users WHERE username LIKE ?";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->error);
        }
        
        $searchParam = "%" . $username . "%";
        $stmt->bind_param('s', $searchParam);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            die('Execute failed: ' . $stmt->error);
        }
    }

    public function updateUser($id, $age, $name, $username, $password, $phone, $role, $email){
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $stmt = $this->db->prepare("UPDATE users SET age=?, name=?, username=?, password=?, phone_num=?, role=?, email=? WHERE id=?");
            $stmt->bind_param("issssssi", $age, $name, $username, $hashedPassword, $phone, $role, $email, $id);
    
            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }
    
            $stmt->close();
    
            return ['success' => true, 'error' => null, 'id' => $id, 'name' => $name, 'role' => $role];
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function updateAnotherUser($id, $name, $email, $phone_num, $age, $password) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ?, phone_num = ?, age = ?, password = ? WHERE id = ?");
        $stmt->bind_param('sssisi', $name, $email, $phone_num, $age, $password, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function verifyUserInfo($email, $petName, $phoneNumber) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND pet_name = ? AND phone_num = ?");
        $stmt->bind_param('sss', $email, $petName, $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updatePassword($email, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param('ss', $hashedPassword, $email);
        $stmt->execute();
    }
    
    public function sendUserMessage($name, $email, $phone, $message) {
        $stmt = $this->db->prepare("INSERT INTO message (name, email, phone, message,created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        if ($stmt->execute() === false) {
            error_log('Execute failed: ' . htmlspecialchars($stmt->error));
            $stmt->close();
            return false;
        }
        
        $stmt->close();
        
        return true;
    }
    
    public function getAllMessage() {
        $stmt = $this->db->prepare("SELECT * FROM message");
        
        if ($stmt->execute() === false) {
            error_log('Execute failed: ' . htmlspecialchars($stmt->error));
            $stmt->close();
            return false;
        }
    
        // Fetch all messages
        $result = $stmt->get_result();
        $messages = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();
        
        return $messages;
    }
    
}
