<?php
require_once __DIR__ . '/../model/ProjectLink.php';

class ProjectLinkService
{
    private $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectLink();
    }

    public function getAllProjectLinks()
    {
        return $this->projectModel->getProjectLinks();
    }

    public function getProjectLinksPagination($page = 1, $perPage = 5)
    {
        return $this->projectModel->getAsTablePagination($page, $perPage);
    }

    public function getProjectLinkById($id)
    {
        return $this->projectModel->getProjectLinks($id);
    }

    public function createProjectLink($source_code_url,$link_type,$icon_class,$status)
    {
        return $this->projectModel->createNewProjectLink($source_code_url,$link_type,$icon_class,$status);
    }

    public function updateProjectLink($id, $source_code_url, $link_type, $icon_class, $status)
    {
        return $this->projectModel->updateProjectLink($source_code_url, $link_type, $icon_class, $status, $id);
    }


    public function deleteProjectLink($id)
    {
        return $this->projectModel->deleteProjectLink($id);
    }
}