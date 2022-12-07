<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>



    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="/"></use>
                </svg>
                <span class="fs-3">Your notepad</span>
            </a>

            <ul class="nav nav-pills" style="display: flex;gap:10px">
                <li class="nav-item"><a href="/complaints" class="nav-link active" aria-current="page">Complaint to admin</a></li>

                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownmenu"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Save as ..
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownmenu">
                        <a class="dropdown-item" href="/notes/txt">Save notes as TXT</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/notes/excel">save all notes as XLSX</a>
                    </div>
                </div>
                <div class="mt-2 space-y-3">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')"
                                onclick="event.preventDefault();
                            this.closest('form').submit();">
                                Log Out</a>

                        </form>
                    </li>
                </div>
            </ul>
        </header>
    </div>


    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
</body>

</html>
