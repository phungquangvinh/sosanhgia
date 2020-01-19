<?php //dd($search_place);?>
<input type="hidden" name="cat_id" value="<?= $cat_id ?>" class="cat_id">
<div class="breadcumbs">
    <div class="container">
        <ul>
            <li><a href="/">Trang chủ&nbsp;</a></li>
            <li>›</li>
            <li><a href="#"><?=$cateData->cat_name?></a></li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<div class="content_products">
    <div class="container">
        <div class="page_list">
            <div class="left_wrap">
                <h2>Lọc sản phẩm</h2>
                <div class="left_search">
                    <div class="left_search_inner">
                        <div class="box_search_item">
                            <form method="get" action="">
                                <button type="submit" name="search_pro" value="yes">Tìm kiếm</button>
                                <div class="search_item">
                                    <h4>Địa chỉ nơi bán</h4>
                                    <div class="filter-list mCustomScrollbar _mCS_1">
                                        <div class="filter-list-item">
                                            <?php foreach ($listCities as $datalistCities ){?>
                                            <label class="control control--radio search-place" data-value="<?= $datalistCities->cit_id?>">
                                                <?= $datalistCities->cit_name?>
                                                <span>(<?= $datalistCities->cit_id ?>)</span>
                                                <input type="checkbox" name="region" value="<?= $datalistCities->cit_id?>" data-name="">
                                                <div class="control__indicator"></div>
                                            </label>
                                            <?}?>
                                        </div>
                                    </div>
                                </div>

                                <div class="search_item">
                                    <h4>Cửa hàng</h4>
                                    <div class="filter-list mCustomScrollbar _mCS_1">
                                        <div class="filter-list-item search-shop">
                                            <?php foreach ($listUserEstore as $datalistUserEstore){?>
                                            <label class="control control--radio" data-value="<?= $datalistUserEstore->ue_id?>">
                                                <?= $datalistUserEstore->ue_name?>
                                                <span>()</span>
                                                <input type="checkbox" name="shop-name" value="<?= $datalistUserEstore->ue_id?>" data-name="">
                                                <div class="control__indicator"></div>
                                            </label>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>

                                <div class="search_item">
                                    <h4>Giá sản phẩm</h4>
                                    
                                    <div class="filter-list_last mCustomScrollbar _mCS_1">
                                        <div class="filter-list-item search-price">
                                            <label class="control control--radio" data-value="0-1000000">Dưới 1 triệu
                                                <input type="radio" name="gia_sp" value="0-1000000" data-name="">

                                                <div class="control__indicator"></div>
                                            </label>
                                            <label class="control control--radio" data-value="1000000-5000000">Từ 1 triệu đến 5 triệu                                                
                                                <input type="radio" name="gia_sp" value="1000000-5000000" data-name="">

                                                <div class="control__indicator"></div>
                                            </label>
                                            <label class="control control--radio" data-value="5000000-10000000">Từ 5 triệu đến 10 triệu
                                                <input type="radio" name="gia_sp" value="5000000-10000000" data-name="">

                                                <div class="control__indicator"></div>
                                            </label>
                                            <label class="control control--radio" data-value="10000000-2147483647">Trên 10 triệu
                                                <input type="radio" name="gia_sp" value="10000000-2147483647" data-name="">

                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="submit" name="search_pro" value="yes">Tìm kiếm</button>
                                <input type="hidden" name="total_region" value="" class="total_region">
                                <input type="hidden" name="total_shop" value="" class="total_shop">
                            </form>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="right_wrap">

                <div class="list_wrap">
                    <div class="list_wrap_header">
                        <div class="search_result">
                            <span>Có <b><? echo $pageSize;?></b> kết quả trong <a href="#"><? echo format_number($totalProducts) ;?> </a>sản phẩm</span>
                        </div>
                        <div class="search_actions">
                            <div id="sortType">
                                <label class="control control_sort">Sắp xếp sản phẩm:</label>
                                <div class="box">
                                    <label class="control control--radio">
                                        Giá tiền tăng &nbsp;↑
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label class="control control--radio">
                                        Giá tiền giảm ↓
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label class="control control--radio">
                                        Đáng quan tâm
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listProduct">
                        <?php require("layout/ListProduct.html.php"); ?>
                    </div>
                    <div class="pag">
                        <div class="pagination">
                            <?php if ($totalProducts > 1) {
                                echo showPaginate($pageSize, $page, $totalProducts);
                            } ?>
                            <div class="clear"></div>  
                        </div>
                    </div>
                </div>
                  
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){

        
        $(".box_search_item").click(function(){
            var place = [];
            var cat_id = [];
            
            $.each($("input[name='region']:checked"), function(){            
                place.push($(this).val());
            });
            $(".total_region").val(place);
            
            $.each($("input[name='shop-name']:checked"), function(){            
                cat_id.push($(this).val());
            }); 
            $(".total_shop").val(cat_id);
        });
            
        
    });
</script>