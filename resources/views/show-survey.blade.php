<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

@include('navbar')

<div class="container mt-4">
    <h3>{{ $survey->survey_name }}</h3>

    <form method="POST" action="{{ route('answer') }}">
        @csrf
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Soru No</th>
                <th>Soru</th>
                <th>Cevap</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $isSelected = false;
                                foreach ($answers as $answer) {
                                    if ($question->id == $answer->question_id && $answer->answer == $i) {
                                        $isSelected = true;
                                        break;
                                    }
                                }
                            @endphp

                            <label class="radio-inline">
                                <input type="radio" name="answers[{{ $question->id }}]" {{ $isSelected ? 'checked' : '' }} disabled>
                                @php
                                    switch ($i) {
                                        case 1:
                                            $result = 'Kesinlikle Katılıyorum';
                                            break;
                                        case 2:
                                            $result = 'Katılıyorum';
                                            break;
                                        case 3:
                                            $result = 'Kararsızım';
                                            break;
                                        case 4:
                                            $result = 'Katılmıyorum';
                                            break;
                                        case 5:
                                            $result = 'Kesinlikle Katılmıyorum';
                                            break;
                                        default:
                                            $result = 'Geçersiz değer';
                                    }

                                    echo $result;
                                @endphp
                            </label>
                        @endfor
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="../../dashboard" class="btn btn-warning">Back To Survey Page</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>