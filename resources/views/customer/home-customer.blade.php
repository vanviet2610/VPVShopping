@extends('layoutmaster.masterlayout-customer')

@section('css')
    <link rel="stylesheet" href="{{ asset('client/plugins/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/responsive.css') }}">
@endsection

@section('content')
    <!-- Slider -->
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($sliders as $key => $slideritems)
                                @if ($key === 0)
                                    <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                                        class="active"></li>
                                @else
                                    <li data-target="#slider-carousel" data-slide-to="{{ $key }}"></li>
                                @endif
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach ($sliders as $key => $slideritems)
                                @if ($key === 0)
                                    <div class="item active">
                                        <div class="col-sm-6">
                                            <h1><span>VPV</span>-Shopping</h1>
                                            <h2>{{ $slideritems->name }}</h2>
                                            <p>{{ $slideritems->description }} </p>
                                            <button type="button" class="btn btn-default get">Get it now</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset($slideritems->file_path) }}" class="girl img-responsive"
                                                alt="{{ $slideritems->file_name }}" />
                                            {{-- <img src="{{ asset('client/plugins/images/home/pricing.png') }}"
                                        class="pricing" alt="" /> --}}
                                        </div>
                                    </div>
                                @else
                                    <div class="item">
                                        <div class="col-sm-6">
                                            <h1><span>VPV</span>-Shopping</h1>
                                            <h2>{{ $slideritems->name }}</h2>
                                            <p>{{ $slideritems->description }} </p>
                                            <button type="button" class="btn btn-default get">Get it now</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="{{ asset($slideritems->file_path) }}" class="girl img-responsive"
                                                alt="{{ $slideritems->file_name }}" />
                                            {{-- <img src="{{ asset('client/plugins/images/home/pricing.png') }}"
                                    class="pricing" alt="" /> --}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($categories as $key => $item)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            @if ($item->categoryChild->count())
                                                <a href="">
                                                    {{ $item->name }}
                                                </a>
                                                <a data-toggle="collapse" data-parent="#accordian"
                                                    href="#{{ $item->slug }}">
                                                    <span class="badge pull-right">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="">
                                                    {{ $item->name }}
                                                </a>
                                            @endif
                                        </h4>
                                    </div>
                                    @if ($item->categoryChild->count())
                                        <div id="{{ $item->slug }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    @foreach ($item->categoryChild as $itemChild)
                                                        <li><a href="#">{{ $itemChild->name }} </a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <!--/category-products-->

                        {{-- <div class="brands_products">
                            <!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                                </ul>
                            </div>
                        </div> --}}
                        <!--/brands_products-->
                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="{{ asset('client/plugins/images/home/shipping.jpg') }}" alt="" />
                        </div>
                        <!--/shipping-->

                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach ($products as $productitem)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('client/plugins/images/home/product5.jpg') }}" alt="" />
                                            <h2>{{ $productitem->price }}</h2>
                                            <p>{{ $productitem->title }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ $productitem->price }}</h2>
                                                <p>{{ $productitem->title }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                        <!-- image slate  nếu muốn có -->
                                        {{-- <img src="{{ asset('client/plugins/images/home/sale.png') }}" class="new"
                                    alt="" /> --}}
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('client/plugins/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('client/plugins/js/price-range.js') }}"></script>
    <script src="{{ asset('client/plugins/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('client/plugins/js/main.js') }}"></script>
@endsection
