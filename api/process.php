<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['id_user'])) {
    $idUser = $_POST['id_user'];
    $cName = $_POST['customer_name'];
    $cNumber = $_POST['contact_number'];
    $cAddres = $_POST['address'];
    $cEmail = $_POST['email'];
    $cTotal = $_POST['total'];
    $cItem = $_POST['item'];
    $cStatus = "pending";
    $berhasil = $conn->query("INSERT INTO basket (`customer_name`,
                                `contact_number`,
                                `address`,
                                `email`,
                                `total`,
                                `status`,
                                `date_made`,
                                `id_user`)
                                VALUES('$cName',
                                '$cNumber',
                                '$cAddres',
                                '$cEmail',
                                '$cTotal',
                                '$cStatus',
                                NOW(),
                                '$idUser')");
    //$simpan = process($conn, $sql);
    if ($berhasil) {
        $ins_id = $conn->insert_id;
        $run = str_replace('}', '', (str_replace('{', '', (str_replace('=', '', (str_replace(array('[', ']'), '', $cItem)))))));
        $food_array = explode(",", $run);
        foreach ($food_array as $key => $value) {

            if (trim($value) != "") {

                $exp = explode("-", $value);

                $values .= "('" . $ins_id . "', '" . $exp[0] . "', '" . $exp[1] . "'),";
            }
        }

        $values = rtrim($values, ",");
        $success = $conn->query("INSERT INTO items(`order_id`, `food`, `qty`) VALUES " . $values . " ");
        if ($success) {
            $respon["sukses"] = 1;
            $respon["pesan"] = "Item Berhasil...";
            echo json_encode($respon);
        }
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


?>