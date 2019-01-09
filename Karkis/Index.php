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
			<center><h2>Početna</h2></center>
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
				<form id="proizvodaci_form" name="proizvodaci_form" method="POST" action="Index.php">
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
				</form>
					<center>
					<?php
						if(isset($_POST['proizvodaci'])){
							$proizvodac_id=$_POST['proizvodaci'];
							$sql2="SELECT naziv FROM proizvodac WHERE proizvodac_id='$proizvodac_id'";
							$rezultat2=izvrsiUpit($baza_pod,$sql2);
							$sql="SELECT * FROM konfiguracija WHERE proizvodac_id='$proizvodac_id'";
							$rezultat=izvrsiUpit($baza_pod,$sql);
							$red2=mysqli_fetch_array($rezultat2);
							echo "<center><label> Popis konf. za proizvodaca: <strong>".$red2['naziv']."</strong></label></center>";
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
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
								echo "<tr>";
								echo "<td>" . $red['naziv'] . "</td>";
								echo "<td>" . $red['procesor'] . "</td>";
								echo "<td>" . $red['radna_memorija'] . "</td>";
								echo "<td>" . $red['tvrdi_disk'] . "</td>";
								echo "<td>" . $red['boja'] . "</td>";
								echo "<td>" . $red['ekran'] . "</td>";
								echo "<td>" . $red['graficka_kartica'] . "</td>";
								echo "<td>" . $red['trajanje_baterije'] . "</td>";
								echo "</tr>";
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