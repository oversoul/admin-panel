<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://demos.creative-tim.com/argon-dashboard/assets/css/argon-dashboard.min.css?v=1.1.1">
    <style>
        .btn:hover { transform: none; }
        .choices__inner, .choices__input { background-color: transparent; }
        .choices__input { margin-bottom: 0; }
        .choices__inner { min-height: 46px; }
        .drop-area { display: flex; min-height: 160px; padding: 10px; position: relative; border-radius: 3px; text-align: center; align-items: center; justify-content: center; border: 2px dashed #ccc; }
        .drop-area strong { display: block; font-weight: 500; font-size: 1.2rem; }
        .drop-area input[type=file] { display: none; }
        .image { width: 300px; position: relative; }
        .image .btn-close { position: absolute; top: 10px; right: 10px; }
        .form-control { transition: none; }
    </style>
    <script>
        function triggerDestroyForm(event, action) {
            const answer = confirm("This action cannot be reversed. are you sure?");
            if (!answer) {
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
                        <?= $view->load('partials/menu') ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <main class="container py-5">
        <form method="POST" id="destroy_form">
            <?= $view->globalFormFields ?>
            <input type="hidden" name="_method" value="DELETE">
        </form>

        <?php $view->load('partials/flash') ?>

        <div class="row">
            <?= $view->content ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v1.9.7/dist/alpine.js" defer></script>
    <script>
    document.querySelectorAll('.single-select').forEach(el => {
        new Choices(el)
    })

    const fields = {
        imageUpload: {
            image: null,
            hideImage() {
                this.image = ''
                this.$refs.file.value = null
            },
            setupImage(field) {
                const file = field.files[0]
                let reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onloadend = () => {
                    this.image = reader.result
                }
            }
        },
    }
    </script>
</body>

</html>