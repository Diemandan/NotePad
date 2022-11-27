<x-app-layout>

    <div class="container">
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
                            <input type="hidden" name="remind_at" value="{{ $note->remind_at }}">

                            <div class="form-group mt-4">
                                <input type="text" name="name" value="{{ $note->name }}" class="form-control">
                            </div>

                            <div class="form-group mt-4">
                                <input type="text" name="description" value="{{ $note->description }}"
                                    class="form-control">
                            </div>

                            <div class="form-floating">
                                <select class="form-select form-select-lg mb-3" name="priority" id="priority">
                                    <option value="high">high</option>
                                    <option value="medium">medium</option>
                                    <option value="low" selected>low</option>
                                </select>
                                <label for="priority">Priority of note</label>
                            </div>

                            <input type="submit" value="Save" class="btn btn-success mt-4">
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
