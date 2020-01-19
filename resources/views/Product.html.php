<div class="breadcumbs">
    <div class="container">
        <ul>
            <li>
                <a href="#">Trang chủ&nbsp;</a>
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

				<h3><?= $Product_detail->pro_name?></h3>
				<div class="gallery_detail">
					<div class="gallery_left">
						<div class="thumbnail">
							<ul class="slide_thumbnail">
								<?php for($x=0; $x <= 3; $x++){?>
									<li>
										<img src="/assets/images/sm1.jpg" alt="">
									</li>
								<?php }?>
							</ul>
						</div>
						<div class="image_detail">
							<div class="image_detail_box">
                                <img src="<?= $Product_detail->getImgProduct() ?>" alt="">
                            </div>
						</div>
					</div>
					<div class="gallery_right">
						<div class="ga_detail owl-carousel owl-loaded owl-drag">
							<?php for($x=0; $x <= 4; $x++){?>
								<div class="ga_detail_item">
									<div class="img_wrap">
										<a href="#">
											<img src="/assets/images/lazada.jpg" alt="">
										</a>
										
									</div>
									<span><?= $Product_detail->pres_price?></span>
									<a href="#" class="lasst">
										<img src="/assets/images/btn_watch.svg" alt="" class="btn_img">
									</a>
								</div>
							<?php }?>
						</div>
						<div class="brief-desc">
							<div class="box_brief_desc">
								<h2>Thông tin nổi bật:</h2>
								<ul>
									<li>Pin 4800 mAh</li>
									<li>Hỗ trợ thẻ nhớ tối đa 4GB</li>
									<li>Hỗ trợ sim 2 sim 2 sóng</li>
									<li>Màn hình 1.8\" TFT</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="compare-wrap" id="anchorComparePrice">
					<div class="detail-caption ssg">
						<h2><a href="#anchorComparePrice">So sánh giá</a></h2>

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
									<li class="li_inner">
										<a class="all_drop">Hồ Chí Minh <span>(10)</span></a>
										<ul class="sub_child_compare">
											<li><a>Q. 7 <span>(3)</span></a></li>
											<li><a>Q. Tân Phú <span>(3)</span></a></li>
										</ul>
									</li>
									<li class="li_inner">
										<a class="all_drop">Hà Nội <span>(7)</span></a>
										<ul class="sub_child_compare">
											<li><a>Q. Hai Bà Trưng <span>(2)</span></a></li>
										</ul>
									</li>
									<li class="li_inner">
										<a class="all_drop">Đà Nẵng <span>(4)</span></a>
										<ul class="sub_child_compare">
											<li><a>Q. Thanh Khê <span>(1)</span></a></li>
											<li><a>Q. Liên Chiểu <span>(1)</span></a></li>
										</ul>
									</li>
									<li style="background: none" class="li_inner">
										<a id="textSortType"  class="all_drop">Sắp xếp: <span class="color-wss fsize12">Giá có VAT</span></a>
										<ul class="sub_child_compare">
											<li><a>Giá cửa hàng</a></li>
											<li><a>Giá có VAT</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<div class="list_compare">
						<?php for($x=0; $x <= 6; $x++){?>
							<div class="list_compare_item">
								<div class="represent">
									<div class="logo_compare">
										<div class="img_wrap">
											<a href="#">
												<img src="/assets/images/lazada.jpg" alt="">
											</a>
											
										</div>
										<span>Lịch sử giá</span>
									</div>
									<div class="rate_compare">
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
										<a href="https://websosanh.vn/cua-hang/lazada_vn.htm" target="_blank" title="lazada.vn"><span class="rate_place">lazada.vn</span></a>
									</div>
								</div>
								<div class="together_compare">
									<div class="list_compare_item_inner">

										<div class="content_compare">
											<h3>
												<a href="#" target="_blank" title="Giá điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe">Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe</a>
											</h3>
											<span>https://c.lazada.vn/t/c.n8x?url=https://www.l...</span><br>
											<div class="location-wrap">
												<span class="location" title="Hồ Chí Minh, Toàn Quốc">Nơi bán: Hồ Chí Minh, Toàn Quốc</span>
											</div>
											
										</div>
										<div class="price_compare">
											<span class="price" itemprop="Price">
												323.000 đ
											</span><br>
											<span class="vat">
												Đã có VAT
											</span>
										</div>
										<div class="btn_compare">
											<a toi-noi-ban-btn="" href="#"><img src="/assets/images/btn-to-the-place-of-sale.svg" class="pull-right" alt="Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe"></a>
										</div>
									</div>
									<button class="btn-compare-price btn btn-default btn-sm btn-compare-price_more" data-action="show" title="lazada.vn">
										+ Xem thêm 2 sản phẩm cùng cửa hàng
									</button>
									<div class="list_compare_related">
										<div class="list_compare_item_related">
											<div class="content_compare">
												<h3>
													<a href="#" target="_blank" title="Giá điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe">Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe</a>
												</h3>
												
											</div>
											<div class="price_compare">
												<span class="price" itemprop="Price">
													323.000 đ
												</span><br>
												<span class="vat">
													Đã có VAT
												</span>
											</div>
											<div class="btn_compare">
												<a toi-noi-ban-btn="" href="#"><img src="/assets/images/btn-to-the-place-of-sale.svg" class="pull-right" alt="Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe"></a>
											</div>
										</div>
										<div class="list_compare_item_related">
											<div class="content_compare">
												<h3>
													<a href="#" target="_blank" title="Giá điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe">Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe</a>
												</h3>
												
											</div>
											<div class="price_compare">
												<span class="price" itemprop="Price">
													323.000 đ
												</span><br>
												<span class="vat">
													Đã có VAT
												</span>
											</div>
											<div class="btn_compare">
												<a toi-noi-ban-btn="" href="#"><img src="/assets/images/btn-to-the-place-of-sale.svg" class="pull-right" alt="Điện thoại Mobell Rock 1 loa to pin trâu sóng khỏe"></a>
											</div>
										</div>
										<button class="btn-compare-price btn btn-default btn-sm btn_collapse" data-action="show" title="lazada.vn">
											- Thu gọn
										</button>
									</div>
									
								</div>
							</div>
						<?php }?>
					</div>
				</div>
				<div class="clear"></div>
				<div class="detail-caption">
					<span class="title">Đánh giá chi tiết </span>
				</div>
				<div class="detail_wrapper_content">
					<div class="box_detail_wrapper_content">
						<h2>Điện thoại Mobell Rock 3 là bản cải tiến của Mobell Rock trước đó với vẻ ngoài hầm hố đặc trưng của dòng <a href="#" class="xauto">điện thoại</a> chống
						sốc cũng như va đập.</h2>
						<h3><strong>Pin sạc dự phòng tiện lợi của Mobell Rock3</strong></h3>
						<p>Máy vẫn giữ cho mình khả năng sạc pin cho các điệnthoại khác từ Mobell Rock trước đó và giờ đây với viên pin códung lượng lên tới 5000 mAh thì bạn còn sạc được nhiều thiết bị hơnso với thế hệ cũ.</p>
						<p>- Bạn chỉ việc cắm dây vào hai thiếtbị là máy sẽ tự động sạc pin (dây đi kèm với hộp máy).</p>
						<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/1.jpg" ></p>
						<p class="text-center"><i>người sử dụng có thể sạc cho máy khác ngay trên chính chiếc điện thoại</i></p>
						<p><strong>Chịu va đập rất tốt</strong></p>
						<p>Sản phẩm sở hữu một số thay đổi nhỏ về ngoại hình so với ngườiđàn anh Mobell Rock nhưng nhìn chung bạn vẫn hoàn toàn yên tâm khisản phẩm sở hữu vô tình rơi rớt hay va đập mạnh.</p>
						<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/2.jpg" width="1020" height="680"></p>
						<p class="text-center"><i>Khả năng chống chịu va đậptốt​</i></p>
						<p><strong>Thiết kế hầm hố và sử dụngdễ dàng</strong></p>
						<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/3.jpg" width="1020" height="680"></p>
						<p class="text-center"><i>Viên pin có kích thước rất lớn củađiện thoại</i></p>
						<p>Ở cạnh dưới có 1 nắp bảo vệ cho cổng sạc pin.</p>
						<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/4.jpg" width="1020" height="680"></p>
						<p class="text-center"><i>Cạnh dưới của điện thoại​</i></p>
						<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/5.jpg" width="1020" height="680"></p>
						<p class="text-center"><i>Bàn phím với kích thước lớn, dễthao tác​</i></p>
						<p>- Để kiểm tra âm thanh, bạn hãy
							<strong>gắn sim vào máy và ấn gọi 900 (miễn phí)</strong> để nghethử âm thanh có phù hợp với ý bạn chưa.</p>
							<p class="text-center"><img alt="Điện thoại Mobell Rock 3" class="lazy" title="Điện thoại Mobell Rock 3" src="/assets/images/6.jpg" width="1020" height="680"></p>
							<p class="text-center">sản phẩm sở hữu khá đầy đủ các tiệních như đèn pin, nghe nhạc,
								radio, báo thức... sản phẩm được trang bị 2 sim và mở rộng <a href="/s/thẻ+nhớ.htm" class="xauto">thẻ nhớ</a>tối đa 8 GB</p>
								<p>Với ưu điểm bền, chống va đập vàviên pin cho thời gian sử dụng có thể lên đến 2 tuần sẽ phù hợp với người dùng hay di chuyển và ít sạc pin.</p>
							</div>
						</div>
						<div class="show-more1">
							<p class="readmore1">Xem thêm</p>
						</div>
						<div class="hide-more1">
							<p class="hide_content1 display_none">Ẩn bớt</p>
						</div>
						<!-- fgfg -->
						<div class="detail-caption">
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
												<td class="text" >Loại sim:</td>
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
												<td class="text" >Hệ điều hành:</td>
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
												<td class="text" >Phù hợp với các mạng:</td>
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
												<td class="text" >Trọng lượng:</td>
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
						</div>
						<!--  -->
						<div class="menu_tabs">
							<!-- Tab links -->
							<div class="tab">
								<button class="tablinks active" onclick="openCity(event, 'London')">Sản phẩm tương tự</button>
								<button class="tablinks" onclick="openCity(event, 'Paris')">Sản phẩm bạn đã xem</button>
							</div>

							<!-- Tab content -->
							<div id="London" class="tabcontent" style="display: block;">
								<div class="listProduct">
									<?php for($x = 0;$x <= 1;$x++) {?>
										<div class="listProduct_item">
											<div class="box_cover">
												<div class="top_list_item">
													<div class="img-wrap lazyload">
														<a href="#">
															<img class="lazyload image1" src="/assets/images/sp1.jpg" alt="Máy tính bảng Apple iPad mini 2 Retina + Cellular - 16GB, Wifi + 3G/4G, 7.9 inch">
															<img src="/assets/images/btn-compare-price.svg" class="image2">
														</a>
													</div>
													<h3 class="title">
														<a href="detail.php">Smart Tivi LED 3D Samsung UA40F6400 (40F6400) - 40 inch, Full HD (1920 x 1080)</a>
													</h3>
													<div class="price ">
														giá từ 7.100.000 đ
													</div>
													<div class="tagline">&nbsp;</div>
													<div class="quantity">
														<p>Xem 2 nơi bán</p>
													</div>
												</div>

											</div>

										</div>
									<?php }?>

								</div>
							</div>

							<div id="Paris" class="tabcontent">
								<div class="listProduct">
									<?php for($x = 0;$x <= 2;$x++) {?>
										<div class="listProduct_item">
											<div class="box_cover">
												<div class="top_list_item">
													<div class="img-wrap lazyload">
														<a href="#">
															<img class="lazyload image1" src="/assets/images/sp1.jpg" alt="Máy tính bảng Apple iPad mini 2 Retina + Cellular - 16GB, Wifi + 3G/4G, 7.9 inch">
															<img src="/assets/images/btn-compare-price.svg" class="image2">
														</a>
													</div>
													<h3 class="title">
														<a href="detail.php">Điện thoại  - 2 sim</a>
													</h3>
													<div class="price ">
														giá từ 7.100.000 đ
													</div>
													<div class="tagline">&nbsp;</div>
													<div class="quantity">
														<p>Xem 2 nơi bán</p>
													</div>
												</div>

											</div>

										</div>
									<?php }?>

								</div>
							</div>

						</div>
						<div class="detail-caption">
							<span class="title">Bình luận sản phẩm</span>
						</div>
						<div id="list-comment">
							<div class="media">
								<div class="media-body">
									<div class="comment-content">
										mobel rock bị quên mật khẩu khởi động thì làm sao ad ?

									</div>             
									<div class="action">
										<strong>Người dùng ẩn danh</strong> - 27 tháng trước
										<div class="pull-right group-action">
											<ul>
												<li class="rep">Trả lời</li>             

											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="media">
								<div class="media-body">
									<div class="comment-content">
										mobel rock bị quên mật khẩu khởi động thì làm sao ad ?

									</div>             
									<div class="action">
										<strong>Người dùng ẩn danh</strong> - 27 tháng trước
										<div class="pull-right group-action">
											<ul>
												<li class="rep">Trả lời</li>             

											</ul>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div id="comment-form"><span class="pull-right user-full-name">Bình luận của bạn sẽ được đăng lên với chế độ ẩn danh</span>
							<textarea id="txtComment"></textarea>
							<p class="cmt-word-count text-right">
								Hãy viết thêm ít nhất <b>10</b> từ nữa
							</p>
							<button id="btnComment" data-action="post" class="btn-orange pull-left">Đăng bình luận</button>
						</div>
						<div class="clear"></div>
						<div id="list-comment-of-merchant" class="comment-wrap">
							<div class="detail-caption">

								<span>Bình luận từ các nguồn khác</span>
							</div>

							<div class="media">
								<div class="media-body">
									<div class="comment-content">
										pin rất trâu và bền 
									</div>             
									<div class="action">
										<strong>Phu Duc Blue</strong> - 37 tháng trước
									</div>
								</div>
							</div>

							<ul id="paging-comment-of-merchant" class="pagination mt5 mb5 pull-right"></ul>
						</div>
					</div>

					<div class="content_detail_right">
						<div class="news_product">
							<div class="top_ads_detail_right">
								<img src="/assets/images/ads4.png" alt="">
							</div>
							<div class="box_right_news">
								<span class="cat-head">
									Tin tức về sản phẩm
								</span>
								<ul>
									<?php for($x=0; $x <= 6; $x++){?>
										<li class="media">
											<div class="media-left">
												<div class="img-wrap">
													<a href="#" title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
														<img class="media-object" src="/assets/images/sp2.jpg"  alt="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
													</a>
												</div>
											</div>
											<div class="media-body">
												<h4><a href="#" title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?</a></h4>
											</div>
										</li>
									<?php }?>
								</ul>
							</div>
						</div>
						<div class="refer_product">
							<div class="top_ads_detail_right">
								<img src="/assets/images/ads5.png" alt="">
							</div>
							<div class="box_right_news">
								<span class="cat-head">
									Sản phẩm đáng quan tâm
								</span>
								<ul>
									<?php for($x=0; $x <= 6; $x++){?>
										<li class="media">
											<div class="media-left">
												<div class="img-wrap">
													<a href="#" title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
														<img class="media-object" src="/assets/images/sp3.jpg"  alt="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">
													</a>
												</div>
											</div>
											<div class="media-body">
												<h4><a href="#" title="Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?">Điện thoại iPhone 11 2019 (iPhone XI) có tích hợp 2 SIM không?</a></h4>
											</div>
										</li>
									<?php }?>
								</ul>
							</div>
						</div>
						<div class="ads_detail">
							<img src="/assets/images/ad_right.gif">
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