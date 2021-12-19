@extends('layoutmaster.masterlayout-customer')


@section('css')
    <link rel="stylesheet" href="{{ asset('client/plugins/css/prettyPhoto.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/jquery.rateyo.min.css') }}">
@endsection

@section('content')
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
                    <div class="product-details">
                        <!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img id="feature" src="{{ asset($products->file_path) }}" alt="" />
                                <h3>ZOOM</h3>
                            </div>
                            <!-- Wrapper for slides -->
                            <div class="slider-wrapper">
                                <img class="backs" src="{{ asset('client/plugins/images/back.png') }}" alt="">
                                <div class="slider">
                                    <img class="thumbnail active" src="{{ asset($products->file_path) }}" alt="">
                                    @foreach ($products->images as $key => $item)
                                        <img class="thumbnail " src="{{ asset($item->file_path) }}" alt="">
                                    @endforeach
                                </div>
                                <img class="nexts" src="{{ asset('client/plugins/images/next.png') }}" alt="">
                            </div>
                            <!-- Controls -->
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <!--/product-information-->
                                <img src="{{ asset('client/plugins/images/product-details/new.jpg') }}"
                                    class="newarrival" alt="" />
                                <h2>{{ $products->title }}</h2>
                                <p><b>Người Đăng: </b>{{ $products->user_product->name }}</p>
                                <div id="rateYo">
                                </div>
                                <br>
                                <div class="col-sm-12">
                                    <span>{{ number_format($products->price) }}.VND</span>
                                </div>
                                <button type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                                <p><b>Địa Chỉ:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p class="date-bot"><b>Ngày Đăng:</b>
                                    {{ \Carbon\Carbon::createFromTimestamp(strtotime($products->created_at))->diffForHumans() }}
                                </p>
                            </div>
                            <!--/product-information-->
                        </div>
                    </div>
                    <!--/product-details-->

                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script src="{{ asset('client/plugins/js/jquery.rating.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#rateYo").rateYo({
                starWidth: '25px',
                halfStar: true,
                // readOnly: true
            });

            $('.thumbnail').hover(function() {
                $('.thumbnail').removeClass('active');
                $(this).addClass('active');
                $('#feature').attr('src', $(this).attr('src'));
            }, function() {
                // out
            });
            $('.backs').click(function(e) {
                e.preventDefault();
                var back = $('.slider').scrollLeft();
                $(".slider").animate({
                    scrollLeft: back - 90
                }, 500);
            });
            $('.nexts').click(function(e) {
                e.preventDefault();
                var right = $('.slider').scrollLeft();
                $(".slider").animate({
                    scrollLeft: right + 180
                }, 500);
            });
        });
    </script>

@endsection
