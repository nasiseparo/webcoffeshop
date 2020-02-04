<?php

$db = new mysqli("localhost", "root", "", "cafe");

if ($db->connect_errno) {

	echo "PLEASE BEAR WITH US AS WE ARE CURRENTLY WORKING ON OUR SITE!!!! PLEASE COME BACK LATER";
}
