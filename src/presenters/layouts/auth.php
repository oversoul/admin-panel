<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.1">
</head>
<body class="bg-default">

    <main class="container py-5">

        <div class="w-50 mx-auto mb-5">
            <?= $view->content ?>
        </div>

        <div class="d-flex justify-content-center">
            <div class="w-50">
                <div class="col">
                    <?= $view->partial('partials/flash') ?>
                </div>
            </div>
        </div>

    </main>
</body>
</html>