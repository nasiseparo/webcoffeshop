<?php

session_start();
require "admin/includes/functions.php";
require "admin/includes/db.php";
require "includes/alamat.php";
// if (!isset($_SESSION["login"])) {
// 	header("Location: login.php");
// 	exit;
// }

$get_recent = $db->query("SELECT * FROM food WHERE food_category='Manual' LIMIT 9");

$result = "";

if ($get_recent->num_rows) {

	while ($row = $get_recent->fetch_assoc()) {

		$result .= "<div class='parallax_item'>
				
							<a href='detail.php?fid=" . $row['id'] . "'><img src='image/FoodPics/" . $row['id'] . ".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>" . $row['food_name'] . "</h4>
								<p class='desc'>" . substr($row['food_description'], 0, 33) . "...</p>
								<p class='price'>Rp." . $row['food_price'] . "</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
	}
}

$get_coffe = $db->query("SELECT * FROM food WHERE food_category='Coffe' LIMIT 9");

$resultCoffe = "";

if ($get_coffe->num_rows) {

	while ($rowCoffe = $get_coffe->fetch_assoc()) {

		$resultCoffe .= "<div class='parallax_item'>
				
							<a href='detail.php?fid=" . $rowCoffe['id'] . "'><img src='image/FoodPics/" . $rowCoffe['id'] . ".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>" . $rowCoffe['food_name'] . "</h4>
								<p class='desc'>" . substr($rowCoffe['food_description'], 0, 33) . "...</p>
								<p class='price'>Rp." . $rowCoffe['food_price'] . "</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
	}
}

?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>

	<title>Terasaki</title>

	<link rel="stylesheet" href="css/main.css" />

	<script src="js/jquery.min.js"></script>

	<script src="js/myscript.js"></script>

</head>

<body>

	<?php require "includes/header.php"; ?>

	<div class="parallax" onclick="remove_class()">

		<div class="parallax_head">

			<h2>Welcome</h2>
			<h3>We are Excited to Cook for You</h3>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<a href="reservation.php" class="submit">BOOK A TABLE</a>

	</div>

	<div class="content remove_pad" onclick="remove_class()">

		<div class="inner_content on_parallax">

			<h2><span class="fresh">Discover Fresh Menu</span></h2>

			<div class="parallax_content">

				<?php echo $result; ?>
				<br>
				<?php echo $resultCoffe; ?>

				<p class="clear"></p>

			</div>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<div class="inner_content">

			<div class="contact">

				<div class="left">

					<h3>LOCATION</h3>
					<p><?= alamat; ?></p>

				</div>

				<div class="left">

					<h3>CONTACT</h3>
					<p><?= phone; ?></p>

				</div>

				<p class="left"></p>

				<div class="icon_holder">

					<a href="#"><img src="image/icons/Facebook.png" alt="image/icons/Facebook.png" /></a>
					<a href="#"><img src="image/icons/Google+.png" alt="image/icons/Google+.png" /></a>
					<a href="#"><img src="image/icons/Twitter.png" alt="image/icons/Twitter.png" /></a>

				</div>

			</div>

		</div>

	</div>

	<div class="footer_parallax" onclick="remove_class()">

		<div class="on_footer_parallax">

			<p>&copy; <?php echo strftime("%Y", time()); ?> <span>Terasaki Coffe</span>. All Rights Reserved</p>

		</div>

	</div>

</body>

</html>