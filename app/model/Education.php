<?php
require_once __DIR__ . '/../core/Database.php';

class Education extends Database
{
    public function __construct(){
        Database::getConnection();
    }

    public function getAllAsTable()
    {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM education ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($university_name,$degree,$field_of_study,$start_year,$end_year,$gpa,$year_of_study,$status)
    {
        $conn = Database::getConnection();
        $sqlCreate = "
            INSERT INTO education 
                (university_name,degree,field_of_study,start_year,end_year,gpa,year_of_study,status)
            VALUES (:university_name,:degree,:field_of_study,:start_year,:end_year,gpa,:year_of_study,:status)   
        ";

        $stmt = $conn->prepare($sqlCreate);
        $stmt->bindParam(':university_name',$university_name);
        $stmt->bindParam(':degree',$degree);
        $stmt->bindParam(':field_of_study',$field_of_study);
        $stmt->bindParam(':start_year',$start_year);
        $stmt->bindParam(':end_year',$end_year);
        $stmt->bindParam(':gpa',$gpa);
        $stmt->bindParam(':year_of_study',$year_of_study);
        $stmt->bindParam(':status',$status);
        $stmt->execute();
    }

    public function update($id,$university_name,$degree,$field_of_study,$start_year,$end_year,$gpa,$year_of_study,$status,$updated_at)
    {
        $conn = Database::getConnection();
        $sqlEdit = "
            UPDATE education SET
                              university_name=:university_name,
                              degree=:degree,
                              field_of_study=:field_of_study,
                              start_year=:start_year,
                              end_year=:end_year,
                              gpa=:gpa,
                              year_of_study=:year_of_study,
                              status=:status,
                              updated_at=:updated_at
            WHERE id =:id
        ";
        $stmt = $conn->prepare($sqlEdit);
        $stmt->bindParam(':university_name',$university_name);
        $stmt->bindParam(':degree',$degree);
        $stmt->bindParam(':field_of_study',$field_of_study);
        $stmt->bindParam(':start_year',$start_year);
        $stmt->bindParam(':end_year',$end_year);
        $stmt->bindParam(':gpa',$gpa);
        $stmt->bindParam(':year_of_study',$year_of_study);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':updated_at',$updated_at);
        $stmt->bindParam(':id',$id);
        return $stmt->execute();
    }

    public function delete($id){
        $conn = Database::getConnection();
        $sqlDelete = "DELETE FROM education WHERE  id=:id";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    }
}