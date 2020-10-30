<!DOCTYPE html>
<html lang="en">
<head>
	<title>Order</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/fashe/util.css">
	<link rel="stylesheet" type="text/css" href="/css/fashe/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	@include('fashe.header')

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Order -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<form action="{{route('orders.store')}}" method="POST">
			<div class="container">
				<!-- Cart item -->
				<div class="container-table-cart pos-relative">
					<div class="wrap-table-shopping-cart bgwhite">
						<table class="table-shopping-cart">
							<tr class="table-head">
								<th class="column-1"></th>
								<th class="column-2">Product</th>
								<th class="column-5">Price</th>
								<th class="column-4 p-l-70">Quantity</th>
								<th class="column-5">Total</th>
							</tr>

							@foreach ($carts as $cart)
							<?php $total = 0 ?>
							<?php $all_total = 0 ?>
							<tr class="table-row">
								<td class="column-1">
									<img src="/storage/products/{{$cart->photo}}" alt="IMG-PRODUCT">
								</td>
								<td class="column-2">
									{{$cart->title}}
									@foreach ($cart->cart_details as $detail)
										<ul>
											<li>{{$detail->subtitle}}</li>
										</ul>
									@endforeach
								</td>
								<td class="column-5">${{$cart->price}}</td>
								<td class="column-4">
									{{$cart->quantity}}
								</td>
								<?php $total = ($cart->price)*($cart->quantity) ?>
								<td class="column-5">${{$total}}</td>
								{{-- <input type="hidden" name="total" value="{{$total}}"> --}}
								<?php $all_total += $total ?> 
							</tr>
							@endforeach
						</table>
					</div>
				</div>

				<!-- Total -->
				<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
					<h5 class="m-text20 p-b-24">
						Cart Totals
					</h5>

					<!--  -->
					<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
						<span class="s-text18 w-size19 w-full-sm">
							Shipping:
						</span>

						<div class="w-size20 w-full-sm">
							<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
								<select class="selection-2" name="contact">
									@foreach ($contacts as $contact)
										<option value="{{$contact->id}}">
											{{$contact->address}}  {{$contact->name}}  {{$contact->phone}}
										</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<!--  -->
					<div class="flex-w flex-sb-m p-t-26 p-b-30">
						<span class="m-text22 w-size19 w-full-sm">
							Total: 
						</span>

						<span class="m-text21 w-size20 w-full-sm">
							${{$all_total}}
							<input type="hidden" name="total" value="{{$all_total}}">
						</span>

						<span class="m-text21 w-size20 w-full-sm">
							<textarea type="text" name="remark">备注</textarea>
						</span>
					</div>

					<input type="hidden" name="status" value="未付款">
					<input type="hidden" name="num" value="{{$num}}">
					<div class="size15 trans-0-4">
						<!-- Button -->
						<button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</form>
	</section>

	<!-- Footer -->
	@include('fashe.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script src="/js/fashe/main.js"></script>

</body>
</html>
