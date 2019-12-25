<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.1">
    <script>
        function triggerDestroyForm(event, action) {
            const answer = confirm("This action cannot be reversed. are you sure?");
            if ( ! answer ) {
                event.preventDefault();
                return;
            }
            
            const form = document.querySelector('#destroy_form');
            form.action = action;
            form.submit();
        }
    </script>
</head>
<body>


    <div class="header bg-gradient-primary pb-4 pt-4 pt-md-4">
      <nav class="navbar navbar-expand-lg navbar-dark">
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
      </div>
    </div>


    <main class="container py-5">
        <form method="POST" id="destroy_form">
            <input type="hidden" name="_method" value="DELETE">
        </form>
        
        <?php require __DIR__ . "/../partials/flash.php";?>

        <?php require __DIR__ . "/../partials/form-errors.php";?>

        <div class="row">
            <?= $content ?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard/assets/js/argon-dashboard.min.js?v=1.1.1"></script>
</body>
</html>