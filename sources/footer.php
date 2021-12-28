<?php
    $arrSupport = $d->getTemplates(53);
    $arrSocialNetwork   = $d->o_fet("select * from #_thongtin where id = 1;");
?>
<!-- 
<footer id="mainFooter">
        <div class="footer-content ">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-5 contact">
                        <h3>Thông tin liên hệ</h3>
                        <p><i class="fas fa-map-marker-alt"></i> <?= $arrSocialNetwork[0]['address']; ?></p>
                        <p><i class="fas fa-phone-volume"></i> <a href="tel:<?= $arrSocialNetwork[0]['hotline']; ?>"><?= $arrSocialNetwork[0]['hotline']; ?> <?= $arrSocialNetwork['map']; ?></a></p>
                        <p><i class="fas fa-envelope"></i> <a href="mail:<?= $arrSocialNetwork[0]["email"]; ?>"><?= $arrSocialNetwork[0]['email']; ?></a></p>
                        <p><i class="fas fa-globe-asia"></i> <a href="<?= URLPATH; ?>"> <?= URLPATH; ?></a></p>
                    </div>
                    <div class="col-md-3 customer">
                        <h3><?= $arrSupport['ten_'.$lang]; ?></h3>
                        <?= $arrSupport['noi_dung_'.$lang]; ?>
                    </div>
                    <div class="col-md-4 checkin">
                        <h3>Hướng dẫn đi đường</h3>
                            <?= $arrSocialNetwork[0]['map']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrighter container">
            <div class="row">
                <div class="col-md-6">
                    <p><?= $copyright ?> - <?=$backlink?></p>
                </div>
                <div class="col-md-6 social">
                    <p>Liên kết mạng xã hội
                        <a href="<?= $arrSocialNetwork[0]['facebook']; ?>"><i class="fab fa-facebook-square"></i></i></a>
                        <a href="<?= $arrSocialNetwork[0]['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                        <a href="mail:<?= $arrSocialNetwork[0]['email']; ?>"><i class="fas fa-at"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
 -->

<footer id="insFooterPage" class="footerTemp">

<section id="footerTop">
    <div class="container">
        <div class="groupNewletter text-center">
            <div class="newletterTitle">
                <h2>
                    Đăng ký nhận bản tin
                </h2>
                <p>
                    Chúng tôi hứa sẽ không gửi những mail với nội dung không quan trọng hoặc spam
                </p>
            </div>
            <div class="newletterForm">
                <div class="customerForm">
                    <form accept-charset='UTF-8' action='/account/contact' class='contact-form' method='post'>
                        <input name='form_type' type='hidden' value='customer'>
                        <input name='utf8' type='hidden' value='✓'>

                        <input type="hidden" id="contact_tags" name="contact[tags]" value="khách hàng tiềm năng, bản tin" />
                        <input name="contact[email]" type="email" placeholder="Đăng ký nhận bản tin..." required="required" class="newsletter-input form-control" aria-label="Nhập email của bạn...">
                        <input type="submit" class="button_mini btn" value="Đăng ký">
                    </form>
                </div>
            </div>
        </div>
        <div class="groupSocial text-center">
            <ul class="ftSocial notStyle">

                <li><a href="/" target="_blank" title="Beauty farm"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>


                <li><a href="/" target="_blank" title="Beauty farm"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>


                <li><a href="/" target="_blank" title="Beauty farm"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>


                <li><a href="/" target="_blank" title="Beauty farm"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>


                <li><a href="/" target="_blank" title="Beauty farm"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

            </ul>
        </div>
    </div>
</section>

<section id="footerMidle">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12 footerCol infoShop">
                <div class="groupFooter">

                    <div class="logoFt">
                        <a href="https://beauty-farm.myharavan.com" title="Beauty farm"><img src="assets/logo_ft.png" alt="Beauty farm" itemprop="logo"></a>
                    </div>

                    <div class="info">
                        Mega Plus là chuyên trang cung cấp các sản phẩm chính hãng với đầy đủ các loại sản phẩm từ thời trang cho đến đồ dùng gia đình, đồ dùng cá nhân, mẹ và bé, nội thất... Với các thương hiệu nổi tiếng được nhập khẩu từ nhiều nước trên thế giới.
                    </div>
                    <div class="address">
                        <ul class="info-address notStyle">
                            <li>
                                <i class="glyphicon glyphicon-map-marker"></i>
                                <span>182, đường Lê Đại Hành, P. 15, Q. 11, Tp. Hồ Chí Minh</span>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-envelope"></i>
                                <span>hi@haravan.com</span>
                            </li>

                            <li>
                                <i class="glyphicon glyphicon-phone-alt"></i>
                                <span>1900.636.099</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 footerCol menuLink">
                <div class="groupFooter">
                    <h4>
                        Thông tin
                    </h4>
                    <div class="menu">
                        <ul class="notStyle linklist">

                            <li>
                                <a href="/search"><span>Tìm kiếm</span></a>
                            </li>

                            <li>
                                <a href="/pages/about-us"><span>Giới thiệu</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12 footerCol menuLink">
                <div class="groupFooter">
                    <h4>
                        Hỗ trợ
                    </h4>
                    <div class="menu">
                        <ul class="notStyle linklist">

                            <li>
                                <a href="/"><span>Trang chủ</span></a>
                            </li>

                            <li>
                                <a href="/collections/all"><span>Sản phẩm</span></a>
                            </li>

                            <li>
                                <a href="/collections/"><span>Rau củ</span></a>
                            </li>

                            <li>
                                <a href="/collections/"><span>Trái cây</span></a>
                            </li>

                            <li>
                                <a href="/blogs/news"><span>Tin tức</span></a>
                            </li>

                            <li>
                                <a href="/pages/lien-he"><span>Liên hệ</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 footerCol images">
                <div class="groupFooter">
                    <h4>
                        Fanpage
                    </h4>
                    <div class="fanpage">
                        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="footerBottom">
    <div class="container">
        <div class="footer-coppyright">
            &copy; Bản quyền thuộc về <a href="http://myinterface.myharavan.com/" target="_blank">Inspired themes</a> | <a target="_blank" href="https://www.haravan.com/?ref=haravan-5">Powered by Haravan</a>.
        </div>
    </div>
</section>
</footer>

<div id="insPopupNewletter" class="newletter-popup engo-popup">
<div class="overlay"></div>
<div class="content">
    <div id="popup-newletter" class="">
        <div class="pa-header">
            <h3 class="">
                Đăng ký nhận tin ngay hôm nay
            </h3>
            <div class="pnewle-message">
                <span>Chúng tôi hứa sẽ không gửi những mail với nội dung không quan trọng hoặc spam</span>
                <p> Bạn là người đầu tiên biết được về </p>
                <ul>
                    <li>Sản phẩm</li>
                    <li>Mã giảm giá</li>
                </ul>
                <p class="title-pnews"> Đăng ký: </p>
            </div>
            <div class="pnewle-form">
                <form accept-charset='UTF-8' action='/account/contact' class='contact-form' method='post'>
                    <input name='form_type' type='hidden' value='customer'>
                    <input name='utf8' type='hidden' value='✓'>

                    <input type="hidden" id="contact_tags" name="contact[tags]" value="khách hàng tiềm năng, bản tin" />
                    <input name="contact[email]" type="email" placeholder="Đăng ký nhận bản tin..." required="required" class="newsletter-input form-control" aria-label="Nhập email của bạn...">
                    <input type="submit" class="button_mini btn" value="Đăng ký">

            </div>

            <div class="social-icons">

                <div class="block_content">
                    <ul class="list-unstyled clearfix">

                        <li class="facebook">
                            <a target="_blank" href="/" title="Beauty farm on Facebook" class="btn-tooltip" data-original-title="Facebook">
                                <i class="fa fa-facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </li>


                        <li class="twitter">
                            <a target="_blank" href="/" title="Beauty farm on Twitter" class="btn-tooltip" data-original-title="Twitter">
                                <i class="fa fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                        </li>




                        <li class="rss">
                            <a target="_blank" href="/" title="Beauty farm on RSS" class="btn-tooltip" data-original-title="RSS">
                                <i class="fa fa-rss"></i>
                                <span>RSS</span>
                            </a>
                        </li>


                        <li class="youtube">
                            <a target="_blank" href="/" title="Beauty farm on Youtube" class="btn-tooltip" data-original-title="Youtube">
                                <i class="fa fa-youtube"></i>
                                <span>Youtube</span>
                            </a>
                        </li>


                        <li class="google-plus">
                            <a target="_blank" href="/" title="Beauty farm on Google Plus" class="btn-tooltip" data-original-title="Google Plus">
                                <i class="fa fa-google-plus"></i>
                                <span>Google Plus</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <a href="javascript:void(0)" class="close_newletter closePopup"></a>
    </div>
</div>
</div>


<div class="pageLoading"></div>
<div class="overlayMenu"></div>
<a href="javascript:;" class="backToTop"><i class="fa fa-angle-double-up"></i></a>
</section>