<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@creative-tim-official/argon-dashboard-free@1.1.0/assets/css/argon-dashboard.css">
</head>
<body class="bg-default">

    <main class="container py-5">

        <div class="w-50 mx-auto mb-5">
            <?= $view->content ?>
        </div>

        <div class="d-flex justify-content-center">
            <div class="w-50">
                <div class="col">
                    <?= $view->load('partials/flash') ?>
                </div>
            </div>
        </div>

    </main>
</body>
</html>