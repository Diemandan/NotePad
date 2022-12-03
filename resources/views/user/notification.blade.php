<x-app-layout>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Customer notifications</h1>
        </div>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">notifications of notes {{ $notifications->count() }}</h6>

            @foreach ($notifications as $notification)
                <div class="d-flex text-muted pt-3" style="position: relative;">
                    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#007bff" /><text x="50%" y="50%"
                            fill="#007bff" dy=".3em">32x32</text>
                    </svg>


                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">{{ $notification->description }}</strong>

                            @if ($notification->id)
                                <div class="form-check form-switch"
                                    style="position: absolute; top:16px; left:600px; display: flex;gap:10px">
                                    <form action="/admin/status" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="notificationId" value={{ $notification->id }}>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            checked>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Active</label>
                                        <button type="submit" name="status" value="0"
                                            class="btn btn-primary btn-sm">Disactivate notification</button>
                                    </form>
                                </div>
                            @else
                                <div class="form-check form-switch"
                                    style="position: absolute; top:16px; left:600px; display: flex;gap:10px">
                                    <form action="/admin/status" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="notificationId" value={{ $notification->id }}>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Not Active</label>
                                        <button type="submit" name="status" value="1"
                                            class="btn btn-primary btn-sm">Activate</button>
                                    </form>
                                </div>
                            @endif


                        </div>
                        <span class="d-block">{{ $notification->id }}</span>
                    </div>
                </div>
            @endforeach
        </div>


        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>


    </main>

</x-app-layout>
