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
			<center><h2>Korisnici</h2></center>
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
				
					<center><h3>Popis svih korisnika sustava</h3></center>
					<center>
					<?php
						if(isset($_SESSION["id"])){												
							$sql="SELECT * FROM korisnik";
							$rezultat=izvrsiUpit($baza_pod,$sql);
							echo "<table border='1'>
								<tr>
								<th>ID korisnika</th>
								<th>Tip korisnika</th>
								<th>Korisnicko ime</th>
								<th>Lozinka</th>
								<th>Ime</th>
								<th>Prezime</th>
								<th>Email</th>
								<th>Slika</th>
								<th>Uredi</th>
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
								echo "<tr>";
								echo "<td>" . $red['korisnik_id'] . "</td>";
								echo "<td>" . $red['tip_id'] . "</td>";
								echo "<td>" . $red['korisnicko_ime'] . "</td>";
								echo "<td>" . $red['lozinka'] . "</td>";
								echo "<td>" . $red['ime'] . "</td>";
								echo "<td>" . $red['prezime'] . "</td>";
								echo "<td>" . $red['email'] . "</td>";
								echo "<td>" . $red['slika'] . "</td>";								
								echo "<td>"	."<a href='unesi_korisnika.php?korisnik_ident=".$red['korisnik_id']."'>edit</a>"."</td>";
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