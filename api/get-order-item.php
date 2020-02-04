<?php
require_once "../konmysqli.php";
$respon = array();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE order_id='$id'";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            $record["item_id"] = $d["item_id"];
            $record["food"] = $d["food"];
            $record["qty"] = $d["qty"];

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