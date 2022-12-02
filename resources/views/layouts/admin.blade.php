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

    <div>
        <x-info.errors />
    </div>

    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="/"></use>
                </svg>
                <span class="fs-3">Your notepad</span>
            </a>

            <ul class="nav nav-pills" style="display: flex;gap:10px">
                <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Home</a></li>


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
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Users of notes {{ $users->count() }}</h6>

        @foreach ($users as $user)
            <div class="d-flex text-muted pt-3" style="position: relative;">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                    preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%"
                        fill="#007bff" dy=".3em">32x32</text>
                </svg>


                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">{{ $user->name }}</strong>

                        @if ($user->is_active)
                            <div class="form-check form-switch"
                                style="position: absolute; top:16px; left:600px; display: flex;gap:10px">
                                <form action="/admin/status" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="userId" value={{ $user->id }}>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>
                                    <button type="submit" name="status" value="0"
                                        class="btn btn-primary btn-sm">Disactivate user</button>
                                </form>
                            </div>
                        @else
                            <div class="form-check form-switch"
                                style="position: absolute; top:16px; left:600px; display: flex;gap:10px">
                                <form action="/admin/status" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="userId" value={{ $user->id }}>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Not Active</label>
                                    <button type="submit" name="status" value="1"
                                        class="btn btn-primary btn-sm">Activate</button>
                                </form>
                            </div>
                        @endif


                    </div>
                    <span class="d-block">{{ $user->email }}</span>
                </div>
                <x-button>
                    <x-slot name="style">float: right;line-height: 10px;color: white</x-slot>
                    <x-slot name="value">delete user</x-slot>
                    {{ '/admin/' . $user->id }}
                </x-button>


            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
</body>

</html>
