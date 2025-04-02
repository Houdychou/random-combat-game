<?php

namespace App\config;

use PDO;

class EntityManager extends Database
{
    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM `" . $this->table . "`";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByHighestSpeciality($name)
    {
        $allowedColumns = ['force', 'sante', 'niveau'];
        if (!in_array($name, $allowedColumns)) {
            throw new \Exception("Invalid speciality name");
        }

        $sql = "SELECT * FROM `" . $this->table . "` ORDER BY `$name` DESC";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateLevel($id, $level)
    {
        $sql = "UPDATE `" . $this->table . "` SET `niveau` = :level WHERE `Id` = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':level', $level);
        $stmt->execute();
    }
}