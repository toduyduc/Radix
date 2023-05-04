<?php
function getPrefixLinkService($module=''){
    $prefixArr = [
        'services'=>'dich-vu',
        'pages'=>'trang',
        'portfolios'=>'du-an',
        'blog_categories'=>'danh-mục-blog',
        'blog'=>'blog'
    ];
    if(!empty($prefixArr[$module])){
        return $prefixArr[$module];
    }
    return false;
}