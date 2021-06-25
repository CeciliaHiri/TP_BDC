<?php

// Récupération d'une base de donnée via WEB, et affiche en tableau (array) //

$url = "https://www.data.gouv.fr/fr/datasets/fichier-consolide-des-bornes-de-recharge-pour-vehicules-electriques/";
$bdc = curl_init();
curl_setopt($bdc, CURLOPT_CONNECTTIMEOUT, 3000);
curl_setopt($bdc, CURLOPT_URL, $url);
$data = curl_exec($bdc);
curl_close($bdc);

$handle = fopen($url, 'r');
$countline = true;
while ($line=fgetcsv($handle, 0, ','))
{
  if ($countline)
  {
    $countline=false;
    continue;
  }
  echo '<pre>';
  var_dump($line);
  echo '</pre>';
  // Affichage de la collone voulu et appropriation de l'entité
  // echo 'siren :'.$line[1].'<br>';
  // $p = new Company();
  // $d->setSiren($line[1]);
  // $d->setName($line[0]);
}

?>