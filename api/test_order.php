<?php
require_once "../konmysqli.php";
$respon = array();
if (isset($_GET['id_user'])) {
    $idUser = $_GET['id_user'];
    $sql = "SELECT * FROM basket AS b LEFT JOIN items i ON b.id=i.order_id GROUP BY i.order_id";

    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            $record["id"] = $d["id"];
            $record["total"] = $d["total"];
            $record["status"] = $d["status"];
            $record["date_made"] = $d["date_made"];
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
?>