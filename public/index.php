<?php

use App\Request;
require __DIR__ . '/../vendor/autoload.php';

echo "hola este es el cambio numero  numero 6 hecho con jenkins";

$request = new Request;
$request->handle($_SERVER);
