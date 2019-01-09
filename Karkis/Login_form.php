<div class="form">
<form name="forma" id="forma" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" >
<input type="text" name="korime" placeholder="Username" required />
<input type="password" name="lozinka" placeholder="Password" required />
<input name="submit" type="submit" value="Prijavi se" />
<a href="logout.php"><button type="button">Odjavi se</button></a>

<?php echo $greska; ?>
<?php if(isset($_SESSION["ime"])){
	echo "Ulogiran kao: <b>". $_SESSION["ime"]."</b>";
	}
	else{
	echo "Status: <b>Gost</b>";
	}
?>
</form>

