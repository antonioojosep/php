<?php
// Listar usuarios
$users = UserRepository::getAllUsers();

// LLamar a la vista
require_once("views/listUserView.phtml");