<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Source+Code+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    {{-- style --}}
    <link rel="stylesheet" href={{asset('css/app.css')}}>
    <title>Contattaci</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center text-center align-content-center">
            <div class="col-12 col-md-4 mt-5 mb-3">
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
                <form method="POST" action="{{route('message')}}" class="mt-5">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Nome</label><br>
                        <label>{{Auth::user()->name}}</label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label><br>
                        <label>{{Auth::user()->email}}</label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Inserisci un messaggio</label>
                        <textarea name="message" cols="50" rows="7" placeholder="Scrivi qui"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-5">Invia</button>
                    <a href="{{route('homepage')}}" class="btn btn-primary">Torna alla home</a>
                </form>
            </div>
        </div>
    </div>
<x-footer>
</x-footer>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>