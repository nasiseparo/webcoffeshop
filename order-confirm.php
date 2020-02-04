<?php
require_once "konmysqli.php";
class emp
{
}

if (
	isset($_POST['gambar']) ||
	(isset($_POST['id_order']))
	) {

	$gambar = $_POST['gambar'];
	$idorder = $_POST['id_order'];

	if (empty($idorder)) {
		$response = new emp();
		$response->success = 0;
		$response->message = "Please dont empty Name";
		die(json_encode($response));
	} else {
		$extension = $idorder . ".jpg";
		$simpan = $conn->query("UPDATE basket SET `payment_status`='1', `image`='$extension' WHERE `id`=$idorder");
		//$simpan = process($conn, $sql);
		//$random = random_word(4);
		$path = "uploads/android/" . $idorder . ".jpg";
		$actualpath = "$path";
		if ($simpan) {
			file_put_contents($path, base64_decode($gambar));
			$response = new emp();
			$response->success = 1;
			$response->message = "Successfully Uploaded";
			die(json_encode($response));
		} else {
			$response = new emp();
			$response->success = 0;
			$response->message = "Error Upload image";
			die(json_encode($response));
		}
	}
} else {
	$response->success = 0;
	$response->message = "No Action";
	die(json_encode($response));
}

function process($conn, $sql)
{
	$s = false;
	$conn->autocommit(false);
	try {
		$rs = $conn->query($sql);
		if ($rs) {
			$conn->commit();
			$last_inserted_id = $conn->insert_id;
			$affected_rows = $conn->affected_rows;
			$s = true;
		}
	} catch (Exception $e) {
		echo 'fail: ' . $e->getMessage();
		$conn->rollback();
	}
	$conn->autocommit(true);
	return $s;
}
// fungsi random string pada gambar untuk menghindari nama file yang sama
function random_word($id = 4)
{
	//$pool = '1234567890abcdefghijkmnpqrstuvwxyz';
	$characters = '0123456789';
	$word = '';
	for ($i = 0; $i < $id; $i++) {
		$charactersLength = strlen($characters);
		$x = $characters[rand(0, $charactersLength - 1)];
		$year = mt_rand(1000, date("Y"));
		//Generate a random month.
		$month = mt_rand(1, 12);
		//Generate a random day.
		$day = mt_rand(1, 30);
		//Using the Y-M-D format.
		$word =  $x . "-" . $year . "-" . $month . "-" . $day;
	}
	return $word;
}
