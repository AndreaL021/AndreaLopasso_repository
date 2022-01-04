<x-layout>
    <x-slot name="title">RevisorHome</x-slot>
    @if ($announcement!=null)
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
                            <form method="POST" action="{{route('revisor.accept', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">Accetta</button>
                            </form>
                            <form method="POST" action="{{route('revisor.reject', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">Rifiuta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="container-fluid body text-center pt-5" style="min-height: 70vh">
            <h1>Non ci sono annunci da revisionare</h1>
        </div>
    @endif
</x-layout>