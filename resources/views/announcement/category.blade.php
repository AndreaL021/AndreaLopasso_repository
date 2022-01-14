<x-layout>
    <x-slot name="title">Category</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h1 style="font-size: 40px" class="mybrand text-white pt-5">Amazon</h1>
        <form action="{{route('search')}}" method="GET">
            <div class="row d-flex justify-content-center">   
                <div class="col-3 p-0">
                    <input type="text" name="q" placeholder="Cerca annuncio" class="form-control align-self-center">
                </div>
                <div class="col-1">
                    <button type="submit" class="btn">
                        <i class="fas fa-2x fa-search search-btn text-white"></i>
                    </button>
                </div>
            </div>
        </form>
        @foreach ($categories as $category)
            @if ($category->name==$name)
                <span class="mt-3 btn homebtn active">{{$category->name}}</span>
            @else
                <a href="{{route('category', compact('category'))}}" class="mt-3 btn homebtn">{{$category->name}}</a>
            @endif
        @endforeach
        <div class="row d-flex justify-content-center mt-5">
            @foreach ($announcements as $announcement)
                <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center mb-4 mt-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$announcement->images->first()->getUrl(300, 200)}}" class="card-img-top" alt="Immagine non disponibile">
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