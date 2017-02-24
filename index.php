<?php
if (empty($_GET['path'])) $_GET['path'] = 'LAN';
$_GET['path'] = htmlentities($_GET['path']);
$_GET['path'] = strtoupper($_GET['path']);
$_GET['path'] = substr($_GET['path'],0,3);
?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
		<meta http-equiv="refresh" content="120">
        <title>TRAINS</title>
		<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <!--<link rel="stylesheet" href="css/uikit.css">-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" ></script>
        <script src="js/uikit.min.js"></script>
		<style>
			@font-face {
				font-family: stdCeefaxFont;
				src: url('ceefax.ttf') format("truetype");
			}

			@font-face {
				font-family: stdTeletextFont;
				src: url('teletext.otf') format("opentype");
			}
			body {
				overflow:hidden;
				font-family: 'stdTeletextFont', sans-serif;
				font-size:25px;
				padding:0;
				margin:0;
				background-color: #222;
				color: #FFF;
			}
			h1 {
				font-family: 'stdCeefaxFont', sans-serif;
				background: #262162;
				color: #fff;
				padding:10px 0;
				margin:0;
				font-size: 60px;
				text-align: center;
			}
			tr.odd {
				background:#444;
			}
			th {
				text-align: left;
			}
			td , td * {
				color:inherit;
			}
			a {
				text-decoration:none;
				color:#FFF;
			}
			#board {
				margin:10px;
			}
			table {
				border-collapse:collapse;
			}
			tr.late {
				background-color:#BB224A;
				color:#FFF;
			}
		</style>
    </head>
    <body>
		<?php
		if ($onetrain) {
			echo '<pre>';
			print_r($response);
			echo '</pre>';
		}
		else {
			?>
			<h1 class="">Departures from <?=$_GET['path']?></h1>
			<div id="board"></div>
			<?php
		}
		?>
		<script>
			function updateBoard(){
				$("#board").load('/ajax.php?path=<?=$_GET['path'];?>');
			}
			$(document).ready(function(){
				updateBoard();
				setInterval(updateBoard, 10000 );
			});
			/* GOOGLE ANALYTICS */
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-75775224-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
