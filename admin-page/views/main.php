<!-- main -->
<main>
	<div class="head-title">
		<div class="left">
			<h1>Admin - XÂY DỰNG WEBSITE BÁN QUẦN ÁO UNIQUE STYLE</h1>
			<ul class="breadcrumb">
				<li>
					<a href="#">Dashboard</a>
				</li>
				<li><i class='bx bx-chevron-right'></i></li>
				<li>
					<a class="active" href="../admin-page">Trang chủ</a>
				</li>
			</ul>
		</div>
		<a href="#" class="btn-download">
			<i class='bx bxs-cloud-download'></i>
			<span class="text">Tải PDF</span>
		</a>
	</div>
	<ul class="box-info">
		<li>
			<i class='bx bxs-calendar-check'></i>
			<span class="text">
				<h3><?= $totalOrders;?> : Đơn hàng</h3>
				<h3><?= $totalQuantity; ?> : Tổng số lượng đơn hàng</h3>
				
			</span>
		</li>
		<li>
			<i class='bx bxs-dollar-circle'></i>
			<span class="text">
			<h3><?=$totalQuantityAfterPayment; ?></h3>
			<p>Đơn hàng thành công</p>
			</span>
		</li>
		<li>
			<i class='bx bxs-dollar-circle'></i>
			<span class="text">
				<h3><?= number_format($doanhThu, 0, ',', '.'); ?></h3>
				<p>Doanh thu</p>
			</span>
		</li>
	</ul>
	<div class="table-data">
		<div class="order">
			<div class="head">
				<h3>Đơn hàng đã đặt (chưa có dữ liệu thực)</h3>
				<i class='bx bx-search'></i>
				<i class='bx bx-filter'></i>
			</div>
			<table>
				<thead>
					<tr>
						<th>Tên người mua</th>
						<th>Ngày đặt hàng</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<img src="/du_an_1/admin-page/img/logo.jpg">
							<p>usernew123</p>
						</td>
						<td>01-10-2024</td>
						<td><span class="status process">Đang giao</span></td>
					</tr>
					<tr>
						<td>
							<img src="/du_an_1/admin-page/img/logo.jpg">
							<p>Khách hàng vip 005</p>
						</td>
						<td>30-4-2024</td>
						<td><span class="status pending">Đang xử lý</span></td>
					</tr>
					<tr>
						<td>
							<img src="/du_an_1/admin-page/img/logo.jpg">
							<p>Khách hàng vip 003</p>
						</td>
						<td>08-03-2024</td>
						<td><span class="status pending">Đang xử lý</span></td>
					</tr>
					<tr>
						<td>
							<img src="/du_an_1/admin-page/img/logo.jpg">
							<p>Khách hàng vip 002</p>
						</td>
						<td>01-02-2024</td>
						<td><span class="status completed">Hoàn thành</span></td>
					</tr>
					<tr>
						<td>
							<img src="/du_an_1/admin-page/img/logo.jpg">
							<p>Khách hàng vip 001</p>
						</td>
						<td>01-01-2024</td>
						<td><span class="status completed">Hoàn thành</span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="todo">
			<div class="head">
				<h3>Việc cần làm(chưa có dữ liệu thực)</h3>
				<i class='bx bx-plus'></i>
				<i class='bx bx-filter'></i>
			</div>
			<ul class="todo-list">
				<li class="completed">
					<p>thống kê admin</p>
					<i class='bx bx-dots-vertical-rounded'></i>
				</li>
				<li class="completed">
					<p>cart user </p>
					<i class='bx bx-dots-vertical-rounded'></i>
				</li>
				<li class="not-completed">
					<p>payment</p>
					<i class='bx bx-dots-vertical-rounded'></i>
				</li>
				<li class="completed">
					<p>comment user</p>
					<i class='bx bx-dots-vertical-rounded'></i>
				</li>
				<li class="not-completed">
					<p>báo cáo</p>
					<i class='bx bx-dots-vertical-rounded'></i>
				</li>
			</ul>
		</div>
	</div>
</main>
</section>