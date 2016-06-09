<!-- Add Market Data -->
<?php
@require('conn.php');

$building_no = $_POST['building_no'];
$market_name = $_POST['market_name'];
$descript = $_POST['descript'];
$floor = $_POST['floor'];
$year = $_POST['year'];

addMarketData($building_no, $year, $market_name, $floor, $descript);

echo '<script>self.close();</script>';
?>