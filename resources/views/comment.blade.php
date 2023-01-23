<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Simple header</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
        </header>
    </div>


    


    <div class="container">

      <div >
        <x-info.errors />
      </div>

        <main class="form-signin w-50 m-auto">
            <form action="/notes/{id}/comments" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please comment</h1>

                <div class="form-floating">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                </div>

                <div class="form-floating">
                    <input type="hidden" name="note_id" value="{{ $note_id }}">
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="comment" name="text">
                    <label for="comment">Comment</label>
                </div>
            
                <button class="w-100 btn btn-lg btn-primary" type="submit">Save comment</button>

            </form>

        </main>
    </div>


    <div class="container">
        <p class="text-center text-muted">All comments</p>

        <div class="list-group w-auto">
            @foreach ($comments as $comment)
                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <p class="mb-0 opacity-75">{{ $comment->text }}</p>
                        </div>

                       
                        <small class="opacity-50 text-nowrap">{{$comment->created_at}}</small>
                    </div>
                    <x-button>
                        <x-slot name="style">float: right;line-height: 10px;color: white</x-slot>
                        <x-slot name="value">delete</x-slot>
                        {{'/notes/'. $note_id . '/comments/' . $comment->id }}
                    </x-button>
                </a>
            @endforeach
        </div>
    </div>
</body>

</html>
