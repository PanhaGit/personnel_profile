<?php
require_once __DIR__ . '/../service/SkillsService.php';
include_once __DIR__ . '/../../Helper.php';
class SkillController
{
    private $skillsService;

    public function __construct()
    {
        $this->skillsService = new SkillsService();
    }

    public function listSkills()
    {
        $data = $this->skillsService->getAllSkills();
        // dd($data);
        return $data;
    }

    public function getSkill($id)
    {
        return $this->skillsService->getSkillById($id);
    }

    public function addSkill($skill_name, $level, $skill_level, $category_id, $status)
    {
        return $this->skillsService->createSkill($skill_name, $level, $skill_level, $category_id, $status);
    }

    public function editSkill($skill_name, $level, $skill_level, $category_id, $id, $status)
    {
        return $this->skillsService->updateSkill($skill_name, $level, $skill_level, $category_id, $id, $status);
    }

    public function removeSkill($id)
    {
        return $this->skillsService->deleteSkill($id);
    }
}
?>