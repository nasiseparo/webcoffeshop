<?php
require_once "../konmysqli.php";
$respon = array();
if (isset($_GET['id_user'])) {
    $idUser = $_GET['id_user'];
    $sql = "SELECT * FROM basket WHERE `id_user`='$idUser' AND `status`='Waitting Payment' ORDER BY id_basket DESC";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            // $record["id"] = $d["id"];
            $record["id_basket"] = $d["id_basket"];
            $record["id_user"] = $d["id_user"];
            $record["id_food"] = $d["id_food"];
            $record["customer_name"] = $d["customer_name"];
            $record["contact_number"] = $d["contact_number"];
            $record["address"] = $d["address"];
            $record["email"] = $d["email"];
            $record["nama_pesanan"] = $d["nama_pesanan"];
            $record["qty"] = $d["qty"];
            $record["total"] = $d["total"];
            $record["status"] = $d["status"];
            $record["date_made"] = $d["date_made"];
            $record["image"] = $d["image"];
            array_push($respon["record"], $record);       //tambahkan array 'record' pada array final 'respon'
        }
        // sukses
        $hitung = "SELECT SUM(total) AS total_belanja FROM basket WHERE `id_user`='$idUser' AND `status`='pending'";
        $x = getField($conn, $hitung);
        $totalBelanja = $x["total_belanja"];
        $respon["sukses"] = 1;
        $respon["pesan"] = "$jum record";
        $respon["jumlah_item"] = $jum;
        $respon["total_belanja"] = $totalBelanja;

        echo json_encode($respon);
    } else {
        // jika data kosong
        $respon["record"] = "";
        $respon["sukses"] = 0;
        $respon["pesan"] = "0 record";
        $respon["total_belanja"] = "0";
        echo json_encode($respon);
    }
} else {
    echo "No data ";
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

function getData($conn, $sql)
{
    $rs = $conn->query($sql);
    $rs->data_seek(0);
    $arr = $rs->fetch_all(MYSQLI_ASSOC);
    $rs->free();
    return $arr;
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