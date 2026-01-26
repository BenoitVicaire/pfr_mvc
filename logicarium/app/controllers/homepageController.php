<?php
namespace Application\Controllers\Homepage;

require('../templates/header.php');
require('../templates/footer.php');
require('../templates/homepage.php');

use App\utils\Database\DatabaseConnection;

class Homepage
{
    public function execute()
    {
        require('templates/homepage.php');
    }
}
