<!DOCTYPE html>
<html>
<head>
	{{ HTML::style('css/bootstrap.min.css'); }}
	{{ HTML::style('css/bootstrap-theme.min.css'); }}
	{{ HTML::style('css/site.css'); }}
    {{HTML::script('js/jquery.js');}}
    {{HTML::script('js/bootstrap.min.js');}}
    {{HTML::script('js/javascript.js');}}
</head>
<body>
	<div class="jumbotron">
		<h1>MusicBox Converter</h1>
	</div>
	{{ $content }}
	<footer>
	</footer>
</body>
</html>