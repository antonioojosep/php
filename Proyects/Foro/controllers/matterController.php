<?php
$Responses = MatterRepository::getAllResponseByMatter($_GET['id']);
$matter = MatterRepository::getMatterById($_GET['id']);

require_once("views/matterView.phtml");