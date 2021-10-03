<?php
//hola
use App\Request;
require __DIR__ . '/../vendor/autoload.php';


$request = new Request;
$request->handle($_SERVER);
