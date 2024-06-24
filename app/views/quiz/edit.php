<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Concursonaire/public/css/style.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/create.css"> 
    <link rel="stylesheet" href="/Concursonaire/public/css/dashboard.css"> 
    <title>Edit Quiz</title>

</head>
<body>
    
    <?php $quiz = $data['quiz']; ?>
    <div class="d-flex main">
    <?php include "../app/views/dashboard/sidebar.php"; ?>
    <div class="container">
        <h1 class="text-center my-4 font-main">Edit Quiz</h1>
        <form id="quiz-form" method="POST">
            <input type="hidden" name="quiz_id" value="<?php echo htmlspecialchars($quiz['id']); ?>">
            <input type="hidden" id="deleted_questions" name="deleted_questions" value="">
            <input type="hidden" id="deleted_answers" name="deleted_answers" value="">
            
            <div class="form-group">
                <label for="title">Quiz Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($quiz['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($quiz['description']); ?>" required>
            </div>

            <div class="form-group">
                <label for="level">Level:</label>
                <select name="level" class="form-select" aria-label="Default select example">
                    <option selected value="<?php echo htmlspecialchars($quiz['level']); ?>"><?php echo htmlspecialchars($quiz['level']); ?></option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i != $quiz['level']): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </div>

            
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($quiz['subject']); ?>" required>
            </div>
            
            <h3>Questions:</h3>
            <div id="questions-container">
                <?php foreach ($quiz['questions'] as $qIndex => $question): ?>
                    <div class="question" data-question-id="<?php echo htmlspecialchars($question['id']); ?>">
                        <div class="form-group">
                            <label>Question:</label>
                            <input type="hidden" name="questions[<?php echo $qIndex; ?>][question_id]" value="<?php echo htmlspecialchars($question['id']); ?>">
                            <input type="text" class="form-control" name="questions[<?php echo $qIndex; ?>][question]" value="<?php echo htmlspecialchars($question['questionText']); ?>" required>
                            <button type="button" class="delete-question btn btn-danger my-2">Delete Question</button>
                        </div>
                        <h4>Answers:</h4>
                        <div class="answers">
                            <?php foreach ($question['answers'] as $aIndex => $answer): ?>
                                <div class="answer" data-answer-id="<?php echo htmlspecialchars($answer['id']); ?>">
                                    <div class="form-group">
                                        <label>Option:</label>
                                        <input type="text" class="form-control" name="questions[<?php echo $qIndex; ?>][answers][<?php echo $aIndex; ?>][option]" value="<?php echo htmlspecialchars($answer['options']); ?>" required>
                                    </div>
                                    <div class="form-check">
                                        
                                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="questions[<?php echo $qIndex; ?>][answers][<?php echo $aIndex; ?>][is_correct]" <?php echo $answer['is_correct'] ? 'checked' : ''; ?> onclick="toggleCheckbox(this)">Is Correct</label>
                                        <input type="hidden" name="questions[<?php echo $qIndex; ?>][answers][<?php echo $aIndex; ?>][is_correct_value]" value="<?php echo $answer['is_correct'] ? '1' : '0'; ?>">
                                        <input type="hidden"  name="questions[<?php echo $qIndex; ?>][answers][<?php echo $aIndex; ?>][id]" value="<?php echo htmlspecialchars($answer['id']); ?>">
                                        <button type="button" class="delete-answer btn btn-danger my-2">Delete Answer</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="add-answer btn btn-primary my-2">Add Answer</button>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="add-question" class="btn btn-success my-2">Add Question</button>
            <button type="submit" name="update" class="btn btn-danger my-2">Update Quiz</button>
        </form>
    </div>
                            </div>

    <script>
        let questionCount = <?php echo count($quiz['questions']); ?>;
        let answerCount = [];
        let deletedQuestions = [];
        let deletedAnswers = [];
        <?php foreach ($quiz['questions'] as $qIndex => $question): ?>
            answerCount[<?php echo $qIndex; ?>] = <?php echo count($question['answers']); ?>;
        <?php endforeach; ?>

        document.getElementById('add-question').addEventListener('click', () => {
            const questionsContainer = document.getElementById('questions-container');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <div class="form-group">
                    <label>Question:</label>
                    <input type="text" class="form-control" name="questions[${questionCount}][question]" required>
                    <button type="button" class="delete-question btn btn-danger my-2">Delete Question</button>
                </div>
                <h4>Answers:</h4>
                <div class="answers">
                    <div class="answer">
                        <div class="form-group">
                            <label>Option:</label>
                            <input type="text" class="form-control" name="questions[${questionCount}][answers][0][option]" required>
                        </div>
                        <div class="form-check">
                            
                            <label class="form-check-label"><input type="checkbox" class="form-check-input" name="questions[${questionCount}][answers][0][is_correct]" onclick="toggleCheckbox(this)">Is Correct</label>
                            <input type="hidden" name="questions[${questionCount}][answers][0][is_correct_value]" value="0">
                            <button type="button" class="delete-answer btn btn-danger my-2">Delete Answer</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="add-answer btn btn-primary my-2">Add Answer</button>
            `;
            questionsContainer.appendChild(newQuestion);
            answerCount[questionCount] = 1;
            questionCount++;
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('add-answer')) {
                const questionDiv = event.target.closest('.question');
                const questionIndex = Array.from(document.querySelectorAll('.question')).indexOf(questionDiv);
                if (!answerCount[questionIndex]) {
                    answerCount[questionIndex] = 0;
                }
                const answersContainer = questionDiv.querySelector('.answers');
                const newAnswer = document.createElement('div');
                newAnswer.classList.add('answer');
                newAnswer.innerHTML = `
                    <div class="form-group">
                        <label>Option:</label>
                        <input type="text" class="form-control" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][option]" required>
                    </div>
                    <div class="form-check">
                        
                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][is_correct]" onclick="toggleCheckbox(this)">Is Correct</label>
                        <input type="hidden" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][is_correct_value]" value="0">
                        <button type="button" class="delete-answer btn btn-danger my-2">Delete Answer</button>
                    </div>
                `;
                answersContainer.appendChild(newAnswer);
                answerCount[questionIndex]++;
            }

            if (event.target && event.target.classList.contains('delete-question')) {
                const questionDiv = event.target.closest('.question');
                const questionId = questionDiv.getAttribute('data-question-id');
                if (questionId) {
                    deletedQuestions.push(questionId);
                }
                questionDiv.remove();
            }

            if (event.target && event.target.classList.contains('delete-answer')) {
                const answerDiv = event.target.closest('.answer');
                const answerId = answerDiv.getAttribute('data-answer-id');
                if (answerId) {
                    deletedAnswers.push(answerId);
                }
                answerDiv.remove();
            }
        });

        document.getElementById('quiz-form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                const hiddenInput = checkbox.nextElementSibling.nextElementSibling;
                if (checkbox.checked) {
                    hiddenInput.value = "1";
                } else {
                    hiddenInput.value = "0";
                }
            });
            document.getElementById('deleted_questions').value = JSON.stringify(deletedQuestions);
            document.getElementById('deleted_answers').value = JSON.stringify(deletedAnswers);
        });

        function toggleCheckbox(checkbox) {
            const questionDiv = checkbox.closest('.question');
            const checkboxes = questionDiv.querySelectorAll('.form-check-input');
            checkboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.checked = false;
                    cb.nextElementSibling.nextElementSibling.value = "0";
                }
            });
            const hiddenInput = checkbox.nextElementSibling.nextElementSibling;
            hiddenInput.value = checkbox.checked ? "1" : "0";
        }
    </script>
</body>
</html>
