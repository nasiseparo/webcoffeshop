<?php
require_once "../konmysqli.php";
$respon = array();

if (isset($_GET['id_user'])) {
    $iduser = $_GET['id_user'];
    $sql = "SELECT * FROM reservation WHERE id_user='$iduser' ORDER BY reserve_id DESC";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            $record["reserve_id"] = $d["reserve_id"];
            $record["id_user"] = $d["id_user"];
            $record["no_of_guest"] = $d["no_of_guest"];
            $record["date_res"] = $d["date_res"];
            $record["time"] = $d["time"];

            array_push($respon["record"], $record);       //tambahkan array 'record' pada array final 'respon'
        }
        // sukses
        $respon["sukses"] = 1;
        $respon["pesan"] = "$jum record";
        echo json_encode($respon);
    } else {
        // jika data kosong
        $respon["record"] = "";
        $respon["sukses"] = 0;
        $respon["pesan"] = "0 record";
        echo json_encode($respon);
    }
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
?>