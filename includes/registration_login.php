<?php 
	// Хувьсагчид
	$username = "";
	$email    = "";
	$errors = array(); 

	// Хэрэглэгч бүртгэх
	if (isset($_POST['reg_user'])) {
		// Бүр өгөгдлийн формоос авах
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// формийг шалгах
		if (empty($username)) {  array_push($errors, "Uhmm...We gonna need your username"); }
		if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
		if (empty($password_1)) { array_push($errors, "uh-oh you forgot the password"); }
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match");}

		// нэр болон хаяг давхардах эсэх, хоёр удаа бүртгэхгүйн тулд
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // хэрэглэгч бүртгэгдсэн бол
			if ($user['username'] === $username) {
			  array_push($errors, "Нэр бүртгэгдсэн байна");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email бүртгэгдсэн байна");
			}
		}
		// Алдаагүй бол бүртгэх
		if (count($errors) == 0) {
			$password = md5($password_1);// нууц үг нууцлах
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
					  VALUES('$username', '$email', '$password', now(), now())";
			mysqli_query($conn, $query);

			// бүртгэгдсэн ID
			$reg_user_id = mysqli_insert_id($conn); 

			// session - д хадгалах
			$_SESSION['user'] = getUserById($reg_user_id);

			// Админ мөн эсэхийг шалгах
			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "LifeBLog-д тавтай морил";
				// админ хэсэгт шилжүүлэх
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "LifeBLog-д тавтай морил";
				// блог хэсэгт
				header('location: index.php');				
				exit(0);
			}
		}
	}

	// Хэрэглэгч нэвтрэх хэсэг
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Нэрээ оруулна уу"); }
		if (empty($password)) { array_push($errors, "Нууц үгээ оруулна уу"); }
		if (empty($errors)) {
			$password = md5($password);
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				$_SESSION['user'] = getUserById($reg_user_id); 
				// Админ эсэхийг шалгах
				if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
					$_SESSION['message'] = "LifeBLog-д тавтай морил";
					header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
				} else {
					$_SESSION['message'] = "LifeBLog-д тавтай морил";
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Нууц үг эсвэл нэр буруу');
			}
		}
	}
	// хэрэггүй зай, тэмдэгтийг хасах
	function esc(String $value)
	{	
		global $conn;
		$val = trim($value); // хоосон зай устгах
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Кодоор мэдээлэл авах
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// ['id'=>1 'username' => 'Баяраа', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>