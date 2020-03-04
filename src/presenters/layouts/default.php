<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .choices__inner, .choices__input { background-color: transparent; }
        .choices__input { margin-bottom: 0; }
        .choices__inner { min-height: 46px; }
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

<body class="text-gray-700">
    <nav class="bg-gray-700">
        <div class="container max-w-7xl mx-auto">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-white">
                        AdminPanel
                    </div>
                    <div class="block">
                        <div class="ml-10 flex items-baseline">
                            <?=$view->load('partials/menu');?>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="ml-3 relative">
                            <a
                                href="javascript:{}"
                                class="text-sm font-medium text-gray-300"
                                onclick="triggerDestroyForm(event, '<?=$config->logoutUrl();?>')">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <header class="bg-white shadow flex justify-center">
        <div class="container">
            <div class="max-w-7xl mx-auto py-6">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-3xl font-bold leading-tight text-gray-700">
                            <?=$view->page->name;?>
                        </h2>
                        <h3 class="text-gray-600"><?=$view->page->description;?></h3>
                    </div>
                    <?=$view->load('partials/top-bar');?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-4 sm:px-0">
                <div class="h-96">
                    <form method="POST" id="destroy_form">
                        <?=$view->globalFormFields;?>
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    <div class="flex justify-center">
                        <div class="container">
                            <?php $view->load('partials/flash') ?>
                            <?=$view->content;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.2/dist/alpine.js" defer></script>
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
        imagesUpload: {
            images: [],
            hideImage(index) {
                this.images.splice(index, 1)
            },
            setupImage(field) {
                const files = Array.from(field.files)

                files.map(file => {
                    let reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onloadend = () => {
                        this.images.push(reader.result)
                    }
                })
            }
        },
    }
    </script>
</body>

</html>