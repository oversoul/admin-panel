<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <style>.table td, .table th { vertical-align: middle; }</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button
                type="button"
                aria-expanded="false"
                class="navbar-toggler"
                data-toggle="collapse"
                aria-label="Toggle navigation"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php foreach ($menus as $menu): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$menu['url']?>"><?=$menu['name']?></a>
                    </li>
                    <?php endforeach?>
                </ul>
            </div>
        </div>
    </nav>


    <main class="container py-5">
        <h1 class="bd-title"><?=$this->name?></h1>
        <p class="lead"><?=$this->description?></p>

        <?php require __DIR__ . "/../partials/flash.php";?>

        <div>
            <?php foreach ($top_bar as $item): ?>
                <?=$item?>
            <?php endforeach;?>
        </div>
        &nbsp;

        <?php require __DIR__ . "/../partials/form-errors.php";?>

        <div class="row">
            <?=$content?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
</body>
</html>