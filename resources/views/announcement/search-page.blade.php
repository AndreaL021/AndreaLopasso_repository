<x-layout>
    <x-slot name="title">Search</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        <h1 class="pt-5">Risultati ricerca per: {{$q}}</h1>
        <div class="row d-flex justify-content-center mt-5">
            @foreach ($announcements as $announcement)
                <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center mb-4 mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <a href="{{route('announcement.detail', compact('announcement'))}}" style="text-decoration: none"><h5 class="card-title">{{$announcement->title}}</h5></a>
                          <h6 class="mb-3">€{{$announcement->price}}</h6>
                          <h6 class="mb-3">{{$announcement->category->name}}</h6>
                          <p class="card-text">{{$announcement->created_at}}</p>
                        </div>
                      </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>