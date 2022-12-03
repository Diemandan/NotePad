<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    </head>

    <body>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">Go home</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
                aria-label="Search">
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link px-3" href="route('logout')"
                            onclick="event.preventDefault();
            this.closest('form').submit();">
                            Log Out</a>

                    </form>

                </div>
            </div>
        </header>

        <div>
            <x-info.errors />
        </div>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">

                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Show all customer users</span>
                                <a class="link-secondary" href="/admin" aria-label="Add a new report">
                                    <span data-feather="plus-circle" class="align-text-bottom"></span>
                                </a>
                            </h6>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/admin">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Customer users
                                </a>
                            </li>

                            <h6
                                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                                <span>Show all notifications</span>
                                <a class="link-secondary" href="#" aria-label="Add a new report">
                                    <span data-feather="plus-circle" class="align-text-bottom"></span>
                                </a>
                            </h6>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/notifications">
                                    <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                                    Notifications
                                </a>
                            </li>
                        </ul>

                        <h6
                            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                            <span>Show all messages from users</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle" class="align-text-bottom"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span data-feather="file-text" class="align-text-bottom"></span>
                                    messages
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

                {{ $slot }}

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
        </script>
    </body>

</html>
