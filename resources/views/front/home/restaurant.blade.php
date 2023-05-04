@extends('layouts.front')
@section('content')
@include('alerts.alert')

<div class="conteiner-blue">
    <section class="py-1 text-center container shadow_new btnFront">
        <a class="list-group-item list-group-item-action" href="{{route('start')}}">
            <div class="btn btn-dark mt-5">
                <h1 class="m-3 shadow_new">Back to Restaurants offers</h1>
            </div>
        </a>
        <hr class=" border border-second border-0 opacity-75">
    </section>

    <section class="container shadow_new">
        <h3 class="mt-1 text-start"><i>{{__('Restaurants')}}</i></h3>
    </section>
    @include('front.home.common.restaurant')

    @include('layouts.find')

    <section class="container shadow_new">
        <h2 class=" pb-5 text-start"><i>{{__('Restaurants')}} {{$restaurant}} offers to you</i></h2>
    </section>
</div>


<div class="page pt-5" id="food-lists">
    <div class="container ">
        {{-- CIA keiciam steilpeliu skaiciu  --}}
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
            @forelse($foods as $key => $food)
            <div id="{{ $food['id'] }}" class="col d-flex justify-content-md-between">
                <div class="card g-0 shadow p-0 bg-body-tertiary rounded">
                    <div class="container_pic">
                        <img src="{{asset($food->photo)}}" class="img-fluid rounded shadow bg-body-tertiary" alt=" hotel">
                        @foreach($restaurants as $restaurant)
                        @if($restaurant->id == $food->rest_id && $restaurant->works == 'false')
                        <div style="transform: translateX({{$restaurant->translateX}}px) translateY({{$restaurant->translateY}}px) rotate({{$restaurant->deg}}deg);" class="centered shadow_new justify-content-center text-block-sm">
                            <div onmouseover="mOver({{$key}})" onmouseout="mOut({{$key}})">
                                <div class="appBannerT{{$key}}" style="display: none;">open {{$restaurant->open}}</div>
                                <div class="appBannerB{{$key}}" style="display: inline;">close</div>
                            </div>
                        </div>

                        @endif
                        @endforeach
                    </div>
                    <div class="justify-content-center align-bottom">
                        @if (app()->getLocale() == "lt")
                        <h4 class="mt-3"><b><i>{{$food->title_lt}}</b></i></h4>
                        @else
                        <h4 class="mt-3"><b><i>{{$food->title_en}}</b></i></h4>
                        @endif
                        <h3 @if($food->price<20) style="color:crimson;" @endif><b>{{__('Price') }}: <i>{{$food->price}} &euro;</b></i></h3>
                    </div>

                    <div class=" card-body ">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h6 class="accordion-header " id="flush-headingOne">
                                    <button class="accordion-button collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        {{-- <a class=" list-group-item list-group-item-action " href=" {{route('list-restaurant',$food->foodReataurants_name->id)}}"> --}}
                                        <div style="font-size:17px;">
                                            <i>{{$food->foodReataurants_name->title}}</i>
                                        </div>
                                        {{-- </a> --}}
                                        <div class="ms-5">
                                            Rating:<b><i> {{$food->rating}}</i></b>
                                        </div>
                                    </button>
                                </h6>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body ">
                                        <h6>City: <b><i>{{$food->foodCities_no->title}}</i></b></h6>
                                        <h6>Category: <b><i>{{$food->foodCategory_no->title_en}}</i></b></h6>
                                        <h6>Addres: <b><i>{{$food->foodReataurants_name->addres}}</i></b></h6>
                                        <h6>Open: <b><i>{{$food->foodReataurants_name->open}}</i></b></h6>
                                        <h6>Close: <b><i>{{$food->foodReataurants_name->close}}</i></b></h6>
                                    </div>

                                    <form action="{{route('update-reviews')}}" method="get">
                                        <div class="gap-3 align-items-center d-flex justify-content-center mt-3">
                                            <input type="hidden" name="product" value="{{$food->id}}">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-outline-secondary" style="width:200px;">Rating & Reviews</button>
                                            </div>
                                        </div>
                                        @csrf
                                    </form>
                                    <hr class="border border-second border-2 opacity-0">
                                    <form action="{{route('add-basket')}}" method="post">
                                        <div class="col-md-12 gap-3 align-items-center d-flex justify-content-center">
                                            <div class="col-md-2">
                                                Qty:
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" class="form-control" name="count" value="1" min="1">
                                                <input type="hidden" name="id" value="{{$food->id}}">
                                                <input type="hidden" name="food_city_no" value="{{$food->food_city_no}}">
                                            </div>
                                            <div class="col-md-1 ">
                                                <div class="form-contro">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="bi bi-cart-check-fill" style="font-size: 1rem"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @csrf
                                        </div>
                                    </form>
                                    <hr class="border border-second border-2 opacity-0">
                                </div>
                            </div>
                            {{-- <hr class="border border-second border-1 opacity-75"> --}}
                            <span class="text-muted">{{$food->add}}</span>
                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="card shadow bg-body-tertiary rounded d-flex ">
                    <div class="card-header justify-content-md-between align-items-center">
                        <h1>Oops! No match found. Try again</h1>
                    </div>
                    <div class="card-header justify-content-md-between align-items-center">
                        <a href="{{route('start')}}" class="btn btn-secondary">BACK</a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        <div class="mt-4">
            @if($perPageShow!='All')
            {{$foods->links()}}
            @endif
        </div>
    </div>
    <hr class="border border-second border-0 opacity-50 m-1">
</div>
@endsection
