<x-app-layout>
    <div class="form-group mt-4">



        <h1 style="font-size: 25px">New note</h1>
        <div>
            <x-info.errors />
        </div>
        <div>
            <x-note.new-note />
        </div>
        <div class="primer1">
            <h2>History of my notes</h2>

            @foreach ($notes as $note)
                <div class="primer1-marg">
                    <li class="table-style">{{ $note->name }} <p>
                            {{ $note->description }}</p>

                            <x-button>{{$note->id}}</x-button>
                    </li>
                </div>
            @endforeach
        </div>
        
    </div>
</x-app-layout>
