<x-app-layout>

    <div class="container">


        <div>
            <x-info.errors />
        </div>


        <form action="/create" method="GET">
            <input style="float: left;color: white" type="submit" value="Create new note" class="btn btn-info  mt-0">
        </form>

        <x-button>
            <x-slot name="style">float: right;color: white</x-slot>
            <x-slot name="value">delete All Notes</x-slot>
            notes/all
        </x-button>


        <div style="position: absolute; top:100px; left:900px; display: flex;gap:10px">
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">
                    Сортировать <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/?sort=desc">Показать новые</a><div class="dropdown-divider"></div></li>
                    <li><a class="dropdown-item" href="/?sort=asc">показать старые</a><div class="dropdown-divider"></div></li>
                    <li><a class="dropdown-item" href="/?priority=low">низкий приоритет</a><div class="dropdown-divider"></div></li>
                    <li><a class="dropdown-item" href="/?priority=medium">средний приоритет</a><div class="dropdown-divider"></div></li>
                    <li><a class="dropdown-item" href="/?priority=high">высокий приоритет</a></li>
                </ul>
            </div>
        </div>
        <div class=" p-5" style="background-color: rgb(206, 204, 204); ">
            @foreach ($notes as $note)
                <div class="row justify-content-center mt-2">

                    <div class="col-md-6" style="position: relative;">
                        <div class="h-60 p-2 text-bg-dark rounded-4">
                            <h5 class="mb-3">{{ $note->name }}</h5>
                            <div style="position: absolute; top:7px; left:380px; ">
                                <h5 class="btn btn-primary btn-sm">comments:<span class="badge bg-secondary">
                                        {{ $note->comments->count() }}</span></h5>
                            </div>
                            <div class="badge rounded-pill bg-success "
                                style="position: absolute; top:70px; left:520px; ">
                                <h5>Priority: {{ $note->priority }}</h5>
                            </div>

                            <form action="/notes/{{ $note->id }}" method="get">
                                <x-primary-button style="float:left; line-height: 10px">open note</x-primary-button>
                            </form>
                            <form action="/notes/{{ $note->id }}/comments" method="GET">
                                @csrf
                                <x-primary-button style="float:left;line-height: 10px">make comment</x-primary-button>
                            </form>
                            <x-button>
                                <x-slot name="style">float: right;line-height: 10px;color: white</x-slot>
                                <x-slot name="value">delete</x-slot>
                                {{ '/notes/' . $note->id }}
                            </x-button>
                            <div class="h-100 p-5 bg-light border rounded-3">
                                <p class="mb-1  opacity-75 text-black text-center text-wrap ">
                                    {{ $note->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
