<x-layout>
    <x-slot name="title">Modifica annuncio</x-slot>
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
                <h1>{{ __('ui.Modifica annuncio')}}</h1>
                <div class="mb-3 col-12">
                    <h4 class="form-label">{{ __('ui.Immagini')}}</h4>
                    <div class="row d-flex justify-content-center">
                    @foreach ($announcement->images as $image)
                        <img src="{{$image->getUrl(300, 200)}}" alt="immagine non disponibile" class="col-3">
                        <div class="align-self-center col-1">  
                          <form action="{{route('announcement.images.delete', compact('image'))}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">{{ __('ui.Elimina')}}</a>
                          </form>
                        </div>
                    @endforeach
                  </div>
                </div>
                <div class="col-12 col-md-4">
                <form method="POST" action="{{route('announcement.update', compact('announcement'))}}" class="mt-5" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="uniqueSecret" value="{{$uniqueSecret}}">
                    <div class="mb-3">
                        <h4>{{ __('ui.Titolo')}}</h4>
                        <input name="title" value="{{$announcement->title}}" type="text" class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <h4 for="Select" class="form-label">{{ __('ui.Categoria')}}</h4>
                        <select name="category_id" class="form-select border-dark">
                          <option selected value="{{$announcement->category->id}}">{{$announcement->category->name}}</option>
                          @foreach ($categories as $category)
                            @if ($category->id != $announcement->category->id)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                          @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <h4 for="exampleInputEmail1" class="form-label">{{ __('ui.Prezzo')}}</h4>
                        <input type="number" class="form-control border-dark" id="exampleInputEmail1" name="price" value="{{$announcement->price}}">
                    </div>
                    <div class="form-group row mb-3">
                      <label for="images"><h4>{{ __('ui.Aggungi immagini')}}</h4></label>
                      <div class="mb-3">
                        <div class="dropzone border border-dark" id="drophere"></div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <h4>{{ __('ui.Testo annuncio')}}</h4>
                      <textarea class="border-dark ps-3" name="body" style="position: relative; left: -10rem;" cols="70" rows="15" placeholder="Scrivi qui l'annuncio">{{$announcement->body}}</textarea>
                    </div>
                    <div class="mb-4 d-flex justify-content-around">
                      <button type="submit" class="btn mybtn mb-5">{{ __('ui.Conferma')}}</button>
                      <a href="{{route('homepage')}}" class="text-white" style="height: 38px"><i class="fas fa-home" style="position: relative; font-size:38px"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</x-layout>