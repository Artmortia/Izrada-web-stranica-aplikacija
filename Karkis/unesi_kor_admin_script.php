<?php
if(isset($_POST["submit2"]))
	{
		$tip_korisnika = $_POST["tip"];
		$kor_ime = $_POST["kor_ime"];
		$lozinka = $_POST["lozinka"];
		$ime = $_POST["ime"];
		$prezime = $_POST["prezime"];
		$email = $_POST["email"];
		$slika = $_POST["slika"];
		$id = $_POST['identifikator'];
		
		
		
		$greska = "";
		
		
		if(!isset($kor_ime) || empty($kor_ime))
		{
			$greska.= "Unesite korisnicko ime!<br>";
			
		}
		if(!isset($lozinka) || empty($lozinka))
		{
			$greska.= "Unesite lozinku! <br>";
			
		}
		if(!isset($ime) || empty($ime))
		{
			$greska.= "Unesite ime!<br>";
			
		}
		if(!isset($prezime) || empty($prezime))
		{
			$greska.= "Unesite prezime!<br>";
			
		}
		if(!isset($email) || empty($email))
		{
			$greska.= "Unesite email!<br>";
			
		}
		if(!isset($slika) || empty($slika))
		{
			$greska.= "Unesite sliku!<br>";
			
		}
		
		
		if(empty($greska))
		{
			if($id!=0){
				$upit = "UPDATE korisnik SET
                tip_id = '$tip_korisnika',
                korisnicko_ime = '$kor_ime',
                lozinka = '$lozinka',
                ime = '$ime',
                prezime = '$prezime',
                email = '$email',
                slika = '$slika'
                WHERE korisnik_id = '$id'";
				
				
				
			}
			else{
			
			$upit="INSERT INTO korisnik
                   (tip_id,korisnicko_ime,lozinka,ime,prezime,email,slika)
                   VALUES ('$tip_korisnika','$kor_ime','$lozinka','$ime','$prezime','$email','$slika')";
						
			
			
			}
			izvrsiUpit($baza_pod,$upit);
		}
	}
?>

