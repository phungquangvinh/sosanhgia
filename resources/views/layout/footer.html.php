<div class="container_fluid" id="footer">

	<div class="container">
        <?php foreach ($dataConfiguration as $Configuration) { ?>
		<div class="most_customer" >
			<h3><span>Cửa hàng nhiều người mua</span></h3>
			<div class="slide owl-carousel">
				<?php foreach ($listUserEstore as $value) {?>
					<div class="slide_item">
						<a href="#" title="<?= $value->ue_name?>">
							<img src="<?= $value->getImgUserEstore()?>" alt="">
							<div class="rate">
								<div class="list_star item_review">
									<div class="item_star append_star" data-star="3">
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
							</div>
						</a>
					</div>
				<?php }?>
			</div>
		</div>
		<div class="box_bottom_mid">
			<div class="image">
                <a href="#">
                    <img src="/assets/images/logo.svg" alt="">
                </a>
			</div>

			<div class="info">
				<h3>CÔNG TY CỔ PHẦN SO SÁNH VIỆT NAM</h3>
				<p>Hotline so sánh giá giúp bạn:
                    <a href="#">
                        <strong><?= $Configuration->hotline ?></strong>
                    </a>
                    <span>(8h30 - 17h30)</span><br>
                </p>
				<p>
                    <span>Công cụ so sánh giá online - Không bán hàng</span>
                </p>
                <p>Email:
                    <a href="<?= $Configuration->admin_email ?>">
                        <span class="contact"><?= $Configuration->admin_email ?></span>
                    </a>
                </p>
			</div>

			<div class="ads_bot" align="right">
               
			</div>
		</div>
		<div class="copyright row">
			© 2012 - 2019 – <strong>CÔNG TY CỔ PHẦN SO SÁNH VIỆT NAM</strong>
		</div>
        <?php }?>
	</div>

</div>