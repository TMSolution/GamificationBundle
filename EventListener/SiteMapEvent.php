<?php

namespace Acme\Bundle\ExampleBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class SitemapEvent extends Event {

    private $pages = array();

    public function addPage($path, $modified) {
        $this->pages[] = array(
            'path' => $path,
            'modified' => $modified
        );
    }

    public function getPages() {
        return $this->pages;
    }

}
