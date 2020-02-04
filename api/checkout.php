<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    $id = $_POST['id_basket'];

    $sql = "UPDATE basket SET `status`='Waitting Payment' WHERE `id_basket`='$id' AND `id_user`='$id_user'";
    $simpan = process($conn, $sql);

    if ($simpan) {
        $sql2 = "INSERT INTO items(order_id, food, qty) " . $values . " ";
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