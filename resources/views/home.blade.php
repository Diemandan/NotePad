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
            
            <x-button>
                <x-slot name="style">float: right;color: red</x-slot>
                <x-slot name="value">delete All Notes</x-slot>
                    all</x-button>

            @foreach ($notes as $note)
                <div class="primer1-marg">
                    <li class="table-style">{{ $note->name }} 
                        <form action="/note/{{$note->id}}" method="get" target="_blank">
                        <x-primary-button style="float:left; line-height: 10px">open note</x-primary-button>
                        </form>
                            <x-button>
                                <x-slot name="style">float: right;line-height: 10px;color: red</x-slot>
                            <x-slot name="value">delete</x-slot>
                                {{$note->id}}</x-button>
                    </li>
                </div>
            @endforeach
        </div>
        
    </div>
</x-app-layout>
