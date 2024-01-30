@if($recentAlbums->isNotEmpty())
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($recentAlbums as $key => $recentAlbum)
                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                    @if ($recentAlbum->image)
                        <img src="{{ $recentAlbum->image }}" class="d-block w-100" alt="{{ $recentAlbum->name }}">
                    @else
                        {{-- Placeholder image --}}
                        <img class="h-auto w-full rounded-lg" src="{{ asset('uploads/images/placeholder_cover.jpg') }}"
                            alt="Placeholder Image">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="font-weight-bold text-black">{{ $recentAlbum->name }}</h5>
                        <p>Some representative placeholder content for the slide.</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@else
    <p><i>Currently no albums in your collection</i></p>
@endif
