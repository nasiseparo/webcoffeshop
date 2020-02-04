<?php
require_once "../konmysqli.php";
$respon = array();
date_default_timezone_set('Asia/Jakarta');


$sql = "SELECT `app_code` FROM basket ORDER BY `app_code` DESC";
$q = mysqli_query($conn, $sql);
$jum = mysqli_num_rows($q);
$th = date("y");
$bl = date("m") + 0;
if ($bl < 10) {
    $bl = "0" . $bl;
}
$kd = "APP" . $th . $bl;
if ($jum > 0) {
    $d = mysqli_fetch_array($q);
    $idmax = $d["app_code"];

    $bul = substr($idmax, 5, 2);
    $tah = substr($idmax, 3, 2);
    if ($bul == $bl && $tah == $th) {
        $urut = substr($idmax, 7, 3) + 1;
        if ($urut < 10) {
            $idmax = "$kd" . "00" . $urut;
        } else if ($urut < 100) {
            $idmax = "$kd" . "0" . $urut;
        } else {
            $idmax = "$kd" . $urut;
        }
    } //==
    else {
        $idmax = "$kd" . "001";
    }
} //jum>0
else {
    $idmax = "$kd" . "001";
}
$appcode = $idmax;


if (isset($_POST['nama'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $idfood = $_POST['id_food'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $namapesanan = $_POST['nama_pesanan'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $status = "pending";
    $date =  date('d-m-Y H:i:s');
    $img = $_POST['img'];


    $sql = "INSERT INTO basket (`customer_name`,`contact_number`,`address`,`email`,`total`,`status`,`date_made`,`id_user`,`app_code`)
    VALUES('$nama','$nohp','$alamat','$email', '$total','$status','$date_made','$id_user','$appcode')";
    $simpan = process($conn, $sql);


    if ($simpan) {
        $conn->insert_id;
        // for($i=0;$i<=$qty;$i++){
        //     $ins = "INSERT INTO items (`order_id`,`food`,`qty`) VALUES('$result','$namapesanan','$qty')";
        //     process($conn, $ins);
        // }p
        $respon["sukses"] = 1;
        $respon["pesan"] = "Tambah Berhasil...";
        echo json_encode($respon);
    } else {
        $respon["sukses"] = 0;
        $respon["pesan"] = "Tambah Gagal!!!";
        echo json_encode($respon);
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "Data Belum Di Tambahkan";
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

function getField($conn, $sql)
{
    $rs = $conn->query($sql);
    $rs->data_seek(0);
    $d = $rs->fetch_assoc();
    $rs->free();
    return $d;
}
?>