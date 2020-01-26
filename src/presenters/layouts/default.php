<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.1">
    <style>
        .select2-container .select2-selection--single { height: auto; padding: .625rem .75rem; } .select2-container--default .select2-selection--single .select2-selection__rendered { padding: 0; color: #8898aa; line-height: 24px; font-size: .875rem; } .select2-container--default .select2-selection--single { border: 1px solid #cbe5f4; } .select2-dropdown { color: #8898aa; border-color: #cbe5f4; } .select2-container--default .select2-selection--single .select2-selection__arrow { height: 48px; } .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple { border-color: #cbe5f4; } .select2-container--default .select2-selection--multiple .select2-selection__rendered { display: block; padding: 0 10px; } .select2-container--default .select2-selection--multiple .select2-selection__rendered li { margin: 10px 2px; } .select2-container .select2-search--inline .select2-search__field { margin-top: 0; }
    </style>
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
                    <ul class="navbar-nav ml-lg-auto">
                        <?=Aecodes\AdminPanel\Layouts\View::make('partials/menu', compact('menus'))?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <main class="container py-5">
        <form method="POST" id="destroy_form">
            <?= $globalFormFields ?>
            <input type="hidden" name="_method" value="DELETE">
        </form>

        <?=Aecodes\AdminPanel\Layouts\View::make('partials/flash', compact('flashMessage'))?>

        <div class="row">
            <?= $content ?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script type="module" src="//unpkg.com/@grafikart/drop-files-element"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js"></script>
    <script src="https://demos.creative-tim.com/argon-dashboard/assets/js/argon-dashboard.min.js?v=1.1.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.single-select').select2();

        $(".single-select[multiple]").select2({
            tags: true,
            placeholder: "Select Your options",
            tokenSeparators: [',']
        });
    });
    </script>
</body>
</html>