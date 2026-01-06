<?php
require_once __DIR__ . '/../service/ProjectLinkService.php';

class ProjectLinkController
{
    private $projectLinkService;

    public function __construct()
    {
        $this->projectLinkService = new ProjectLinkService();
    }

    public function listProjectLinks()
    {
        return $this->projectLinkService->getAllProjectLinks();
    }

    public function viewProjectLink($id)
    {
        return $this->projectLinkService->getProjectLinkById($id);
    }

    public function addProjectLink($source_code_url, $link_type, $icon_class, $status)
    {
        return $this->projectLinkService->createProjectLink($source_code_url, $link_type, $icon_class, $status);
    }

    public function editProjectLink($id, $source_code_url, $link_type, $icon_class, $status)
    {
        return $this->projectLinkService->updateProjectLink($id, $source_code_url, $link_type, $icon_class, $status);
    }

    public function listProjectLinksPagination($page = 1, $perPage = 5)
    {
        return $this->projectLinkService->getProjectLinksPagination($page, $perPage);
    }


    public function removeProjectLink($id)
    {
        return $this->projectLinkService->deleteProjectLink($id);
    }
}