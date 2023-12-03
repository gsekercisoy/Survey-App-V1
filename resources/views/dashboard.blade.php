
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
</head>
<body>

@include('navbar')

    <div class="container mt-4">
        <h2>Welcome to Dashboard</h2>

        <table id="surveysTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Anket No</th>
                    <th>Anket Adı</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($surveys as $survey)
                <tr>
                    <td>{{ $survey->id }}</td>
                    <td>{{ $survey->survey_name }}</td>
                    <td>
                        @php
                            $userSurveyStatus = \App\Models\UserSurveyStatus::where('user_id', auth()->user()->id)
                                ->where('survey_id', $survey->id)
                                ->first();
                        @endphp

                        @if ($userSurveyStatus && $userSurveyStatus->question_status === 0)
                            Anket tamamlandı
                            <!-- Add anchor tag to show answers -->
                            <a href="survey/show/{{ $survey->id }}" class="btn btn-info">Cevapları Gör</a>
                        @elseif (strtotime($survey->end_date) < strtotime(now()))
                            Anket süresi doldu
                        @else
                            <a href="survey/{{ $survey->id }}" class="btn btn-success">Başla</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#surveysTable').DataTable();
        });
    </script>

</body>
</html>
