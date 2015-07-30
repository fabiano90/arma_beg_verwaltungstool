<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>ARMA</title>
<!-- Latest compiled and minified CSS -->
{!! HTML::style('css/bootstrap.min.css') !!} {!!
HTML::style('css/bootstrap-theme.min.css') !!} {!!
HTML::style('css/style.css') !!} {!! HTML::script('js/jquery.min.js')
!!} {!! HTML::script('js/bootstrap.min.js') !!}
</head>
<body>
	<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Studentenverwaltung</title>
<!-- Latest compiled and minified CSS -->
{!! HTML::style('css/bootstrap.min.css') !!} {!!
HTML::style('css/bootstrap-theme.min.css') !!} {!!
HTML::style('css/bootstrap.datetimepicker.css') !!} {!!
HTML::style('css/style.css') !!} {!! HTML::script('js/moment.js') !!}
{!! HTML::script('js/jquery.min.js') !!} {!!
HTML::script('js/bootstrap.min.js') !!} {!!
HTML::script('js/bootstrap.datetimepicker.js') !!} {!!
HTML::script('js/bootstrap.datetimepicker-de.js') !!}
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
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Navigation</span> <span class="icon-bar"></span>
					<span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				{!! HTML::link('/', 'Studentenverwaltung',
				array('class'=>'navbar-brand')) !!}
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Studenten <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">{!!
							HTML::link('users/index', 'Liste') !!} {!!
							HTML::link('users/new', 'Hinzuf�gen') !!}
						</ul></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Semster <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">{!! HTML::link('semesters/posts',
							'Liste') !!} {!! HTML::link('semesters/friends', 'Hinzuf�gen') !!}
						</ul></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">@yield('content')</div>
</body>
</html>