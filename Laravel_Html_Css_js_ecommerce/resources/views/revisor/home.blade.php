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
                        <h1 class="card-title">{{ __('ui.Annuncio numero')}} #{{$announcement->id}}</h1>
                        <h4 class="card-title">{{$announcement->title}}</h4>
                        <div class="mb-4 row ms-3">
                            @foreach ($announcement->images as $image)
                                <div class="col-8 col-md-6 text-start">
                                    <img src="{{$image->getUrl(300, 200)}}" alt="immagine non disponibile" class="rounded"> <br>
                                    <h4>{{ __('ui.Analisi contenuto')}}</h4>
                                    <p>{{ __('ui.Per adulti:')}} {{$image->adult}}</p>
                                    <p>{{ __('ui.Bullismo:')}} {{$image->spoof}}</p>
                                    <p>{{ __('ui.Medico:')}} {{$image->medical}}</p>
                                    <p>{{ __('ui.Violento:')}} {{$image->violence}}</p>
                                    <p>{{ __('ui.Razzismo:')}} {{$image->racy}}</p>
                                    <b>{{ __('ui.Rilevazioni')}}</b>
                                    @if ($image->labels)
                                    <p>
                                        @foreach ($image->labels as $label)
                                            {{$label}}
                                        @endforeach
                                    </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <b>{{ __('ui.Testo annuncio')}}</b>
                        <p class="mb-3">{{$announcement->body}}</p>
                        <b>{{ __('ui.Prezzo:')}} €{{$announcement->price}}</b> <br>
                        <b>{{ __('ui.Categoria')}} {{$announcement->category->name}}</b>
                        <p class="card-text">{{ __('ui.Creato da')}} {{$announcement->user->name}} {{ __('ui.il giorno')}} {{$announcement->created_at}}</p>
                        <div class="mb-4 d-flex justify-content-around">
                            <form method="POST" action="{{route('revisor.accept', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">{{ __('ui.Accetta')}}</button>
                            </form>
                            <form method="POST" action="{{route('revisor.reject', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">{{ __('ui.Rifiuta')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="container-fluid body d-flex flex-column justify-content-evenly text-center pt-5" style="min-height: 70vh">
            <div><h1>{{ __('ui.Non ci sono annunci da revisionare')}}</h1></div>
            @if ($announcements!=null)
                <div><a href="{{route('revisor.archive')}}" class="btn homebtn position-relative">
                    {{ __('ui.Archivio')}}
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