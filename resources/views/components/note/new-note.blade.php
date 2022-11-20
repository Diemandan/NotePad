

<div class="container">
<div>
  <x-info.errors />
</div>

    <main class="form-signin w-50 m-auto">
        <form method="POST" action="/notes">
            @csrf
        <h1 class="h3 mb-3 fw-normal">Please write your new note</h1>
    
        <div class="form-floating">
          <input type="text" name="name" id="name your note" class="form-control">
          <label for="comment">name your note</label>
        </div>
  
        <div class="form-floating">
            <input type="text" name="description"  id="description" class="form-control">
            <label for="comment">description</label>
        </div>
        
        <div class="form-floating">
          <input type="date" class="form-control" id="date" name="remind_at">
          <label for="date">remind at</label>
      </div>

    
        
        <button class="w-100 btn btn-lg btn-primary" type="submit">Save new note</button>
        
      </form>
  
    </main>
    </div>
  