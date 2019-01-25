<?php

namespace Kuru\DevTest\Controller;

use Kuru\DevTest\Model\User;
use Kuru\DevTest\Model\UserManager;
use Kuru\DevTest\Model\WebsiteManager;

class IndexAction
{

    /**
     * @var WebsiteManager
     */
    private $websiteManager;

    /**
     * @var User
     */
    private $user;

    public function __construct(UserManager $userManager, WebsiteManager $websiteManager)
    {
        $this->websiteManager = $websiteManager;
        if (isset($_SESSION['login'])) {
            $this->user = $userManager->getByLogin($_SESSION['login']);
        }
    }

    protected function getWebsites()
    {
        if($this->user) {
            return $this->websiteManager->getAllByUser($this->user);
        } 
        return [];
    }
    protected function getPageViews(){
        if($this->user) {

            return $this->websiteManager->getPagesByUser($this->user);

        }
        return [];
    }
    protected function getLeastRecent(){
        if($this->user) {

            return $this->websiteManager->getLeastRecent($this->user);

        }
        return [];
    }
    protected function getMostRecent(){
        if($this->user) {

            return $this->websiteManager->getMostRecent($this->user);

        }
        return [];
    }

    public function execute()
    {
        if (isset($_SESSION['login'])) {
            require __DIR__ . '/../view/index.phtml';
        }else{
            require __DIR__ . '/../view/login.phtml';
        }

    }
}