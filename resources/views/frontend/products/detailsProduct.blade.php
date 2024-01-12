@extends('layouts.front')

@section('title', $products->name)

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">قيم ({{ $products->name }})</h5>
                        <button type="button" class="btn-close" style="margin-left:0 !important;" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container collection">
            <h6 class="mb-0">
                <a href="{{ url('category') }}">Category</a> /
                <a href="{{ url('view-category/' . $products->category->slug) }}">{{ $products->category->name }}</a> /
                <a
                    href="{{ url('category/' . $products->category->slug . '/' . $products->slug) }}">{{ $products->name }}</a>
            </h6>
        </div>
    </div>

    <div class="container mb-5 mt-5">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        {{-- <img src="{{ asset('uploading/' . $products->image) }}" class="w-100" alt=""> --}}

                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @isset($products)
                                        @php
                                            $getAlbums = explode(',', $products->albums);
                                        @endphp
                                        @foreach ($getAlbums as $item)
                                            <li><img src="{{ asset('uploadingMultiple/' . $item) }}" class=""
                                                    alt=""></li>
                                        @endforeach
                                    @endisset
                                </ul>
                            </div>
                            <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn">
                                    < </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0 mt-1">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size:16px;margin-left:.5rem;"
                                    class="float-end badge bg-danger trending_tag">popular</label>
                            @endif
                        </h2>


                        <hr>
                        <label class="me-3">Before: <s>{{ $products->original_price }}</s></label>
                        <label class="fw-bold me-3">After Discount:{{ $products->selling_price }}</label>
                        {{-- @php
                            $number_rate = number_format($rating_value);
                        @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $number_rate; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $number_rate; $j < 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count())
                                ({{ $ratings->count() }}تقييم)
                                @else
                                    لايوجد تقييم
                                @endif
                            </span>
                        </div> --}}
                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        <hr>
                        @if ($getProdQTY > 0)
                            <label class="badge bg-success">In stock</label>
                            <div class="d-flex flex-column getIDProd">
                                @if (isset($products->productColorSizes))
                                    <input type="hidden" value="{{ $products->id }}" class="prodID">
                                    <select name="colorSelection" id="selectColor" class="mt-1 colorName"
                                        style="width: fit-content;">
                                        <option value="">-- Select Colour --</option>
                                        @foreach ($products->productColorSizes->unique('color_id') as $colorItem)
                                            <option value="{{ $colorItem->color->id }}">{{ $colorItem->color->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="sizeSelection" id="selectSize" class="mt-1 sizeValue"
                                        style="width: fit-content;">
                                        <option value="">-- Size --</option>
                                    </select>
                                @endif

                            </div>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif

                        <div class="row mt-2">
                            @if ($getProdQTY > 0)
                                <div class="col-md-3">
                                    <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                    <label for="Quantity">Quantity</label>

                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" name="quantity" value="1"
                                            class="form-control qty-input" />
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-9 btn-adds">
                                <br />
                                @if ($getProdQTY > 0)
                                    <button type="button"
                                        class="btn btn-primary me-3 addToCartBtn float-start btn-pr">Add To Cart<i
                                            class="fa fa-shopping-cart mx-2"></i></button>
                                @endif
                                <button type="button" class="btn btn-success me-3 addToWishlist float-start btn-pr">Add
                                    To Wishlist<i class="fa fa-heart mx-2"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>Description:</h3>
                    <p class="mt-3">
                        {!! $products->description !!}
                    </p>
                    {{-- <button type="button" class="btn btn-primary" style="width:15%;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        قيم المنتج
                    </button> --}}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#selectColor').on('change', function(e) {
                var product_id = $(this).closest('.getIDProd').find('.prodID').val();
                var colorID = e.target.value;
                // console.log(countryID);
                $.ajax({
                    url: "{{ route('getsize') }}",
                    type: "POST",
                    data: {
                        colorID: colorID,
                        product_id: product_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#selectSize').empty();
                        $('#selectSize').append('<option value="">Select Size</option>');
                        // $('#selectSize').append('<option value=""> -- لا شيئ --</option>');

                        $.each(data, function(index, val) {
                            $('#selectSize').append('<option value="' + val.size_id +
                                '">' + 'size:' + val.size.value +
                                ' (quantity: ' + val.qty + ')</option>');
                        });
                        // console.log(data[0].size.value);
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {

            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });

        });
    </script>
@endsection

