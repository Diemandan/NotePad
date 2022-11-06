<x-app-layout>
    <div class="form-group mt-4">



        <h1 style="font-size: 25px">Edit Your note {{ $note->name }}</h1>
        <div>
            <x-info.errors />
        </div>

        <div class="primer1">



            <x-button>
                <x-slot name="style">float: right;color: red</x-slot>
                <x-slot name="value">delete this note</x-slot>
                {{ $note->id }}
            </x-button>

            <div class="table-style">

                <div>
                    <form method="POST" action="/notes">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="note_id" value="{{ $note->id }}">
                        <div class="form-group mt-4">
                            <input type="text" name="name" value="{{ $note->name }}" class="form-control">
                        </div>
                        <div class="form-group mt-4">
                            <input type="text" name="description" value="{{ $note->description }}"
                                class="form-control">
                        </div>

                        <input type="submit" value="Save" class="btn btn-success mt-4">
                    </form>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>
