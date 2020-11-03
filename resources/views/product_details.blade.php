@extends('index')

@section('content')

    <div style="height: 250px">
        @if($product->img_url)
           <img style="height:100%;" src="{{asset($product->img_url)}}" alt=""/>

        @else
            <img style="height: 100%" src="{{asset('images/package.png')}}" alt=""/>

        @endif
    </div>
    <h1>{{$product->name}}</h1>
    <div class="alert alert-info">
        <h2>{{$product->price}} FCFA</h2>
    </div>
    <p>{{$product->description}}</p>
     <ul>
         @if($product->discount)
            <li><h5>Product has a discount</h5></li>
          @else
             <li><h5>This product has no discount</h5></li>

         @endif
         @if($product->service)
            <li><h5>This product is a service</h5></li>
             @else
                 <li><h5>This product is not a service</h5></li>
         @endif
        @if($product->discount)
            <li><h5>This product is in stock</h5></li>
             @else
                 <li><h5>This product is not in stock</h5></li>
         @endif
     </ul>

@endsection