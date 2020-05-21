<?php $qunatity=0;  ?>
@foreach($result['commonContent']['cart'] as $cart_data)
    <?php $qunatity += $cart_data->customers_basket_quantity; ?>
@endforeach
    <a href="{{ url('/viewcart') }}" class="cart-count"><i class="fa fa-shopping-cart" aria-hidden="true"></i>{{$qunatity}}</a>
    <a href="{{ url('/wishlist') }}" class="wishlist-count"><i class="fa fa-heart" aria-hidden="true"></i>{{$result['commonContent']['wishlist_count']}}</a>
