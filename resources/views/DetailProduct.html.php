<?php //dd($productHistory);?>
<div class="breadcumbs">
    <div class="container">
        <ul>
            <li>
                <a href="/">Trang chủ&nbsp;</a>
                ›
            </li>
            <li><a href="#">Điện thoại -máy tính bảng</a></li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<div class="content_detail" id="detail">
    <div class="container ">
        <div class="detaiProduct">
                <div class="content_detail_left">
                    <h3><?= $productDetail->pro_name ?></h3>
                    <div class="gallery_detail">
                        <div class="gallery_left">
                            <div class="thumbnail">
                                <ul class="slide_thumbnail">
                                    <?php 
                                    $i = 0;
                                    foreach ($dataImagesProduct as $value) {
                                        $link_img = pictureProductThumb($value->pipr_name,60,45);
                                        echo '<li><img src="' . $link_img . '" alt=""></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="image_detail">
                                <div class="box_img_detail">
                                    <img src="<?=pictureProductThumb($productDetail->pro_picture,220,220)?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="gallery_right">
                            <div class="brief-desc">
                                <div class="box_brief_desc">
                                    <h2>Thông tin nổi bật:</h2>
                                    <?= $productDetail->pro_teaser ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="compare-wrap" id="anchorComparePrice">
                        <div class="detail-caption ssg">
                            <h2><a href="#anchorComparePrice">So sánh giá</a></h2>
<!-- 
                            <div class="compare-region-wrap">
                                <p>Sản phẩm bán tại:</p>

                                <div class="compare-region-inner">
                                    <ul class="ul_inner">
                                        <li class="li_inner">
                                            <a class="all_drop">Tất cả</a>
                                            <ul class="sub_child_compare">
                                                <li><a>Hồ Chí Minh <span>(10)</span></a></li>
                                                <li><a>Hà Nội <span>(7)</span></a></li>
                                                <li><a>Đà Nẵng <span>(4)</span></a></li>
                                            </ul>
                                        </li>
                                      
                                        <li style="background: none" class="li_inner">
                                            <a id="textSortType" class="all_drop">Sắp xếp: <span
                                                        class="color-wss fsize12">Giá có VAT</span></a>
                                            <ul class="sub_child_compare">
                                                <li><a>Giá cửa hàng</a></li>
                                                <li><a>Giá có VAT</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <div class="list_compare">
                            <div class="list_compare_item">
                                <div class="represent">
                                    <div class="logo_compare">
                                        <div class="img_wrap">
                                            <a href="#">
                                                <img class="img_estore_2" src="/assets/images/logo.svg" alt="">
                                            </a>
                                        </div>
                                 
                                    </div>
                                    <div class="rate_compare">
                                        <div class="list_star item_review">
                                           <!--  <div class="item_star append_star" data-star="<?= $proEstore->pres_rate ?>">
                                                <div class="star-rating" title="3 star">
                                                    <div class="back-stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars" style="width: 60%">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <a href="https://vatgia.com" target="_blank"
                                           title="Vatgia.com"><span class="rate_place">Vatgia.com</span></a>
                                    </div>
                                </div>
                                <div class="together_compare">
                                    <div class="list_compare_item_inner">

                                        <div class="content_compare">
                                            <h3>
                                                <a href="https://vatgia.com/<?= generateURL_product($productDetail->pro_category_id,$productDetail->pro_id,$productDetail->pro_name) ?>" target="_blank"
                                                   title="<?= $productDetail->pro_name ?>"><?= $productDetail->pro_name ?></a>
                                            </h3>
                                         
                                        </div>
                                        <div class="price_compare">
                                        <span class="price" itemprop="Price">
                                            <?= format_number($productDetail->pro_price)  ?> VNĐ
                                        </span><br>
                                            <span class="vat">
                                            Đã có VAT
                                        </span>
                                        </div>
                                        <div class="btn_compare">
                                            <a target="_blank" href="https://vatgia.com/<?= generateURL_product($productDetail->pro_category_id,$productDetail->pro_id,$productDetail->pro_name) ?>">
                                                <img src="/assets/images/btn-to-the-place-of-sale.svg" class="pull-right" alt="<?=$productDetail->pro_name?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($dataEstoreProduct as $proEstore) { ?>
                                <div class="list_compare_item">
                                    <div class="represent">
                                        <div class="logo_compare">
                                            <div class="img_wrap">
                                                <a href="#">
                                                    <img class="img_estore_2" src="<?= $proEstore->getImgEstore() ?>" alt="">
                                                </a>
                                            </div>
                                     
                                        </div>
                                        <div class="rate_compare">
                                            <div class="list_star item_review">
                                                <div class="item_star append_star" data-star="<?= $proEstore->pres_rate ?>">
                                                    <div class="star-rating" title="3 star">
                                                        <div class="back-stars">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>

                                                            <div class="front-stars" style="width: 60%">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="https://websosanh.vn/cua-hang/lazada_vn.htm" target="_blank"
                                               title="lazada.vn"><span class="rate_place">lazada.vn</span></a>
                                        </div>
                                    </div>
                                    <div class="together_compare">
                                        <div class="list_compare_item_inner">

                                            <div class="content_compare">
                                                <h3>
                                                    <a href="#" target="_blank"
                                                       title="<?= $productDetail->pro_name ?>"><?= $productDetail->pro_name ?></a>
                                                </h3>
                                                <span><?= $proEstore->pres_link ?></span><br>
                                                <div class="location-wrap">
                                                    <span class="location" title="<?= $proEstore->pres_district ?>"><?= $proEstore->pres_district ?></span>
                                                </div>

                                            </div>
                                            <div class="price_compare">
											<span class="price" itemprop="Price">
												<?= $proEstore->pres_price ?>
											</span><br>
                                                <span class="vat">
												Đã có VAT
											</span>
                                            </div>
                                            <div class="btn_compare">
                                                <a href="<?= $proEstore->pres_link ?>"><img
                                                            src="/assets/images/btn-to-the-place-of-sale.svg"
                                                            class="pull-right"
                                                            alt="Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <!-- fgfg -->
              <!--       <div class="detail-caption">
                        <span class="title">Thông tin chi tiết</span>
                    </div>
                    <div class="detail_info_wrapper">
                        <div class="detail-item">
                            <div class="caption">Tổng quan</div>
                            <div class="information">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text">Hãng sản xuất:</td>
                                        <td class="value">
                                            Mobell
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Loại sim:</td>
                                        <td class="value">
                                            Mini Sim
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Số lượng sim:</td>
                                        <td class="value">
                                            2 sim
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Hệ điều hành:</td>
                                        <td class="value">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Mạng 2G:</td>
                                        <td class="value">
                                            GSM 900 / 1800
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Mạng 3G:</td>
                                        <td class="value">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Mạng 4G:</td>
                                        <td class="value">
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Kiểu dáng:</td>
                                        <td class="value">
                                            Thanh
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Phù hợp với các mạng:</td>
                                        <td class="value">
                                            Mobifone, Vinafone, Viettel
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Ngôn ngữ hỗ trợ:</td>
                                        <td class="value">
                                            Tiếng Anh, Tiếng Việt
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Bàn phím Qwerty hỗ trợ:</td>
                                        <td class="value">
                                            -
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="caption">Kích thước và trọng lượng</div>
                            <div class="information">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="text">Kích thước:</td>
                                        <td class="value">
                                            -mm
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text">Trọng lượng:</td>
                                        <td class="value">
                                            -g
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="show-more2">
                        <p class="readmore2">Xem thông tin chi tiết</p>
                    </div>
                    <div class="clear"></div>
                    <div class="hide-more2">
                        <p class="hide_content2 display_none">Ẩn bớt</p>
                    </div> -->
                    <!--  -->
                    <div class="menu_tabs">
                        <!-- Tab links -->
                        <div class="tab">
                            <button class="tablinks active" onclick="openCity(event, 'London')">Sản phẩm tương tự
                            </button>
                            <button class="tablinks" onclick="openCity(event, 'Paris')">Sản phẩm bạn đã xem</button>
                        </div>

                        <!-- Tab content -->
                        <div id="London" class="tabcontent" style="display: block;">
                            <div class="listProduct">
                                <?php if ($dataRelaProduct && count($dataRelaProduct) > 0) { ?>
                                    <?php foreach ($dataRelaProduct as $pro_rela) { 
                                        $link_img = pictureProductThumb($pro_rela->pro_picture,235,215);
                                        $link_detail = createlink('product_detail',array('nTitle' => $pro_rela->pro_name, 'iData' => $pro_rela->pro_id));
                                        ?>
                                        <div class="listProduct_item">
                                            <div class="box_cover">
                                                <div class="top_list_item">
                                                    <div class="img-wrap lazyload">
                                                        <a href="<?=$link_detail?>">
                                                            <img class="lazyload image1" src="<?=$link_img?>"
                                                                 alt="<?= $pro_rela->pro_name ?>">
                                                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                                                        </a>
                                                    </div>
                                                    <h3 class="title">
                                                        <a href="<?= $link_detail ?>"><?= cut_string2($pro_rela->pro_name,60) ?></a>
                                                    </h3>
                                                    <div class="price ">
                                                        <?= format_number($pro_rela->pro_price) ?> VNĐ
                                                    </div>
                                                   
                                                </div>

                                            </div>

                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                        <div id="Paris" class="tabcontent" >
                            <div class="listProduct">
                                <?php if ($productHistory && count($productHistory) > 0) { ?>
                                    <?php foreach ($productHistory as $dataProHistory) { 
                                        $link_img = pictureProductThumb($dataProHistory->pro_picture,235,215);
                                        $link_detail = createlink('product_detail',array('nTitle' => $dataProHistory->pro_name, 'iData' => $dataProHistory->pro_id));
                                        ?>
                                        <div class="listProduct_item">
                                            <div class="box_cover">
                                                <div class="top_list_item">
                                                    <div class="img-wrap lazyload">
                                                        <a href="<?=$link_detail?>">
                                                            <img class="lazyload image1" src="<?=$link_img?>"
                                                                 alt="<?= $dataProHistory->pro_name ?>">
                                                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                                                        </a>
                                                    </div>
                                                    <h3 class="title">
                                                        <a href="<?= $link_detail ?>"><?= cut_string2($dataProHistory->pro_name,60) ?></a>
                                                    </h3>
                                                    <div class="price ">
                                                        <?= format_number($dataProHistory->pro_price) ?> VNĐ
                                                    </div>
                                                   
                                                </div>

                                            </div>

                                        </div>
                                    <?php } ?>
                                <?php } else {?>
                                    <p>Bạn chưa xem sản phẩm nào.</p>
                                <?php }?>
                            </div>
                        </div>

                    </div>
              
                </div>
  

            <div class="content_detail_right">
                <div class="news_product">
                    <div class="box_right_news">
						<span class="cat-head">
							Tin tức về sản phẩm
						</span>
                        <ul>
                            <?php for ($x = 0; $x <= 0; $x++) { ?>
                                <li class="media">
                                    <div class="media-left">
                                        <div class="img-wrap">
                                            <a href="#"
                                               title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
                                                <img class="media-object" src="/assets/images/sp2.jpg"
                                                     alt="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="#"
                                               title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">Điện
                                                thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?</a></h4>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>