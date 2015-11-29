<?php

namespace Acme\Bundle\ExampleBundle\GamificationEvent;

use Symfony\Component\GamificationEventDispatcher\GamificationEvent;

class SitemapGamificationEvent extends GamificationEvent {

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
