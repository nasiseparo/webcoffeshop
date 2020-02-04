<?php
require_once "../konmysqli.php";
$respon = array();

$sql = "SELECT * FROM category ORDER BY id_category ASC";
$jum = getJum($conn, $sql);
if ($jum > 0) {
    $respon["record"] = array();
    $arr = getData($conn, $sql);
    foreach ($arr as $d) {
        $record = array();
        $record["id_category"] = $d["id_category"];
        $record["category_name"] = $d["category_name"];
        $record["category_description"] = $d["category_description"];
        $record["img_category"] = $d["img_category"];
        // $record["food_price"] = $d["food_price"];
        // $record["food_description"] = $d["food_description"];

        array_push($respon["record"], $record);       //tambahkan array 'record' pada array final 'respon'
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