@extends('Admin.Layout')

@section('bodycontent')
@php(error_reporting(1))
<section role="main" class="content-body">
<header class="page-header">
	<h2>Track Your Order</h2>

	<!-- <div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.html">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Pages</span></li>
			<li><span>Timeline</span></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div> -->
</header>

<!--  -->
<div class="row">
<div class="col-md-6 col-lg-12 col-xl-6">
<section class="panel">
<div class="panel-body">
<div class="row">
	<div class="col-md-8">
		<input type="text" name="orderno" class="form-control" placeholder="Write Your Order Number">
	</div>	
	<div class="col-md-4">
		<button type="submit" class="btn btn-primary">Search</button>
	</div>
</div>
</div>
</section>
</div>


</div>
<!--  -->
<!-- start: page -->
<div class="timeline">
	<div class="tm-body">
		<div class="tm-title">
			<h3 class="h5 text-uppercase">Booking Date</h3>
		</div>
		<ol class="tm-items">
			<li>
				<div class="tm-info">
					<div class="tm-icon"><i class="fa fa-star"></i></div>
					<time class="tm-datetime" datetime="2013-11-22 19:13">
						<!-- <div class="tm-datetime-date">7 months ago.</div> -->
						<div class="tm-datetime-time">07:13 PM</div>
				</time>
				</div>
				<div class="tm-box appear-animation" data-appear-animation="fadeInRight"data-appear-animation-delay="100">
					<p>Booking Time</p>
					<!-- <div class="tm-meta">
						<span>
							<i class="fa fa-user"></i> By <a href="#">John Doe</a>
						</span>
						<span>
							<i class="fa fa-tag"></i> <a href="#">Porto</a>, <a href="#">Awesome</a>
						</span>
						<span>
							<i class="fa fa-comments"></i> <a href="#">5652 Comments</a>
						</span>
					</div> -->
				</div>
			</li>
			<li>
				<div class="tm-info">
					<div class="tm-icon"><i class="fa fa-thumbs-up"></i></div>
					<time class="tm-datetime" datetime="2013-11-19 18:13">
						<!-- <div class="tm-datetime-date">7 months ago.</div> -->
						<div class="tm-datetime-time">07:13 PM</div>
					</time>
				</div>
				<div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="250">
					<p>Product Details</p>
				</div>
			</li>
			<!-- <li>
				<div class="tm-info">
					<div class="tm-icon"><i class="fa fa-map-marker"></i></div>
					<time class="tm-datetime" datetime="2013-11-14 17:25">
						<div class="tm-datetime-date">7 months ago.</div>
						<div class="tm-datetime-time">05:25 PM</div>
					</time>
				</div>
				<div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="400">
					<p>
						<a href="#">John Doe</a> is reading a book at <span class="text-primary">New York Public Library</span>
					</p> -->
					<!-- <blockquote class="primary">
						<p>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</p>
						<small>A. Einstein,
							<cite title="Brainyquote">Brainyquote</cite>
						</small>
					</blockquote> -->
					<!-- <div id="gmap-checkin-example" class="mb-sm" style="height: 250px; width: 100%;"></div>
					<div class="tm-meta">
						<span>
							<i class="fa fa-user"></i> By <a href="#">John Doe</a>
						</span>
						<span>
							<i class="fa fa-comments"></i> <a href="#">9 Comments</a>
						</span>
					</div> -->
				<!-- </div>
			</li> -->
		</ol>
		<div class="tm-title">
			<h3 class="h5 text-uppercase">Dispatch Date</h3>
		</div>
		<ol class="tm-items">
			<li>
				<div class="tm-info">
					<div class="tm-icon"><i class="fa fa-heart"></i></div>
					<time class="tm-datetime" datetime="2013-09-08 16:13">
						<!-- <div class="tm-datetime-date">9 months ago.</div> -->
						<div class="tm-datetime-time">04:13 PM</div>
					</time>
				</div>
				<div class="tm-box appear-animation" data-appear-animation="fadeInRight">
					<p>Today Arrival Time</p>
					<!-- <div class="thumbnail-gallery">
						<a class="img-thumbnail" href="assets/images/projects/project-4.jpg">
							<img width="215" src="assets/images/projects/project-4.jpg">
							<span class="zoom">
								<i class="fa fa-search"></i>
							</span>
						</a>
						<a class="img-thumbnail" href="assets/images/projects/project-3.jpg">
							<img width="215" src="assets/images/projects/project-3.jpg">
							<span class="zoom">
								<i class="fa fa-search"></i>
							</span>
						</a>
						<a class="img-thumbnail" href="assets/images/projects/project-2.jpg">
							<img width="215" src="assets/images/projects/project-2.jpg">
							<span class="zoom">
								<i class="fa fa-search"></i>
							</span>
						</a>
					</div> -->
					<!-- <div class="tm-meta">
						<span>
							<i class="fa fa-user"></i> By <a href="#">John Doe</a>
						</span>
						<span>
							<i class="fa fa-tag"></i> <a href="#">Duis</a>, <a href="#">News</a>
						</span>
						<span>
							<i class="fa fa-comments"></i> <a href="#">12 Comments</a>
						</span>
					</div> -->
				</div>
			</li>
			<li>
				<div class="tm-info">
					<div class="tm-icon"><i class="fa fa-video-camera"></i></div>
					<time class="tm-datetime" datetime="2013-09-08 11:26">
						<!-- <div class="tm-datetime-date">9 months ago.</div> -->
						<div class="tm-datetime-time">5:26 PM</div>
					</time>
				</div>
				<div class="tm-box appear-animation" data-appear-animation="fadeInRight">
					<p>Dilevery Boy Details</p>
					<!-- <div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="//player.vimeo.com/video/67957799"></iframe>
					</div> -->
					<!-- <div class="tm-meta">
						<span>
							<i class="fa fa-user"></i> By <a href="#">John Doe</a>
						</span>
						<span>
							<i class="fa fa-thumbs-up"></i> 122 Likes
						</span>
						<span>
							<i class="fa fa-comments"></i> <a href="#">3 Comments</a>
						</span>
					</div> -->
				</div>
			</li>
		</ol>

		<div class="tm-title">
			<h3 class="h5 text-uppercase">Order Dilever Date</h3>
		</div>

	</div>
</div>
<!-- end: page -->
</section>


@endsection