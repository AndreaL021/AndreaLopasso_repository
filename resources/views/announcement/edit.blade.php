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
              </div>
              <div class="row d-flex justify-content-center text-center">
                  <h1>Modifica annuncio</h1>
                  <div class="col-12 col-md-4">
                  <form method="POST" action="{{route('announcement.update', compact('announcement'))}}" class="mt-5">
                      @csrf
                      @method('put')
                      <div class="mb-3">
                        <h4>Titolo</h4>
                        <input name="title" value="{{$announcement->title}}" type="text" class="form-control border-dark" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="mb-3">
                        <h4 for="Select" class="form-label">Modifica categoria</h4>
                        <select name="category_id" class="form-select border-dark">
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <h4 for="exampleInputEmail1" class="form-label">Modifica prezzo</h4>
                        <input type="number" class="form-control border-dark" id="exampleInputEmail1" name="price" value="{{$announcement->price}}">
                     </div>
                      <div class="mb-3">
                          <h4>Modifica testo</h4>
                          <textarea class="border-dark" name="body" style="position: relative; left: -10rem;" cols="70" rows="15" placeholder="Scrivi qui l'annuncio">{{$announcement->body}}</textarea>
                      </div>
                      <div class="mb-4 d-flex justify-content-around">
                          <button type="submit" class="btn mybtn mb-5">Conferma</button>
                          <a href="{{route('homepage')}}" class="text-white" style="height: 38px"><i class="fas fa-home" style="position: relative; font-size:38px"></i></a>
                      </div>
                  </form>
  
                  </div>
              </div>
          </div>
      </div>
    </div>
</x-layout>