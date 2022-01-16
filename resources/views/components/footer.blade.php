<div class="container-fluid footer">
    <div class="row">
        <div class="col-8 mt-5">
            @auth
                <a href="{{route('contacts')}}" class="primary ms-5" style="text-decoration: none">{{ __('ui.Contattaci')}}</a>
            @endauth
        </div>
        <div class="col-4 mt-5 d-flex justify-content-end">
            <a href="#"><i class="fab fa-2x primary fa-twitter me-3"></i></a>
            <a href="#"><i class="fab fa-2x primary fa-whatsapp me-3"></i></a>
            <a href="#"><i class="fab fa-2x primary fa-instagram me-3"></i></a>
            <a href="#"><i class="fab fa-2x primary fa-facebook me-5"></i></a>
        </div>
    </div>
</div>