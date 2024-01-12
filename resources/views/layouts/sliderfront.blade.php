<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($getcateslide as $key => $item)
        @if ($item->status == '0')
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}" class="active"
            aria-current="true" aria-label="Slide 1"></button>
            
        @endif
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($getcateslide as $key => $item)
            @if ($item->status == '0')
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <a href="{{url('view-category/' . $item->slug)}}">
                        <img src="{{asset('uploading/' . $item->image)}}" class="d-block w-100" alt="صورة">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h1>{{$item->name}}</h1>
                        <p>{{$item->description}}</p>
                    </div>
                </div>
            @endif
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
