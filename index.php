<?php 
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {   
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Multi-User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color:#106EBE;
            margin: 0;
            height: 100vh;
        }
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }
        .form-title {
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Login</h2>
            <form action="check-login.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_GET['error'] ?>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
} else {
    header("Location: redirect.php");
} 
?>