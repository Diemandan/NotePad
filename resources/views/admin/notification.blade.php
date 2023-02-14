<x-admin-layout>

    <div class="container">

         
          <main class="form-signin w-50 m-auto" style="position: absolute; top:100px; left:350px; gap:10px ">
              <form action="/admin/notifications" method="POST">
                  @csrf
                  <h1 class="h3 mb-3 fw-normal">Make new notification</h1>
  
                  <div class="form-floating">
                    <input type="text" class="form-control" id="title" name="title">
                    <label for="title">title</label>
                </div>
  
                  <div class="form-floating">
                      <input type="text" class="form-control" id="description" name="description">
                      <label for="description">description</label>
                  </div>
              
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Publish</button>
  
              </form>
  
          </main>
      </div>
  
  
      <div class="container">
          <p class="text-center text-muted">All notifications</p>
  
          <div class="list-group w-auto">
              @foreach ($allNotificationsWithReadStatus as $notification)
                  <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                      <div class="d-flex gap-2 w-100 justify-content-between">
                          <div>
                              <p class="mb-0 opacity-75">{{ $notification->title }}</p>
                              <p class="mb-0 opacity-75">{{ $notification->description }}</p>
                          </div>
  
                         
                          <small class="opacity-50 text-nowrap">{{$notification->created_at}}</small>
                      </div>
                      
                  </a>
              @endforeach
          </div>
      </div>

</x-admin-layout>