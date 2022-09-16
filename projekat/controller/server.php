<?php
//Uzimaju se sirovi HTTP POST body podaci
$post_podaci = @file_get_contents('php://input');

//proverava se Content-Type poslatog zahteva. Ako nije poslat, prekida se izvrsavanje skripta.
if (isset ($_SERVER['CONTENT_TYPE'])){
switch ($_SERVER['CONTENT_TYPE']){
case "application/json":
$json_podaci = json_decode ($post_podaci);
$sortiranje = $json_podaci->opcije->sortiranje;
break;
case "application/xml":
$xml_podaci = new SimpleXMLElement($post_podaci,null,false);
$sortiranje = $xml_podaci->sortiranje;
break;
default:
die ("Format podataka nije podrzan!");
break;
}
} else {
die ("Nije definisan tip ulaznih podataka!");
}


//proverava se MIME tip sadrzaja koji zahteva klijent. Ukoliko nije zadat, generise se JSON
if (isset ($_SERVER['HTTP_ACCEPT'])){
switch ($_SERVER['HTTP_ACCEPT']){
case "application/json":
generisiJSON($sortiranje);
break;
case "application/xml":
generisiXML($sortiranje);
break;
default:
generisiJSON($sortiranje);
break;
}
} else {
generisiJSON($sortiranje);
}

function generisiJSON($sortiranje){
include "../model/konekcija.php";
//definiše se mime type
header("Content-type: application/json");?>{"proizvodi":<?php
$sql="SELECT * FROM proizvodi ORDER BY naziv ".$sortiranje;
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
echo '{"greska":"Nastala je greška pri izvršavanju upita."}';
exit();
} else {
//ako je upit u redu
if ($q->num_rows>0){
//ako ima rezultata u bazi
$niz = array();
while ($red=$q->fetch_object()){
$niz[] = $red;
}
//print_r ($niz);
$niz_json = json_encode ($niz);
print ($niz_json);
} else {
//ako nema rezultata u bazi
echo '{"greska":"Nema rezultata."}';
}
}?>}
<?php
$mysqli->close();
}

function generisiXML($sortiranje){
//definiše se mime type
header("Content-type: application/xml");
//konekcija ka bazi
require_once "../model/konekcija.php";

//priprema upita
$sql="SELECT * FROM proizvodi ORDER BY naziv ".$sortiranje;;
//kreiranje XMLDOM dokumenta
$dom = new DomDocument('1.0','utf-8');

//dodaje se koreni element
 $proizvodi = $dom->appendChild($dom->createElement('proizvodi'));

//izvršavanje upita
if (!$q=$mysqli->query($sql)){
//ako se upit ne izvrši
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $proizvodi->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Došlo je do greške pri izvršavanju upita"));
} else {
//ako je upit u redu
if ($q->num_rows>0){
//ako ima rezultata u bazi
$niz = array();
while ($red=$q->fetch_object()){
  //dodaje se element <proizvod> u korenom elementu <proizvodi>
 $proizvod = $proizvodi->appendChild($dom->createElement('proizvod'));

 //dodaje  se <id> element u <proizvod>
 $id = $proizvod->appendChild($dom->createElement('id'));
 //dodaje se elementu <id> sadrzaj cvora
 $id->appendChild($dom->createTextNode($red->id));

 //dodaje  se <naziv> element u <proizvod>
 $naziv = $proizvod->appendChild($dom->createElement('naziv'));
 //dodaje se elementu <naziv> sadrzaj cvora
 $naziv->appendChild($dom->createTextNode($red->naziv));
}
} else {
//ako nema rezultata u bazi
  //dodaje se element <greska> u korenom elementu <proizvodi>
 $greska = $proizvodi->appendChild($dom->createElement('greska'));
 //dodaje se elementu <greska> sadrzaj cvora
 $greska->appendChild($dom->createTextNode("Nema unetih proizvoda"));
}
}
//cuvanje XML-a
$xml_string = $dom->saveXML(); 
echo $xml_string;
//zatvaranje konekcije
$mysqli->close();
}
?>