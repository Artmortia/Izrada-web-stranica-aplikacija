<?php
	include("baza_connect.php");
	$baza_pod=spojiSeNaBazu();
	$greska=NULL;
	include("Login_script.php");
	include("unesi_kor_admin_script.php");
	
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
			<center><h2>Unesi Korisnika</h2></center>
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
					if(isset($_GET['korisnik_ident'])){
						$korisnik_identifikator = $_GET['korisnik_ident'];
						$sql="SELECT * FROM korisnik WHERE korisnik_id = $korisnik_identifikator";
						$rezultat2 = izvrsiUpit($baza_pod,$sql);
						$red2 = mysqli_fetch_array($rezultat2);
						$tip_korisnika = $red2['tip_id'];
						$koris_ime = $red2['korisnicko_ime'];
						$password = $red2['lozinka'];
						$name = $red2['ime'];
						$surname = $red2['prezime'];
						$email = $red2['email'];
						$picture = $red2['slika'];
						$id = $_GET['korisnik_ident'];
						
					}
					else{
						$tip_korisnika = "";
						$koris_ime = "";
						$password = "";
						$name = "";
						$surname = "";
						$email = "";
						$picture = "";
					}
				?>
				<form name="forma" id="forma" method="POST" 
				action="<?php echo $_SERVER["PHP_SELF"] ?>" >
				<table>
					
					<input type ="hidden" name = "identifikator" value="<?php if(!empty($id))echo $id;else echo 0;?>">
					
					<tr>
					
					<td><label for="tip">Tip Korisnika: </label></td>
					<td>
					<select name ="tip">
					<option value="0" selected="<?php if($tip_korisnika==0){echo"selected";}?>">Admin</option>
					<option value="1" <?php if($tip_korisnika==1){echo"selected=\"selected\"";}?>>Moderator</option>
					<option value="2" <?php if($tip_korisnika==2){echo"selected=\"selected\"";}?>>Korisnik</option>
					</select>
					</td>	
					
						
						
					</tr>
					
					
					
					<tr><td><label for="kor_ime" size=40>Korisnicko ime: </label></td>
					<td><input name="kor_ime" id="kor_ime" type="text" value = "<?php echo($koris_ime);?>" required/></td>
					</tr>
					
					<tr><td><label for="lozinka">Lozinka: </label></td>
					<td><input name="lozinka" id="lozinka" type="text" value = "<?php echo($password);?>" required/></td>
					</tr>
					
					<tr><td><label for="ime">Ime: </label></td>
					<td><input name="ime" id="ime" type="text" value = "<?php echo($name);?>" required/></td>
					</tr>
					
					<tr><td><label for="prezime">Prezime: </label></td>
					<td><input name="prezime" id="prezime" type="text" value = "<?php echo($surname);?>" required/></td>
					</tr>
					
					<tr><td><label for="email">Email: </label></td>
					<td><input name="email" id="email" type="text" value = "<?php echo($email);?>" required/></td>
					</tr>
					
					<tr><td><label for="slika">Slika: </label></td>
					<td><input name="slika" id="slika" type="text" value = "<?php echo($picture);?>" required/></td>
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
