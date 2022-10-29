    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css">
        <title>@yield('title')</title>
    </head>

    <body>

        <div class="first">
            <div class="row">
                <div class="col-5">
                    @yield('body')
                </div>
            </div>
        </div>

    </body>

    </html>
