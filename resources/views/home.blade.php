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
        <div style="position: absolute; top:100px; left:750px; display: flex;gap:10px"><a href="/?sort=desc" class="btn btn-outline-dark btn-sm" aria-current="page">Показать новые</a>
        <a href="/?sort=asc" class="btn btn-outline-dark btn-sm">показать старые</a></div>
        <div class=" p-5" style="background-color: rgb(206, 204, 204); ">
            @foreach ($notes as $note)
                <div class="row justify-content-center mt-2">

                    <div class="col-md-6" style="position: relative;">
                        <div class="h-60 p-2 text-bg-dark rounded-4">
                            <h5 class="mb-3">{{ $note->name }}</h5>
                            <div style="position: absolute; top:7px; left:370px; "><h5 >comments: {{ $note->comments->count() }}</h5></div>

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
