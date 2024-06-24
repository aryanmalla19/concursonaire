<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css"> 
    <link rel="stylesheet" href="../../public/css/create.css"> 
    <link rel="stylesheet" href="../../public/css/dashboard.css"> 

    <title>Create Quiz</title>
</head>
<body>
    <div class="d-flex main">
    <?php include "../app/views/dashboard/sidebar.php"; ?>
        <div class="container">
            <h1 class="text-center font-main my-4">Create a new Quiz</h1>
            <form id="quiz-form" action="create" method="POST">
                <input type="text" hidden id="title" name="user_id" value="<?php echo $_SESSION['user_id'] ?>" required>
                <div class="form-group">
                    <label for="title">Quiz Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Quiz Description:</label>
                    <textarea type="text" class="form-control" id="subject" rows=5 name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
    
                <div class="form-group">
                    <label for="level">Level:</label>
                    <select name="level" class="form-select" aria-label="Default select example">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <br>
                <h3>Questions:</h3>
                <div id="questions-container">
                    <div class="question">
                        <div class="form-group">
                            <label>Question:</label>
                            <input type="text" class="form-control" name="questions[0][question]" required>
                        </div>
                        <h4>Answers:</h4>
                        <div class="answers">
                            <div class="answer">
                                <div class="form-group">
                                    <label>Option:</label>
                                    <input type="text" class="form-control" name="questions[0][answers][0][option]" required>
                                    <!-- Delete button for answers (not stored in database yet) -->
                                    </div>
                                    <div class="form-check">
                                        
                                        <label class="form-check-label"> <input type="checkbox" class="form-check-input" name="questions[0][answers][0][is_correct]" onclick="toggleCheckbox(this)">Is Correct</label>
                                        <input type="hidden" name="questions[0][answers][0][is_correct_value]" value="0">
                                        <button type="button" class="delete-answer btn btn-danger">Delete Answer</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="add-answer btn btn-primary my-2">Add Answer</button>
                        <!-- Remove button for questions (not stored in database yet) -->
                        <button type="button" class="delete-question btn btn-danger my-2">Delete Question</button>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="button" id="add-question" class="btn btn-success">Add Question</button>
                    <button type="submit" class="btn btn-danger">Create Quiz</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let questionCount = 1;
        let answerCount = [1];

        document.getElementById('add-question').addEventListener('click', () => {
            const questionsContainer = document.getElementById('questions-container');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <div class="form-group">
                    <label>Question:</label>
                    <input type="text" class="form-control" name="questions[${questionCount}][question]" required>
                </div>
                <h4>Answers:</h4>
                <div class="answers">
                    <div class="answer">
                        <div class="form-group">
                            <label>Option:</label>
                            <input type="text" class="form-control" name="questions[${questionCount}][answers][0][option]" required>
                            <!-- Delete button for answers (not stored in database yet) -->
                            </div>
                            <div class="form-check">
                            <label class="form-check-label"><input type="checkbox" class="form-check-input" name="questions[${questionCount}][answers][0][is_correct]" onclick="toggleCheckbox(this)">Is Correct</label>
                            <input type="hidden" name="questions[${questionCount}][answers][0][is_correct_value]" value="0">
                            <button type="button" class="delete-answer btn btn-danger">Delete Answer</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="add-answer btn btn-primary my-2">Add Answer</button>
                <!-- Remove button for questions (not stored in database yet) -->
                <button type="button" class="delete-question btn btn-danger my-2">Delete Question</button>
            `;
            questionsContainer.appendChild(newQuestion);
            answerCount[questionCount] = 1;
            questionCount++;
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('add-answer')) {
                const questionDiv = event.target.closest('.question');
                const questionIndex = Array.from(document.querySelectorAll('.question')).indexOf(questionDiv);
                const answersContainer = questionDiv.querySelector('.answers');
                const newAnswer = document.createElement('div');
                newAnswer.classList.add('answer');
                newAnswer.innerHTML = `
                    <div class="form-group">
                        <label>Option:</label>
                        <input type="text" class="form-control" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][option]" required>
                        <!-- Delete button for answers (not stored in database yet) -->

                    </div>
                    <div class="form-check">
                        
                        <label class="form-check-label"><input type="checkbox" class="form-check-input" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][is_correct]" onclick="toggleCheckbox(this)">Is Correct</label>
                        <input type="hidden" name="questions[${questionIndex}][answers][${answerCount[questionIndex]}][is_correct_value]" value="0">
                        <button type="button" class="delete-answer btn btn-danger">Delete Answer</button>
                        </div>
                `;
                answersContainer.appendChild(newAnswer);
                answerCount[questionIndex]++;
            } else if (event.target && event.target.classList.contains('delete-question')) {
                const questionDiv = event.target.closest('.question');
                questionDiv.remove();
                // Optionally, you can update indexes if you need to maintain them
            } else if (event.target && event.target.classList.contains('delete-answer')) {
                const answerDiv = event.target.closest('.answer');
                answerDiv.remove();
                // Optionally, you can update indexes if you need to maintain them
            }
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
