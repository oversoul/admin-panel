<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.1">
    <style>
    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    form {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    form .checkbox { font-weight: 400; }
    form .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    form .form-control:focus {
        z-index: 2;
    }
    form input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    form input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    </style>
</head>
<body>

    <main class="container py-5">
        <div class="text-center">
            <h1 class="bd-title"><?=$this->name?></h1>
            <p class="lead"><?=$this->description?></p>
        </div>

        <?=$content?>

        <div class="d-flex justify-content-center">
            <div class="w-50">
                <?php require __DIR__ . "/../partials/flash.php"; ?>
                <?php require __DIR__ . "/../partials/form-errors.php"; ?>
            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
</body>
</html>