<?php
	include("baza_connect.php");
	$baza_pod=spojiSeNaBazu();
	$greska=NULL;
	include("Login_script.php");
?>
<html>
<head>
	
	<meta charset="UTF-8">
	<title>IWA Karkis</title>
	<link rel ="stylesheet" href="css/Style.css">
</head>

<body>

	<div id="main-wrapper">
		<header>
		<br>
			<center><h2>O AUTORU</h2></center>
			<?php
				include("Login_form.php")
			?>
			<?php
				include("Navigation.php");
			?>
		</header>
		
			<section id="sekcija">
				<div id = "sekcija_tekst">
					Ime: Karlo<br>
					Prezime: Kiš<br>
					Broj indexa: 42000/13R<br>
					Mail: karkis@foi.hr<br>
					Centar: Varaždin - PITUP<br>
					Godina upisa kolegija: 2016/2017<br>
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