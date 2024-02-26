<!DOCTYPE html>
<html>

<head>
	<title>How To Add Input Mask Using Jquery In Laravel 10 - shouts.dev</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
</head>

<body>
	<div class="container">
		<h1>How To Add Input Mask Using Jquery In Laravel 10 - shouts.dev</h1>
		<div class="form border p-5">
			<strong>Phone Number:</strong>
			<input type="text" name="phone" class="phone form-control"><br>
			<strong>Mobile Number:</strong>
			<input type="text" name="mobile" class="mobile form-control">
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.phone').inputmask('+7 (999)-999-99-99');
			$('.mobile').inputmask('(999)-999-9999');
		});
	</script>
</body>

</html>