<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
<head>
<meta charset="UTF-8">
<title>Beg Osnabrück</title>
<!-- Latest compiled and minified CSS -->
{!!HTML::style('css/footable/footable.standalone.css')!!}
{!!HTML::style('css/footable/footable.core.css')!!}
{!!HTML::style('css/bootstrap.min.css')!!}
{!!HTML::style('css/bootstrap-theme.min.css')!!}
{!!HTML::style('css/bootstrap.datetimepicker.css')!!}
{!!HTML::style('css/offcanvas.css')!!}{!!HTML::style('css/style.css')!!}
{!!HTML::style('css/stickysort-css/normalize.css')!!}
{!!HTML::style('css/stickysort-css/stickysort.css')!!}
=======
	<head>
		<meta charset="UTF-8">
		<title>Beg Osnabrück</title>
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git

<<<<<<< HEAD
{!!HTML::style('css/stickysort-css/styles.css')!!}



<!-- JavaScript -->
=======
		<!-- Latest compiled and minified CSS -->
		{!!HTML::style('css/footable/footable.standalone.css')!!}
		{!!HTML::style('css/footable/footable.core.css')!!}
		{!!HTML::style('css/bootstrap.min.css')!!}
		{!!HTML::style('css/bootstrap-theme.min.css')!!}
		{!!HTML::style('css/bootstrap.datetimepicker.css')!!}
		{!!HTML::style('css/offcanvas.css')!!}
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git

<<<<<<< HEAD
{!!HTML::script('js/moment.js')!!}
{!!HTML::script('js/jquery.min.js')!!}
{!!HTML::script('js/jquery.js')!!}
{!!HTML::script('js/bootstrap.min.js')!!}
{!!HTML::script('js/bootstrap.datetimepicker.js')!!}
{!!HTML::script('js/bootstrap.datetimepicker-de.js')!!}
{!!HTML::script('js/jquery.stickysort.js')!!}
{!!HTML::script('js/offcanvas.js')!!}
{!!HTML::script('js/jquery.ba-throttle-debounce.min.js')!!}
{!!HTML::script('js/ScrollToFixed-master/jquery-scrolltofixed.js')!!}
=======
		{!!HTML::style('css/style.css')!!}
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git

<<<<<<< HEAD
{!!HTML::script('js/footable-plugin/footable.js')!!}
{!!HTML::script('js/footable-plugin/footable.plugin.template.js')!!}
{!!HTML::script('js/footable-plugin/footable.sort.js')!!}
{!!HTML::script('js/footable-plugin/footable.filter.js')!!}
=======
		<!-- JavaScript -->
		{!!HTML::script('js/moment.js')!!}
		{!!HTML::script('js/jquery.min.js')!!}
		{!!HTML::script('js/jquery.js')!!}
		{!!HTML::script('js/bootstrap.min.js')!!}
			{!!HTML::script('js/bootstrap.datetimepicker.js')!!}
			{!!HTML::script('js/bootstrap.datetimepicker-de.js')!!}
			{!!HTML::script('js/offcanvas.js')!!}
			{!!HTML::script('js/jquery.ba-throttle-debounce.min.js')!!}

			{!!HTML::script('js/jquery.stickysort.js')!!}
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git


			{!!HTML::script('js/useful.js')!!}
	</head>
	<body>
		<div class="container">
		<h3><a class="" href="/public/users">Logo</a></h3>
		<nav class="navbar navbar-default header">
			<div class="container-fluid">

<<<<<<< HEAD

</head>
<body>


	<div class="container">
	<nav class="navbar navbar-default header">
		<div class="container">

			<div class="navbar-header">
				<a id"title-menu" class="navbar-brand" href="/public/users">Logo</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation ein-/ausblenden</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">

					<li><a href="sundays"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
					<li><a href="songs"><span class="glyphicon glyphicon-music" aria-hidden="true"></span></a></li>
					<li><a href="login/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
			
	            	<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bearbeiten <span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            {!! cleverLink('/kigos', 'Kigo') !!}
	            			{!! cleverLink('/sundayservices', 'Leitung') !!} 
	            			{!! cleverLink('/sermons', 'Predigten') !!}
	            			{!! cleverLink('/users/userlist', 'Mitarbeiter') !!}  
				            {!! cleverLink('/members', 'Geburtstage') !!}  
				          </ul>
				     </li>
	            	
	            	
				</ul>
			</div>
			<!-- /.nav-collapse -->
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.navbar -->
	{!! showMessageAndErrors(Session::get('message'), $errors->all()) !!}
	@yield('menu')
	
	<div class="container">
		@yield('mainslider')
	</div>
	<div class="container">
		@yield('content')
	</div>
		
	

		<div class="row row-offcanvas row-offcanvas-right">

			<div class="col-xs-12 col-sm-9">
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs"
						data-toggle="offcanvas">Menü ausklappen</button>
				</p>
				
=======
				<div class="navbar-header">
					<a id"title-menu" class="navbar-brand" href="#">@yield('title')</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Navigation ein-/ausblenden</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span>
					</button>
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git
					
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						{!! cleverLink('/sundays', 'Kalender') !!}
						{!! cleverLink('/kigos', 'Kigo') !!}
		            	{!! cleverLink('/sundayservices', 'Leitung') !!} 
		            	{!! cleverLink('/sermons', 'Predigt') !!}
		            	{!! cleverLink('/songs', 'Lieder') !!}
		            	<li class="dropdown">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gemeinde <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            {!! cleverLink('/users/userlist', 'Mitarbeiter') !!}  
					            {!! cleverLink('/members', 'Geburtstage') !!}  
					          </ul>
					     </li>
		            	{!! cleverLink('/login/logout', 'Logout') !!}
		            	
					</ul>
				</div>
				<!-- /.nav-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		<!-- /.navbar -->
		<ul class="nav nav-tabs">
			@yield('menu')
		</ul>
		
		<div class="container-fluid navbar-default">@yield('content')</div>

			<div class="row row-offcanvas row-offcanvas-right">

				<div class="col-xs-12 col-sm-9">
					<p class="pull-right visible-xs">
						<button type="button" class="btn btn-primary btn-xs"
							data-toggle="offcanvas">Menü ausklappen</button>
					</p>
					
						
					

				</div>
				<!--/.col-xs-12.col-sm-9-->

				<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
					</div>
				<!--/.sidebar-offcanvas-->
			</div>
			<!--/row-->


			<hr>



			<footer class"footer">
				<p>© Firma 2014</p>
			</footer>

		</div>
<<<<<<< HEAD
		<!--/row-->


	
=======
		<!--/.container-->
>>>>>>> branch 'master' of https://github.com/fabiano90/arma_beg_verwaltungstool.git



	</body>
</html>