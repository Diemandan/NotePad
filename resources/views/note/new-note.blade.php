<div>
    <form method="POST" action="/notes">
        @csrf
        <div class="form-group mt-4">
            <input type="text" name="name" placeholder="name your note" class="form-control">
        </div>
        <div class="form-group mt-4">
            <input type="text" name="description" placeholder="description" class="form-control">
        </div>
        <input type="submit" value="send" class="btn btn-success mt-4">
    </form>

</div>
