<?php

require_once __DIR__ . '/../core/Database.php';

class Skills extends Database
{
    public function __construct()
    {
        Database::getConnection();
    }

    public function getAllSkills()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
        SELECT 
            s.id,
            s.skill_name,
            s.category_id,
            s.skill_level,
            s.level,
            s.status,
            c.category_name,
            c.status AS category_status
        FROM skills s
        LEFT JOIN categories c ON s.category_id = c.id
        ORDER BY s.id DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getSkillById($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("
        SELECT 
            s.id AS skill_id,
            s.skill_name,
            s.level,
            s.status,
            s.skill_level,
            s.category_id,
            c.category_name
        FROM skills AS s
        INNER JOIN categories AS c ON s.category_id = c.id
        WHERE s.id = :id
        LIMIT 1
    ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createSkill($skill_name, $level, $skill_level, $category_id, $status)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO skills (skill_name, level,skill_level,category_id,status) VALUES (:skill_name, :level, :skill_level, :category_id,:status)");
        $stmt->bindParam(':skill_name', $skill_name, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        $stmt->bindParam(':skill_level', $skill_level, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateSkill($skill_name, $level, $skill_level, $category_id, $id, $status)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE skills SET skill_name = :skill_name, level = :level, skill_level = :skill_level, category_id = :category_id, status = :status WHERE id = :id");
        $stmt->bindParam(':skill_name', $skill_name, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        $stmt->bindParam(':skill_level', $skill_level, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function deleteSkill($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM skills WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}