<?php

$slide  = $d->getImg(1130);
$strHtml ="";
// echo $lang; die;
foreach ($slide as $key => $item_sl) {
    $strActive = $key==0?'active':'';
    $strHtml .='

    <div class="itemSlide">
        <a href="'.$item_sl['link'].'" title="" target="_blank">
            <img class="owl-lazy" data-src="'.URLPATH.'img_data/images/'.$item_sl['picture'].'" alt="'.$item_sl['title_'.$lang].'" />
        </a>
    </div>
    ';
}
?>



<section id="insHomeSlider">
    <div id="insSlider" class="bannerSlider">
        <div class="boxSlideHome">
            <div class="owlStyle notDots sliderWrap">
            <?= $strHtml ?>
            </div>
        </div>
    </div>
</section>