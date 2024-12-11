<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../admin-page/public/styles.css">
	<title>Admin Dashboard - Unique style</title>
	<style>
		@import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap");

		.blur {
			filter: blur(5px);
			transition: filter 0.3s ease;
		}

		.popup {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.5);
			display: flex;
			justify-content: center;
			align-items: center;
			visibility: hidden;
			opacity: 0;
			transition: opacity 0.3s ease, visibility 0.3s ease;
		}

		.popup.show {
			visibility: visible;
			opacity: 1;
		}

		.popup-content {
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			text-align: center;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
		}

		.popup-content h2 {
			margin: 0 0 10px;
			font-family: 'Poppins', sans-serif;
		}

		.popup-content button {
			padding: 10px 20px;
			margin: 5px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
		}

		.popup-content .confirm {
			background-color: #f44336;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease, transform 0.2s ease;
		}

		.popup-content .confirm:hover {
			background-color: #d32f2f;
			transform: scale(1.05);
			color: #fff;
		}

		.popup-content .cancel {
			background-color: #ccc;
			color: #000;

		}

		.popup-content .cancel:hover {
			background-color: #ccc;
			color: #000;
			transform: scale(1.05);
		}

		.title-admin {
			display: flex;
			justify-content: center;
			align-items: center;
			text-decoration: none;
			color: #000;
			transition: all 0.3s ease;
		}
		
		.title-admin:hover {
			color: #3c91e6;
			transform: scale(1.1);
		}
	</style>
</head>

<body>
	<section id="sidebar">
		<a>.</a>
		<li>
		<a href="../admin-page/" style="text-align:center" class="title-admin">
			<h1>Admin Unique Style<i class='bx bx-user'></i></h1>
		</a>
		</li>
		<ul class="side-menu top">
			<li class="active">
				<a href="../admin-page">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Trang Chủ</span>
				</a>
			</li>
			<li>
				<a href="../client-page">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Trang cửa hàng</span>
				</a>
			</li>
			<li>
				<a href="?act=thongke">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Thống kê</span>
				</a>
			</li>
			<li>
				<a href="?act=list-order">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Quản lý đơn hàng</span>
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
			<li>
				<a href="?act=sizes-list">
					<i class='bx bx-list-ul'></i>
					<span class="text">Quản lý biến thể</span>
				</a>
			</li>
			<li>
				<a href="?act=comment-list">
					<i class='bx bx-list-ul'></i>
					<span class="text">Quản lý bình luận</span>
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
				<div id="main-content">
					<a href="#" class="logout" onclick="openLogoutPopup(event)">
						<i class='bx bxs-log-out-circle'></i>
						<span class="text">Logout</span>
					</a>
				</div>
				<div id="logout-popup" class="popup">
					<div class="popup-content">
						<h2>Bạn muốn Logout khỏi trang admin?</h2>
						<button class="confirm" onclick="confirmLogout()">Logout</button>
						<button class="cancel" onclick="closeLogoutPopup()">Cancel</button>
					</div>
				</div>
			</li>
		</ul>
	</section>
	<section id="content">
		<nav>
			<i class='bx bx-menu'></i>
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
				<span class="num"></span>
			</a>
			<a href="#" class="profile">
				<img src="../admin-page/img/logo.jpg">
			</a>
		</nav>
		<script>
			const mainContent = document.getElementById('main-content');
			const popup = document.getElementById('logout-popup');
			// thông báo
			function openLogoutPopup(event) {
				event.preventDefault();
				mainContent.classList.add('blur');
				popup.classList.add('show');
			}
			// close thông báo
			function closeLogoutPopup() {
				mainContent.classList.remove('blur');
				popup.classList.remove('show');
			}
			// xác nhận
			function confirmLogout() {
				window.location.href = '?act=logout';
			}
		</script>
		<script src="../admin-page/public/script.js"></script>