<x-layout>
  <x-slot name="title">Crea annuncio</x-slot>
  <div class="container-fluid body">
    <div class="container ">
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
          @if (session('status'))
              <div class="alert alert-danger">
                  {{ session('status') }}
              </div>
          @endif
        </div>
        <div class="row d-flex justify-content-center text-center">
          <h1>{{ __('ui.Crea annuncio')}}</h1>
          <div class="col-12 col-md-4">
            <form method="POST" action="{{route('announcement.store')}}" class="mt-5" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="uniqueSecret" value="{{$uniqueSecret}}">
              <div class="mb-3">
                <h4>{{ __('ui.Titolo')}}</h4>
                <input name="title" value="{{old('title')}}" type="text" class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <h4 for="Select" class="form-label">{{ __('ui.Categoria annuncio')}}</h4>
                <select name="category_id" class="form-select border-dark">
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <h4 for="exampleInputEmail1" class="form-label">{{ __('ui.Inserisci prezzo')}}</h4>
                <input type="number" class="form-control border-dark" id="exampleInputEmail1" name="price" value="{{old('price')}}">
              </div>
              <div class="form-group row mb-3">
                <label for="images"><h4>{{ __('ui.Immagini')}}</h4></label>
                <div class="mb-3">
                  <div class="dropzone border border-dark" id="drophere"></div>
                </div>
              </div>
              <div class="mb-3">
                <h4>{{ __('ui.Testo annuncio')}}</h4>
                <textarea class="border-dark ps-3" name="body" style="position: relative; left: -10rem;" cols="70" rows="15" placeholder="Scrivi qui l'annuncio">{{old('body')}}</textarea>
              </div>
              <div class="mb-4 d-flex justify-content-around">
                <button type="submit" class="btn mybtn mb-5">{{ __('ui.Crea')}}</button>
                <a href="{{route('homepage')}}" class="text-white" style="height: 38px"><i class="fas fa-home" style="position: relative; font-size:38px"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>