
   <x-app-layout>
   <div class="form-group mt-4">
        

        <h2>New note</h2>
        <div><x-info.errors/></div>
        <div><x-note.new-note/></div>

        <h2>History of my notes</h2>

        @foreach ($notes as $note)
            <div class="marg">
                <li class="table-style">{{ $note->name }} <p>
                        {{ $note->description }}</p>
                </li>
            </div>
        @endforeach
    </div>

</x-app-layout>
