<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 shadow-lg rounded">
                <?=$view->content;?>
            </div>

            <div class="d-flex justify-content-center">
                <div class="w-50">
                    <div class="col">
                        <?=$view->load('partials/flash');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>