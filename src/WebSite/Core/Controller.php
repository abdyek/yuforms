<?php
namespace Yuforms\WebSite\Core;

use Yuforms\WebSite\Core\View;
use Yuforms\WebSite\Config;

class Controller {
    public function __construct($slug) {
        $keys = array_keys(Config::PAGES);
        if(in_array($slug, $keys)) {
            new View($slug);
        } else {
            http_response_code(404);
            echo '404';
        }
    }
}
