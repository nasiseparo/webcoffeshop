<?php
require_once "../konmysqli.php";
$respon = array();

if (isset($_GET["username"])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";
    $jum = getJum($conn, $sql);
    if ($jum > 0) {
        $d = getField($conn, $sql);
        $record = array();
        $record["id_user"] = $d["id_user"];
        $record["username"] = $d["username"];
        $record["password"] = $d["password"];
        $record["nama"] = $d["nama"];
        $record["email"] = $d["email"];
        $record["no_tlp"] = $d["no_tlp"];
        $record["alamat"] = $d["alamat"];

        $respon["sukses"] = 1;
        $respon["record"] = array();
        array_push($respon["record"], $record);
        $respon["pesan"] = "$jum record";
        echo json_encode($respon);
    } else {
        $respon["sukses"] = 0;
        $respon["pesan"] = "Maaf Login Gagal...";
        echo json_encode($respon);
    }
} else {
    $respon["sukses"] = 0;
    $respon["pesan"] = "? lengkapi data";
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

function getField($conn, $sql)
{
    $rs = $conn->query($sql);
    $rs->data_seek(0);
    $d = $rs->fetch_assoc();
    $rs->free();
    return $d;
}
?>