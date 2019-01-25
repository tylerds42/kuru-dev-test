<?php

namespace Kuru\DevTest\Model;

use Kuru\DevTest\Core\Database;

class WebsiteManager
{
    /**
     * @var Database|\PDO
     */
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    
    public function getById($websiteId) {
        /** @var \PDOStatement $query */
        $query = $this->database->prepare('SELECT * FROM websites WHERE website_id = :id');
        $query->setFetchMode(\PDO::FETCH_CLASS, Website::class);
        $query->bindParam(':id', $websiteId, \PDO::PARAM_STR);
        $query->execute();
        /** @var Website $website */
        $website = $query->fetch(\PDO::FETCH_CLASS);
        return $website;
    }

    public function getAllByUser(User $user)
    {
        $userId = $user->getUserId();
        /** @var \PDOStatement $query */
        $query = $this->database->prepare('SELECT * FROM websites WHERE user_id = :user');
        $query->bindParam(':user', $userId, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS, Website::class);
    }
    public function getPagesByUser(User $user){
        $userId = $user->getUserId();
        /** @var \PDOStatement $query */
        $query = $this->database->prepare('select count(*) from websites as w inner join pages as p on w.website_id=p.website_id where user_id = :user');
        $query->bindParam(':user', $userId, \PDO::PARAM_INT);
        $query->execute();
        $count=$query->fetchColumn();

        return $count;
    }
    public function getLeastRecent(User $user){

        $userId = $user->getUserId();
        /** @var \PDOStatement $query */
        $query = $this->database->prepare('select p.url,p.last_viewed from websites as w inner join pages as p on w.website_id=p.website_id where user_id = :user ORDER BY p.last_viewed ASC LIMIT 1');
        $query->bindParam(':user', $userId, \PDO::PARAM_INT);
        $query->execute();
        $leastrecent=$query->fetchColumn();

        return $leastrecent;
    }
    public function getMostRecent(User $user){

        $userId = $user->getUserId();
        /** @var \PDOStatement $query */
        $query = $this->database->prepare('select p.url,p.last_viewed from websites as w inner join pages as p on w.website_id=p.website_id where user_id = :user ORDER BY p.last_viewed DESC LIMIT 1');
        $query->bindParam(':user', $userId, \PDO::PARAM_INT);
        $query->execute();
        $mostrecent=$query->fetchColumn();

        return $mostrecent;
    }

    public function create(User $user, $name, $hostname)
    {
        $userId = $user->getUserId();
        /** @var \PDOStatement $statement */
        $statement = $this->database->prepare('INSERT INTO websites (name, hostname, user_id) VALUES (:name, :host, :user)');
        $statement->bindParam(':name', $name, \PDO::PARAM_STR);
        $statement->bindParam(':host', $hostname, \PDO::PARAM_STR);
        $statement->bindParam(':user', $userId, \PDO::PARAM_INT);
        $statement->execute();
        return $this->database->lastInsertId();
    }

}