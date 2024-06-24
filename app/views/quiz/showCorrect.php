<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['title']); ?> - Quiz</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .quiz-container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .question {
            margin-bottom: 20px;
        }
        .answers {
            list-style-type: none;
            padding: 0;
        }
        .answers li {
            margin-bottom: 10px;
        }
        .correct {
            color: green;
            font-weight: bold;
        }
        .quiz-title {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .quiz-description {
            font-size: 1.1em;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1 class="quiz-title"><?php echo htmlspecialchars($data['title']); ?></h1>
        <p class="quiz-description"><?php echo htmlspecialchars($data['description']); ?></p>
        
        <?php foreach ($data['questions'] as $question): ?>
            <div class="question">
                <h4><?php echo htmlspecialchars($question['questionText']); ?></h4>
                <ul class="answers list-group">
                    <?php foreach ($question['answers'] as $answer): ?>
                        <li class="list-group-item <?php echo $answer['is_correct'] ? 'correct' : ''; ?>">
                            <?php echo htmlspecialchars($answer['options']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
