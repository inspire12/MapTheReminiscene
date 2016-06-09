<?php
@require('conn.php');
$arr = getBuildingForMap($_GET['latLow'], $_GET['lngLow'], $_GET['latHigh'], $_GET['lngHigh']);
echo json_encode($arr);
?>