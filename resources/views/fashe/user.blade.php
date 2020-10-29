<!DOCTYPE html>
<html lang="en">
<head>
	<title>User</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/storage/images/icons/favicon.png"/>
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
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/fashe/util.css">
	<link rel="stylesheet" type="text/css" href="/css/fashe/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	@include('fashe.header')

	<!-- contact -->
	<div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div id="debug"></div>
        <h2 class="w-25 p-3">联系方式</h2>
        <div class="table-responsive">
            <button class="btn btn-primary" id="ctadd">添加</button>
            {{-- <input type="text" class="form-control names" id="lin" placeholder="请输入需要搜索的内容"> --}}
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>名字</th>
                        <th>联系号码</th>
                        <th>地址</th>
                    </tr>
                </thead>
                <tbody id="contact-list">
                    @foreach($contacts as $contact)
                        <tr id="contact{{ $contact->id }}">
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->address}}</td>
                            <td>
                                <button class="btn btn-info ctedit" value="{{$contact->id}}">编辑</button>
                                <button class="btn btn-danger ctdelete" value="{{$contact->id}}">删除</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('fashe.ctform')
    </div>

	<!-- Footer -->
	@include('fashe.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>
	
	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

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
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="/js/fashe/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="/vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>
<!--===============================================================================================-->
    <script src="/js/fashe/main.js"></script>
    <script src="/js/fashe/contact.js"></script>
</body>
</html>
