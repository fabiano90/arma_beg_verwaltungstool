<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Beg Osnabr&uuml;ck</title>
<!-- Latest compiled and minified CSS -->
{!!HTML::style('css/footable/footable.standalone.css')!!}
{!!HTML::style('css/footable/footable.core.css')!!}
{!!HTML::style('css/bootstrap.min.css')!!}
{!!HTML::style('css/bootstrap-theme.min.css')!!}
{!!HTML::style('css/bootstrap.datetimepicker.css')!!}
{!!HTML::style('css/offcanvas.css')!!}
{!!HTML::style('css/style.css')!!}
{!!HTML::style('css/stickysort-css/normalize.css')!!}
{!!HTML::style('css/stickysort-css/stickysort.css')!!}
{!!HTML::style('css/stickysort-css/styles.css')!!}



<!-- JavaScript -->


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

{!!HTML::script('js/footable-plugin/footable.js')!!}
{!!HTML::script('js/footable-plugin/footable.plugin.template.js')!!}
{!!HTML::script('js/footable-plugin/footable.sort.js')!!}
{!!HTML::script('js/footable-plugin/footable.filter.js')!!}
{!!HTML::script('js/footable-plugin/footable.paginate.js')!!}
{!!HTML::script('js/useful.js')!!}



</head>
<body>


	<div class="container">
	<nav class="navbar navbar-default header">
		<div class="container">

			<div class="navbar-header">
				<a id"title-menu" class="navbar-brand" href="/users">Logo</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Navigation ein-/ausblenden</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
				</button>
				
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/users"  title="Schreibe und empfange Nachrichten"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
					<li><a href="/messages/chat/0#end"  title="Schreibe und empfange Nachrichten"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>@yield('messages')</a></li>
					<li><a href="/sundays" title="Hier kannst du deine Dienste einsehen und tauschen"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></li>
					<li><a href="/songs" title="Informationen zu Liedern"><span class="glyphicon glyphicon-music" aria-hidden="true"></span></a></li>
					<li><a href="/members" title="Geburtstage, Emailadressen und Namen von Gemeindemitgliedern, Mitarbeitern und Freunden"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
	            	<li><a href="/login/logout" title="Auslogen"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
	            	<li class="dropdown" title="Hier geht es zu den Listen Kigo, Leitung und Predigten. Trage deine Dienste ein.">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> <span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            {!! cleverLink('/kigos', 'Kigo') !!}
	            			{!! cleverLink('/sundayservices', 'Leitung') !!} 
	            			{!! cleverLink('/sermons', 'Predigten') !!}
				            {!! cleverLink('/members', 'Nutzer') !!}  
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
		
	


				




			<footer class"footer">
				<p>&copy; Bekennende Evangelische Gemeinde Osnabr&uuml;ck </p>
			</footer>

		</div>


	</body>
</html>