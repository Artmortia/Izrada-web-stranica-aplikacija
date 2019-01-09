<?php
	include("baza_connect.php");
	$baza_pod=spojiSeNaBazu();
	$greska=NULL;
	include("Login_script.php");
	
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<title>IWA Karkis</title>
	<link rel ="stylesheet" href="css/Style.css">
</head>

<body>

	<div id="main-wrapper">
		<header>
		
		<br>
			<center><h2>Moje narudzbe</h2></center>
			<?php
				include("Login_form.php");
			?>
			<br>
			<?php
				include("Navigation.php");
			?>
		<br>
		
		</header>
		
			<section id="sekcija">
				<div id = "sekcija_tekst"> 
				
					<center><h3>Popis mojih narudzba</h3></center>
					<center>
					<?php
						if(isset($_SESSION["id"])){
							if(isset($_GET["id_narudzbe"])){
								$datum = date("Y-m-d");
								$id_narudzba = $_GET["id_narudzbe"];
								$upit = "UPDATE narudzba SET
										status = 'K',
										datum_kreiranja = '$datum'
										WHERE narudzba_id = '$id_narudzba'";
								izvrsiUpit($baza_pod,$upit);
							}
							$korisnik_id=$_SESSION["id"];											
							$sql="SELECT * FROM konfiguracija WHERE korisnik_id='$korisnik_id'";
							
							$rezultat=izvrsiUpit($baza_pod,$sql);
							
							echo "<table border='1'>
								<tr>
								<th>Naziv</th>
								<th>Procesor</th>
								<th>Radna memorija</th>
								<th>Tvrdi disk</th>
								<th>Boja</th>
								<th>Ekran</th>
								<th>Graficka kartica</th>
								<th>Trajanje baterije</th>
								<th>Status</th>
								<th>Datum kreiranja</th>
								<th>Datum isporuke</th>
								<th>Vrijeme isporuke</th>
								<th>Datum dostave</th>
								<th>Naruci</th>
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
									
									$sql2="SELECT * FROM narudzba";
									$rezultat2=izvrsiUpit($baza_pod,$sql2);
									while($red2=mysqli_fetch_array($rezultat2)){
										
										
										if($red['narudzba_id']==$red2['narudzba_id']){
											echo "<tr>";
											echo "<td>" . $red['naziv'] . "</td>";
											echo "<td>" . $red['procesor'] . "</td>";
											echo "<td>" . $red['radna_memorija'] . "</td>";
											echo "<td>" . $red['tvrdi_disk'] . "</td>";
											echo "<td>" . $red['boja'] . "</td>";
											echo "<td>" . $red['ekran'] . "</td>";
											echo "<td>" . $red['graficka_kartica'] . "</td>";
											echo "<td>" . $red['trajanje_baterije'] . "</td>";
											echo "<td>" .$red2['status']. "</td>";
											echo "<td>" .$red2['datum_kreiranja']. "</td>";
											echo "<td>" .$red2['datum_isporuke']. "</td>";
											echo "<td>" .$red2['vrijeme_isporuke']. "</td>";
											echo "<td>" .$red2['datum_dostave']. "</td>";
											if(!$red2['status']){
							
												echo "<td><b><a href='kor_narudzbe.php?id_narudzbe=".$red2['narudzba_id']."'>naruci</a></b></td>";
											}
											else{
												echo "<td>naruceno</td>";
											}
											echo "</tr>";
									
										}
									}
									
								}
						
							
							echo"</table>";
						}
					?>
					</center>
				
				</div>
			</section>
		
		<footer id="footer">
		<br>
			<h4><a href="oautoru.php">O autoru</a></h4>
		<br>	
		</footer>
	
	</div>

</body>

</html>
<?php
	zatvoriVezuNaBazu($baza_pod);
?>