<?php

namespace Kuru\DevTest\Model;

class Page
{

    public $page_id;
    public $url;
    public $website_id;
    public $last_viewed;
    
    public function __construct()
    {
        $this->website_id = intval($this->website_id);
        $this->page_id = intval($this->page_id);
        $this->last_viewed = $this->last_viewed;
    
    }

    /**
     * @return int
     */
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->website_id;
    }

    public function getLastViewed()
    {
        return $this->last_viewed;
    }
}