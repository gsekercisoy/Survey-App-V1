<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Anket Ekle</h1>
    <form method="POST" action="{{ route('survey.store') }}" class="mb-4">
        @csrf

        <div class="form-group">
            <label for="survey_name">Anket Başlığı:</label>
            <input type="text" name="survey_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_date">Bitiş Tarihi:</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div id="questions" class="mb-4">
            <div class="question">
                <label for="question">Soru:</label>
                <textarea name="questions[]" class="form-control" required></textarea>
            </div>
        </div>
        <div id="questions" class="mb-4 row ">
            <div class="col-2">
                <button type="button" onclick="addQuestion()" class="btn btn-primary mb-2">Soru Ekle</button>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success">Anketi Ekle</button>
            </div>
        </div>


    </form>

    <script>
        function addQuestion() {
            var questionsDiv = document.getElementById('questions');
            var questionDiv = document.createElement('div');
            questionDiv.className = 'question form-group';

            var label = document.createElement('label');
            label.textContent = 'Soru:';
            questionDiv.appendChild(label);

            var textarea = document.createElement('textarea');
            textarea.name = 'questions[]';
            textarea.className = 'form-control';
            textarea.required = true;
            questionDiv.appendChild(textarea);

            questionsDiv.appendChild(questionDiv);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
