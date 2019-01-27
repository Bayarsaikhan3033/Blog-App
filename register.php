<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>

<?php include('includes/head_section.php'); ?>

<title>LifeBlog | Бүртгүүлэх </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="register.php" >
			<h2>Register on LifeBlog</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Хэрэглэгчийн нэр">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="E-mail хаяг">
			<input type="password" name="password_1" placeholder="Нүүц үг">
			<input type="password" name="password_2" placeholder="Нүүц үг баталгаажуулах">
			<button type="submit" class="btn" name="reg_user">Бүртгүүлэх</button>
			<p>
				Бүртгэлтэй юу? <a href="login.php">Нэвтрэх</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->