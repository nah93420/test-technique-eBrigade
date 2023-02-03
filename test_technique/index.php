<?php

function tab($fichier){
    $dataset = fopen($fichier,"r"); //J'ouvre et je recupere le contenu du fichier dataset1
    while(! feof($dataset))//puis je fais une boucle qui me permet de stocker le contenu dans un tableau
    //la fonction feof me permet de tester la fin du fichier
      {
      $tableau[] = fgetcsv($dataset);//j'utilise la fonction fgetcsv pour renvoyer les champs CSV dans le tableau dinosaures1
      }
    fclose($dataset);
    //je fais de même pour le second fichier
    return $tableau;
}
$dinosaures1 = tab("fichiers/dataset1.csv");
$dinosaures2 = tab("fichiers/dataset2.csv");

//ensuite je vais stocker dans un tabelau seulement les dinosaures bipède

$bipedes = [];
foreach($dinosaures2 as $dinosaure) { //je fais une boucle foreach afin de parcourir tous le tableau "dinosaures2"
    if($dinosaure[2] == "bipedal") {
        foreach($dinosaures1 as $dinosaure1){
            if($dinosaure[0] == $dinosaure1[0] ){
                $bipedes[] = $dinosaure; //puis je stock seuelement les bipèdes (le nom)
            }
        }
    }
}

// Maintenant je vais stocker dans un tableau vitesse le nom du dinosaure et ça vitesse correspondante sui est calculer

$vitesses = [];
$g = 9.8;

foreach($bipedes as $bipede) { //je recupère tous les bipèdes
    $legLength = 0; 
    foreach($dinosaures1 as $dinosaure) {//puis tous les dinosaures1
        if($dinosaure[0] == $bipede[0]) {// et losque les noms correspondes je stocke legLength dans une variable
            $legLength = $dinosaure[1];
            break;
        }
    }
    $vitesse = (($bipede[1] / $legLength) - 1) * sqrt($legLength * $g); //je fais le calcule
    $vitesses[] = array($bipede[0], $vitesse);//ensuite je stock ne nom et la vitesse dans le tableau
}
//la focntion usort Trie un tableau en utilisant une fonction de comparaison
usort($vitesses, function($a, $b) { //je l'utilise afin trier les dinosaures selon leurs vitesses (vitesse[1])

    return $b[1] <=> $a[1];
});

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Vitesse</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($vitesses as $vitesse) { ?>
    <tr>
      <td><?php  echo $vitesse[0];  ?></td>
      <td><?php  echo round($vitesse[1],2);  ?> km/h</td>
    </tr>


  <?php } ?>
  </tbody>
</table>
    
</body>
</html>