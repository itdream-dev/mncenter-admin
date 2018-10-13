<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>
@extends('layouts.back')

@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Dashboard</h2>
        </header>
        <div class="row" id="pageDocument" style="padding-left:10px; padding-top:10px;background-color:#ecedf0;">
            <div class="row" style="">
				<div class="col-md-8 col-lg-5 col-xl-3 ">
					<section class="panel panel-featured-left panel-featured-secondary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-secondary">
										<i class="fa fa-usd"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Sales this month</h4>
										<div class="info" style="padding-top:5px">
											<strong id="netsales-str" class="amount">@if ($shoppingcartsetting['currency'] == "USD") ${{$net_sales}} @else {{$net_sales}} Ft @endif</strong>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-8 col-lg-5 col-xl-3">
					<section class="panel panel-featured-left panel-featured-quartenary">
						<div class="panel-body">
							<div class="widget-summary">
								<div class="widget-summary-col widget-summary-col-icon">
									<div class="summary-icon bg-quartenary">
										<i class="fa fa-user"></i>
									</div>
								</div>
								<div class="widget-summary-col">
									<div class="summary">
										<h4 class="title">Total registered members</h4>
										<div class="info" style="padding-top:5px">
											<strong class="amount">{{count($users)}}</strong>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="row" style="padding-top:50px; padding-bottom:50px;">
				<div class="col-md-8 col-lg-5 col-xl-3">
					<section class="panel">
						<header class="panel-heading">
							<h2 class="panel-title">
								<span class="va-middle">New members</span>
							</h2>
						</header>
						<div class="panel-body">
							<div class="content">
								<ul class="simple-user-list">
								<?php
									$cnt=0;
									foreach ($users as $user){
									if ($cnt > 4) break;
								?>
									<li>
										<figure class="image rounded">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle">
										</figure>
										<span class="title">{{$user->email}}</span>
										<span class="message truncate">{{$user->created_at}}</span>
									</li>
								<?php
									$cnt++;
									}
								?>
								</ul>

							</div>
						</div>
					</section>
				</div>
			</div>
        </div>
    </section>
	<script>

	</script>
@endsection
