<?php
  require_once('conn.php');
  $getInfo = getInfoWeb();
  if ($getInfo['code'] == '0') {
    $info = $getInfo['result'];
    $row = $info->fetch_assoc();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Giới thiệu</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- STYLE-->
  <link rel="stylesheet" href="style.css" />
</head>

<body>
	<?php
		include_once('nav.php');
	?>
	<div class="container">
		<div id="show-tuyendung">
			<?= $row['tuyendung'] ?>
		</div>
	</div>
</body>
	<?php
		include_once('footer.php');
	?>