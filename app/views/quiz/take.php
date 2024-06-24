<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <link rel="stylesheet" href="/Concursonaire/public/css/take.css">
    <link rel="stylesheet" href="/Concursonaire/public/css/style.css">
    <link rel="stylesheet" href="/Concursonaire/public/css/footer.css">
</head>
<body>
    <h1>Taking Quiz: <?php echo htmlspecialchars($data['quiz']['title']); ?></h1>

    <div class="container" id="start-screen">
        <h2 class="mb-3">Quiz Details</h2>
        <p class="mb-2 fs-5"><strong>Title:</strong> <?php echo htmlspecialchars($data['quiz']['title']); ?></p>
        <p class="mb-2"><strong>Level:</strong> <?php echo htmlspecialchars($data['quiz']['level']); ?></p>
        <p class="mb-2"><strong>Description:</strong> <?php echo htmlspecialchars($data['quiz']['description']); ?></p>
        <p class="mb-2"><strong>Total Questions:</strong> <?php echo count($data['quiz']['questions']); ?></p>
        <p class="mb-2"><strong>Created At:</strong> <?php echo htmlspecialchars($data['quiz']['created_at']); ?></p>
        <button class="custom-btn" onclick="startQuiz()">Start the Quiz</button>
    </div>

    <div class="container" id="quiz-screen" style="display:none;">
        <div id="timer" class="timer">Time Left: 05:00</div>
        <div id="timer-display" class="timer"></div>
        <div id="question-counter" class="question-counter">Question 1/<?php echo count($data['quiz']['questions']); ?></div>
        <form id="quizForm" method="POST">
            <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($data['quiz']['id']); ?>">
            <?php foreach ($data['quiz']['questions'] as $index => $question): ?>
                <div class="question <?php echo $index === 0 ? 'active' : ''; ?>" data-question="<?php echo $index; ?>">
                    <h4><?php echo htmlspecialchars($question['questionText']); ?></h4>
                    <?php foreach ($question['answers'] as $answer): ?>
                        <div class="option">
                            <input class="form-check-input" type="radio" id="answer-<?php echo htmlspecialchars($answer['id']); ?>" name="answers[<?php echo htmlspecialchars($question['id']); ?>]" value="<?php echo htmlspecialchars($answer['id']); ?>">
                            <label for="answer-<?php echo htmlspecialchars($answer['id']); ?>"><?php echo htmlspecialchars($answer['options']); ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <div class="navigation">
                <button type="button" class="btn btn-secondary" onclick="prevQuestion()">Previous</button>
                <button type="button" class="btn btn-primary" onclick="nextQuestion()">Next</button>
                <button name="submit" class="btn btn-success" type="submit">Submit Quiz</button>
            </div>
        </form>
    </div>

    <div class="container comments-section">
        <h3>Comments</h3>
        <?php foreach ($data['comments'] as $comment): ?>
            <div class="comment" id="comment-<?php echo $comment['comment_id']; ?>">
                <div class="d-flex mb-2 align-items-center">
                    <i class="fa-solid comment-icon text-black mx-1 fa-user"></i><h5><?php echo htmlspecialchars($comment['name']); ?></h5>
                </div>

                <div id="comment-text-<?php echo $comment['comment_id']; ?>" class="comment-text">
                    <p><?php echo htmlspecialchars($comment['text']); ?></p>
                </div>
                <small class="text-muted"><?php echo htmlspecialchars($comment['created_at']); ?></small>
                <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
                    <br>
                    <button type="button" class="btn mt-2 btn-primary edit-btn" onclick="editComment(<?php echo $comment['comment_id']; ?>)">EDIT</button>
                    <form method="post" class="edit-form" id="edit-form-<?php echo $comment['comment_id']; ?>" style="display: none;">
                        <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($data['quiz']['id']); ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                        <textarea name="edited_comment" class="form-control"><?php echo htmlspecialchars($comment['text']); ?></textarea>
                        <button type="submit" name="edit" class="btn mt-1 btn-success">SAVE</button>
                        <button type="button" class="btn mt-1 btn-secondary" onclick="cancelEdit(<?php echo $comment['comment_id']; ?>)">CANCEL</button>
                    </form>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($data['quiz']['id']); ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                        <button name="delete" id="delete-btn" type="submit" class="btn mt-2 btn-danger">DELETE</button>    
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <form method="post">
            <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($data['quiz']['id']); ?>">
            <label>Your comment:</label>
            <textarea name="comment" placeholder="Add a comment" class="form-control"></textarea>
            <button class="my-3 btn btn-primary" name="add" type="submit">ADD</button>
        </form>
    </div>

    <script>
        function editComment(commentId) {
            const editForm = document.getElementById('edit-form-' + commentId);
            const commentText = document.getElementById('comment-text-' + commentId);

            // Hide edit and delete buttons
            const editButton = document.querySelector('#comment-' + commentId + ' .edit-btn');
            editButton.style.display = 'none';

            // Show the edit form and hide the comment text
            editForm.style.display = 'block';
            commentText.style.display = 'none';
        }

        function cancelEdit(commentId) {
            const editForm = document.getElementById('edit-form-' + commentId);
            const commentText = document.getElementById('comment-text-' + commentId);

            // Show edit and delete buttons
            const editButton = document.querySelector('#comment-' + commentId + ' .edit-btn');
            editButton.style.display = 'inline-block';

            // Hide the edit form and show the comment text
            editForm.style.display = 'none';
            commentText.style.display = 'block';
        }



        let currentQuestion = 0;
        const questions = document.querySelectorAll('.question');
        const timerElement = document.getElementById('timer');
        const questionCounterElement = document.getElementById('question-counter');
        const timerDisplay = document.getElementById('timer-display');
        let timeLeft = 10;

        function showQuestion(index) {
            questions[currentQuestion].classList.remove('active');
            currentQuestion = index;
            questions[currentQuestion].classList.add('active');
            updateQuestionCounter();
        }

        function nextQuestion() {
            if (currentQuestion < questions.length - 1) {
                showQuestion(currentQuestion + 1);
            }
        }

        function prevQuestion() {
            if (currentQuestion > 0) {
                showQuestion(currentQuestion - 1);
            }
        }

        function updateQuestionCounter() {
            questionCounterElement.textContent = `Question ${currentQuestion + 1}/${questions.length}`;
        }

        function toggleEditForm(commentId) {
            const editForm = document.getElementById('edit-form-' + commentId);
            editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        }

        function disableOptions() {
            const options = document.querySelectorAll('input[type="radio"]');
            options.forEach(option => {
                option.disabled = true;
            });
        }

        function startTimer() {
            const timer = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timerDisplay.textContent = 'Time is up. Please submit the quiz.';
                    console.log(timerDisplay);
                    disableOptions();
                } else {
                    timeLeft--;
                    const minutes = String(Math.floor(timeLeft / 60)).padStart(2, '0');
                    const seconds = String(timeLeft % 60).padStart(2, '0');
                    timerElement.textContent = `Time Left: ${minutes}:${seconds}`;
                }
            }, 1000);
        }

        function startQuiz() {
            document.getElementById('start-screen').style.display = 'none';
            document.getElementById('quiz-screen').style.display = 'block';
            startTimer();
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            updateQuestionCounter();
        });
    </script>
</body>
</html>
