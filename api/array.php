<?php
require_once "../konmysqli.php";
// $idUser = "test";
// $cName = "test";
// $cNumber = "test";
// $cAddres = "test";
// $cEmail = "test";
// $cTotal = "test";
// $cItem = "test";
// $cStatus = "pending";

// $berhasil = $conn->query("INSERT INTO basket (`customer_name`,
//                                          `contact_number`,
//                                          `address`,
//                                          `email`,
//                                          `total`,
//                                          `status`,
//                                          `date_made`,
//                                          `id_user`)
//                                           VALUES('$cName',
//                                                  '$cNumber',
//                                                  '$cAddres',
//                                                  '$cEmail',
//                                                  '$cTotal',
//                                                  '$cStatus',
//                                                  NOW(),
//                                                  '$idUser')");

// if ($berhasil) {
//     $insert_id = $conn->insert_id;
//     var_dump($insert_id);
//     $d = "[{=Hot Mocachino-1}, {=Ice Tea-2}]";
//     $run = str_replace('}', '', (str_replace('{', '', (str_replace('=', '', (str_replace(array('[', ']'), '', $d)))))));
//     $values = "";
//     $food_array = explode(",", $run);
//     foreach ($food_array as $key => $value) {
//         if (trim($value) != "") {

//             $exp = explode("-", $value);

//             $values .= "('" . $insert_id . "', '" . $exp[0] . "', '" . $exp[1] . "'),";
//         }

//         //$berhasil = process($conn, $sql2);
//     }

//     $values = rtrim($values, ",");
//     $berhasil = $conn->query("INSERT INTO items(`order_id`, `food`, `qty`) VALUES " . $values . " ");
//     var_dump($berhasil);
// }
$sql = "SELECT * FROM items ORDER BY item_id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["item_id"] . " - Name: " . $row["food"] . " " . $row["qty"];
        echo "<br>";
    }
} else {
    echo "0 results";
}

// $sql = $conn->query("SELECT * FROM items");

// if ($sql->num_rows > 0) {
//     while ($row = $sql->fetch_assoc()) {
//         echo $row['item_id'];
//     }
// }
