<x-layout>
    <x-slot name="title">RevisorHome</x-slot>
    @if ($announcement!=null)
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
                        <div class="mb-4 d-flex justify-content-around">
                            @foreach ($announcement->images as $image)
                                <div>
                                    <img src="{{Storage::url($image->file)}}" alt="immagine non disponibile" class="rounded">
                                </div>
                                <div>
                                    {{$image->id}} <br>
                                    {{$image->file}} <br>
                                    {{Storage::url($image->file)}} <br>
                                </div>
                            @endforeach
                        </div>
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
        <div class="container-fluid body d-flex flex-column justify-content-evenly text-center pt-5" style="min-height: 70vh">
            <div><h1>Non ci sono annunci da revisionare</h1></div>
            @if ($announcements!=null)
                <div><a href="{{route('revisor.archive')}}" class="btn homebtn position-relative">
                    Archivio 
                    <span class="badge bg-warning primary bold rounded-circle">
                        {{\App\Models\Announcement::ArchiveCount()}}
                    </span>
                </a></div>
            @else
            <a href="{{route('homepage')}}" class="text-white" style="height: 38px"><i class="fas fa-home" style="position: relative; font-size:38px"></i></a>
            @endif
        </div>
    @endif
</x-layout>