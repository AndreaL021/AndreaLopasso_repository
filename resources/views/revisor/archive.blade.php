<x-layout>
    <x-slot name="title">RevisorHome</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h1 style="font-size: 40px" class="mybrand text-white pt-5">Amazon</h1>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 d-flex justify-content-center mb-4 mt-4">
                <div class="card" style="width: 50rem;">
                    <div class="card-body">
                        <h1 class="card-title">Articolo numero #{{$announcement->id}}</h1>
                        <h4 class="card-title">{{$announcement->title}}</h4>
                        <p class="mb-3">{{$announcement->body}}</p>
                        <h6 class="mb-3">€{{$announcement->price}}</h6>
                        <h6 class="mb-3">{{$announcement->category->name}}</h6>
                        <p class="card-text">Creato da {{$announcement->user->name}} il giorno {{$announcement->created_at}}</p>
                        <div class="mb-4 d-flex justify-content-around">
                            <form method="POST" action="{{route('revisor.restore', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">Ripristina</button>
                            </form>
                            <form method="POST" action="{{route('revisor.delete', $announcement->id)}}">
                                @csrf
                                <button class="btn mybtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Elimina</button>
                                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                                  <div class="offcanvas-header">
                                    <h5 id="offcanvasTopLabel">Elimina</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                  </div>
                                  <div class="offcanvas-body">
                                      Sei sicuro? L'articolo verrà eliminato definitivamente. <br>
                                    <button type="submit" class="btn mybtn mb-3">conferma</button>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>