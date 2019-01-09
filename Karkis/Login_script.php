<?php
	session_start();
	
	if(isset($_GET["odjava"])){
		unset($_SESSION["id"]);
		unset($_SESSION["tip"]);
		unset($_SESSION["ime"]);
		session_destroy();
	}
if(isset($_POST["submit"]))
	{
		$korime = $_POST["korime"];
		$lozinka = $_POST["lozinka"];
		if(isset($korime) && 
			isset($_POST["lozinka"]) &&
			!empty($korime) &&
			!empty($_POST["lozinka"]))
		{
			$upit = "SELECT * FROM korisnik WHERE korisnicko_ime='".$korime."'
			AND lozinka = '".$lozinka."'";
				
				$rezultat = izvrsiUpit($baza_pod,$upit);
				$loginOK = false;
				while($row = mysqli_fetch_array($rezultat)){
					$_SESSION["id"] = $row[0];
					$_SESSION["ime"] = $row["ime"];
					$_SESSION["prezime"] = $row["prezime"];
					$_SESSION["tip"] = $row["tip_id"];
					$loginOK = true;
				}				
				if($loginOK){
					
					header("Location:index.php");
					exit();
				}
				else{
					$greska = "Korisničko ime ili lozinka nisu ispravni! ";
					
				}
		}
		
	}


?>
