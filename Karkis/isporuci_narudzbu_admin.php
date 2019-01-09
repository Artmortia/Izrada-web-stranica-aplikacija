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
			<center><h2>Isporući narudžbu</h2></center>
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
					<form name="forma" id="forma" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" >
						<label for="datum_od">Pretrazi od: </label>
						<input type="text" name="datum_od" placeholder="dd-mm-yyyy"/ required>
						<label for="datum_do">Pretrazi do: </label>
						<input type="text" name="datum_do" placeholder="dd-mm-yyyy"/ required>
						<input name="submit_search" type="submit" value="Pretraži"/>
					</form>
					<center><h3>Narudžbe Korisnika</h3></center>
					
					<br>
					<?php 
					if (isset($_POST["submit_search"])){
						
							$datum_od = $_POST['datum_od'];
							$datum_do = $_POST['datum_do'];
							$od_baza = date("Y-m-d", strtotime($datum_od));
							$do_baza = date("Y-m-d", strtotime($datum_do));							
							$sql = "SELECT count(datum_kreiranja) FROM narudzba WHERE datum_kreiranja BETWEEN '$od_baza' AND '$do_baza' ";
							$rezultat = izvrsiUpit($baza_pod,$sql);
							$red = mysqli_fetch_array($rezultat);											
							echo "</br>Broj narudzba od $datum_od do $datum_do: $red[0]";
							$sql2 = "SELECT COUNT(k.korisnik_id), kr.korisnicko_ime FROM konfiguracija k, narudzba n, korisnik kr WHERE k.narudzba_id = n.narudzba_id AND k.korisnik_id = kr.korisnik_id AND datum_kreiranja BETWEEN '$od_baza' AND '$do_baza' GROUP BY k.korisnik_id ORDER BY COUNT(k.korisnik_id) DESC LIMIT 10";
							$rezultat = izvrsiUpit($baza_pod,$sql2);
							$broj=1;
							while ($red=mysqli_fetch_array($rezultat)){
								echo "<br>";
								echo $broj.". ".$red['korisnicko_ime'];
								$broj++;
							}
						
						
					}
					else{
					?>
					<center>
					<?php
						if(isset($_SESSION["id"])){
							if(isset($_GET["id_narudzbe"])){
								
								$id_narudzba = $_GET["id_narudzbe"];
								$upit = "UPDATE narudzba SET
										status = 'N'
										WHERE narudzba_id = '$id_narudzba'";
								izvrsiUpit($baza_pod,$upit);
							}
							if(isset($_GET["id_narudzbe_P"])){
								$id_narudzba = $_GET["id_narudzbe_P"];
								$datum = date("Y-m-d");
								$datum_dostave = date('Y-m-d', strtotime($datum.' + 18 days'));
								
								$upit = "UPDATE narudzba SET
										status = 'I',
										datum_dostave = '$datum_dostave'																				
										WHERE narudzba_id = '$id_narudzba'";
								izvrsiUpit($baza_pod,$upit);
							}
																	
							$sql="SELECT * FROM konfiguracija";
							
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
								<th>Isporući</th>
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
									
									$sql2="SELECT * FROM narudzba WHERE status = 'P'";
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
											echo "<td><b><a href='isporuci_narudzbu_admin.php?id_narudzbe_P=".$red2['narudzba_id']."'>Isporući</a></b></td>";
											echo "</tr>";
									
										}
									}
									
								}
						
							
							echo"</table>";
						}
					?>
					</center>
					<?php
					}
					?>
					
				
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
