<?php
 $menu = "";
    $nav  = $d->o_fet("select * from #_category where tieu_bieu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
    foreach($nav as $item) {
        $sub=$d->o_fet("select * from #_category where id_loai={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
        if(count($sub)>0) {
            $menusub="";
            foreach ($sub as $key => $item1) {
                $sub1=$d->o_fet("select * from #_category where id_loai={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                if(count($sub1)>0){
                    $menusub2="";
                    foreach ($sub1 as $key1 => $item2) {
                        $menusub2.='<li><a href="'.URLPATH.$item2['alias_'.$lang].'.html" title="'.$item2['ten_'.$lang].'">'.$item2['ten_'.$lang].'</a></li>';
                    }
                    $menusub.='
                        <li  class="nav-item">
                            <a class="nav-link" href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].' <span class="caret"></span></a>
                            <ul>'.$menusub2.'</ul>
                        </li>'; 
                }  else {
                   $menusub.='<li class=""><a class="dropdown-item" href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].'</a></li>'; 
                }
                
            }

            $menu.='<li class="liChild">
                        <a class="" title="'.$item['ten_'.$lang].'" href="'.URLPATH.$item['alias_'.$lang].'.html" data-toggle="dropdown"> <span>'.$item['ten_'.$lang].' </span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="mainChild levlup_2" role="menu">
                            '.$menusub.'
                        </ul>
                    </li>';
        }  else {
            $menu.='<li class="nav-item"><a class="nav-link" href="'.URLPATH.$item['alias_'.$lang].'.html" title="'.$item['ten_'.$lang].'">'.$item['ten_'.$lang].'</a></li>';
        }
        
    }

    echo $menu;

?>
