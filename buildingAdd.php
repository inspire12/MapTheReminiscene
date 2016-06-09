<!-- Add Building Data -->
<?php
@require('conn.php');

$latInput = $_POST['lat'];
$lngInput = $_POST['lng'];

addBuildingData($latInput, $lngInput);

echo 'Done';
?>