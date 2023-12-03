<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Anket Güncelle</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
</head>

<body class="container mt-5">
@include('navbar')
    <h1 class="mb-4">Anket Güncelle</h1>
    <form method="POST" action="{{ route('update.survey', $survey->id) }}" class="mb-4">
        @csrf

        <div class="form-group">
            <label for="survey_name">Anket Başlığı:</label>
            <input type="text" name="survey_name" class="form-control" value="{{ $survey->survey_name }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Bitiş Tarihi:</label>
            <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime($survey->end_date)) }}" required>
        </div>

        <div id="questions" class="mb-4">
            @php
                $i=1;
            @endphp
            @foreach($questions as $question)
                <div class="question form-group row">
                    <div class="col-1">
                    <label for="question">{{$i}}. Soru:</label>
                    </div>
                    <div class="col-10">
                        <textarea name="questions[]" class="form-control" required>{{ $question->question }}</textarea>
                    </div>
                    <div class="col-1">
                        <button id="question_{{$question->id}}" type="button" onclick="removeQuestionAjax({{$question->id}})" class="btn btn-danger">Delete</button>
                    </div>

                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>

        <div class="mb-4 row">
            <div class="col-2">
                <button type="button" onclick="addQuestion()" class="btn btn-primary mb-2">Soru Ekle</button>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success">Anketi Güncelle</button>
            </div>
            <div class="col-2">
                <a href="../admin" class="btn btn-warning">Geri Dön</a>
            </div>
        </div>
    </form>

    <script>
    function addQuestion() {
        var questionsDiv = document.getElementById('questions');
        var questionDiv = document.createElement('div');
        questionDiv.className = 'question form-group row';

        var labelDiv = document.createElement('div');
        labelDiv.className = 'col-1';

        var label = document.createElement('label');
        label.textContent = (questionsDiv.children.length +1) + '. Soru:';

        labelDiv.appendChild(label);
        questionDiv.appendChild(labelDiv);

        var textareaDiv = document.createElement('div');
        textareaDiv.className = 'col-10';

        var textarea = document.createElement('textarea');
        textarea.name = 'questions[]';
        textarea.className = 'form-control';
        textarea.required = true;

        textareaDiv.appendChild(textarea);
        questionDiv.appendChild(textareaDiv);

        var buttonDiv = document.createElement('div');
        buttonDiv.className = 'col-1';

        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Delete';
        deleteButton.className = 'btn btn-danger';

        buttonDiv.appendChild(deleteButton);
        questionDiv.appendChild(buttonDiv);

        questionsDiv.appendChild(questionDiv);
    }
    function removeQuestionAjax(questionId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'POST',
        url: '/remove-question',
        data: {
            _token: csrfToken, 
            question_id: questionId
        },
        success: function (response) {
            console.log(response);
            removeQuestion(document.getElementById('question_' + questionId));
        },
        error: function (error) {
            console.log(error);
        }
    });
}

    function removeQuestion(element) {
        element.parentNode.parentNode.remove();
    }

</script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
