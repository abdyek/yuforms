<?php

namespace Yuforms\WebSite\Core;
use Yuforms\WebSite\Config;

class View {
    public static function redirect($slug) {
        include 'Redirect.php';
    }
    public static function create($slug) {
        $pageConfig = Config::PAGES[$slug];
        $title = $pageConfig['title'];
        $body = 'public/html/'.$pageConfig['name'].'.html';
        $style = $pageConfig['name'];
        $script = $pageConfig['name'];
        include 'Template.php';
    }
}
