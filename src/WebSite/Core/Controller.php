<?php
namespace Yuforms\WebSite\Core;

use Yuforms\WebSite\Core\View;
use Yuforms\WebSite\Config;
use Yuforms\Api\Core\Endpoint as ApiEndpoint;

class Controller {
    public function __construct($slug) {
        $this->slug = $slug;
        $this->checkAvailable();
        $this->config = Config::PAGES[$slug];
        $this->detectAuthorization();
        $this->go();
    }
    private function checkAvailable() {
        if(!in_array($this->slug, array_keys(Config::PAGES))){
            http_response_code(404);
            echo '404';
            exit();
        }
    }
    private function detectAuthorization() {
        $autho = ApiEnpoint::detectAuthorization();
        $this->who = $autho['who'];
    }
    private function go() {
        if($this->checkAuthorization()) {
            View::create($this->slug);
        } else {
            View::redirect($this->config['authorization'][$this->who]);
        }
    }
    private function checkAuthorization() {
        return ($this->config['authorization'][$this->who]===true);
    }
}
