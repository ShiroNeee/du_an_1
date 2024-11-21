<div class="container mt-4">
    <h1 class="text-center">Giỏ hàng của bạn (cart)</h1>
    <div class="row">
        <div class="col-md-7 mb-4 mt-4">
            <div class="d-flex flex-column">
                <div class="p-2 bg-light border">
                    <div class="d-flex">
                        <img src="../client-page/images/aophongnam.png" alt="er" width="150" height="200" />
                        <div class="p-2 bg-light">
                            <h4 class="fw-light mb-4">Áo phông cộc tay nam chất liệu xịn cotton cực tốt</h4>
                            <h4 class="fw-light text-success mb-4">Size:L</h4>
                            <h4 class="fw-light border" style="width:60px;height:70px;background-color:#87CEFA">Màu xanh</h4>
                        </div>
                        <div class="p-2 bg-light">
                            <h4 class="fw-light text-end ms-auto text-danger mb-5">199.000đ</h4>
                            <p class="mb-4 text-end">.</p>
                            <input type="number" value="1" min="0" max="1000" class="form-control" />
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <img src="../client-page/images/aokhoac.png" alt="er" width="150" height="200" />
                        <div class="p-2 bg-light">
                            <h4 class="fw-light mb-4">Áo Teelab mới chất liệu cotton cực đẹp và chất liệu tốt</h4>
                            <h4 class="fw-light text-success mb-4">Size:XL</h4>
                            <h4 class="fw-light border" style="width:60px;height:70px;background-color:#87CEFA">Màu đen</h4>
                        </div>
                        <div class="p-2 bg-light">
                            <h4 class="fw-light text-end ms-auto text-danger mb-5">299.000đ</h4>
                            <p class="mb-4 text-end">.</p>
                            <input type="number" value="1" min="0" max="1000" class="form-control" />
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <img src="../client-page/images/vest-ghi.jpg" alt="er" width="150" height="200" />
                        <div class="p-2 bg-light">
                            <h4 class="fw-light mb-4">Áo vest nam cực lịch lãm, năng động, trẻ trung dành cho các bạn trẻ</h4>
                            <h4 class="fw-light text-success mb-4">Size:L</h4>
                            <h4 class="fw-light border" style="width:60px;height:70px;background-color:#87CEFA">Màu ghi</h4>
                        </div>
                        <div class="p-2 bg-light">
                            <h4 class="fw-light text-end ms-auto text-danger mb-5">999.000đ</h4>
                            <p class="mb-4 text-end">.</p>
                            <input type="number" value="1" min="0" max="1000" class="form-control" />
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <img src="../client-page/images/off-white-dai-tay.png" alt="er" width="150" height="200" />
                        <div class="p-2 bg-light">
                            <h4 class="fw-light mb-4">Áo Off-White dài tay cực phong cách street out thích cá tính</h4>
                            <h4 class="fw-light text-success mb-4">Size:L</h4>
                            <h4 class="fw-light border" style="width:60px;height:70px;background-color:#87CEFA">Màu trắng</h4>
                        </div>
                        <div class="p-2 bg-light">
                            <h4 class="fw-light text-end ms-auto text-danger mb-5">199.000đ</h4>
                            <p class="mb-4 text-end">.</p>
                            <input type="number" value="1" min="0" max="1000" class="form-control" />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex ">
                        <h4 class="mt-2">Tạm tính:</h4>
                        <h4 class="ms-auto text-danger">?.000.000đ</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4 mt-4">
            <div class="checkout-form p-3 border">
                <h4>Thông tin người nhận:</h4>
                <form action="../client-page/index.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="username" placeholder="Nhập đầy đủ họ tên của bạn...">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ nhà:</label>
                        <input type="text" class="form-control" id="address" placeholder="Địa chỉ nhà...">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="number" class="form-control" id="phone" placeholder="Số điện thoại...">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Lời nhắn(message):</label>
                        <textarea class="form-control" id="message" placeholder="message......"></textarea>
                    </div>
                    <h4>Thanh toán đơn hàng:</h4>
                    <div class="d-flex">
                        <p>Tổng số tiền:</p>
                        <strong class="ms-auto text-danger">?.000.000đ</strong>
                    </div>
                    <div class="payment-method">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="bankTransfer" name="paymentMethod">
                            <label class="form-check-label" for="bankTransfer">Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="bank" name="paymentMethod">
                            <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="atm" name="paymentMethod">
                            <label class="form-check-label" for="atm">Qua thẻ ATM</label>
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="terms">
                        <label class="form-check-label" for="terms">
                            Tôi đồng ý với chính sách xử lý dữ liệu cuả shop Unique Style
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 w-100">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>