<?php 

    $arrCategorys  = $d->getImg(1172);
    $arrAbout = $d->o_fet("select * from #_category where hien_thi = 1 AND id = 1173");
    $arrAboutImage  = $d->getImg(1173);
    $arrBannerTop  = $d->getImg(1172);
    $arrWe = $d->getTemplates(56);
    $arrCategoryProduct = $d->o_fet("select * from #_category where hien_thi = 1 AND module = 3 and menu = 1 order by so_thu_tu asc, id desc");
?>


    <div class="insMain">
    <?php include 'module/slider.php'; ?>

            <section id="insBannerTop" class="hidden-xs">
                <div class="container">
                    <div class="groupBanner">
                        <div class="row">
                            <?php foreach($arrBannerTop as $k => $item): ?>
                            <div class="itemSlide col-md-3 col-sm-3">
                                <div class="imageHover">
                                    <a href="/" title="<?= $item['link'] ?>" target="_blank">
                                        <img src="<?= URLPATH.'img_data/images/'.$item['picture']; ?>" alt="" />
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>


            <section id="insAboutUs" class="seasionPage">
                <div class="container">
                    <div class="groupAboutUs">
                        <div class="row">
                            <div class="col-md-4 imgAbout">
                                <div class="image">
                                    <img src="<?= URLPATH.'img_data/images/'.$arrWe['hinh_anh']; ?>" alt="<?=  $arrWe['ten_vn']?>" />
                                </div>
                            </div>
                            <div class="col-md-8 detailAbout">
                                <div class="group">
                                    <div class="titleGroup text-center">
                                        <h2>
                                            <?=  $arrWe['ten_vn']?>
                                        </h2>
                                        <p><?=  $arrWe['noi_dung_vn']?></p>
                                    </div>
                                    <div class="borderLine">
                                        <div class="icon">
                                            <img src="assets/icon_border.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="policyGroup">
                                        <div class="clearfix listPolicy">
                                        <?php foreach($arrAboutImage as $k => $item): ?>
                                            <div class="item col-md-3 col-sm-3 col-xs-6">
                                                <div class="info">
                                                    <div class="icon">
                                                        <img src="<?= URLPATH.'img_data/images/'.$item['picture']; ?>" alt="" />
                                                    </div>
                                                    <div class="detail">
                                                        <h3>
                                                        <?= $item['title_vn'] ?>
                                                        </h3>
                                                        <p>
                                                        <?= $item['body_vn'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="insProductTabs" class="seasionPage">
                <div class="container">
                <?php foreach ($arrCategoryProduct as $key => $value) { 
                    $intId =  $value['id'];
                    $arrProduct = $d->o_fet("select * from #_sanpham where hien_thi = 1 AND id_loai =$intId  order by so_thu_tu asc, id desc limit 8");
                ?>
                    <div class="groupProductTabs">
                        <div class="effectTitle">
                            <h2><?= $value['ten_'.$lang]?></h2>
                            <div class="borderLine">
                                <div class="icon">
                                    <img src="assets/icon_border.png" alt="<span>Sản phẩm </span>nổi bật nhất">
                                </div>
                            </div>
                        </div>
                        <div class="tabsCatelogy">
                            <div class="tabContent tab-content">

                                <div role="tabpanel" class="tab-pane fade in active " id="groupPdTab-1">
                                    <div class="pdListItem pdListTab">

                                        <div class="row">
                                        <?php foreach ($arrProduct as $key => $item) : 
                                            $gia=$item['gia'];
                                            $km = $item['khuyen_mai'];
                                        ?>
                                            <div class="itemProduct col-md-3 col-sm-3 col-xs-6">
                                                <div class="pdLoopItem animated zoomIn">
                                                    <div class="itemLoop clearfix">
                                                        <div class="pdLoopImg elementFixHeight">



                                                            <a href="<?= $item['alias_'.$lang]?>" title="Acaiberry grande">
                                                                <img src="<?= URLPATH.'img_data/images/'.$item['hinh_anh']; ?>" data-reg="false" class="imgLoopItem" alt="<?= $item['ten_'.$lang]?>">

                                                            </a>
                                                            <div class="pdLoopAction">
                                                                <div class="listAction">
                                                                    



                                                                <form method="post" action="<?= URLPATH ?>gio-hang.html">
                                                                    <a href="<?= $item['alias_'.$lang]?>.html" class="btnLoop btnViewPd " data-toggle="tooltip" data-placement="left" title="Xem chi tiết">
                                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                    </a>
                                                                    <input type="hidden" name="id" value="<?= $item['id']?>">
                                                                    <input type="hidden" name="soluong" class="soluong" value="1">
                                                                    <button type="submit" class="add-cart btnLoop" name="addcart">
                                                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span>Thêm vào giỏ</span>
                                                                    </button>
                                                                </form>

                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pdLoopDetail text-center clearfix">
                                                            <h3 class="pdLoopName"><a class="productName" href="<?= $item['alias_'.$lang]?>" title="<?= $item['ten_'.$lang]?>"><?= $item['ten_'.$lang]?></a></h3>
                                                            <p class="pdPrice">


                                                                <span> 
                                                                    <?php if($km>0){ ?>
                                                                        <?=$d->vnd($km)?> 
                                                                    <?php }else{?>
                                                                        <?php if($gia==0){ ?>
                                                                        <strong><?= constant('_contact'); ?></strong>
                                                                        <?php }else{?>
                                                                            <?=$d->vnd($gia)?>
                                                                        <?php }?>
                                                                    <?php }?></span>



                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </section>



            <section id="insCountdown" class="">
                <div class="groupCountdown clearfix">
                    <div class="col-md-7 col-sm-12 full-left text-right">
                        <div class="image">
                            <img src="assets/countdown_banner.png" alt="Giảm ngay 30%" />
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 full-right">
                        <div class="countdownDetail">
                            <p>
                                Khuyễn mãi
                            </p>
                            <h2>
                                Giảm ngay 30%
                            </h2>
                            <h5>
                                Tiết kiệm lên đến hàng triệu đồng
                            </h5>
                            <div id="timeCountdown" data-time="September 07 2018 00:00:00 ">

                            </div>
                            <div class="action">
                                <a href="/" class="insButton">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="insWhy" class="seasionPage">
                <div class="container">
                    <div class="groupWhy">
                        <div class="insHeading">
                            <i>Tại sao chọn chúng tôi</i>
                            <h2>Các sản phẩm tốt nhất</h2>
                        </div>
                        <div class="whyContent">
                            <div class="group clearfix">
                                <div class="whyLeft pull-left">




                                    <div class="item-os">
                                        <img src="assets/icon-bp-1.jpg" alt="">
                                        <h4>100% Tự nhiên</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>




                                    <div class="item-os">
                                        <img src="assets/icon-bp-2.jpg" alt="">
                                        <h4>Công thức nấu ăn lành mạnh</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>




                                    <div class="item-os">
                                        <img src="assets/icon-bp-3.jpg" alt="">
                                        <h4>Chế độ ăn uống lành mạnh</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>

                                </div>
                                <div class="whyRight pull-right">






                                    <div class="item-os">
                                        <img src="assets/icon-bp-4.jpg" alt="">
                                        <h4>Luôn tươi</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>






                                    <div class="item-os">
                                        <img src="assets/icon-bp-5.jpg" alt="">
                                        <h4>Thực hiện bài tập</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>






                                    <div class="item-os">
                                        <img src="assets/icon-bp-6.jpg" alt="">
                                        <h4>Giữ sức khỏe</h4>
                                        <p>Đó là một thực tế được thành lập từ lâu rằng một độc giả sẽ bị phân tâm bởi nội dung có thể đọc được.</p>
                                    </div>

                                </div>
                                <div class="whyCenter pull-left">

                                    <img class="lazy" src="assets/img_best_big.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="insBrands" class="seasionPage">
                <div class="container">
                    <div class="groupBrands">
                        <div class="titleBrand text-center">
                            <h2>
                                Đối tác từ chúng tôi
                            </h2>
                            <img src="assets/title-line.png" />
                        </div>
                        <div class="slideBrands owlDesign notDots">




                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_1_image.png" alt="Thương hiệu 1" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_2_image.png" alt="Thương hiệu 2" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_3_image.png" alt="Thương hiệu 3" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_4_image.png" alt="Thương hiệu 4" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_5_image.png" alt="Thương hiệu 5" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_6_image.png" alt="Thương hiệu 6" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_7_image.png" alt="Thương hiệu 7" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_8_image.png" alt="Thương hiệu 8" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_9_image.png" alt="Thương hiệu 9" />
                                </a>
                            </div>





                            <div class="item">
                                <a href="/">
                                    <img src="assets/brand_10_image.png" alt="Thương hiệu 10" />
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </section>


            <section id="insReview" class="seasionPage">
                <div class="container">
                    <div class="groupReview">
                        <div class="insHeading">
                            <i>Đánh giá</i>
                            <h2>Khách hàng nói gì?</h2>
                        </div>
                        <div class="reviewContent">
                            <div class="slideRevivews owlStyle notDots">









                                <div class="itemReview">
                                    <div class="info personText">
                                        <div class="arrow"></div>
                                        <i class="fa fa-quote-left"></i>
                                        <div class="text">
                                            <h3>
                                                Better Than The Best !!!
                                            </h3>
                                            <div class="ps">
                                                <p>
                                                    Pharetra libero non facilisis imperdiet mi augue feugiat nisl sit amet mollis enim velit Vestibulum fringilla nulla ultricies sem. Maecenas ultrices faucibus felis.
                                                </p>

                                                <p>Maecenas tincidunt. Proin porttitor lacus eget mi. Aenean at mi. Mauris vulputate mi vitae lobortis. Pellentesque ac ipsum vel massa imperdiet semper. In maurisd libero interdum quis molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info personInfo clearfix">
                                        <div class="avt">
                                            <img src="assets/img_index_review_1.png" alt="">
                                        </div>
                                        <div class="name">
                                            <h4>Thomas Ben</h4>
                                            <p>Happy Client</p>
                                        </div>
                                        <div class="rating">


                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star-o"></i>



                                            <i class="fa fa-star-o"></i>


                                        </div>
                                    </div>
                                </div>










                                <div class="itemReview">
                                    <div class="info personText">
                                        <div class="arrow"></div>
                                        <i class="fa fa-quote-left"></i>
                                        <div class="text">
                                            <h3>
                                                Better Than The Best !!!
                                            </h3>
                                            <div class="ps">
                                                <p>
                                                    Pharetra libero non facilisis imperdiet mi augue feugiat nisl sit amet mollis enim velit Vestibulum fringilla nulla ultricies sem. Maecenas ultrices faucibus felis.
                                                </p>

                                                <p>Maecenas tincidunt. Proin porttitor lacus eget mi. Aenean at mi. Mauris vulputate mi vitae lobortis. Pellentesque ac ipsum vel massa imperdiet semper. In maurisd libero interdum quis molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info personInfo clearfix">
                                        <div class="avt">
                                            <img src="assets/img_index_review_2.png" alt="">
                                        </div>
                                        <div class="name">
                                            <h4>Thomas Ben</h4>
                                            <p>Happy Client</p>
                                        </div>
                                        <div class="rating">


                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star-o"></i>


                                        </div>
                                    </div>
                                </div>










                                <div class="itemReview">
                                    <div class="info personText">
                                        <div class="arrow"></div>
                                        <i class="fa fa-quote-left"></i>
                                        <div class="text">
                                            <h3>
                                                Better Than The Best !!!
                                            </h3>
                                            <div class="ps">
                                                <p>
                                                    Pharetra libero non facilisis imperdiet mi augue feugiat nisl sit amet mollis enim velit Vestibulum fringilla nulla ultricies sem. Maecenas ultrices faucibus felis.
                                                </p>

                                                <p>Maecenas tincidunt. Proin porttitor lacus eget mi. Aenean at mi. Mauris vulputate mi vitae lobortis. Pellentesque ac ipsum vel massa imperdiet semper. In maurisd libero interdum quis molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info personInfo clearfix">
                                        <div class="avt">
                                            <img src="assets/img_index_review_3.png" alt="">
                                        </div>
                                        <div class="name">
                                            <h4>Thomas Ben</h4>
                                            <p>Happy Client</p>
                                        </div>
                                        <div class="rating">


                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star-o"></i>


                                        </div>
                                    </div>
                                </div>










                                <div class="itemReview">
                                    <div class="info personText">
                                        <div class="arrow"></div>
                                        <i class="fa fa-quote-left"></i>
                                        <div class="text">
                                            <h3>
                                                Better Than The Best !!!
                                            </h3>
                                            <div class="ps">
                                                <p>
                                                    Pharetra libero non facilisis imperdiet mi augue feugiat nisl sit amet mollis enim velit Vestibulum fringilla nulla ultricies sem. Maecenas ultrices faucibus felis.
                                                </p>

                                                <p>Maecenas tincidunt. Proin porttitor lacus eget mi. Aenean at mi. Mauris vulputate mi vitae lobortis. Pellentesque ac ipsum vel massa imperdiet semper. In maurisd libero interdum quis molestie.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info personInfo clearfix">
                                        <div class="avt">
                                            <img src="assets/img_index_review_4.png" alt="">
                                        </div>
                                        <div class="name">
                                            <h4>Thomas Ben</h4>
                                            <p>Happy Client</p>
                                        </div>
                                        <div class="rating">


                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star"></i>



                                            <i class="fa fa-star-o"></i>



                                            <i class="fa fa-star-o"></i>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="insBlog" class="seasionPage">
                <div class="container">
                    <div class="groupBlog">
                        <div class="effectTitle">
                            <h2>
                                <span>Tin tức</span> nổi bật
                            </h2>
                            <div class="borderLine">
                                <div class="icon">
                                    <img src="assets/icon_border.png" alt="<span>Sản phẩm </span>nổi bật nhất">
                                </div>
                            </div>
                        </div>
                        <div id="blogHomeSlide" class="owlStyle notDots slideBlogHome">

                            <div class="article_item">







                                <div class="insArticleLoop">
                                    <div class="articlePostBody bg_w">
                                        <div class="postThumbIMG relative imageHover">
                                            <a href="/blogs/news/7-loai-rau-nen-trong-vao-mua-dong">
                                                <img data-reg="false" class="imgLoopItem" src="//file.hstatic.net/1000271724/article/3-min_icon.jpg" alt="7 loại rau nên trồng vào mùa đông">
                                            </a>
                                            <div class="createdInfo">
                                                <ul class="notStyle">
                                                    <li class="time"><i class="fa fa-calendar" aria-hidden="true"></i> <time>14/06/2018</time></li>
                                                    <li class="comment"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>0</span></li>
                                                    <li class="post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Beauty farm</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="postDetail">
                                            <div class="detail clearfix">
                                                <h3><a href="/blogs/news/7-loai-rau-nen-trong-vao-mua-dong" title="7 loại rau nên trồng vào mùa đông">7 loại rau nên trồng vào mùa đông</a></h3>
                                                <p>Tháng 10 là thời gian vô cùng thuận lợi để trồng 7 loại rau củ dưới đây, vì vậy hãy bắt tay vào trồng luôn để cả gia đình khỏi...</p>
                                                <a href="/blogs/news/7-loai-rau-nen-trong-vao-mua-dong" class="view" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="article_item">







                                <div class="insArticleLoop">
                                    <div class="articlePostBody bg_w">
                                        <div class="postThumbIMG relative imageHover">
                                            <a href="/blogs/news/thay-doi-thuc-don-cho-be-voi-5-loai-cu-qua-tot-nhat-mua-dong">
                                                <img data-reg="false" class="imgLoopItem" src="//file.hstatic.net/1000271724/article/5-min_icon.jpg" alt="Thay đổi thực đơn cho bé với 5 loại củ quả tốt nhất mùa đông">
                                            </a>
                                            <div class="createdInfo">
                                                <ul class="notStyle">
                                                    <li class="time"><i class="fa fa-calendar" aria-hidden="true"></i> <time>21/05/2018</time></li>
                                                    <li class="comment"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>0</span></li>
                                                    <li class="post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Beauty farm</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="postDetail">
                                            <div class="detail clearfix">
                                                <h3><a href="/blogs/news/thay-doi-thuc-don-cho-be-voi-5-loai-cu-qua-tot-nhat-mua-dong" title="Thay đổi thực đơn cho bé với 5 loại củ quả tốt nhất mùa đông">Thay đổi thực đơn cho bé với 5 loại củ quả tốt nhất mùa đông</a></h3>
                                                <p>Mùa nào thức nấy! Vào mùa đông bé nên ăn những loại rau củ nào để hấp thụ dinh dưỡng một cách tốt nhất? Khám phá ngay! 1. Súp lơNhững loại...</p>
                                                <a href="/blogs/news/thay-doi-thuc-don-cho-be-voi-5-loai-cu-qua-tot-nhat-mua-dong" class="view" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="article_item">







                                <div class="insArticleLoop">
                                    <div class="articlePostBody bg_w">
                                        <div class="postThumbIMG relative imageHover">
                                            <a href="/blogs/news/6-dau-hieu-cua-co-the-canh-bao-ban-an-qua-it-rau-qua">
                                                <img data-reg="false" class="imgLoopItem" src="//file.hstatic.net/1000271724/article/6-min_icon.jpg" alt="6 dấu hiệu của cơ thể cảnh báo bạn ăn quá ít rau quả">
                                            </a>
                                            <div class="createdInfo">
                                                <ul class="notStyle">
                                                    <li class="time"><i class="fa fa-calendar" aria-hidden="true"></i> <time>09/05/2018</time></li>
                                                    <li class="comment"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>0</span></li>
                                                    <li class="post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Beauty farm</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="postDetail">
                                            <div class="detail clearfix">
                                                <h3><a href="/blogs/news/6-dau-hieu-cua-co-the-canh-bao-ban-an-qua-it-rau-qua" title="6 dấu hiệu của cơ thể cảnh báo bạn ăn quá ít rau quả">6 dấu hiệu của cơ thể cảnh báo bạn ăn quá ít rau quả</a></h3>
                                                <p>Xuất hiện vết bầm tím thường xuyên Xuất hiện vết bầm trên da là dấu hiệu tố cáo bạn ăn quá ít rau quả. Tuy nhiên, những vết bầm này đa...</p>
                                                <a href="/blogs/news/6-dau-hieu-cua-co-the-canh-bao-ban-an-qua-it-rau-qua" class="view" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="article_item">







                                <div class="insArticleLoop">
                                    <div class="articlePostBody bg_w">
                                        <div class="postThumbIMG relative imageHover">
                                            <a href="/blogs/news/nhung-loai-rau-xanh-nen-an-nhieu-trong-mua-thu">
                                                <img data-reg="false" class="imgLoopItem" src="//file.hstatic.net/1000271724/article/4-min_icon.jpg" alt="Những loại rau xanh nên ăn nhiều trong mùa thu">
                                            </a>
                                            <div class="createdInfo">
                                                <ul class="notStyle">
                                                    <li class="time"><i class="fa fa-calendar" aria-hidden="true"></i> <time>21/03/2018</time></li>
                                                    <li class="comment"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>0</span></li>
                                                    <li class="post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Beauty farm</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="postDetail">
                                            <div class="detail clearfix">
                                                <h3><a href="/blogs/news/nhung-loai-rau-xanh-nen-an-nhieu-trong-mua-thu" title="Những loại rau xanh nên ăn nhiều trong mùa thu">Những loại rau xanh nên ăn nhiều trong mùa thu</a></h3>
                                                <p>Thời tiết chuyển sang thu sẽ không còn nóng nực như mùa hè. Thời tiết thay đổi cũng khiến nhiều người không kịp thích nghi nên dễ bị ốm, nhất...</p>
                                                <a href="/blogs/news/nhung-loai-rau-xanh-nen-an-nhieu-trong-mua-thu" class="view" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="article_item">







                                <div class="insArticleLoop">
                                    <div class="articlePostBody bg_w">
                                        <div class="postThumbIMG relative imageHover">
                                            <a href="/blogs/news/rua-rau-cu-qua-bang-dung-dich-gi-la-sach-nhat">
                                                <img data-reg="false" class="imgLoopItem" src="//file.hstatic.net/1000271724/article/7-min_icon.jpg" alt="Rửa rau củ quả bằng dung dịch gì là sạch nhất?">
                                            </a>
                                            <div class="createdInfo">
                                                <ul class="notStyle">
                                                    <li class="time"><i class="fa fa-calendar" aria-hidden="true"></i> <time>21/03/2018</time></li>
                                                    <li class="comment"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>0</span></li>
                                                    <li class="post"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Beauty farm</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="postDetail">
                                            <div class="detail clearfix">
                                                <h3><a href="/blogs/news/rua-rau-cu-qua-bang-dung-dich-gi-la-sach-nhat" title="Rửa rau củ quả bằng dung dịch gì là sạch nhất?">Rửa rau củ quả bằng dung dịch gì là sạch nhất?</a></h3>
                                                <p>Chắc không phải nhắc, ai cũng biết rằng rau củ quả mua ở ngoài về là phải rửa sạch. Kể cả khi mua ở siêu thị hay những cửa hàng hoa quả...</p>
                                                <a href="/blogs/news/rua-rau-cu-qua-bang-dung-dich-gi-la-sach-nhat" class="view" title="Xem thêm">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>



        </div>