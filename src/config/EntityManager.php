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

    public function joinCombattantAptitude($id)
    {
        $sql = "SELECT c.nom AS 'name', c.sante, c.id, a.nom, a.id AS 'aptitudeId', c1.note, c1.note FROM combattant c INNER JOIN combattant_aptitude c1 ON c.Id = c1.id_combattant INNER JOIN aptitude a ON c1.id_aptitude = a.Id WHERE c.Id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
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

    public function update($id, $data)
    {
        $fields = [];
        $values = [':id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "`$key` = :$key";
            $values[":$key"] = $value;
        }

        $sql = "UPDATE `" . $this->table . "` SET " . implode(', ', $fields) . " WHERE `Id` = :id";
        $stmt = $this->getConnection()->prepare($sql);

        foreach ($values as $param => $val) {
            $stmt->bindValue($param, $val);
        }

        $stmt->execute();
    }
}