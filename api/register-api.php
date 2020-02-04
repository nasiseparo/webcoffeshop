<?php
require_once "../konmysqli.php";
$respon = array();

if (isset($_POST['username'])) {
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $notlp = $_POST['no_tlp'];
    $alamat = $_POST['alamat'];

    $sqlcek = "SELECT * FROM user WHERE `username`='$userName'";
    $jum = getJum($conn, $sqlcek);
    if ($jum >= 1) {
        $respon["sukses"] = 2;
        $respon["pesan"] = "Maaf... Username Sudah digunakan";
        echo json_encode($respon);
    } else {
        $sql = "INSERT INTO user (`username`,`password`,`nama`,`email`,`no_tlp`,`alamat`) VALUES('$userName', '$password', '$nama', '$email', '$notlp','$alamat')";
        $simpan = process($conn, $sql);

        if ($simpan) {
            $respon["sukses"] = 1;
            $respon["pesan"] = "Registrasi Berhasil...";
            echo json_encode($respon);
        } else {
            $respon["sukses"] = 0;
            $respon["pesan"] = "Registrasi Gagal!!!";
            echo json_encode($respon);
        }
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "Data Belum Di Tambahkan";
    echo json_encode($respon);
}
?>




<?php

function getJum($conn, $sql)
{
    $rs = $conn->query($sql);
    $jum = $rs->num_rows;
    $rs->free();
    return $jum;
}

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
