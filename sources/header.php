<?php


($com!='') ? $linkcom = "&langcom=".$com : $linkcom ='';
$num_cart = 0;
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        $num_cart = $num_cart + $value['so_luong'];
    }
}
$camket=$d->getImg(1166);
$arrSocialNetwork   = $d->o_fet("select * from #_thongtin where id = 1;");
$hotline =$d->getTemplates(55);
$arrClock =$d->getTemplates(54);
$arrClock =$d->getTemplates(54);
$arrCategory = $d->o_fet("select * from #_category where hien_thi = 1 AND module = 3 order by so_thu_tu asc, id desc");




?>

<section class="insBody">

<div id="insLoadpage" class="preloader">
    <div class="wrapLoading">
        <div class="loader">Loading...</div>
    </div>
</div>

<header id="insHeaderPage" class="headerTemp">
    <div id="headerPage">
        <div class="container">
            <div class="insHeaderWrap">
                <div class="row">
                    <div id="headerLogo" class="col-lg-2 col-md-3 col-sm-12 col-xs-12">
                        <div class="visible-xs visible-sm mbToggle translateY-50">
                            <a href="javascript:void(0)" class="btnMBToggleNav menuHeading">
                                <div class="icon"><span></span></div>
                            </a>
                        </div>

                        <p itemscope itemtype="<?= URLPATH?>">
                            <a itemprop="url" href="<?= URLPATH?>">
                                <img itemprop="logo" src="<?=$logo?>" alt="<?=$ten_cong_ty?>" />
                            </a>
                        </p>

                        <h1 class="hide">
                            Beauty farm
                        </h1>


                        <div class="visible-xs visible-sm mbCart translateY-50">
                            <a href="<?= URLPATH?>gio-hang.html">
                                <div class="icon">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                </div>
                                <span id="cartCountMB" class="numberCart" data-count="0"><?=  $num_cart ?></span>
                            </a>
                        </div>
                    </div>
                    <div id="headerNav" class="col-lg-8 col-md-7 col-sm-12 col-xs-12 navSiteMain">
                        <div class="loginMB visible-xs visible-sm">
                            <div class="wrapLogin clearfix">
                                <div class="icon">
                                    <img src="assets/icon_avatar.png" alt=" ">
                                </div>
                                <div class="user">

                                    <a class="log-only" href="/account/login" title="Đăng nhập">Đăng nhập</a>
                                    <h3>
                                        Thông tin tài khoản
                                    </h3>

                                </div>
                            </div>
                        </div>
                        <ul id="navMenu" class="nav-navbar notStyle clearfix text-center">


                            <li class=" active">
                                <a href="<?= URLPATH ?>" class=" current" title="Trang chủ">
                                    <span>Trang chủ</span>
                                </a>
                            </li>


                            <?php include 'module/menu.php'; ?>


                        </ul>
                        <div class="visible-xs visible-sm closeMenuMB text-center">
                            <a href="javascript:void(0)" class="closeNav viewAll">Đóng</a>
                        </div>
                    </div>
                    <div id="headerUser" class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                        <div class="wrap cleafix text-right">
                            <div class="searchBox itemUse">
                                <a href="javascript:void(0)">
                                    <div class="box">
                                        <div class="icon">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="frmSearch popupLogin">
                                    <form id="searchFRM" method="POST" action="<?= URLPATH ?>search.html">
                                        <i class="glyphicon glyphicon-search"></i>
                                        <input type="hidden" name="type" value="product" />
                                        <input required autocomplete="off" type="text" name="q" id="inputSearchAuto" placeholder="Tìm..." />
                                        <button type="submit" class="insButton btnSearch">
                                    Tìm kiếm
                                </button>
                                    </form>
                                </div>
                            </div>
                            <div class="cartBox itemUse">
                                <a href="<?= URLPATH ?>gio-hang.html">
                                    <div class="groupCart">
                                        <div class="box">
                                            <div class="icon">
                                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                <span id="cartCount" class="numberCart" data-count="0"><?=  $num_cart ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- <div class="miniPopup cartPopup">
                                    <div class="wrap">
                                        <div class="popupHeading">
                                            <h4 class="title">
                                                Giỏ hàng
                                            </h4>
                                        </div>
                                        <div class="popupBody">
                                            <div class="miniCart">

                                                <div class="listCart">
                                                    <p class="emptyData">
                                                        Giỏ hàng của bạn đang trống...
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>