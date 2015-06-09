<!DOCTYPE html>
<html>
@include('layout._head')
<body>
	<div class="main-container">
           <?php if(Route::current()->getName() == 'dashboard') { $class="cms-admin-dashboard main-row"; } else {  $class="cms-create-form main-row"; }?>
		<div class="{{{$class}}}">
			@include('layout._sidebar')
			<!-- END of .left-section -->
			<div class="right-section">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cms-title">
						<div class="cms-toggle-menu-section">
							<div class="cms-menu-icon">
								<img src="{{{url()}}}/images/menu.png" alt="menu"/>
								<span>Compliance Management System</span>
							</div>
							<div class="cms-right-top-icons">
								<div class="notification">12</div>
								<img src="{{{url()}}}/images/notifications.png" alt="notifications"/>
								<a href="/signout">
									<img src="{{{url()}}}/images/logout.png" alt="logout"/>
								</a>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- END of .cms-toggle-menu-section -->
					</div>
					<!-- END of .cms-title -->
				</div>
				<!-- END of .row -->	
				 @yield('content')
				<!-- END of .right-section-content -->
				@include('layout._footer')
				<!-- END of .row -->
			
			</div>
			<!-- END of .right-section -->
		</div>
		<!-- END of .main-row -->
	</div>
	<!-- END of .main-container -->		
</body>