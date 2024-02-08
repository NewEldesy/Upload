<?php
    function db() {
        $connexion = null;
        $host= 'mysql-javacrud.alwaysdata.net';
        $dbname = "javacrud_up";
        $username = 'javacrud';
        $password = 'Javacrud.mysql';

        try {
            $connexion = new PDO("mysql:host=".$host.";dbname=".$dbname, $username, $password);
            $connexion->exec("set names utf8");
        } catch (PDOException $th) {
            echo "Erreur de connection: ". $th->getMessage();
        }
        return $connexion;
    }


?>