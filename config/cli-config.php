<?php

require_once 'app/Database.php';

use App\Database;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet((new Database())->db);