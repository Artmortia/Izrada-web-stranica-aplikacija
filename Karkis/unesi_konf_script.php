<?php
if(isset($_POST["submit2"]))
	{
		$id_korisnika = $_SESSION["id"];
		$proizvodac = $_POST["proizvodac"];
		$naziv = $_POST["naziv"];
		$procesor = $_POST["procesor"];
		$ram = $_POST["ram"];
		$hardDisk = $_POST["hardDisk"];
		$boja = $_POST["boja"];
		$ekran = $_POST["ekran"];
		$gpu = $_POST["GPU"];
		$baterija = $_POST["baterija"];
		$id = $_POST['identifikator'];
		
		
		$greska = "";
		
		if(!isset($proizvodac) || empty($proizvodac))
		{
			echo $proizvodac;
			$greska.= "Unesite proizvodaca! <br>";
			
		}
		if(!isset($naziv) || empty($naziv))
		{
			$greska.= "Unesite naziv!<br>";
			
		}
		if(!isset($procesor) || empty($procesor))
		{
			$greska.= "Unesite procesor! <br>";
			
		}
		if(!isset($ram) || empty($ram))
		{
			$greska.= "Unesite ram!<br>";
			
		}
		if(!isset($hardDisk) || empty($hardDisk))
		{
			$greska.= "Unesite HDD!<br>";
			
		}
		if(!isset($boja) || empty($boja))
		{
			$greska.= "Unesite boju!<br>";
			
		}
		if(!isset($ekran) || empty($ekran))
		{
			$greska.= "Unesite ekran!<br>";
			
		}
		if(!isset($gpu) || empty($gpu))
		{
			$greska.= "Unesite email!<br>";
			
		}
		if(!isset($baterija) || empty($baterija))
		{
			$greska.= "Unesite gpu!<br>";
			
		}
		
		if(empty($greska))
		{
			if($id!=0){
				$upit = "UPDATE konfiguracija SET
                korisnik_id = '$id_korisnika',
                proizvodac_id = '$proizvodac',
                naziv = '$naziv',
                procesor = '$procesor',
                radna_memorija = '$ram',
                tvrdi_disk = '$hardDisk',
                boja = '$boja',
                ekran = '$ekran',
                graficka_kartica = '$gpu',
                trajanje_baterije = '$baterija'
                WHERE konfiguracija_id = '$id'";
				
			}
			else{
			$upit2="INSERT INTO narudzba () VALUES ()";
                   izvrsiUpit($baza_pod,$upit2);
            $upit2="SELECT narudzba_id FROM narudzba ORDER BY narudzba_id DESC LIMIT 1";
                   $rez=izvrsiUpit($baza_pod,$upit2);
                   $row = mysqli_fetch_array($rez);
                   $narudzba = $row['narudzba_id'];
			$upit="INSERT INTO konfiguracija
                   (korisnik_id,proizvodac_id,narudzba_id,naziv,procesor,radna_memorija,tvrdi_disk,boja,ekran,graficka_kartica,trajanje_baterije) 
                   VALUES ('$id_korisnika','$proizvodac','$narudzba','$naziv','$procesor','$ram','$hardDisk','$boja','$ekran','$gpu','$baterija')";
						
			
			
			}
			izvrsiUpit($baza_pod,$upit);
		}
	}
?>
