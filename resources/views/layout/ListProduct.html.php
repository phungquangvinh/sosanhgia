<?php if ($region == '' && $shop == '' && $price == ''){ ?>
<?php if ($listProducts && count($listProducts) > 0){ ?>
    <?php foreach ($listProducts as $item) { 
        $link_img = pictureProductThumb($item->pro_picture,235,215);
        $link_detail = createlink('product_detail',array('nTitle' => $item->pro_name, 'iData' => $item->pro_id));
        ?>
        <div class="listProduct_item">
            <div class="box_cover">
                <div class="top_list_item">
                    <div class="img-wrap lazyload list-product">
                        <a href="<?= $link_detail ?>">
                            <img class="lazyload image1" src="<?=$link_img?>" alt="<?echo $item->pro_name;?>">
                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                        </a>
                    </div>
                    <h3 class="title">
                        <a href="<?= $link_detail?>"><?= cut_string2($item->pro_name,60)  ?></a>
                    </h3>
                    <div class="price ">
                        <?= format_number($item->pro_price) ?> VNĐ
                    </div>
                    <!-- <div class="tagline">&nbsp;</div>
                    <div class="quantity">
                        <p>Xem 2 nơi bán</p>
                    </div> -->
                </div>

            </div>
            <!-- <div class="cover_merchant">
                <div class="list-merchant">
                    <ul>
                        <li>
                            <div class="img-merchant-wrap">
                                <a href="#" title="" target="_blank">
                                    <img src="/assets/images/sen.jpg"
                                         alt="daihuynhquang.com.vn">
                                </a>
                            </div>
                            <span class="price"><b><?= number_format($item->pro_price) ?> đ</b></span>
                        </li>
                       
                    </ul>
                </div>
            </div> -->
        </div>
    <?php } ?>
<?php }}?>

                     
<?php if ($dataProductCity && count($dataProductCity) > 0){ ?>
    <?php foreach ($dataProductCity as $item) { 
        $link_img = pictureProductThumb($item->pro_picture,235,215);
        $link_detail = createlink('product_detail',array('nTitle' => $item->pro_name, 'iData' => $item->pro_id));
        ?>
        <div class="listProduct_item">
            <div class="box_cover">
                <div class="top_list_item">
                    <div class="img-wrap lazyload list-product">
                        <a href="<?= $link_detail ?>">
                            <img class="lazyload image1" src="<?=$link_img?>" alt="<?echo $item->pro_name;?>">
                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                        </a>
                    </div>
                    <h3 class="title">
                        <a href="<?= $link_detail?>"><?= cut_string2($item->pro_name,60)  ?></a>
                    </h3>
                    <div class="price ">
                        <?= format_number($item->pro_price) ?> VNĐ
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
<?php }?>

<?php if ($dataProductPrice && count($dataProductPrice) > 0){ ?>
    <?php foreach ($dataProductPrice as $item) { 
        $link_img = pictureProductThumb($item->pro_picture,235,215);
        $link_detail = createlink('product_detail',array('nTitle' => $item->pro_name, 'iData' => $item->pro_id));
        ?>
        <div class="listProduct_item">
            <div class="box_cover">
                <div class="top_list_item">
                    <div class="img-wrap lazyload list-product">
                        <a href="<?= $link_detail ?>">
                            <img class="lazyload image1"
                                 src="<?=$link_img?>"
                                 alt="<?echo $item->pro_name;?>">
                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                        </a>
                    </div>
                    <h3 class="title">
                        <a href="<?= $link_detail?>"><?= cut_string2($item->pro_name,60)  ?></a>
                    </h3>
                    <div class="price ">
                        <?= format_number($item->pro_price) ?> VNĐ
                    </div>
                </div>

            </div>
            
        </div>
    <?php } ?>
<?php }?>

<?php if ($dataProductShop && count($dataProductShop) > 0){ ?>
    <?php foreach ($dataProductShop as $item) { 
        $link_img = pictureProductThumb($item->pro_picture,235,215);
        $link_detail = createlink('product_detail',array('nTitle' => $item->pro_name, 'iData' => $item->pro_id));
        ?>
        <div class="listProduct_item">
            <div class="box_cover">
                <div class="top_list_item">
                    <div class="img-wrap lazyload list-product">
                        <a href="<?= $link_detail ?>">
                            <img class="lazyload image1" src="<?=$link_img?>" alt="<?echo $item->pro_name;?>">
                            <img src="/assets/images/btn-compare-price.svg" class="image2">
                        </a>
                    </div>
                    <h3 class="title">
                        <a href="<?= $link_detail?>"><?= cut_string2($item->pro_name,60)  ?></a>
                    </h3>
                    <div class="price ">
                        <?= format_number($item->pro_price) ?> VNĐ
                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
<?php }?>