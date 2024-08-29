<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 200px; /* Width of the sidebar */
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center">Dashboard</h4>
            <a href="#">Home</a>
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="#">Reports</a>
            <a href="#">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Loop through the boards and display them -->
                    @if(isset($boards) && count($boards) > 0)
                        @foreach($boards as $board)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $board['name'] }}</h5>
                                        <p class="card-text">{{ $board['desc'] ?? 'No description available' }}</p>
                                        <a href="{{ $board['url'] }}" class="btn btn-primary">View Board</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="alert alert-info">No boards available.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
