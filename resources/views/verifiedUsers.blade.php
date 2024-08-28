<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Users List</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <img src="<?= $user->avatar ? $user->avatar : 'https://via.placeholder.com/50' ?>" alt="<?= htmlspecialchars($user->name) ?>" class="avatar">
                            </td>
                            <td><?= htmlspecialchars($user->name) ?></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td><?= (new DateTime($user->created_at))->format('d M Y') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
