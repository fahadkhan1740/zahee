@extends('web.layout')
@section('content')
    <section class="section category__section">
        <div class="container">
            <div class="row">
                @if(count($result['categoryArray']) > 0)
                    @foreach($result['categoryArray'] as $cat)
                        <div class="col-sm-4">
                            <div class="box">
                                <div class="imgbox">
                                    <img src="{{ url('https://zaahee.shop/'.$cat->image)}}" class="img-responsive">
                                </div>
                                <div class="content">
                                    <h3>{{$cat->name}}</h3>
                                    <a href="{{url('/shop?category='.$cat->slug)}}" class="btn btn-default btnD">Explore</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
