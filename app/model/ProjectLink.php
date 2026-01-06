<?php
require_once __DIR__ . '/../core/Database.php';

class ProjectLink extends Database
{
    public function __construct(){
        Database::getConnection();
    }

    public function getProjectLinks(){
        $conn = Database::getConnection();
        $sql = "SELECT * FROM project_links order by id desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewProjectLink($source_code_url,$link_type,$icon_class,$status)
    {
        $conn =  Database::getConnection();
        $sql = "INSERT INTO project_links (source_code_url, link_type, icon_class, status) "."
                VALUES (:source_code_url, :link_type, :icon_class, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':source_code_url', $source_code_url);
        $stmt->bindParam(':link_type', $link_type);
        $stmt->bindParam(':icon_class', $icon_class);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function updateProjectLink($source_code_url, $link_type, $icon_class, $status, $id){
        $conn = Database::getConnection();
        $sql = "UPDATE project_links 
            SET source_code_url = :source_code_url, link_type = :link_type, icon_class = :icon_class, status = :status 
            WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':source_code_url', $source_code_url);
        $stmt->bindParam(':link_type', $link_type);
        $stmt->bindParam(':icon_class', $icon_class);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }



    public function deleteProjectLink($id){
        $conn =  Database::getConnection();
        $sql = "DELETE FROM project_links WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


//    pagination //model

public function getAsTablePagination($page=1,$perPage =5)
{
    $offset = ($page - 1) * $perPage;
    $conn = Database::getConnection();

    //get pagination rows
    $stmt = $conn->prepare("SELECT * FROM project_links LIMIT $offset,$perPage");
    $stmt->bindValue(':offset', $offset);
    $stmt->bindValue(':perPage', $perPage);
    $stmt->execute();
    $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);

    // get total rows for pagination
    $totalStmt = $conn->query("SELECT COUNT(*) as total FROM project_links");
    $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

    return [
        'data' => $rows,
        'total' => $total,
        'perPage' => $perPage,
        'currentPage' => $page,
        'totalPages' => ceil($total / $perPage)
    ];
}
}