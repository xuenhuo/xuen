<!DOCTYPE html>
<html lang="en">
<head>
	<title>Blog</title>
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
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/images/heading-pages-05.jpg);">
		<h2 class="l-text2 t-center">
			Blog
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-60">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-75">
					<div class="p-r-50 p-r-0-lg">
						<!-- item blog -->
						<?php $con = 0 ?>
						@foreach ($articles as $article)
						<div class="item-blog p-b-80">
							<a href="{{route('articles.show', $article->id)}}" class="item-blog-img pos-relative dis-block hov-img-zoom">
								<img src="/storage/articles/{{$article->photo}}" alt="IMG-BLOG">

								<span class="item-blog-date dis-block flex-c-m pos1 size30 bg4 s-text1">
									{{$article->created_at}}
								</span>
							</a>

							<div class="item-blog-txt p-t-33">
								<h4 class="p-b-11">
									<a href="{{route('articles.show', $article->id)}}" class="m-text24">
										{{$article->title}}
									</a>
								</h4>

								<div class="s-text8 flex-w flex-m p-b-21">
									<span>
										By {{$article->author}}
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										@foreach ($article->tags as $tag)
										{{$tag->title}}
										@endforeach
										<span class="m-l-3 m-r-6">|</span>
									</span>

									<span>
										{{$article->comments_count}} Comments
									</span>
								</div>

								<p class="p-b-12">
									<?php $con = mb_substr($article->content, 0, 50) ?>
									{{$con}}...
								</p>

								<a href="{{route('articles.show', $article->id)}}" class="s-text20">
									Continue Reading
									<i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						@endforeach
					</div>

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						{{$articles->links('vendor.pagination.bootstrap-4')}}
					</div>
				</div>

				@include('fashe.blog-sub')
			</div>
		</div>
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
