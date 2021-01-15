<?php

namespace Yuforms\WebSite\Core;
use Yuforms\WebSite\Config;

class View {
    public function __construct($slug) {
        $this->slug = $slug;
        $this->beforeCreate();
        $this->createPage();
        $this->afterCreate();
    }
    private function createPage() {
        $path = 'public/'.$this->slug.'.php';
        include $path;
    }
    protected function beforeCreate() {}
    protected function afterCreate() {}
}
