<?php
require_once "../konmysqli.php";
$respon = array();

if (isset($_POST['category']) != "") {
    $foodCategory = $_POST['category'];
    $sql = "SELECT * FROM food WHERE food_category='$foodCategory' ORDER BY id DESC";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            $record["id"] = $d["id"];
            $record["food_name"] = $d["food_name"];
            $record["food_price"] = $d["food_price"];
            $record["food_description"] = $d["food_description"];
            $record["img_category"] = $d["img_category"];

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
} elseif (isset($_POST['category_search']) != "" || (isset($_POST['search']) != "")) {
    $dataSearch = $_POST['search'];
    $foodCategorySearch = $_POST['category_search'];

    $sql = "SELECT * FROM food WHERE food_category='$foodCategorySearch' AND food_name LIKE '%$dataSearch%'";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $respon["record"] = array();
        $arr = getData($conn, $sql);
        foreach ($arr as $d) {
            $record = array();
            $record["id"] = $d["id"];
            $record["food_name"] = $d["food_name"];
            $record["food_description"] = $d["food_description"];
            $record["food_price"] = $d["food_price"];
            $record["food_category"] = $d["food_category"];
            $record["img_category"] = $d["img_category"];

            array_push($respon["record"], $record);
        }
        $respon["sukses"] = 1;
        $respon["pesan"] = "$jum record";
        echo json_encode($respon);
    }
} else {
    echo "data kosong";
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