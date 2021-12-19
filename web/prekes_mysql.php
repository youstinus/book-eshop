<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("mysql.php");
//include("pgconect.php");


if(isset($_GET['atnaujinti']) and $_GET['atnaujinti']='Atnaujinti' and isset($_GET['naujaskiekis']) and isset($_GET['id_naujinti']) and !empty($_GET['id_naujinti'])){
	if(!empty($_GET['naujaskiekis']) and $_GET['naujaskiekis']>0){
		$_SESSION['bendraskiekis'] -= $_SESSION['kiekis'.$_GET['id_naujinti']];
		$_SESSION['kiekis'.$_GET['id_naujinti']] = $_GET['naujaskiekis'];
		$_SESSION['bendraskiekis'] += $_SESSION['kiekis'.$_GET['id_naujinti']];
	} else {
		$_SESSION['bendraskiekis'] -= $_SESSION['kiekis'.$_GET['id_naujinti']];
		$_SESSION['kiekis'.$_GET['id_naujinti']] = 0;
	}
}

echo "
<html>
	<head>
		<head>
			<title>Užsakymai</title>
		</head>
		<body style='background-color:#efe6f7;'>
			<table align='center' style='width:70%' height=100>
				<tr>
					<td align='center' >
					<h1>Krepšelis</h1>
					</td>
				</tr>
			</table>
			<table align='center' style='width:70%' height=50>
				<tr>
					<td style='vertical-align:center;cursor:hand;' onclick=\"window.location.href = 'index.php'\" align='center' width=60%>
					<b style='font-size:20px;color: #3C6478'>Grįžti į pagrindinį</b>
					</td>
				</tr>
			</table>
			<table align='center' style='width:60%' height=50>
				<tr>
					<td align='left' width=60%>
					<b><h3>Knyga</h3></b>
					</td>
					<td align='center' width=20%>
					<b><h3>Kiekis</h3></b>
					</td>
					<td align='center' width=20%>
					<b><h3>Veiksmas</h3></b>
					</td>
				</tr>
			</table>
			<table style='width:60%' align='center'>
					";
					if(!empty($_SESSION['krepselis'])){
						foreach($_SESSION['krepselis'] as $prekes_id)
						{
							if($_SESSION['kiekis'.$prekes_id]!=0){
								$query = mysqli_query($con, "select * from knygos where id=$prekes_id");
								$row = mysqli_fetch_assoc($query);
								//$query = pg_query($pgcon, "select * from knygos where id=$prekes_id");
								//$row = pg_fetch_assoc($query);
								echo "<tr>
									<td align='left' width=60% height=40>
									".$row['pavadinimas']."
									".$row['autorius']."
									".$row['metai']."</td>
									<form action='prekes.php'>
										<td align='center' width=20% height=40>
											<input type='text' value='".$_SESSION['kiekis'.$prekes_id]."' name='naujaskiekis'/>
											<input type='hidden' value='$prekes_id' name='id_naujinti'/>
										</td>
										<td align='center' width=20% height=40>
											<input type='submit' value='Atnaujinti' name='atnaujinti'/>								
										</td>
									</form>
									</tr>";
							}
						}
					}
									
					echo "
			</table>
			<table style='width:60%' align='center'>
				<tr>
					<td>";
						if(isset($_GET['krp']) and $_GET['krp']='valom' and isset($_POST)){
							@extract($_POST);
							if(!isset($uzs_vardas) || !isset($uzs_adresas) || !isset($uzs_email) || strlen($uzs_vardas)<4 || strlen($uzs_adresas)<4 || strlen($uzs_email)<6){
								echo "<b>Įveskite teisingus duomenis</b>";
							} else {
								$uzsakymu_tekstas = "Uzsakymas knygu<br>";
								foreach($_SESSION['krepselis'] as $prekes_id){
									$uzsakymu_tekstas = $uzsakymu_tekstas."id ".$prekes_id." kiekis".$_SESSION['kiekis'.$prekes_id]."<br>";
								}
								mail("example@gmail.com", "Uzsakymas", $uzsakymu_tekstas." $uzs_email");									
								echo "
								<b>Užsakymas išsiųstas, laukite laiško su mokėjimo nurodymu</b>
								";
								$_SESSION['bendraskiekis']=0;
								$_SESSION['krepselis']=array();
								session_destroy();
								header('Location: prekes.php');
							}
						} else {
							if(isset($_SESSION['bendraskiekis']) and $_SESSION['bendraskiekis']!=0)
							echo "
							<form action='prekes.php?krp=valom' method='post' align='center'>							
								Vardas: <input type='text' name='uzs_vardas'/><br>
								Adresas: <input type='text' name='uzs_adresas'/><br>
								E-mail: <input type='text' name='uzs_email'/><br>
								<input type='submit' value='užsakyti' name='valom'/>
							</form>
							";
						}
						echo "
					</td>
				</tr>
			</table>
		</body>
	</head>
</html>


";

?>