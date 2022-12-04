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




                            @if ($notification->readStatus)
                                <div class="form-check form-switch"
                                    style="position: absolute; top:16px; left:600px; display: flex;gap:10px">

                                    <button type="button" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z">
                                            </path>
                                            <path
                                                d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z">
                                            </path>
                                        </svg>
                                        <ya-tr-span data-index="34-0" data-translated="true" data-source-lang="en"
                                            data-target-lang="ru" data-value=" " data-translation=" " data-ch="0"
                                            data-type="trSpan" data-selected="false"> </ya-tr-span>
                                        <ya-tr-span data-index="34-1" data-translated="true" data-source-lang="en"
                                            data-target-lang="ru" data-value="Button " data-translation="Кнопка "
                                            data-ch="0" data-type="trSpan" data-selected="false">Прочитано </ya-tr-span>
                                    </button>



                                </div>
                            @else
                                <div class="form-check form-switch"
                                    style="position: absolute; top:16px; left:600px; display: flex;gap:10px">
                                    <form action="/admin/notification/status" method="POST">
                                        @csrf
                                        <input type="hidden" name="userId" value={{ Auth()->id() }}>
                                        <input type="hidden" name="notificationId" value={{ $notification->id }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-envelope-exclamation-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 4.697v4.974A4.491 4.491 0 0 0 12.5 8a4.49 4.49 0 0 0-1.965.45l-.338-.207L16 4.697Z" />
                                            <path
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0Zm0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                                        </svg>

                                        <button type="submit" name="status" value="0"
                                            class="btn btn-primary btn-sm">Отметить как прочитано</button>
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
