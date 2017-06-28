<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Randonnées</title>
	<script src="./js/Chart.min.js">
	</script>
	<link href="./css/style.css" rel="stylesheet">
</head>
<body>
	<div>
		<?php
		include("./includes/connection.php");

		//détermination des dates limites de réactualisation (mois et année)
		$mois = date("m");
		$outdatedMois = $mois - 1;
		$annee = date("Y");
		$outdatedAnnee = $annee - 1;
		//séparation dans la requête des entreprises actualisées et non actualisées
		$remplies = $bdd->query("SELECT mois, annee, identifiant FROM infos WHERE (mois>'$outdatedMois') AND (annee='$outdatedAnnee')");
		$pasremplies = $bdd->query("SELECT mois, annee, identifiant FROM infos WHERE (mois<='$outdatedMois') AND (annee<='$outdatedAnnee')");
		$allremplies = $remplies->fetchAll();
		$allpasremplies = $pasremplies->fetchAll();
		//compte du nombre total des actualisés et des non actualisés
		$count = 0;
		$count2= 0;
		foreach ($allremplies as $value) {
		    $count++;
		}
		foreach ($allpasremplies as $value) {
		    $count2++;
		}
		//résultat ramené en pourcentage
		$calc = ($count / ($count + $count2))*100;
		$calc2 = ($count2 / (($count + $count2)))*100 ;
		//ouverture du graph
		?>
		<div class="graph">
			<canvas height="400" id="myChart" width="400"></canvas>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">
			</script>
			<script>
      //transfert du résultat des variables php vers des variables javascript
      var val1 = "<?php echo $calc ?>";
      var val2 = "<?php echo $calc2 ?>";
      var ctx = document.getElementById("myChart").getContext('2d');
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: ["À jour", "Pas à jour"],
              datasets: [{
                  label: '%',
                  //utilisation des variables pour conparer les résultats dans un graphe
                  data: [val1, val2],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                  ],
                  borderColor: [
                      'rgba(255,99,132,1)',
                      'rgba(75, 192, 192, 1)',
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
			</script>
		</div>
	</div>
</body>
</html>
