<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("pgconect.php");
//include("mysql.php");

/*
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return str_repeat('Hello', getenv('TIMES'));
});

$app->get('/cowsay', function() use($app) {
  $app['monolog']->addDebug('cowsay');
  return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});

*/




/*foreach($dbopts as $bopsd){
echo $bopsd."<br>";
}
echo $dbopts['user']."<br>";
echo $dbopts['driver']."<br>";
echo $dbopts['pass']."<br>";
echo $dbopts['host']."<br>";
echo $dbopts['port']."<br>";
echo $dbopts['path']."<br>";*/


/*$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);

$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});

$app->run();

*/


//$zodiss = pg_fetch_assoc(pg_query($pgcon, "select * from knygos"));
//echo "<br>".$zodiss['pavadinimas']."<br>".$zodiss['autorius']."<br>".$zodiss['zanras']."<br>".$zodiss['id']."<br>".$zodiss['metai']."<br>";

session_start();
/*if (ini_get('register_globals'))
{
    foreach ($_SESSION as $key=>$value)
    {
        if (isset($GLOBALS[$key]))
            unset($GLOBALS[$key]);
    }
}*/

$ieskomas_zanras = ((isset($_GET['ieskomas_zanras']) and  $_GET['ieskomas_zanras']!="")? $_GET['ieskomas_zanras'] : "");
$elementu_kiekis = ((isset($_GET['elkiekis']) and  $_GET['elkiekis']!="") ? $_GET['elkiekis'] : 6);
$rusiavimas_pagal = ((isset($_GET['rusiuoti']) and $_GET['rusiuoti']!="") ? $_GET['rusiuoti'] : "pavadinimas");
$puslapis = ((isset($_GET['psl']) and $_GET['psl']!="" and $_GET['psl']>0) ? $_GET['psl'] : "1");
$iekoma_fraze = ((isset($_GET['ieska']) and $_GET['ieska']!="") ? $_GET['ieska'] : "");

$pradzia = $elementu_kiekis * ($puslapis - 1);

if($ieskomas_zanras == ""){
	if($iekoma_fraze != "" ){
		$query = "select * from knygos where ((raktai like \"%$iekoma_fraze%\") or (pavadinimas like \"%$iekoma_fraze%\") or (autorius like \"%$iekoma_fraze%\")) order by $rusiavimas_pagal asc";
	} else {
		$query = "select * from knygos order by $rusiavimas_pagal asc";
	}
} else {
	if($iekoma_fraze != "" ){
		$query = "select * from knygos where (zanras like '$ieskomas_zanras') and ((raktai like \"%$iekoma_fraze%\") or (pavadinimas like \"%$iekoma_fraze%\") or (autorius like \"%$iekoma_fraze%\")) order by $rusiavimas_pagal asc";
	} else {
		$query  = "select * from knygos where (zanras like '$ieskomas_zanras') order by $rusiavimas_pagal asc";		
	}
}

//$mq = mysqli_query($con, $query);
//$kiekis_isrinktu = mysqli_num_rows($mq);
$mq = pg_query($pgcon, $query);
$kiekis_isrinktu = pg_num_rows($mq);

if($kiekis_isrinktu <= $elementu_kiekis) {
	$puslapiu = 1;
} else {
	if(($kiekis_isrinktu % $elementu_kiekis) == 0) {
		$puslapiu = $kiekis_isrinktu / $elementu_kiekis;
	} else {
		$puslapiu = $kiekis_isrinktu / $elementu_kiekis + 1;
	}
}

//$query = $query." limit $pradzia, $elementu_kiekis";
//$mq = mysqli_query($con, $query);
//$kiekis_isrinktu = mysqli_num_rows($mq);
$query = $query." limit $elementu_kiekis offset $pradzia";
$mq = pg_query($pgcon, $query);
$kiekis_isrinktu = pg_num_rows($mq);

class Knyga{
	public $id;
	public $pavadinimas;
	public $autorius;
	public $zanras;
	public $metai;
	public function __construct($id, $pavadinimas, $autorius, $zanras, $metai){
		$this->id=$id;
		$this->pavadinimas=$pavadinimas;
		$this->autorius=$autorius;
		$this->zanras=$zanras;
		$this->metai=$metai;
	}
	public function __toString()
    {
		return 
	//	"<td style='vertical-align:center;' align='center' width=30% height=300 bgcolor='cyan'><img src='images/$this->id.jpg' alt='icon'/><br><b>"
	//	.$this->pavadinimas."</b><br>".$this->autorius."<br>".$this->metai."<br>
		"
		<td style='vertical-align:center;' align='center' width=30% height=300 bgcolor='cyan'>
		<form method='post' action='index.php?veiksmas=prideti&id=$this->id'>
			<img src='/images/$this->id.jpg' alt='icon'/><br>
			<b>".$this->pavadinimas."</b><br>
			".$this->autorius."<br>
			".$this->metai."<br>
			<input type='submit' value='Pasirinkti' />
		</form>
		</td>"
		
		;
		
	}
}

for($i=0;$i<$kiekis_isrinktu;$i++){
	$row = pg_fetch_assoc($mq);
	//$row = mysqli_fetch_assoc($mq);
	$knygos[$i]= new Knyga($row['id'],$row['pavadinimas'],$row['autorius'],$row['zanras'],$row['metai']);
}

if(!isset($_SESSION['krepselis'])){
	$_SESSION['krepselis']=array();	
}
if(!isset($_SESSION['bendraskiekis'])){
	$_SESSION['bendraskiekis']=0;
}
if(!empty($_GET['veiksmas']) and $_GET['veiksmas']=='prideti' and !empty($_GET['id'])) {	
	$ids = $_GET['id'];
	if(!isset($_SESSION['kiekis'.$ids])){
		$_SESSION['kiekis'.$ids]=1;
		array_push($_SESSION['krepselis'], $_GET['id']);
	} else {
		$_SESSION['kiekis'.$ids]++;
	}	
	$_SESSION['bendraskiekis']++;
} else if(!empty($_GET['veiksmas']) and $_GET['veiksmas']=='pasalinti'){
	
	/*foreach ($_SESSION as $key=>$value)
    {
        if (isset($GLOBALS[$key]))
            ($GLOBALS[$key]="");
    }*/
	$_SESSION['bendraskiekis']=0;
	$_SESSION['krepselis']=array();
	session_destroy();
}


echo "
<html>
<head>
	<head>
		<title>Svetainė</title>				
	</head>
<body style='background-color:#efe6f7;'>
	<table align='center' style='width:70%;' height=120>
		<tr>
			<td style='vertical-align:center;cursor:hand;' onclick=\"window.location.href = 'index.php'\" align='center' width=80% height=120>
				<h1>Knygų el. parduotuvė</h1>
			</td>
			<td style='vertical-align:top;' width=20%>
				<b style='font-size:25px;color: #3C6478'>Krepšelis</b>
				<form method='post' action='index.php?veiksmas=pasalinti&ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=$puslapis' >
					<input type='submit' value='Išvalyti'/><br>
				</form>
				<b style='color: #3C6478;font-size:20px'>Prekių kiekis: ".$_SESSION['bendraskiekis']."</b>  <a style='color: #3C6478;font-size:20px;text-decoration: none' href='prekes.php'>Peržiūrėti</a><br>
				
			</td>
		</tr>
	</table>
	<table align='center' style='width:70%;'>
		<tr>
			<td style='vertical-align:top;' width=20%>
				<h2>Navigacija</h2>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Visos</b></a><br>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=Detektyvas&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Detektyvai</b></a><br>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=Fantastika&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Fantastika</b></a><br>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=istoriniai_romanai&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Istoriniai romanai</b></a><br>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=Humoras&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Humoras</b></a><br>
				<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=lietuviu_proza&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=&psl=1'><b>Lietuvių proza</b></a><br>";
				/*<hr><form action='ideti.php' method='post'>
				Pavadinimas: <input type='text' name='aa' /><br>
				Autorius: <input type='text' name='ab' /><br>
				Žanras: <input type='text' name='ac' /><br>
				Metai: <input type='text' name='ad' /><br>
				Raktai: <input type='text' name='ae' /><br>
				<br>
				<input type='submit' value='siųsti' />
				</form>*/
			echo"
			</td>
			<td style='vertical-align:top;' width=80%>
				<table align='center' style='width:100%;'>
					<tr>						
						<h2>";
						if($ieskomas_zanras == "Detektyvas") {
							echo "Detektyvai";
						} else if($ieskomas_zanras == "Fantastika") {
							echo "Fantastika";
						} else if($ieskomas_zanras == "istoriniai_romanai") {
							echo "Istoriniai romanai";
						} else if($ieskomas_zanras == "Humoras") {
							echo "Humoras";
						} else if($ieskomas_zanras == "lietuviu_proza") {
							echo "Lietuvių proza";
						} else {
							echo "Visos";
						}
						
						
						echo"</h2>
					</tr>
					<tr>
						<td style='vertical-align:top;' align='left'  width=20%>
							<form action='index.php' method='get'>
								<input type='hidden' name='ieskomas_zanras' value='$ieskomas_zanras' />
								<input type='hidden' name='elkiekis' value='$elementu_kiekis' />
								<input type='hidden' name='rusiuoti' value='$rusiavimas_pagal' />
								<input type='hidden' name='psl' value='1' />
								<input type='text' style='width:80px; border: 3px solid #0CC;color: #3C6478;font-size:20px;' name='ieska' />
								<input type='submit' style='border: 3px solid #0CC;color: #3C6478;font-size:20px;' value='ieškoti' />
							</form>
						</td>
						<td style='vertical-align:top;' align='right' width=30%>
							<b>Puslapiai:</b><br>
							";
							for($i=1; $i<=$puslapiu; $i++) {
								if($i != $puslapis) { echo " <a style='color: #3C6478;font-size:20px;text-decoration: none' href=\"index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=$i\">$i</a> "; 
								} else {echo "<b style='font-size:20px'>$i</b>"; }
							}
							
							echo "														
						</td>
						<td style='vertical-align:top;' align='right' width=20%>
							<b>Rodytini įrašai:</b><br>
							<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=6&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=1'>6</a>
							<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=12&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=1'>12</a>
							<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=24&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=1'>24</a>
							<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=48&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=1'>48</a>
						</td>
						<td style='vertical-align:top;' align='right' width=30%>
						<b>Rūšiuoti pagal:</b><br>
						<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=metai&ieska=$iekoma_fraze&psl=$puslapis'>Metus</a>
						<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=pavadinimas&ieska=$iekoma_fraze&psl=$puslapis'>Pavadinimą</a>
						<a style='color: #3C6478;font-size:20px;text-decoration: none' href='index.php?ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=autorius&ieska=$iekoma_fraze&psl=$puslapis'>Autorių</a>
						</td>
					</tr>
				</table>
				<table align='center' style='width:100%;' border='3'>					
					<tr>";
					$eile=0;
					if(!empty($knygos)){
						foreach($knygos as $knygele){
							echo "	
							
							<td style='vertical-align:center;' align='center' width=30% height=300>
								<form method='post' action='index.php?veiksmas=prideti&id=$knygele->id&ieskomas_zanras=$ieskomas_zanras&elkiekis=$elementu_kiekis&rusiuoti=$rusiavimas_pagal&ieska=$iekoma_fraze&psl=$puslapis'>
									<img src='/images/$knygele->id.jpg' alt='icon'/><br>
										<b style='color: #2C6478;font-size:20px'>".$knygele->pavadinimas."</b><br>
										".$knygele->autorius."<br>
										".$knygele->metai."<br>
									<input type='submit' value='Pasirinkti' />
								</form>
							</td>						
							";
							$eile++;
							if($eile%3==0){
								echo "</tr><tr>";
							}
						}
					} else echo "<td><b>Knygų nėra</b></td>";
					echo "
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</head>
</html>

";
				
//mysqli_close($con);
pg_close($pgcon);			
?>