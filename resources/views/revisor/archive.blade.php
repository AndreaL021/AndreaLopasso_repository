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
                        <p class="mb-3">{{$announcement->body}}</p>
                        <h6 class="mb-3">€{{$announcement->price}}</h6>
                        <h6 class="mb-3">{{$announcement->category->name}}</h6>
                        <p class="card-text">{{ __('ui.Creato da')}} {{$announcement->user->name}} {{ __('ui.il giorno')}} {{$announcement->created_at}}</p>
                        <div class="mb-4 d-flex justify-content-around">
                            <form method="POST" action="{{route('revisor.restore', $announcement->id)}}">
                                @csrf
                                <button type="submit" class="btn mybtn mb-3">{{ __('ui.Ripristina')}}</button>
                            </form>
                            <form method="POST" action="{{route('revisor.delete', $announcement->id)}}">
                                @csrf
                                <button class="btn mybtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">{{ __('ui.Elimina')}}</button>
                                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                                  <div class="offcanvas-header">
                                    <h5 id="offcanvasTopLabel">{{ __('ui.Elimina')}}</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                  </div>
                                  <div class="offcanvas-body">
                                    {{ __('ui.Sei sicuro? L\'annuncio verrà eliminato definitivamente')}}<br>
                                    <button type="submit" class="btn mybtn mt-3">{{ __('ui.Conferma')}}</button>
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