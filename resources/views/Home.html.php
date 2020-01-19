<div class="home_content" id="homePage">
    <div class="container">
        <div class="compare_trademark">
            <div class="box_compare_trademark">
                <div class="left_trademark sidebar">
                    <div class="inner">
                        <h3 class="caption">So sánh thực sự dễ dàng</h3>
                        <ul>
                            <!-- menu -->
                            <?php foreach ($listMenu as $datalistMenu) { ?>
                            <li>
                                <img src="<?= $datalistMenu->getImgmenu() ?>" alt="">
                                <div>
                                    <a href="/<?= to_slug($datalistMenu->cat_name).'-c'.$datalistMenu->cat_id?>.html" target="_blank"><?= $datalistMenu->menu_name ?></a><br>
                                    <p><?= $datalistMenu->menu_description ?></p>
                                </div></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="right_trademark deal-banner">
                    <div class="banner owl-carousel owl-loaded owl-drag">
                        <? foreach (array_values($BannerTopCenter->toArray()) as $key => $value) {
                            $url_img = parse_file_url($value['picture']);
                            ?>
                            <a href="#">
                                <img alt="" data-src="<?= $url_img ?>" src="<?= $url_img ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <div>
                        <ul class="home_ads">
                            <? foreach (array_values($BannerMiddleCenter->toArray()) as $key => $value) {
                                $url_img = parse_file_url($value['picture']);
                                ?>
                                <li>
                                    <a href="#">
                                        <img data-src="<?= $url_img ?>" src="<?= $url_img ?>" alt=""
                                             class="img_home_ads">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="best_price">
            <div class="box_best_price" id="best-price-everyday">
                <h2>Giá tốt mỗi ngày</h2>
                <ul class="nav nav-tabs">
                    <?php foreach ($listCategoryProduct as $listCategoryProduct ) {?>
                        <li><a href="/<?= to_slug($listCategoryProduct->cat_name).'-c'.$listCategoryProduct->cat_id?>.html"><?= $listCategoryProduct->cat_name?></a></li>
                    <?php }?>
                </ul>
                <div id="tivi-am-thanh" class="tab-pane tab_content active">
                    <ul class="first_tab_pane owl-carousel owl-loaded owl-drag">
                        <?php foreach ($listProducts as $value) { 
                            $link_img = pictureProductThumb($value->pro_picture,235,215);
                            $link_detail = createlink('product_detail',array('nTitle' => $value->pro_name, 'iData' => $value->pro_id));
                            ?>
                            <li>
                                <div class="img-wrap">
                                    <a href="<?= $link_detail ?>" title="<?= $value->pro_name?>" target="_blank" atl="<?= $value->pro_name?>">
                                        <img src="<?= $link_img?>" alt="">
                                    </a>
                                </div>

                                <div class="information">
                                    <div class="title_tabs">
                                        <h4><a href="<?= $link_detail ?>"
                                               title="<?= $value->pro_name?>">
                                                <?= $value->pro_name?></a></h4>
                                    </div>
                                    <div class="box_cover_info">
                                        <!-- <div class="percent">24<span>%</span></div> -->
                                        <div class="price">
                                            <!-- <span>&nbsp;</span><br> -->
                                            <span style="white-space: nowrap;"><?= format_number($value->pro_price) ?> đ</span>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="list_cate_compare">
            <?
            foreach ($dataCate as $key => $value) {
                ?>
                <div class="list_cate_compare_item">
                    <div class="top_cate_item">
                        <h2><a href="#" title=""><?= $value->cat_name ?></a></h2>
                        <div>
                            <a href="#">
                                <img alt="" data-src="" src="<?= parse_file_url($value->cat_background_home_page) ?>">
                            </a>
                        </div>
                        <?
                        if(isset($dataProductCate[$value->cat_id])){
                            ?>
                            <div class="top-list-item-inner">
                                <ul>
                                    <? foreach ($dataProductCate[$value->cat_id] as $key2 => $value2) {
                                        $link_img = pictureProductThumb($value2->pro_picture,235,215);
                                        $link_detail = createlink('product_detail',array('nTitle' => $value2->pro_name, 'iData' => $value2->pro_id));
                            
                                        ?>
                                        <li>
                                            <div class="img-wrap">
                                                <a href="<?= $link_detail ?>"
                                                   title="<?= $value2->pro_name ?>">
                                                    <img src="<?=$link_img ?>" alt="#">
                                                </a>
                                            </div>
                                            <div class="information">
                                                <a href="<?= $link_detail ?>"
                                                   class="title"
                                                   title="<?= $value2->pro_name ?>"><span><?= $value2->pro_name ?></span></a>
                                                <p class="price"><?= number_format($value2->pro_price) ?>đ</p>

                                                <p class="store">Có <? //không dùng count ở trong foreach?> nơi bán</p>

                                                <p class="store">Có 0 nơi bán</p>

                                            </div>
                                        </li>
                                        <?
                                    } 
                                    ?>
                                </ul>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
                <?
            }
            ?>
        </div>

        <div id="article" class="article_home">
            <div class="head-article">
                <h2>Thông tin hữu ích</h2>
            </div>
            <div class="list-category">
                <ul class="owl-carousel owl-loaded owl-drag">
                    <?php foreach ($dataCatelv2 as $listCategoryProduct ) {?>
                        <li><a href="/<?= to_slug($listCategoryProduct->cat_name).'-c'.$listCategoryProduct->cat_id?>.html"><?= $listCategoryProduct->cat_name?></a></li>
                    <?php }?>
                </ul>
            </div>

            <div class="article_box">
                <div class="left_article">
                    <div class="left_article_inner">
                        <div class="left_article_box">
                            <?php foreach ($getNews as $key => $get_news ){ 
                                if($key == 0){
                            ?>
                            <div class="main_article">
                                <div class="focus-large">
                                    <div class="img-wrap">
                                        <a href="news/<? echo $get_news['nes_slug']; ?>-<? echo $get_news['nes_id']; ?>.html" title="<? echo $get_news['nes_title']; ?>">
                                            <img src="<?php echo parse_image('news', 'default', $get_news['nes_image']); ?>"
                                                 alt="Đánh giá Huawei FreeBuds Lite: Thêm một lựa chọn thay thế Airpods giá rẻ chỉ một nửa">
                                        </a>
                                    </div>
                                    <h4><a href="news/<? echo $get_news['nes_slug']; ?>-<? echo $get_news['nes_id']; ?>.html"><? echo $get_news['nes_title']; ?></a></h4>
                                    <p><? echo $get_news['nes_description']; ?></p>
                                </div>
                            </div>
                                
                            <div class="extra_article">                                 
                                <ul>
                                    <?} else {?>
                                    <li>
                                        <div class="img-wrap">
                                            <a href="news/<? echo $get_news['nes_slug']; ?>-<? echo $get_news['nes_id']; ?>.html" title="<? echo $get_news['nes_title']; ?>">
                                                <img src="<?php echo parse_image('news', 'default', $get_news['nes_image']); ?>"  alt="<? echo $get_news['nes_title']; ?>">
                                            </a>
                                        </div>
                                        <h4><a href="news/<? echo $get_news['nes_slug']; ?>-<? echo $get_news['nes_id']; ?>.html"><b><? echo $get_news['nes_title']; ?></b></a></h4>
                                    </li><?}}?>
                                </ul>
                            </div>
                        </div>

                        <div class="list-grid">
                            <ul>
                                <?php foreach ($hotNews as $value ) {?>
                                    <li>
                                        <div class="img-wrap">

                                            <a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>">
                                                <img src="<?php echo parse_image('news', 'default', $value['nes_image']); ?>"  alt="<? echo $value['nes_title']; ?>">
                                            </a>
                                        </div>
                                        <a class="title" href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>"><? echo $value['nes_title']; ?></a>
                                        <p class="desc"><? echo $value['nes_description']; ?></p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="list-item">
                            <ul>
                                <?php foreach ($pc as $value ) {?>
                                <li class="media">
                                    <div class="media-left">
                                        <div class="img-wrap">
                                            <a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>">
                                                <img class="media-object_img" src="<?php echo parse_image('news', 'default', $value['nes_image']); ?>"  alt="<? echo $value['nes_title']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body_article">
                                        <h3 class="media-heading_article"><a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>"><? echo $value['nes_title']; ?></a></h3>
                                        <p class="media-publish-date"><? echo date('d-m-Y h:m A', $value['nes_create_time']); ?></p>
                                        <p class="media-text"><? echo $value['nes_description']; ?></p>
                                    </div>
                                </li>
                                <?}?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="right_article content_detail_right">
                    <div class="news_product">
                        <div class="top_ads_detail_right"></div>
                        
                        <div class="box_right_news">
                            <span class="cat-head">
                                Tin tức sản phẩm
                            </span>
                            <ul>
                                <?php foreach ($tin_tuc_theo_type as $value ){ ?>
                                <li class="media">
                                    <div class="media-left">
                                        <div class="img-wrap">
                                            <a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>">
                                                <img class="media-object" src="<?php echo parse_image('news', 'default', $value['nes_image']); ?>"  alt="<? echo $value['nes_title']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>"><? echo $value['nes_title']; ?></a></h4>
                                    </div>
                                </li><? }?>
                            </ul>
                        </div>     
                    </div>
                    <div class="news_product">
                        <div class="box_right_news">
                            <span class="cat-head">
                                Đồ dùng gia đình
                            </span>
                            <ul>
                            <?php foreach ($tin_tuc_theo_type as $value ){
                                if(($value['nes_type_id'] == 677) || ($value['nes_type_id'] == 58) || ($value['nes_type_id'] == 119) || ($value['nes_type_id'] == 162) || ($value['nes_type_id'] == 2) || ($value['nes_type_id'] == 15) || ($value['nes_type_id'] == 84)){
                            ?>
                                <li class="media">
                                    <div class="media-left">
                                        <div class="img-wrap">
                                            <a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>">
                                                <img class="media-object" src="<?php echo parse_image('news', 'default', $value['nes_image']); ?>" alt="<? echo $value['nes_title']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4><a href="news/<? echo $value['nes_slug']; ?>-<? echo $value['nes_id']; ?>.html" title="<? echo $value['nes_title']; ?>"><? echo $value['nes_title']; ?></a></h4>
                                    </div>
                                </li><? }}?>
                            </ul>
                        </div>
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