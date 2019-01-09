<?php
	include("baza_connect.php");
	$baza_pod=spojiSeNaBazu();
	$greska=NULL;
	include("Login_script.php");
	include("unesi_proizvodaca_script.php");
	
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
			<center><h2>Dodaj proizvođaća</h2></center>
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
						$sql="SELECT * FROM proizvodac WHERE proizvodac_id = $korisnik_identifikator";
						$rezultat2 = izvrsiUpit($baza_pod,$sql);
						$red2 = mysqli_fetch_array($rezultat2);
						$moderator = $red2['moderator_id'];
						$proizvodac = $red2['naziv'];
						$id = $_GET['korisnik_ident'];
						
					}
					else{
						$moderator = "";
						$proizvodac = "";
						$id = 0;
						
						
						
					}
				?>
				<form name="forma" id="forma" method="POST" 
				action="<?php echo $_SERVER["PHP_SELF"] ?>" >
				<table>
					<input type ="hidden" name = "identifikator" value="<?php if(!empty($id))echo $id;else echo 0;?>">
					<tr><td><label for="moderatori">Prodavać:</label></td>
					<td><select name="moderatori">
						<?php
							if(isset($_GET['korisnik_ident'])){
							$sql3="SELECT * FROM korisnik k, proizvodac p WHERE k.korisnik_id = p.moderator_id GROUP BY k.korisnicko_ime";
							}
							else{
							$sql3="SELECT * FROM korisnik WHERE tip_id = 1";
							}
							
							$rezultat3 = izvrsiUpit($baza_pod,$sql3);
						
							while ($red4=mysqli_fetch_array($rezultat3)){
								
								 
								
						?>
							
						<option value="<?php echo $red4['korisnik_id'];?>" <?php   if(isset($_GET['korisnik_ident'])){if($moderator==$red4['moderator_id']){echo"selected";}}?>><?php echo $red4['korisnicko_ime']; ?></option>
						
						
						<?php
							}
						?>
					
					</select></td>
					</tr>
					
					
									
					<tr><td><label for="naz_proizvodaca" size=40>Naziv Proizvođaća: </label></td>
					<td><input name="naz_proizvodaca" id="naz_proizvodaca" type="text" value = "<?php echo($proizvodac);?>" required/></td>
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