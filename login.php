<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/head_section.php'); ?>
	<title>LifeBlog | Нэвтрэх </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="login.php" >
			<h2>Login</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input type="text" name="username" value="<?php echo $username; ?>" value="" placeholder="Хэрэглэгчийн нэр">
			<input type="password" name="password" placeholder="Нууц үг">
			<button type="submit" class="btn" name="login_btn">Нэвтрэх</button>
			<p>
				Бүртгэлгүй юу? <a href="register.php">Бүртгүүлэх</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->