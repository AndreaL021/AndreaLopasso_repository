<x-layout>
    <x-slot name="title">Dettaglio annuncio</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        <h1 style="font-size: 40px" class="mybrand text-white pt-5">Amazon</h1>
                @foreach ($categories as $category)
                        <a href="{{route('category', compact('category'))}}" class="mt-3 btn homebtn">{{$category->name}}</a>
                @endforeach
        <div class="row d-flex justify-content-center mt-5">
            <div class="d-flex justify-content-center mb-4 mt-4">
                <div class="card" style="width: 60rem; min-height:20rem;">
                    <div class="card-body">
                        <h5 class="card-title mb-5">{{$announcement->title}}</h5>
                        <h6 class="mb-4">{{$announcement->body}}</h6>
                        <h6 class="mb-4">Prezzo: €{{$announcement->price}}</h6>
                        <h6 class="mb-4">Categoria: {{$announcement->category->name}}</h6>
                        <div class="d-flex justify-content-evenly mt-5">
                            <p class="card-text">{{$announcement->created_at}}</p>
                            <p class="card-text">Annuncio di: {{$announcement->user->name}}</p>
                        </div>
                        @if ($announcement->user->name===Auth::user()->name)
                            <div class="d-flex justify-content-evenly">
                                <a href="{{route('announcement.edit', compact('announcement'))}}" class="btn btn-warning mt-3">Modifica</a>
                                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                        @endif
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-layout>