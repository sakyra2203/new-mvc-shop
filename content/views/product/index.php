<?php require('content/views/shared/header.php'); ?>
<div role="main" class="main shop">
    <div class="container">
        <hr class="tall">
        <?php if (isset($result_add)) echo $result_add; ?>
        <div class="row">
            <ul class="breadcrumb">
                <li><a href="<?php echo PATH_URL; ?>home">Home</a></li>
                <li><a href="category/<?php echo $subcategories['id'] . '-' . $subcategories['slug']; ?>"><?php echo $breadCrumb ?></a></li>
                <li class="active"><?php echo $product['product_name'] ?></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="owl-carousel" data-plugin-options='{"items": 1}'>
                            <div>
                                <div class="thumbnail">
                                    <img alt="" class="img-responsive img-rounded" src="public/upload/products/<?php echo $product['img1'] ?>">
                                </div>
                            </div>
                            <div>
                                <div class="thumbnail">
                                    <img alt="" class="img-responsive img-rounded" src="public/upload/products/<?php echo $product['img2'] ?>">
                                </div>
                            </div>
                            <div>
                                <div class="thumbnail">
                                    <img alt="" class="img-responsive img-rounded" src="public/upload/products/<?php echo $product['img3'] ?>">
                                </div>
                            </div>
                            <div>
                                <div class="thumbnail">
                                    <img alt="" class="img-responsive img-rounded" src="public/upload/products/<?php echo $product['img4'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="summary entry-summary">
                            <h1 class="shorter"><strong><?php echo $product['product_name'] ?></strong></h1>
                            <p class="price">
                                <?php if ($product['saleoff'] != 0) { ?>
                                    <del><span class="amount"><?php echo number_format($product['product_price'], 0, ',', '.');  ?></span></del>
                                    <ins><span class="amount"><?php echo number_format(($product['product_price']) - (($product['product_price'] * $product['percentoff']) / 100), 0, ',', '.'); ?> VNĐ</span></ins>
                                <?php } else { ?>
                                    <ins><span class="amount"><?php echo number_format($product['product_price'], 0, ',', '.');  ?> VNĐ</span></ins>
                                <?php } ?>
                            </p>
                            <p class="taller"><?php echo $product['product_description'] ?>. </p>
                            <form enctype="multipart/form-data" method="post" class="cart" action="cart/add/<?php echo $product['id']; ?>">
                                <input type="hidden" name="slug" value="<?php echo $product['slug']; ?>">
                                <div class="quantity">
                                    <input type="number" class="input-text qty text" title="Nhập Để Đổi Số Lượng" value="1" name="number_cart" min="1" step="1" max="100">
                                </div>
                                <button class="btn btn-primary btn-icon" role="button" type="submit">Thêm vào giỏ hàng</button>
                            </form>
                            <div class="product_meta">
                                <span class="posted_in">Danh Mục Con: <a rel="tag" href="category/<?php echo $subcategories['id'] . '-' . $subcategories['slug']; ?>"><?php echo $breadCrumb ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs tabs-product">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#productDetail" data-toggle="tab">Chi tiết về sản phẩm</a></li>
                                <li><a href="#productInfo" data-toggle="tab">Thông tin khác</a></li>
                                <li><a href="#productReviews" data-toggle="tab">BLuận (<?= $comments_total ?>)</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="productDetail">
                                    <p><?php echo $product['product_detail'] ?></p>
                                </div>
                                <div class="tab-pane" id="productInfo">
                                    <table class="table table-striped push-top">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Size:
                                                </th>
                                                <td>
                                                    <?php echo $product['product_size'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Colors
                                                </th>
                                                <td>
                                                    <?php echo $product['product_color'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Material
                                                </th>
                                                <td>
                                                    <?php echo $product['product_material'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Total View
                                                </th>
                                                <td>
                                                    <?php echo $product['totalView'] ?> View
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Giảm giá
                                                </th>
                                                <td>
                                                    <?php if ($product['saleoff'] != 0) echo $product['percentoff'];
                                                    else echo '0'; ?> %
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="productReviews">
                                    <ul class="comments">
                                        <?php foreach ($comments as $comment) : ?>
                                            <li>
                                                <div class="comment">
                                                    <div class="img-thumbnail">
                                                        <img class="avatar" alt="" src="public/upload/media/author-comment.png">
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-arrow"></div>
                                                        <span class="comment-by">
                                                            <strong><?= $comment['author'] ?></strong>
                                                        </span>
                                                        <p><?= $comment['content'] ?></p>
                                                    </div>
                                                </div>
                                            </li><?php endforeach; ?>
                                    </ul>
                                    <hr class="tall">
                                    <h4>Thêm bình luận</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="index.php?controller=comment" id="submitReview" method="post">
                                                <input name="product_id" type="hidden" value="<?= $product['id'] ?>">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <label>Tên bạn *</label>
                                                            <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="author" id="author" placeholder="Please enter your name.." required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email của bạn *</label>
                                                            <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" placeholder="Please enter your email..." required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label>Nhận xét, bình luận của bạn *</label>
                                                            <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="content" id="message" placeholder="Nhập nhận xét hoặc tin nhắn hoặc bình luận của bạn về sản phẩm ....."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" value="Xác nhận gửi" class="btn btn-primary" data-loading-text="Loading...">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="tall" />
                <div class="row">
                    <div class="col-md-12">
                        <h2>Sản phẩm <strong>Liên quan danh mục</strong></h2>
                    </div>
                    <?php $product_related = get_all('products', array(
                        'limit' => '8',
                        'where' => $subcategories['id'] . '=sub_category_id and id<>' . $product['id'], //liên quan theo category
                        'offset' => '0',
                        'order_by' => 'totalView DESC'
                    )); ?>
                    <ul class="products product-thumb-info-list">
                        <?php if (empty($product_related)) : ?>
                            <h3 class="col-sm-12">Không có sản phẩm liên quan nào.</h3>
                        <?php endif; ?>
                        <?php foreach ($product_related as $related_product) : ?>
                            <li class="col-sm-3 col-xs-12 product">
                                <?php if ($related_product['saleoff'] != 0) : ?>
                                    <a href="type/3-san-pham-dang-giam-gia">
                                        <span class="onsale">-<?php echo $related_product['percentoff']; ?>%</span>
                                    </a>
                                <?php endif; ?>
                                <span class="product-thumb-info">
                                    <form action="cart/add/<?php echo $related_product['id']; ?>" method="post">
                                        <input type="hidden" name="number_cart" value="1">
                                        <button type="submit" href="cart/add/<?php echo $related_product['id']; ?>" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</span>
                                        </button>
                                    </form>
                                    <a href="product/<?php echo $related_product['id']; ?>-<?php echo $related_product['slug']; ?>">
                                        <span class="product-thumb-info-image">
                                            <span class="product-thumb-info-act">
                                                <span class="product-thumb-info-act-left"><em>View</em></span>
                                                <span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
                                            </span>
                                            <img alt="" class="img-responsive" src="public/upload/products/<?php echo $related_product['img1']; ?>">
                                        </span>
                                    </a>
                                    <span class="product-thumb-info-content">
                                        <a href="product/<?php echo $related_product['id']; ?>-<?php echo $related_product['slug']; ?>">
                                            <h4><?php echo $related_product['product_name']; ?></h4>
                                            <span class="price">
                                                <?php if ($related_product['saleoff'] != 0) { ?>
                                                    <del><span class="amount"><?php echo number_format($related_product['product_price'], 0, ',', '.');  ?></span></del>
                                                    <ins><span class="amount"><?php echo number_format(($related_product['product_price']) - (($related_product['product_price'] * $related_product['percentoff']) / 100), 0, ',', '.'); ?> VNĐ</span></ins>
                                                <?php } else { ?>
                                                    <ins><span class="amount"><?php echo number_format($related_product['product_price'], 0, ',', '.');  ?> VNĐ</span></ins>
                                                <?php } ?>
                                            </span>
                                        </a>
                                    </span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <?php $get_sidebar_with_only_product = 0;
                require('content/views/shared/sidebar.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php
require('content/views/shared/footer.php');
