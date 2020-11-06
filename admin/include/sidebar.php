<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
			
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
<!--		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>-->
		<ul class="nav menu">
                    <li class="<?php if($page=='dashboard'){echo 'active';}?>"><a href="dashboard.php"> <img src="img/dashboard_icon.png"/>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
			<li class="<?php if($page=='viewcategory'){echo 'active';}?>"><a href="viewcategory.php"> <img src="img/category.png"/>&nbsp;&nbsp;&nbsp;Category</a></li>
			
                        <li class="<?php if($page=='product'){echo 'active';}?>"><a href="product.php"> <img src="img/product.png"/>&nbsp;&nbsp;&nbsp;Product</a></li>
                       <li class="<?php if($page=='bestproduct'){echo 'active';}?>"><a href="bestproduct.php"> <img src="img/product.png"/>&nbsp;&nbsp;&nbsp;Best Product</a></li>

                        <li class="<?php if($page=='user'){echo 'active';}?>"><a href="user.php"> <img src="img/usericon.png"/>&nbsp;&nbsp;&nbsp;User</a></li>
                        <li class="<?php if($page=='news'){echo 'active';}?>"><a href="cryptonews.php"> <img src="img/usericon.png"/>&nbsp;&nbsp;&nbsp;News</a></li>
                        <li class="<?php if($page=='delivery'){echo 'active';}?>"><a href="deliveryboy.php"> <img src="img/deliveryboy.png"/>&nbsp;&nbsp;&nbsp;Delivery Boy</a></li>
<!--			<li><a href="addproduct.php"><em class="fa fa-calendar">&nbsp;</em>Add Product</a></li>-->
<!--			<li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
			<li class="active"><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li>-->
			<li class="<?php if($page=='logout'){echo 'active';}?>"><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
	
