<?php  include('../config.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>Admin | Dashboard</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
				<h1>Cine_club- Administrateur</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">logout</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>Bienvenue</h1>
		<div class="stats">
			<a href="enregistrerCinema.php" class="first">
				
				<span>Gerer Cinema</span>
			</a>
			<a href="enregistrerSalle.php">
				
				<span>Gerer Salles</span>
			</a>
			<a href="listerCinema.php">
				
				<span>Lister les cinemas</span>
			</a>
			<a href="listerSalle.php">
				
				<span>Lister les salles par cinema</span>
			</a>
		</div>
		<br><br><br>
		<!-- <div class="buttons">
			<a href="users.php">Ajouter un </a>
			<a href="posts.php">Ajouter un  film</a>
		</div> -->
	</div>
</body>
</html>
