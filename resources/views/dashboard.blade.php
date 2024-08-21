<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h1>Dashboard</h1>
                    <a href="{{route('logout')}}" class="btn btn-danger">Logout</a>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">Welcome, {{ Auth::user()->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p>This is your dashboard. Here you can manage employees and departments</p>
                        <a href="{{url('employees')}}" class="btn btn-primary">Employee</a>
                        <a href="{{url('departments')}}" class="btn btn-primary">Department</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
