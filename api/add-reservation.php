<?php
require_once "../konmysqli.php";
date_default_timezone_set('Asia/Jakarta');
$respon = array();
if (isset($_POST['id_user'])) {
    $idUser = $_POST['id_user'];
    $noTable = $_POST['no_table'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dateRes = $_POST['date'];
    $time = $_POST['time'];
    $suggestions = "from app";
    $hasil = str_replace('', '', str_replace('table=', '', str_replace('}', '', str_replace('{', '', str_replace(array('[', ']'), '', $noTable)))));


    $simpan = $conn->query("INSERT INTO reservation(`id_user`,`no_of_guest`,`email`,`phone`,`date_res`,`time`,`suggestions`)
    VALUES('$idUser','$hasil', '$email','$phone','$dateRes','$time','$suggestions')");
    ///$simpan = process($conn, $sql);

    if ($simpan) {
        $insert_id = $conn->insert_id;
        $hasil = str_replace('', '', str_replace('table=', '', str_replace('}', '', str_replace('{', '', str_replace(array('[', ']'), '', $noTable)))));
        $result = explode(", ", $hasil);
        $values = "";
        foreach ($result as $key => $value) {
            if (trim($value) != "") {
                $values .= "('" . $insert_id . "', '" . $value . "'),";
            }
        }
        $values = rtrim($values, ",");
        $res = $conn->query("INSERT INTO table_seat(`reserve_id`,`no_table`) VALUES " . $values . " ");

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

function getField($conn, $sql)
{
    $rs = $conn->query($sql);
    $rs->data_seek(0);
    $d = $rs->fetch_assoc();
    $rs->free();
    return $d;
}
?>
