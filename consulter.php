<?php require_once('config.php') ?>

<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Home </title>
</head>
<body>
	

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
		<?php 
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=cine_club', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
		
		$reponse = $bdd->query('SELECT * FROM film');
		while ($donnees = $reponse->fetch())
			{
				echo $donnees['numero'] . '<br />';
				echo $donnees['titre'] . '<br />';
				echo $donnees['description'] . '<br />';
				echo $donnees['genre'] . '<br />';
				echo $donnees['anne_sortie'] . '<br />';
				echo $donnees['duree'] . '<br />';
				echo $donnees['budget_realisation'] . '<br /></br></br>' 
		?>
				<input type="button" value="reserver place" />;
				<img src="<?php $donnees['image']?>" />

		<?php	}

		$reponse->closeCursor(); 
		 include( ROOT_PATH . '/includes/footer.php')?>
		