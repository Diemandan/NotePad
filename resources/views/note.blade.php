<x-app-layout>
    <div class="form-group mt-4">



        <h1 style="font-size: 25px">Your note {{ $note->name }}</h1>
        <div>
            <x-info.errors />
        </div>

        <div class="primer1">


            <x-button>
                <x-slot name="style">float: right;color: red</x-slot>
                <x-slot name="value">delete this note</x-slot>
                {{ $note->id }}
            </x-button>


            <div class="primer1-marg">
                <li class="table-style">{{ $note->name }}

                </li>

            </div>

            <div class="primer1-marg">
                <li class="table-style">{{ $note->description }}
                    <form action="/notes/{{ $note->id }}/edit" method="get">
                        <x-primary-button style="float:right; line-height: 10px">edit note</x-primary-button>
                    </form>

                </li>

            </div>

        </div>

    </div>
</x-app-layout>
