<?php

namespace Yuforms\WebSite\Core;
use Yuforms\WebSite\Config;

class View {
    public function __construct($slug) {
        $title = Config::PAGES[$slug]['title'];
        $body = 'public/html/'.Config::PAGES[$slug]['className'].'.html';
        $style = Config::PAGES[$slug]['className'];
        $script = Config::PAGES[$slug]['className'];
        include 'Template.php';
    }
}
