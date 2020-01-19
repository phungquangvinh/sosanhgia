<div class="menu_responsive ">
	<div class="btn_respon">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</div>
</div>
<div id="header" class="">
	<div class="container container_header">
		<div class="row_header">
			<div class="scroll_logo logo">
				<a href="/">
					<img width="300px" src="/assets/images/logo.svg" alt="">
				</a>
			</div>
		</div>
		<div class="scroll">
			<div class="search">
				<div id="dropdowFilter" class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" >
						Tất cả
						<i class="fa fa-caret-down" aria-hidden="true"></i>
					</button>
					<ul class="dropdown-menu">
                        <?php foreach ($listCategoryProduct as $listCategoryProduct ) {?>
						<li><a href="/<?= to_slug($listCategoryProduct->cat_name).'-c'.$listCategoryProduct->cat_id?>.html"><?= $listCategoryProduct->cat_name?></a></li>
                        <?php }?>
					</ul>
				</div>
                <form action="<?= url('search') ?>" method="GET" class="contact-form">
                    <input id="inputFilter" type="text" placeholder="Tìm sản phẩm bạn muốn so sánh ...." name="name" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>">
                    <button id="btnFilter" type="submit">Tìm kiếm</button>
                </form>
			</div>
			<div class="ads">
				<a href="#">
					<img src="/assets/images/ads1.png">
				</a>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="navigator container_fluid">
	<div class="container navigate">
		<div class="main_nav">
			<i class="fa fa-bars" aria-hidden="true"></i>
			Danh mục sản phẩm
			<div class="list_pro">
				<ul>
                    <?php //dd('hsbdhfvjfnjndjvfngj');die;
                     foreach ($dataCatelv2 as $dataCate ) {
                    	$link_cat = createlink("product",array('nTitle' => $dataCate->cat_name, 'iData' => $dataCate->cat_id));
                    	?>
					<li class="list_parents">
						<a href="<?=$link_cat?>" class="listCateProductParent"><?= $dataCate->cat_name?></a>
						<div class="child">
							<ul class="sub_list">
                                <?php 
                                if(isset($dataCatelv3[$dataCate->cat_id])){
                                	foreach ($dataCatelv3[$dataCate->cat_id] as $listCateChild ) {
                                		$link_cat = createlink("product",array('nTitle' => $listCateChild->cat_name, 'iData' => $listCateChild->cat_id));
                                	?>
									<li class="sub_list_left"><a href="<?=$link_cat?>" class="listCateProduct"><?= $listCateChild->cat_name?></a></li>
	                                <?php 
                                	}
                            	}
                                ?>
							</ul>
						</div>
					</li>
                    <?php }?>
				</ul>
			</div>
		</div>
		<div class="list_navs ">
			<ul class="ds owl-carousel owl-loaded owl-drag">
				<li><a href="#">Huggies: Mua 1 tặng 1</a></li>
				<li><a href="#">Phụ kiện hiệu: giảm 50%</a></li>
				<li><a href="#">Săn Deal khủng: chỉ từ 8k</a></li>
				<li><a href="#">Kagaroo giảm kịch sàn</a></li>
				<li><a href="#">Gia dụng: giảm 60%</a></li>
				<li><a href="#">Huggies: Mua 1 tặng 1</a></li>
				<li><a href="#">Phụ kiện hiệu: giảm 50%</a></li>
				<li><a href="#">Săn Deal khủng: chỉ từ 8k</a></li>
				<li><a href="#">Kagaroo giảm kịch sàn</a></li>
				<li><a href="#">Gia dụng: giảm 60%</a></li>
			</ul>
		</div>
	</div>
</div>
