<?php

namespace Yuforms\WebSite\Core;
use Yuforms\WebSite\Config;

class View {
    public function redirect($slug) {
        include 'Redirect.php';
    }
    public function create($slug) {
        $title = Config::PAGES[$slug]['title'];
        $body = 'public/html/'.Config::PAGES[$slug]['name'].'.html';
        $style = Config::PAGES[$slug]['name'];
        $script = Config::PAGES[$slug]['name'];
        include 'Template.php';
    }
}
