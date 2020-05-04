<?php $qunatity=0; ?>
@foreach($result['commonContent']['cart'] as $cart_data)
    <?php $qunatity += $cart_data->customers_basket_quantity; ?>
@endforeach
    <a href="{{ url('/viewcart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>{{$qunatity}}</a>
