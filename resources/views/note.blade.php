<x-app-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <h4>Your note</h4>
            </div>
        </div>

        <div>
            <x-info.errors />
        </div>

        <form action="/notes/{{ $note->id }}/edit" method="get">
            <x-primary-button style="float:left; line-height: 10px">edit note</x-primary-button>
        </form>

        <x-button>
            <x-slot name="style">float: right;color: white</x-slot>
            <x-slot name="value">delete this note</x-slot>
            {{ '/notes/' . $note->id }}
        </x-button>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="h-60 p-2 text-bg-dark rounded-4 ">
                    <h5 class="mb-3">{{ $note->name }}</h5>
                    <h6 class="mb-3">remind me: {{ $note->remind_at }}</h6>
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <p class="mb-1  opacity-75 text-black text-center text-wrap ">
                            {{ $note->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-signin w-50 m-auto">
            <x-comment-add>{{ $note->id }}</x-comment-add>
        </div>

        <div class="container">
            <div class="table-style">
                <p class="text-center text-muted">All comments</p>

                <div class="list-group w-auto">
                    @foreach ($comments as $comment)
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                            aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <p class="mb-0 opacity-75">{{ $comment->text }}</p>
                                </div>
                                <small class="opacity-50 text-nowrap">{{ $comment->created_at }}</small>
                            </div>
                            <x-button>
                                <x-slot name="style">float: right;line-height: 10px;color: white</x-slot>
                                <x-slot name="value">delete</x-slot>
                                {{ '/notes/' . $note->id . '/comments/' . $comment->id }}
                            </x-button>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
