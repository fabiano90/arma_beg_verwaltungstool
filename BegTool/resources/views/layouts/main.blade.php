<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Beg Osnabrück</title>
<!-- Latest compiled and minified CSS -->
{!!HTML::style('css/footable/footable.standalone.css')!!}
{!!HTML::style('css/footable/footable.core.css')!!}
{!!HTML::style('css/bootstrap.min.css')!!}
{!!HTML::style('css/bootstrap-theme.min.css')!!}
{!!HTML::style('css/bootstrap.datetimepicker.css')!!}
{!!HTML::style('css/offcanvas.css')!!}

{!!HTML::style('css/style.css')!!}
<!-- JavaScript -->

{!!HTML::script('js/moment.js')!!}
{!!HTML::script('js/jquery.min.js')!!}
{!!HTML::script('js/jquery.js')!!}
{!!HTML::script('js/bootstrap.min.js')!!}
{!!HTML::script('js/bootstrap.datetimepicker.js')!!}
{!!HTML::script('js/bootstrap.datetimepicker-de.js')!!}
{!!HTML::script('js/offcanvas.js')!!}
{!!HTML::script('js/footable-plugin/footable.js')!!}
{!!HTML::script('js/footable-plugin/footable.filter.js')!!}
{!!HTML::script('js/footable-plugin/footable.sort.js')!!}

{!!HTML::script('js/useful.js')!!}


</head>
<body>
	<div class="container">
	<h3><a class="" href="#">Projekt-Titel</a></h3>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation ein-/ausblenden</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active">{!! HTML::link('/sundayservices/kalender', 'Kalender') !!}</li>
					<li class="active">{!! HTML::link('/sundayservices', 'Leitung') !!}</li>
					<li><a href="/public/users">Gemeinde</a></li>
					<li><a href="/public/songs">Lieder</a></li>
					<li><a href="/public/kigos">Kigos</a></li>
				</ul>
			</div>
			<!-- /.nav-collapse -->
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.navbar -->

	

		<div class="row row-offcanvas row-offcanvas-right">

			<div class="col-xs-12 col-sm-9">
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs"
						data-toggle="offcanvas">Menü ausklappen</button>
				</p>
				<div class="jumbotron">
					<div class="container">@yield('content')</div>
				</div>

			</div>
			<!--/.col-xs-12.col-sm-9-->

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
				@yield('menu')</div>
			<!--/.sidebar-offcanvas-->
		</div>
		<!--/row-->


		<hr>



		<footer>
			<p>© Firma 2014</p>
		</footer>

	</div>
	<!--/.container-->



</body>
</html>