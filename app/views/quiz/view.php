<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>View Results</title>
    <style>
    .logo {
            width: 20px;
            height: 30px;
    }
    .star-rating {
    display: inline-block;
    unicode-bidi: bidi-override;
    color: #c5c5c5;
    font-size: 30px;
    height: 30px;
    width: auto;
    margin: 0;
    position: relative;
}

.star-rating > input {
    display: none;
}

.star-rating > label {
    float: left; /* Change from float: right to float: left */
    color: #c5c5c5; /* Default color */
    cursor: pointer; /* Added cursor pointer for better UX */
}

.star-rating > label:before {
    content: '★';
    margin-right: 5px;
}

.star-rating > input:checked ~ label {
    color: #ffd700; /* Yellow color for selected stars */
}

.star-rating > input:checked + label:hover:before,
.star-rating > input:checked ~ label:hover:before {
    color: #ffd700; /* Yellow color on hover for selected stars */
}
@media (max-width: 508px) {
.action {
    flex-direction:column;
    justify-conten:center;
    align-items:center;
}
.action > * {
    margin-bottom:5px;
}
*{
    font-size:10px
}
}

    </style>
</head>
<body>
    
    <h1 class="text-center my-3">View Results</h1>
    <div class="container">
        <?php if (isset($data['results']) && count($data['results']) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Quiz Level</th>
                        <th>Score</th>
                        <th>Date Taken</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['results'] as $result):?>
                        <tr>
                            <td><?php echo htmlspecialchars($result['title']); ?></td>
                            <td>Level <?php echo htmlspecialchars($result['level']); ?></td>
                            <td><?php echo htmlspecialchars($result['score'].'/'.$result['total_questions']); ?></td>
                            <td><?php echo htmlspecialchars($result['date_taken']); ?></td>
                            <td class="d-flex action justify-content-center">
                                <div>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reg-modal">Give Review</button>
                                </div>
                                <form method="post" class="d-flex action justify-content-end">
                                    <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                                    <input type="hidden" name="quiz_id" value="<?php echo $result['quiz_id']; ?>">
                                    <button type="submit" class="btn btn-success mx-2" name="show">Show Correct Answer</button>
                                    <button type="submit" class="btn btn-danger " name="delete">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
    <div class="m-3">
        <a href="/Concursonaire/public/dashboard" class="btn text-white btn-primary">Back to Dashboard</a>
    </div>

    <?php if (isset($data['review']) && $data['review'] == 0): ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="../../../public/images/logo.png" class="rounded logo me-2" alt="...">
                    <strong class="me-auto">Concursonaire</strong>
                    <small>1 min ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body d-flex justify-content-between align-items-center">
                    Click here to give review
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#reg-modal">RATE</button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Modal -->
    <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="reg-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post"> <!-- Replace with actual path to handle form submission -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reg-modal-label">Review for Quiz</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Give Rating</label>
                            <div class="star-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <input type="radio" id="rating<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" />
                                    <label for="rating<?php echo $i; ?>"></label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="review-text" class="form-label">Review Text</label>
                            <textarea class="form-control" id="review-text" name="review_text" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submitReview" class="btn btn-primary">Submit Review</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script to trigger the toast -->
    <?php if (isset($data['review']) && $data['review'] == 0): ?>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const toastLiveExample = document.getElementById('liveToast');
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            });
        </script>
    <?php endif; ?>

    <!-- JavaScript to handle star rating -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const starInputs = document.querySelectorAll('.star-rating > input');
            starInputs.forEach(input => {
                input.addEventListener('click', function () {
                    // Reset all stars to default color
                    const labels = input.parentElement.querySelectorAll('label');
                    labels.forEach(label => label.style.color = '#c5c5c5');

                    // Set selected star and preceding stars to yellow color
                    let current = input;
                    while (current) {
                        const label = current.nextElementSibling;
                        if (label) {
                            label.style.color = '#ffd700';
                        }
                        current = current.previousElementSibling;
                    }
                });
            });
        });
    </script>
</body>
</html>
