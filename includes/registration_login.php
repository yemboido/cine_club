<?php 
	
	$username = "";
	$email    = "";
	$errors = array(); 

	
	if (isset($_POST['reg_user'])) {
		
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		
		if (empty($username)) {  array_push($errors, "Entrez un login"); }
		if (empty($email)) { array_push($errors, "Entrez votre email"); }
		if (empty($password_1)) { array_push($errors, "Pas de mots de passe"); }
		if ($password_1 != $password_2) { array_push($errors, "Les deux mots de passe ne correspondent pas ");}

		
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { 
			if ($user['username'] === $username) {
			  array_push($errors, "Ce login existe deja");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Cet email existe deja ");
			}
		}
		
		if (count($errors) == 0) {
			$password = md5($password_1);
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
					  VALUES('$username', '$email', '$password', now(), now())";
			mysqli_query($conn, $query);

			
			$reg_user_id = mysqli_insert_id($conn); 

			
			$_SESSION['user'] = getUserById($reg_user_id);

			
			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "Bravo tu es l'un des notres";
				
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "Bravo tu es l'un des notres";
				
				header('location: index.php');				
				exit(0);
			}
		}
	}

	
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "login requis"); }
		if (empty($password)) { array_push($errors, "Mots de passe requis"); }
		if (empty($errors)) {
			$password = md5($password); 
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				
				$_SESSION['user'] = getUserById($reg_user_id); 

				
				if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
					$_SESSION['message'] = "Tu es connecte bravo";
					
					header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
				} else {
					$_SESSION['message'] = "Tu es connecte bravo";
					
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Mauvais login ou mots de passe');
			}
		}
	}
	
	function esc(String $value)
	{	
		
		global $conn;

		$val = trim($value); 
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}

	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		return $user; 
	}
?>