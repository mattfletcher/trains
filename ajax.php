<?php
$api_key = 'ADD YOUR API KEY HERE';

require("OpenLDBWS.php");
$OpenLDBWS = new OpenLDBWS($api_key,TRUE);
if (!isset($_GET['path'])) $_GET['path'] = 'LAN';
if (strlen($_GET['path']) == 3) {
	$response = json_decode(json_encode($OpenLDBWS->GetDepartureBoard(20,$_GET['path'])), true);
	$onetrain = false;
}
else {
	$response = $OpenLDBWS->GetServiceDetails(base64_decode($_GET['path']));
	$onetrain = true;
}
?>
	<table style="width:100%">
				<tr>
					<th>Due</th>
					<th>Expected</th>
					<th>P</th>
					<th>Destination</th>
					<th>Operator</th>
					<th>Service</th>
				</tr>
			<?php

			foreach ($response['GetStationBoardResult']['trainServices']['service'] as $service) {
				$i++;
				?>
				<tr class="<?php if ($i % 2) echo 'odd ' ; ?><?php if ($service['etd'] != 'On time') echo ' late' ; ?>">
					<!--<td><a href="/--><?//=base64_encode($service['serviceID']);?><!--">--><?//=$service['std'];?><!--</a></td>-->
					<td><?=$service['std'];?></td>
					<td><?=$service['etd'];?></td>
					<td><?php if (isset($service['platform'])) echo $service['platform'];?></td>
					<td><a href="/<?=$service['destination']['location']['crs'];?>"><?=$service['destination']['location']['locationName'];?></a></td>
					<td><span title="<?=$service['operatorCode'];?>"><?=$service['operator'];?></span></td>
					<td>
							<?php
							if ($response['GetStationBoardResult']['locationName'] == $service['origin']['location']['locationName']) {
								echo 'Starts here';
							}
							else {
							?>
							From <a
								href="/<?= $service['origin']['location']['crs']; ?>"><?= $service['origin']['location']['locationName']; ?></a>
						<?php
						}
						?>
					</td>
				</tr>
				<?php



			}
			?>
	</table>
<?php
			if (isset($response['GetStationBoardResult']['nrccMessages'])) {
				foreach ($response['GetStationBoardResult']['nrccMessages'] as $message) {
					//print_r($message);
					echo '<p>'.$message['_'].'</p>';
				}
			}
			?>
