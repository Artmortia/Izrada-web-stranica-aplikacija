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
			<center><h2>Proizvodaci</h2></center>
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
				
					<center><h3>Popis proizvođaća sustava</h3></center>
					<center>
					<?php
						if(isset($_SESSION["id"])){												
							$sql="SELECT * FROM proizvodac";
							$rezultat=izvrsiUpit($baza_pod,$sql);
							echo "<table border='1'>
								<tr>
								<th>Korisnicko ime Prodavaca</th>
								<th>Proizvođać</th>
								<th>Uredi</th>
								</tr>";
							while ($red=mysqli_fetch_array($rezultat)){
								$mod_id = $red['moderator_id'];
								$sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnik_id = $mod_id";
								$rezultat2 = izvrsiUpit($baza_pod,$sql);
								$red2 = mysqli_fetch_array($rezultat2);
								echo "<tr>";
								echo "<td>" . $red2[0] . "</td>";
								echo "<td>" . $red['naziv'] . "</td>";												
								echo "<td>"	."<a href='uredi_proizvodaca.php?korisnik_ident=".$red['proizvodac_id']."'>edit</a>"."</td>";
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
