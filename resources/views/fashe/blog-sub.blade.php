<div class="col-md-4 col-lg-3 p-b-75">
    <div class="rightbar">
        <!-- Search -->
        <div class="pos-relative bo11 of-hidden">
            <input class="s-text7 size16 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search">

            <button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
                <i class="fs-13 fa fa-search" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Categories -->
        <h4 class="m-text23 p-t-56 p-b-34">
            Categories
        </h4>

        <ul>
            @foreach ($categories as $category)
            <li class="p-t-6 p-b-8 bo6">
                <a href="#" class="s-text13 p-t-5 p-b-5">
                    {{$category->title}}
                </a>
            </li>
            @endforeach
        </ul>

        <!-- Featured Products -->
        <h4 class="m-text23 p-t-65 p-b-34">
            Featured Products
        </h4>

        <ul class="bgwhite">
            @foreach ($products as $product)
            <li class="flex-w p-b-20">
                <a href="{{route('products.show', $product->id)}}" class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                    <img src="/storage/products/{{$product->photo}}" alt="IMG-PRODUCT">
                </a>

                <div class="w-size23 p-t-5">
                    <a href="{{route('products.show', $product->id)}}" class="s-text20">
                        {{$product->title}}
                    </a>

                    <span class="dis-block s-text17 p-t-6">
                        {{$product->price}}
                    </span>
                </div>
            </li>
            @endforeach
        </ul>

        <!-- Tags -->
        <h4 class="m-text23 p-t-50 p-b-25">
            Tags
        </h4>

        <div class="wrap-tags flex-w">
            @foreach ($tags as $tag)
            <a href="#" class="tag-item">
                {{$tag->title}}
            </a>
            @endforeach
        </div>
    </div>
</div>