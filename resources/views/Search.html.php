<?php //dd($productSearch);?>
<div class="search container" id="search">
    <p>Kết quả tìm kiếm:</p>
    <div class="listProduct">
        <?php if ($productSearch && count($productSearch) > 0){ ?>
            <?php foreach ($productSearch as $item) { 
                $link_img = pictureProductThumb($item->pro_picture,245,205);

                $link_detail = createlink('product_detail',array('nTitle' => $item->pro_name, 'iData' => $item->pro_id));
                ?>
                <div class="listProduct_item">
                    <div class="box_cover">
                        <div class="top_list_item">
                            <div class="img-wrap lazyload">
                                <a href="#">
                                    <img class="lazyload image1"
                                         src="<?= $link_img ?>"
                                         alt="<?=$item->pro_name?>">
                                    <img src="/assets/images/btn-compare-price.svg" class="image2">
                                </a>
                            </div>
                            <h3 class="title">
                                <a href="<?= $link_detail ?>"><?= $item->pro_name ?></a>
                            </h3>
                            <div class="price ">
                                giá từ <?= number_format($item->pro_price) ?> đ
                            </div>
                           <!--  <div class="tagline">&nbsp;</div>
                            <div class="quantity">
                                <p>Xem 2 nơi bán</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else {?>
            <p>Không tìm thấy kết quả</p>
        <?php }?>
    </div>
    <div class="clear"></div>
    <div class="pag" align="right" >
        <div class="pagination">
            <?php if ($totalProduct > 1) {
                echo showPaginate($pageSize, $page, $totalProduct);
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>

</div>
