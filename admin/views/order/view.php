<?php require('admin/views/shared/header.php'); ?>
<?php require('admin/views/shared/loader.php'); ?>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<?php require('admin/views/shared/formsearch.php'); ?>
<?php require('admin/views/shared/rightnavbar.php'); ?>
<?php require('admin/views/shared/leftnavbar.php'); ?>
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Thông tin đơn hàng</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> ChiKoi</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=order">Đơn hàng</a></li>
                        <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Truy Xuất Dữ Liệu</strong> "Tất cả các sản phẩm của đơn hàng" </h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:vorder_id(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right slideUp">
                                        <li><a href="javascript:vorder_id(0);">Action</a></li>
                                        <li><a href="javascript:vorder_id(0);">Another action</a></li>
                                        <li><a href="javascript:vorder_id(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Giá gốc</th>
                                            <th>Giá khuyến mãi</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh đại diện</th>
                                            <th>Giá gốc</th>
                                            <th>Giá khuyến mãi</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $stt = 0;
                                        $order_total = 0;
                                        foreach ($order_detail as $product) :
                                            $stt++;
                                            if ($product["product_typeid"] == 3) {
                                                $order_total += ($product['product_price'] - (($product['product_price']) * ($product['percentoff']) / 100)) * $product['quantity'];
                                            } else
                                                $order_total += $product['product_price'] * $product['quantity'];
                                        ?>
                                            <tr>
                                                <td><?= $stt; ?></td>
                                                <td><a href="index.php?controller=product&id=<?php echo $product['id']; ?>"><?php echo $product['product_name']; ?></a></td>
                                                <td><?php if (is_file("public/upload/products/" . $product['img1'])) echo '<image src="public/upload/products/' . $product['img1'] . '?time=' . time() . '" style="max-width:50px;" />'; ?></td>
                                                <td><?= $product['product_price'] ?></td>
                                                <td><? if ($product['saleoff'] == 1) echo ($product['product_price'] - (($product['product_price']) * ($product['percentoff']) / 100)); ?></td>
                                                <td><?= $product['quantity'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <h3 style="font-weight: bold;text-align: center;">Thành tổng tiền : <?php echo number_format($order_total, 0, ',', '.'); ?> VNĐ</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <h3>Thông tin khách hàng</h3>
                        <table id="info" class="table">
                            <tr>
                                <td>Họ và tên</td>
                                <td><?php echo $order['customer']; ?></td>
                            </tr>
                            <tr>
                                <td>Tỉnh/ Thành phố</td>
                                <td><?php echo $order['province']; ?></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td><?php echo $order['address']; ?></td>
                            </tr>
                            <tr>
                                <td>Di động</td>
                                <td><?php echo $order['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Thời gian</td>
                                <td><?php echo $order['createtime']; ?></td>
                            </tr>
                        </table>
                        <?php if ($order['status'] == 0) { ?>
                            <form id="order_form" method="post" action="admin.php?controller=order&amp;action=inprocess" role="form">
                                <div style="text-align: center;" class="form-group">
                                    <input name="order_id" type="hidden" value="<?php echo $order['id']; ?>" />
                                    <button class="btn btn-primary waves-effect" type="submit">Tiến hành xử lý đơn hàng</button>
                                    <a href="admin.php?controller=order" class="btn btn-warning waves-effect">Quay lại</a>
                                </div>
                            </form>
                        <?php } elseif ($order['status'] == 2) { ?>
                            <form id="order_form" method="post" action="admin.php?controller=order&amp;action=complete" role="form">
                                <div style="text-align: center;" class="form-group">
                                    <input name="order_id" type="hidden" value="<?php echo $order['id']; ?>" />
                                    <button class="btn btn-primary waves-effect" type="submit">Xác nhận đã xử lý thành công đơn hàng này</button>
                                    <a href="admin.php?controller=order" class="btn btn-warning waves-effect">Quay lại</a>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div style="text-align: center;">
                                <a class="btn btn-primary waves-effect" href="admin.php?controller=order&amp;action=delete&amp;order_id=<?= $order['id'] ?>">Xoá đơn hàng này</a>
                                <a href="admin.php?controller=order" class="btn btn-warning waves-effect">Quay lại</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="admin/themes/bundles/libscripts.bundle.js"></script>
<script src="admin/themes/bundles/vendorscripts.bundle.js"></script>
<script src="admin/themes/bundles/datatablescripts.bundle.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="admin/themes/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="admin/themes/bundles/mainscripts.bundle.js"></script>
<script src="admin/themes/js/pages/tables/jquery-datatable.js"></script>
</body>

</html>