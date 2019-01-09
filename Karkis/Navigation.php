<ul>
			<?php
				if(isset($_SESSION["tip"])){
					switch ($_SESSION["tip"]){
						case 0:	
							echo"<li><a href=\"Index.php\">Početna</a></li>
								<li><a href=\"sastavi_konfiguracije.php\">Sastavi konfiguraciju</a></li>
								<li><a href=\"kor_konfiguracije.php\">Moje Konfiguracije</a></li>
								<li><a href=\"kor_narudzbe.php\">Moje narudzbe</a></li>
								<li><a href=\"korisnici_admin.php\">Korisnici</a></li>
								<li><a href=\"unesi_korisnika.php\">Unesi korisnika</a></li>
								<li><a href=\"narudzbe_korisnika.php\">Narudzbe Korisnika</a></li>
								<li><a href=\"proizvodaci.php\">Proizvođaći</a></li>
								<li><a href=\"uredi_proizvodaca.php\">Dodaj proizvođaća</a></li>
								<li><a href=\"isporuci_narudzbu_admin.php\">Isporuci narudzbu</a></li>
								<li><a href=\"sve_konf_admin.php?sort=desc\">Sve konfiguracije</a></li>";
							break;
						case 1:
							echo"<li><a href=\"Index.php\">Početna</a></li>
								<li><a href=\"sastavi_konfiguracije.php\">Sastavi konfiguraciju</a></li>
								<li><a href=\"kor_konfiguracije.php\">Moje Konfiguracije</a></li>
								<li><a href=\"kor_narudzbe.php\">Moje narudzbe</a></li>
								<li><a href=\"narudzbe_korisnika.php\">Narudzbe Korisnika</a></li>";
							break;
						case 2:
							echo"<li><a href=\"Index.php\">Početna</a></li>
								<li><a href=\"sastavi_konfiguracije.php\">Sastavi konfiguraciju</a></li>
								<li><a href=\"kor_konfiguracije.php\">Moje Konfiguracije</a></li>
								<li><a href=\"kor_narudzbe.php\">Moje narudzbe</a></li>";
								
							break;
						

					}
					}
				else{
					echo "<li><a href=\"Index.php\">Početna</a></li>";
				}
				
			?>
			</ul>
