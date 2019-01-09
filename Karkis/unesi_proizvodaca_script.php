<?php
if(isset($_POST["submit2"]))
	{
		$moderator = $_POST['moderatori'];
		$proizvodac = $_POST['naz_proizvodaca'];
		$id = $_POST['identifikator'];
		
		
		
		$greska = "";
		
		if(!isset($moderator) || empty($moderator))
		{
			echo $moderator;
			$greska.= "Unesite moderatora! <br>";
			
		}
		if(!isset($proizvodac) || empty($proizvodac))
		{
			$greska.= "Unesite Naziv proizvodaca!<br>";
			
		}
		
		
		
		if(empty($greska))
		{
			if($id!=0){
				$upit = "UPDATE proizvodac SET
                moderator_id = '$moderator',
				naziv = '$proizvodac'
                WHERE proizvodac_id = '$id'";
				
				
				
			}
			else{
			
			$upit="INSERT INTO proizvodac
                   (moderator_id,naziv)
                   VALUES ('$moderator','$proizvodac')";
						
			
			
			}
			izvrsiUpit($baza_pod,$upit);
		}
	}
?>
