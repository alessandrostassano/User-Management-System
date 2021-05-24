<?php

use sarassoroberto\usm\service\UserSession;
require "./__autoload.php";

$usersession = new UserSession();
//viva dux
$usersession->logOut();
$usersession->redirect();




?>