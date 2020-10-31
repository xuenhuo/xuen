<div class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="wrap_header">
            <!-- Logo -->
            <a href="{{route('home')}}" class="logo">
                <img src="/images/icons/logo.png" alt="IMG-LOGO">
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}">Shop</a>
                        </li>
                        <li class="sale-noti">
                            <a href="{{route('products.index')}}">Sale</a>
                        </li>
                        <li>
                            <a href="{{route('products.index')}}">Features</a>
                        </li>
                        <li>
                            <a href="{{route('articles.index')}}">Blog</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons dropdown">
                <a href="#" class="header-wrapicon1 dis-block" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @guest
                        <a class="dropdown-item" href="{{route('login')}}">{{__('Login')}}</a>
                        @if (Route::has('register'))
                            <a class="dropdown-item" href="{{route('register')}}">{{__('Register')}}</a>
                        @endif
                    @else
                        <a class="dropdown-item" href="{{route('contacts.index')}}">Home</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest
                </div>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2">
                    <img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{$all_num}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach ($carts as $cart)
                                <li class="header-cart-item">
                                    <form action="{{route('carts.destroy', $cart->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                                <img src="/storage/products/{{$cart->photo}}" alt="IMG-PRODUCT">
                                            </div>
                                        </button>
                                    </form>

                                    <?php $all_price = 0 ?>
                                    <?php $detail_price = 0 ?>
                                    @foreach ($cart->cart_details as $detail)
                                        <?php $detail_price += $detail->price ?>
                                    @endforeach
                                    <div class="header-cart-item-txt">
                                        <a href="{{route('products.show', $cart->product_id)}}" class="header-cart-item-name">
                                            {{$cart->title}}
                                        </a>

                                        <?php $all_price = $detail_price+($cart->price) ?>
                                        <span class="header-cart-item-info">
                                            {{$cart->quantity}}x${{$all_price}}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{-- <div class="header-cart-total">
                            Total: ${{$all_total}}
                        </div> --}}

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{route('carts.index')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{route('orders.index')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{route('home')}}" class="logo-mobile">
            <img src="/images/icons/logo.png" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="#" class="header-wrapicon1 dis-block">
                    <img src="/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{$all_num}}</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach ($carts as $cart)
                            <li class="header-cart-item">
                                <form action="{{route('carts.destroy', $cart->id)}}" method="post">
									@csrf
									@method('DELETE')
									<button type="submit">
										<div class="cart-img-product b-rad-4 o-f-hidden">
											<img src="/storage/products/{{$cart->photo}}" alt="IMG-PRODUCT">
										</div>
									</button>
								</form>

                                <div class="header-cart-item-txt">
                                    <a href="{{route('products.show', $cart->product_id)}}" class="header-cart-item-name">
                                        {{$cart->title}}
                                    </a>

                                    <span class="header-cart-item-info">
                                        {{$cart->quantity}}x${{$cart->price}}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        {{-- <div class="header-cart-total">
                            Total: ${{$all_total}}
                        </div> --}}

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{route('carts.index')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{route('orders.index')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main_menu">
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('products.index')}}">Shop</a>
                </li>
                <li class="sale-noti">
                    <a href="{{route('products.index')}}">Sale</a>
                </li>
                <li>
                    <a href="{{route('products.index')}}">Features</a>
                </li>
                <li>
                    <a href="{{route('articles.index')}}">Blog</a>
                </li>
                <li>
                    <a href="{{route('about')}}">About</a>
                </li>
                <li>
                    <a href="{{route('contact')}}">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</div>