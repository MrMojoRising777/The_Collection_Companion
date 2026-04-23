@if($recentAlbums->isNotEmpty())
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($recentAlbums as $key => $recentAlbum)
                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                    @if ($recentAlbum->albumSerie->album->image)
                        <img
                            src="{{ $recentAlbum->albumSerie->album->image }}"
                            alt="{{ $recentAlbum->albumSerie->album->name }}"
                            class="h-auto w-50 rounded-lg"
                        />
                    @else
                        <img
                            src="{{ asset('uploads/images/placeholder_cover.jpg') }}"
                            alt="Placeholder Image"
                            class="h-auto w-50 rounded-lg"
                        />
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="font-weight-bold text-mist-300">{{ $recentAlbum->albumSerie->album->name }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Vorige</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Volgende</span>
        </button>
    </div>
@else
    <p><i>Er zijn geen albums gevonden in je collectie</i></p>
@endif
