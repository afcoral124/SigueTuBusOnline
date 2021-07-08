<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
</head>
<body>
	<h2>recargar seccion de web automaticamente cada cierto tiempo</h2>
	<div id="seccionRecargar"></div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		setInterval(
				function(){
					$('#seccionRecargar').load('interfaz_GPS_viajero1.php');
				},5000
			);
	});
</script>