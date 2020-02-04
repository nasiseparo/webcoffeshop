<?php
$data = "[{table=3}, {table=54}]";
$hasil = str_replace('', '', str_replace('table=', '', str_replace('}', '', str_replace('{', '', str_replace(array('[', ']'), '', $data)))));
$result = explode(", ", $hasil);
$values = "";
foreach ($result as $key => $value) {
    if (trim($value) != "") {
        $values .= "('" . $insert_id . "', '" . $value . "'), ";
    }
}
var_dump($hasil);
var_dump($result);
var_dump($values);
