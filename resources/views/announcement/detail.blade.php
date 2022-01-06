<x-layout>
    <x-slot name="title">Dettaglio annuncio</x-slot>
    <div class="container-fluid body text-center" style="min-height: 70vh">
        <h1 style="font-size: 40px" class="mybrand text-white pt-5">Amazon</h1>
                @foreach ($categories as $category)
                        <a href="{{route('category', compact('category'))}}" class="mt-3 btn homebtn">{{$category->name}}</a>
                @endforeach
        <div class="row d-flex justify-content-center mt-5">
            <div class="d-flex justify-content-center mb-4 mt-4">
                <div class="card" style="width: 60rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$announcement->title}}</h5>
                        <h6 class="mb-3">{{$announcement->body}}</h6>
                        <h6 class="mb-3">Prezzo: €{{$announcement->price}}</h6>
                        <h6 class="mb-3">Categoria: {{$announcement->category->name}}</h6>
                        <div class="d-flex justify-content-evenly">
                            <p class="card-text">{{$announcement->created_at}}</p>
                            <p class="card-text">Annuncio di: {{$announcement->user->name}}</p>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-layout>