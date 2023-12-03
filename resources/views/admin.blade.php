
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
    <div class="d-flex justify-content-between align-items-center">
        <h2>Welcome to the Admin Page</h2>
        <a href="add-survey" class="btn btn-primary">
            Add Survey
        </a>
    </div>

        <table id="surveysTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Anket No</th>
                    <th>Anket Adı</th>
                    <th>Bitiş Tarihi</th>
                    <th>Seçenekler</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($surveys as $survey)
                <tr>
                    <td>{{ $survey->id }}</td>
                    <td>{{ $survey->survey_name }}</td>
                    <td>{{ $survey->end_date }}</td>
                    <td>
                    <a href="admin/{{$survey->id}}" class="btn btn-danger" onclick="return confirm('Bu Anketi silmek istediğinizden emin misiniz?')">Sil</a>
                    <a href="edit-survey/{{$survey->id}}" class="btn btn-warning" >Düzenle</a>
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
