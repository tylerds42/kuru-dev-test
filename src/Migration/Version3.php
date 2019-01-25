<?php

namespace Kuru\DevTest\Migration;

use Kuru\DevTest\Core\Database;
use Kuru\DevTest\Model\PageManager;
use Kuru\DevTest\Model\UserManager;
use Kuru\DevTest\Model\WebsiteManager;

class Version3
{
    /**
     * @var Database|\PDO
     */
    private $database;
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var WebsiteManager
     */
    private $websiteManager;
    /**
     * @var PageManager
     */
    private $pageManager;

    public function __construct(
        Database $database,
        UserManager $userManager,
        WebsiteManager $websiteManager,
        PageManager $pageManager
    ) {
        $this->database = $database;
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
        $this->pageManager = $pageManager;
    }

    public function __invoke()
    {
        $this->addPageLastViewed();
    }

    private function addPageLastViewed()
    {
        $createQuery = <<<SQL
        ALTER TABLE pages ADD last_viewed DATE;
SQL;
        $this->database->exec($createQuery);
    }


}