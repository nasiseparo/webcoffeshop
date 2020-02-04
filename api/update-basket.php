<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    $id = $_POST['id_basket'];
    $qty = $_POST['qty'];

    $sql = "UPDATE basket SET `qty`='$qty' WHERE `id_basket`='$id' AND `id_user`='$id_user'";
    $simpan = process($conn, $sql);

    if ($simpan) {
        $respon["sukses"] = 1;
        $respon["pesan"] = "Update Berhasil...";
        echo json_encode($respon);
    } else {
        $respon["sukses"] = 0;
        $respon["pesan"] = "Update Gagal!!!";
        echo json_encode($respon);
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "Data Belum Di Update";
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