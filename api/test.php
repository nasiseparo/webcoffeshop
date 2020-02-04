<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['array_cart'])) {
    $id_user = $_POST['id_user'];
    $id = $_POST['id_basket'];

    $arrayCart = $_POST['array_cart'];

    $food_array = explode(",", $arrayCart);

    foreach ($food_array as $key => $value) {

        if (trim($value) != "") {

            $exp = explode("-", $value);

            $values .= "('" . $ins_id . "', '" . $exp[0] . "', '" . $exp[1] . "'),";
        }
    }

    $values = rtrim($values, ",");

    // $save_item = $db->query("INSERT INTO items(order_id, food, qty) " . $values . " ");


    $sql = "INSERT INTO items (order_id, food, qty)VALUES(" . $values . ")";
    $simpan = process($conn, $sql);

    if ($simpan) {
        $respon["sukses"] = 1;
        $respon["pesan"] = "Checkout Berhasil...";
        echo json_encode($respon);
    } else {
        $respon["sukses"] = 0;
        $respon["pesan"] = "Checkout Gagal!!!";
        echo json_encode($respon);
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "Data Belum Di Checkout";
    echo json_encode($respon);
}
?>

<?php
function process($conn, $sql)
{
    $s = false;
    $conn->autocommit(FALSE);
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
    $conn->autocommit(TRUE);
    return $s;
}

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
?>