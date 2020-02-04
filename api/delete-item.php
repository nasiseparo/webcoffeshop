<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    $id = $_POST['id_basket'];

    $sql = "DELETE FROM basket WHERE id_basket='$id' AND id_user='$id_user'";
    $simpan = process($conn, $sql);

    if ($simpan) {
        $respon["sukses"] = 1;
        $respon["pesan"] = "Delete Berhasil...";
        echo json_encode($respon);
    } else {
        $respon["sukses"] = 0;
        $respon["pesan"] = "Delete Gagal!!!";
        echo json_encode($respon);
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "Data Belum Di Delete";
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