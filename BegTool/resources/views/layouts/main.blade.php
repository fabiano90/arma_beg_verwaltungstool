<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Beg Osnabr�ck</title>
<!-- Latest compiled and minified CSS -->
{!! HTML::style('css/bootstrap.min.css') !!} {!!
HTML::style('css/bootstrap-theme.min.css') !!} {!!
HTML::style('css/bootstrap.datetimepicker.css') !!} {!!
HTML::style('css/offcanvas.css') !!} {!! HTML::style('css/style.css')
!!} {!! HTML::script('js/moment.js') !!} {!!
HTML::script('js/jquery.min.js') !!} {!! HTML::script('js/jquery.js')
!!} {!! HTML::script('js/bootstrap.min.js')!!} {!!
HTML::script('js/bootstrap.datetimepicker.js') !!} {!!
HTML::script('js/bootstrap.datetimepicker-de.js') !!} {!!
HTML::script('js/offcanvas.js') !!}
<script>
		$(document).ready(function() {
		      $('.datetimepicker').datetimepicker({
		          language: 'de',
		          pickTime: false,
		          format: 'yyyy-mm-DD'
		      });
		  });
	</script>
</head>
<body>
	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Navigation ein-/ausblenden</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Projekt-Titel</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active">{!! HTML::link('/sundayservices', 'Leitung') !!}</li>
					<li><a href="#ueber">�ber</a></li>
					<li><a href="#kontakt">Kontakt</a></li>
				</ul>
			</div>
			<!-- /.nav-collapse -->
		</div>
		<!-- /.container -->
	</nav>
	<!-- /.navbar -->

	<div class="container">

		<div class="row row-offcanvas row-offcanvas-right">

			<div class="col-xs-12 col-sm-9">
				<p class="pull-right visible-xs">
					<button type="button" class="btn btn-primary btn-xs"
						data-toggle="offcanvas">Toggle nav</button>
				</p>
				<div class="jumbotron">
					<div class="container">@yield('content')</div>
				</div>

			</div>
			<!--/.col-xs-12.col-sm-9-->

			<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
				<div class="list-group">
					<a href="#" class="list-group-item active">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a> <a href="#"
						class="list-group-item">Link</a>
				</div>
			</div>
			<!--/.sidebar-offcanvas-->
		</div>
		<!--/row-->

		<hr>

		<footer>
			<p>� Firma 2014</p>
		</footer>

	</div>
	<!--/.container-->



</body>
</html>