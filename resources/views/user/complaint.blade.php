<x-app-layout>
    <main class="form-signin w-50 m-auto">
        <form action="/complaints" method="POST">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Write your problem</h1>

            <div class="form-floating">
                <input type="hidden" name="userId" value="{{ Auth()->id() }}">
            </div>

            

            <div class="form-floating">
                <input type="text" class="form-control" id="complaint" name="complaint">
                <label for="complaint">complaint</label>
            </div>
        
            <button class="w-100 btn btn-lg btn-primary" type="submit">Send complaint</button>

        </form>

    </main>
</x-app-layout>