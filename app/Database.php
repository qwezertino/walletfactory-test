<?php

namespace App;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
class Database
{
    /*TODO: refactor this!*/
    public $db;

    public function __construct()
    {

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(['src'], $isDevMode);

        $connection = include 'config/database.php';
        $this->db = EntityManager::create($connection, $config);
    }
}