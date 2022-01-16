<x-layout>
    <x-slot name="title">Contattaci</x-slot>
    <div class="container" style="min-height: 80vh">
        <div class="row d-flex justify-content-center text-center align-content-center">
            <div class="col-12 col-md-5 mt-5 mb-3">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <h1 class="logo">Amazon</h1>
                @if ($announcement!=null)
                    <form method="POST" action="{{route('message', compact('announcement'))}}" class="mt-5">
                @else
                    <form method="POST" action="{{route('message', compact('announcement'))}}" class="mt-5">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">{{ __('ui.Nome')}}</label><br>
                        <label>{{Auth::user()->name}}</label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{ __('ui.Email')}}</label><br>
                        <label>{{Auth::user()->email}}</label>
                    </div>
                    @if ($announcement!=null)
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">{{ __('ui.Annuncio rifiutato')}}</label><br>
                            <label>N°{{$announcement->id}} - {{$announcement->title}}</label>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">{{ __('ui.Inserisci un messaggio')}}</label>
                            <textarea name="message" cols="50" rows="7" placeholder="{{ __('ui.Scrivi qui')}}"></textarea>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">{{ __('ui.Inserisci un messaggio')}}</label>
                            <textarea name="message" cols="50" rows="7" placeholder="{{ __('ui.Scrivi qui')}}"></textarea>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary me-5">{{ __('ui.Invia')}}</button>
                    <a href="{{route('homepage')}}" class="btn btn-primary">{{ __('ui.Torna alla home')}}</a>
                </form>
            </div>
        </div>
    </div>
</x-layout>