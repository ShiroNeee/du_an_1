<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center pb-5">
                    <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                        <div class="py-4 d-flex flex-row align-items-center">
                            <h5><span class="far fa-check-square pe-2"></span><b>Xác nhận thông tin</b> |</h5>
                            <span class="ps-2">PAY</span>
                        </div>
                        <form class="pb-3" action="?act=payment_method" method="POST">
                            <?php
                            if (!empty($listOrders)) {
                                $totalQuantity = 0;
                                foreach ($listOrders as $order) {
                                    $totalQuantity += $order['Quantity'];

                                    echo '<h4>Tên đơn hàng: ' . htmlspecialchars($order['ProductName']) . '</h4>';
                                    echo '<div class="d-flex pt-2">';
                                    echo '<div>';
                                    echo '<p>';
                                    $formattedDate = date("Y-m-d H:i:s", strtotime($order['OrderDate']));
                                    echo '<b> Ngày đặt hàng: ' . htmlspecialchars($formattedDate) . '</b>';
                                    echo '</p>';
                                    echo '</div>';
                                    echo ' </div>';
                                    echo '<p>Giá tiền: ' . number_format($order['TotalAmount']) . ' VNĐ</p>';
                                }
                                echo '<div class="ms-auto">';
                                echo '<p class="text-primary">Số lượng: ' . htmlspecialchars($totalQuantity) . '</p>';
                                echo '</div>';
                            } else {
                                echo '<div class="col-12">Không có đơn hàng nào.</div>';
                            }
                            ?>
                            <hr />
                            <input type="hidden" name="OrderID" value="<?php echo $orderId; ?>" />
                            <h4>Phương thức thanh toán</h4>
                                <div class="pt-2">
                                    <div class="d-flex flex-row pb-3 align-items-center">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="payment_method1"
                                                value="direct_payment" aria-label="..." checked />
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                <i class="fas fa-hand-holding-usd fa-lg text-primary pe-2"></i>Thanh toán trực tiếp
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Thanh toán ATM Momo -->
                                    <div class="d-flex flex-row pb-3 align-items-center">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="payment_method2"
                                                value="atm_momo" aria-label="..." />
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                <i class="fab fa-cc-mastercard fa-lg text-body pe-2"></i>Thanh toán ATM Momo
                                            </p>
                                        </div>
                                    </div>

                                    <h4 class="text-primary mt-4"> Thành tiền:
                                        <?php
                                        $totalAmount = 0;
                                        if (!empty($listOrders)) {
                                            foreach ($listOrders as $order) {
                                                $totalAmount += $order['TotalAmount'];
                                            }
                                            echo number_format($totalAmount) . ' VNĐ';
                                        } else {
                                            echo '0 VNĐ';
                                        }
                                        ?>
                                        <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>" />
                                    </h4>
                                    <button type="submit" name="thanhtoan" class="btn btn-primary ">Xác nhận đặt hàng</button>
                                </div>
                        </form>
                    </div>

                    <!-- Thông tin cá nhân -->
                    <div class="col-md-5 col-xl-4 offset-xl-1">
                        <div class="py-4 d-flex justify-content-end">
                            <h6><a href="/du_an_1/client-page/" style="text-decoration: none;">Cancel and return to website</a></h6>
                        </div>
                        <div class="rounded d-flex flex-column p-2 bg-body-tertiary">
                            <div class="p-2 me-3">
                                <h4>Thông tin cá nhân</h4>
                            </div>
                            <div class="p-2 d-flex flex-column">
                                <div class="mb-2">
                                    <div class="col-12">Họ và tên:</div>
                                    <div class="col-12"><?= $userDetail['name'] ?></div>
                                </div>
                                <div class="mb-2">
                                    <div class="col-12">Email:</div>
                                    <div class="col-12"><?= $userDetail['email'] ?></div>
                                </div>
                                <div class="mb-2">
                                    <div class="col-12">Số điện thoại:</div>
                                    <div class="col-12"><?= $userDetail['phoneNumber'] ?></div>
                                </div>
                                <div class="mb-2">
                                    <div class="col-12">Địa chỉ:</div>
                                    <div class="col-12"><?= $userDetail['address'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Thông tin cá nhân -->
                </div>
            </div>
        </div>
    </div>
</section>