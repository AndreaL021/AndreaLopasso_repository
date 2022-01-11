<x-layout>
    <x-slot name="title">I tuoi articoli</x-slot>

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
                    <input type="text" name="q" placeholder="Cerca articolo" class="form-control align-self-center">
                </div>
                <div class="col-1">
                    <button type="submit" class="btn">
                        <i class="fas fa-2x fa-search search-btn text-white"></i>
                    </button>
                </div>
            </div>
        </form>
        @foreach ($categories as $category)
                <a href="{{route('category', compact('category'))}}" class="mt-3 btn homebtn">{{$category->name}}</a>
        @endforeach
        <div class="row d-flex justify-content-center mt-5">
            @foreach ($announcements as $announcement)
                <div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center mb-4 mt-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <a href="{{route('announcement.detail', compact('announcement'))}}" style="text-decoration: none"><h5 class="card-title">{{$announcement->title}}</h5></a>
                            <h6 class="mb-3">€{{$announcement->price}}</h6>
                            <h6 class="mb-3">{{$announcement->category->name}}</h6>
                            <p class="card-text">{{$announcement->created_at}}</p>
                            <a href="{{route('announcement.edit', compact('announcement'))}}" class="btn btn-warning">Modifica</a>
                            
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Elimina
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Elimina</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Sei sicuro di voler eliminare l'annuncio?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{route('announcement.delete', compact('announcement'))}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Elimina</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>