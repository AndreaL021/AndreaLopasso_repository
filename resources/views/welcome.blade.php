<x-layout>
    <x-slot name="title">Home</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('status-danger'))
            <div class="alert alert-danger">
                {{ session('status-danger') }}
            </div>
        @endif
        <h1 style="font-size: 40px" class="mybrand text-white pt-5">Amazon</h1>
                @foreach ($categories as $category)
                        <a href="{{route('category', compact('category'))}}" class="mt-3 btn homebtn">{{$category->name}}</a>
                @endforeach
                <span class="flag-icon flag-icon-gr"></span>
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