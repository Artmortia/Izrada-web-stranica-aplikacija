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
			<center><h2>Sve konfiguracije</h2></center>
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
				
					<center><h3>Sve konfiguracije</h3></center>
					
					<form id="proizvodaci_form" name="proizvodaci_form" method="POST" action="sve_konf_admin.php?sort=desc&ok=1">
							
							<select name="proizvodaci">
								<?php
									$sql="SELECT * from proizvodac ORDER BY naziv";
									$rezultat = izvrsiUpit($baza_pod,$sql);
									while ($red=mysqli_fetch_array($rezultat)){
								?>
								<option value="<?php echo $red['proizvodac_id']; ?>"><?php echo $red['naziv']; ?></option>
								<?php
									}
								?>
							</select>
					
						<input name="submit_btn" type="submit" value="Odaberi">
						<a href="sve_konf_admin.php?sort=desc"><button type="button">Sve konfiguracije</button></a>
					</form>
					<center>
						
					<?php
						
						if(isset($_SESSION["id"])){
														
							if(isset($_GET['pro'])){
								$proizvodac_id=$_GET['pro'];
								$sql2 = "SELECT naziv from proizvodac WHERE proizvodac_id = $proizvodac_id";
								$rezultat2 = izvrsiUpit($baza_pod,$sql2);
								$red2 = mysqli_fetch_array($rezultat2);
								echo "<center><label> Popis konf. za proizvodaca: <strong>".$red2['naziv']."</strong></label></center>";
								
								$sql = "SELECT * FROM konfiguracija k, narudzba n, proizvodac p WHERE p.proizvodac_id = $proizvodac_id AND k.narudzba_id = n.narudzba_id AND k.proizvodac_id = p.proizvodac_id";
							}
							else{
							if(isset($_POST['proizvodaci'])){
								
								
								$proizvodac_id=$_POST['proizvodaci'];
								$sql2 = "SELECT naziv from proizvodac WHERE proizvodac_id = $proizvodac_id";
								$rezultat2 = izvrsiUpit($baza_pod,$sql2);
								$red2 = mysqli_fetch_array($rezultat2);
								echo "<center><label> Popis konf. za proizvodaca: <strong>".$red2['naziv']."</strong></label></center>";
								
								$sql = "SELECT * FROM konfiguracija k, narudzba n, proizvodac p WHERE p.proizvodac_id = $proizvodac_id AND k.narudzba_id = n.narudzba_id AND k.proizvodac_id = p.proizvodac_id";
							
							}
							else{								
								$sql="SELECT * FROM konfiguracija k, narudzba n, proizvodac p WHERE k.narudzba_id = n.narudzba_id AND k.proizvodac_id = p.proizvodac_id";
								
							}
							}
							if(isset($_GET['sort'])){
								if($_GET['sort'] == 'asc')
									{
										$sql .= " ORDER BY n.datum_isporuke ASC";
									}
								elseif($_GET['sort'] == 'desc')
									{
										$sql .= " ORDER BY n.datum_isporuke DESC";
									}
							}
							$rezultat=izvrsiUpit($baza_pod,$sql);
							
							echo "<table border = '1'>
								<tr>
								<th>Proizvođać</th>
								<th>Naziv konfiguracije</th>
								<th>Procesor</th>
								<th>Radna memorija</th>
								<th>Tvrdi disk</th>
								<th>Boja</th>
								<th>Ekran</th>
								<th>Graficka kartica</th>
								<th>Trajanje baterije</th>
								<th>Status</th>
								<th>Datum kreiranja</th>";
								
								if(isset($_GET['pro'])or isset($_GET['ok'])){
									if($_GET['sort']=="asc"){
										echo"<th><a href='sve_konf_admin.php?sort=desc&pro=$proizvodac_id'>Datum isporuke</a></th>";
									}
									else{
									
										echo"<th><a href='sve_konf_admin.php?sort=asc&pro=$proizvodac_id'>Datum isporuke</a></th>";
									}
								}
								else{
									if(isset($_POST['proizvodaci'])){
										echo"<th><a href='sve_konf_admin.php?sort=desc&pro=$proizvodac_id'>Datum isporuke</a></th>";	
									}
									else{
										if(isset($_GET['sort'])){
											if($_GET['sort'] == 'asc')
											{
												echo "<th><a href='sve_konf_admin.php?sort=desc'>Datum isporuke</a></th>";


											}
											elseif($_GET['sort'] == 'desc'){
												echo "<th><a href='sve_konf_admin.php?sort=asc'>Datum isporuke</a></th>";
											}
										}
										else{
											echo "<th><a href='sve_konf_admin.php?sort=asc'>Datum isporuke</a></th>";
										}
									}
								}
								
								echo"
								<th>Vrijeme isporuke</th>
								<th>Datum dostave</th>
								
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
									
								
										
										
										
										echo "<tr>";
										echo "<td>" . $red[20] . "</td>";
										echo "<td>" . $red[4] . "</td>";
										echo "<td>" . $red['procesor'] . "</td>";
										echo "<td>" . $red['radna_memorija'] . "</td>";
										echo "<td>" . $red['tvrdi_disk'] . "</td>";
										echo "<td>" . $red['boja'] . "</td>";
										echo "<td>" . $red['ekran'] . "</td>";
										echo "<td>" . $red['graficka_kartica'] . "</td>";
										echo "<td>" . $red['trajanje_baterije'] . "</td>";
										echo "<td>" .$red['status']. "</td>";
										echo "<td>" .$red['datum_kreiranja']. "</td>";
										echo "<td>" .$red['datum_isporuke']. "</td>";
										echo "<td>" .$red['vrijeme_isporuke']. "</td>";
										echo "<td>" .$red['datum_dostave']. "</td>";
											
									
										
									
									
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