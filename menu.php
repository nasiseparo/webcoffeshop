<?php

session_start();
require "admin/includes/functions.php";
require "admin/includes/db.php";
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
$bfast = "";
$lunch = "";
$dinner = "";
$special = "";

$get_recent = $db->query("SELECT * FROM food");

if ($get_recent->num_rows) {

	while ($row = $get_recent->fetch_assoc()) {

		if ($row['food_category'] == "Manual") {

			$bfast .= "<div class='parallax_item'>
				
							<a href='detail.php?fid=" . $row['id'] . "'><img src='image/FoodPics/" . $row['id'] . ".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>" . $row['food_name'] . "</h4>
								<p class='desc'>" . substr($row['food_description'], 0, 33) . "...</p>
								<p class='price'>Rp." . $row['food_price'] . "</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
		} elseif ($row['food_category'] == "Coffe") {

			$lunch .=	"<div class='parallax_item'>
				
							<a href='detail.php?fid=" . $row['id'] . "'><img src='image/FoodPics/" . $row['id'] . ".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>" . $row['food_name'] . "</h4>
								<p class='desc'>" . substr($row['food_description'], 0, 33) . "...</p>
								<p class='price'>Rp." . $row['food_price'] . "</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
		} elseif ($row['food_category'] == "Signature") {

			$dinner .= "<div class='parallax_item'>
				
							<a href='detail.php?fid=" . $row['id'] . "'><img src='image/FoodPics/" . $row['id'] . ".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>" . $row['food_name'] . "</h4>
								<p class='desc'>" . substr($row['food_description'], 0, 33) . "...</p>
								<p class='price'>Rp." . $row['food_price'] . "</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
		} elseif ($row['food_category'] == "Chocolate") {

			$special .= "<div class='parallax_item'>
				
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
} else { }

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

			<h2>Discover</h2>
			<h3>FOOD MENU</h3>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<div class="inner_content on_parallax">

			<h2><span class="fresh">Manual Brew Menu</span></h2>

			<div class="parallax_content">

				<?php echo ($bfast == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>" : $bfast; ?>

				<p class="clear"></p>

			</div>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<div class="inner_content on_parallax">

			<h2><span class="fresh">Coffe Menu</span></h2>

			<div class="parallax_content">

				<?php echo ($lunch == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>" : $lunch; ?>

				<p class="clear"></p>

			</div>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<div class="inner_content on_parallax">

			<h2><span class="fresh">Signature Menu</span></h2>

			<div class="parallax_content">

				<?php echo ($dinner == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>" : $dinner; ?>

				<p class="clear"></p>

			</div>

		</div>

	</div>

	<div class="content" onclick="remove_class()">

		<div class="inner_content on_parallax">

			<h2><span class="fresh">Chocolate Menu</span></h2>

			<div class="parallax_content">

				<?php echo ($special == "") ? "<h3 style=' text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>" : $special; ?>

				<p class="clear"></p>

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