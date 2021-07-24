<!DOCTYPE html>
<html>
<head>
    <title>Meetings List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="mx-2">
    <div class="row">


        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Meetings</strong></h3>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Host Id</th>
                    <th>Topic</th>
                    <th>Type</th>
                    <th>Start Time</th>
                    <th>Duration</th>
                    <th>Timezone</th>
                    <th>Agenda</th>
                    <th>created At</th>
                    <th>Link to join</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $meeting)
                <tr>
                    <td>{{ $meeting->id }}</td>
                    <td>{{ $meeting->host_id }}</td>
                    <td>{{ $meeting->topic }}</td>
                    <td>{{ $meeting->type }}</td>
                    <td>{{ $meeting->start_time }}</td>
                    <td>{{ $meeting->duration }}</td>
                    <td>{{ $meeting->timezone }}</td>
                    <td>{{ $meeting->agenda }}</td>
                    <td>{{ $meeting->created_at }}</td>
                    <td>{{ $meeting->join_url }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $('.data-table').DataTable({});
</script>
</html>
