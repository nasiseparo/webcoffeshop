<?php
require_once "../konmysqli.php";
$respon = array();


$sql = "SELECT * FROM table_seat";
$jum = getJum($conn, $sql);
if ($jum > 0) {
    $respon["record"] = array();
    $arr = getData($conn, $sql);
    foreach ($arr as $d) {
        $record = array();
        $record["id_table"] = $d["id_table"];
        $record["no_table"] = $d["no_table"];
        $record["status"] = $d["status"];
        array_push($respon["record"], $record);
    }
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