<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../admin-page/public/styles.css">
	<title>Admin Dashboard - Unique style</title>
</head>

<body>
	<section id="sidebar">
		<a href="../admin-page" class="brand">
			<i class='bx bxs-user'></i>
			<span class="text">Admin Unique Style</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="../admin-page">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Trang Chủ</span>
				</a>
			</li>
			<li>
				<a href="../client-page">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Trang cửa hàng</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Thống kê</span>
				</a>
			</li>
			<li>
				<a href="?act=messageshop">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Tin nhắn(message)</span>
				</a>
			</li>
			<li>
				<a href="?act=list-product">
					<i class='bx bx-list-ul'></i>
					<span class="text">Danh sách sản phẩm (product)</span>
				</a>
			</li>
			<li>
				<a href="?act=list-category">
					<i class='bx bx-list-ul'></i>
					<span class="text">Danh mục sản phẩm (category)</span>
				</a>
			</li>
			<li>
				<a href="?act=list-user">
					<i class='bx bx-list-ul'></i>
					<span class="text">Quản lý người dùng</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Setting</span>
				</a>
			</li>
			<li>
				<a href="?act=logout" class="logout" onclick="return confirm('Bạn muốn Logout khỏi trang admin?')">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

	<section id="content">
		<nav>
			<i class='bx bx-menu'></i>
			<a href="?act=list-category" class="nav-link">Danh mục (category)</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Tìm kiếm...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">10</span>
			</a>
			<a href="#" class="profile">
				<img src="../admin-page/img/logo.jpg">
			</a>
		</nav>
		<script src="../admin-page/public/script.js"></script>