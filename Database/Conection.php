<?php

namespace Database;

class Conection
{
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conection;

    public function __construct()
    {
        $config = $this->getData();   
        $this->server = $config["conection"]["server"];
        $this->user = $config["conection"]["user"];
        $this->password = $config["conection"]["password"];
        $this->database = $config["conection"]["database"];
        $this->port = $config["conection"]["port"];
        
        $this->conection = mysqli_connect($this->server,$this->user,$this->password,$this->database,$this->port);
        $this->conection->set_charset('utf8');

        if (!$this->conection) {
            echo "error " . mysqli_connect_error();
            die();
        }
        echo "Connected successfully";
    }

    private function getData()
    {
        $configPath = dirname(__FILE__);
        $configFile = file_get_contents($configPath."/config");
        return json_decode($configFile,true);
    }

    public function query($query)
    {
        return $this->conection->query($query);
    }

    public function closeConection($query)
    {
        return $this->conection->close();
    }
}