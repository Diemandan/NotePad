<x-app-layout>
    <div class="form-group mt-4">

        <div>
            <x-info.errors />
        </div>

        <div style="position: relative">
            <form action="/create" method="get">
                <x-primary-button style="float:left; line-height: 30px">Create note</x-primary-button>
            </form>

            <x-button style="float: right">
                <x-slot name="style">float: right;color: red</x-slot>
                <x-slot name="value">delete All Notes</x-slot>
                all
            </x-button>
        </div>
        <div class="primer1" style="position: relative; top: 120px; left: -20px;">


            @foreach ($notes as $note)
                <div class="primer1-marg">
                    <li class="table-style">{{ $note->name }}
                        <form action="/notes/{{ $note->id }}" method="get" target="_blank">
                            <x-primary-button style="float:left; line-height: 10px">open note</x-primary-button>
                        </form>
                        <x-button>
                            <x-slot name="style">float: right;line-height: 10px;color: red</x-slot>
                            <x-slot name="value">delete</x-slot>
                            {{ $note->id }}
                        </x-button>
                    </li>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
