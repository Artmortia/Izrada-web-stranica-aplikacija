<?php
	include("baza_connect.php");
	$baza_pod=spojiSeNaBazu();
	$greska=NULL;
	include("Login_script.php");
	include("unesi_konf_script.php");
	
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
			<center><h2>Sastavi Konfiguraciju</h2></center>
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
				<center>
				<?php
					if(isset($_GET['konfiguracija'])){
						$konfiguracija = $_GET['konfiguracija'];
						$sql="SELECT * FROM konfiguracija WHERE konfiguracija_id = $konfiguracija";
						$rezultat2 = izvrsiUpit($baza_pod,$sql);
						$red2 = mysqli_fetch_array($rezultat2);
						$naziv_konf = $red2['naziv'];
						$procesor = $red2['procesor'];
						$ram = $red2['radna_memorija'];
						$hdd = $red2['tvrdi_disk'];
						$boja = $red2['boja'];
						$ekran = $red2['ekran'];
						$gpu = $red2['graficka_kartica'];
						$bat = $red2['trajanje_baterije'];
						$proizvodac_id = $red2['proizvodac_id'];
						$id = $_GET['konfiguracija'];
						
					}
					else{
						$naziv_konf = "";
						$procesor = "";
						$ram = "";
						$hdd = "";
						$boja = "";
						$ekran = "";
						$gpu = "";
						$bat = "";
						$proizvodac_id = "";
					}
				?>
				<form name="forma" id="forma" method="POST" 
				action="<?php echo $_SERVER["PHP_SELF"] ?>" >
				<table>
					<input type ="hidden" name = "identifikator" value="<?php if(!empty($id))echo $id;else echo 0;?>">
					<tr><td><label for="proizvodac">Proizvodac</label></td>
					<td><select id="proizvodac" name="proizvodac">
							<?php
								$sql="SELECT * from proizvodac ORDER BY naziv";
								$rezultat = izvrsiUpit($baza_pod,$sql);
								while ($red=mysqli_fetch_array($rezultat)){
							?>
							<option value="<?php echo $red['proizvodac_id']; ?>" <?php if($red['proizvodac_id']==$proizvodac_id){echo"selected";}?>> <?php echo $red['naziv']; ?></option>
							<?php
								}
							?>
					</select></td>
					</tr>
					
					<tr><td><label for="naziv">Naziv konfiguracije: </label></td>
					<td><input name="naziv" id="naziv" type="text" value="<?php echo($naziv_konf);?>"required/></td>
					</tr>
					
					<tr><td><label for="procesor" size=40>Procesor: </label></td>
					<td><input name="procesor" id="procesor" type="text" value="<?php echo($procesor);?>"required/></td>
					</tr>
					
					<tr><td><label for="ram">Radna memorija: </label></td>
					<td><input name="ram" id="ram" type="text" value="<?php echo($ram);?>"required/></td>
					</tr>
					
					<tr><td><label for="hardDisk">Tvrdi disk: </label></td>
					<td><input name="hardDisk" id="hardDisk" type="text" value="<?php echo($hdd);?>"required/></td>
					</tr>
					
					<tr><td><label for="boja">Boja: </label></td>
					<td><input name="boja" id="boja" type="text" value="<?php echo($boja);?>"required/></td>
					</tr>
					
					<tr><td><label for="ekran">Ekran: </label></td>
					<td><input name="ekran" id="ekran" type="text" value="<?php echo($ekran);?>"required/></td>
					</tr>
					
					<tr><td><label for="GPU">Graficka kartica: </label></td>
					<td><input name="GPU" id="GPU" type="text" value="<?php echo($gpu);?>"required/></td>
					</tr>
					
					<tr><td><label for="baterija">Trajanje baterije: </label></td>
					<td><input name="baterija" id="baterija" type="text" value="<?php echo($bat);?>"required/></td>
					</tr>
					
					<tr><td colspan="2" style="text-align:center;"><input type="submit" name="submit2" id="submit" 
						   value="Unesi" /></td></tr>
						  
				</table>
				</form>
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