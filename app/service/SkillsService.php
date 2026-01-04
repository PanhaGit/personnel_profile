<?php

require_once __DIR__ . '/../model/Skills.php';

class SkillsService
{

    private $skillsModel;
    public function __construct()
    {
        $this->skillsModel = new Skills();
    }

    public function getAllSkills()
    {
        return $this->skillsModel->getAllSkills();
    }

    public function getSkillById($id)
    {
        return $this->skillsModel->getSkillById($id);
    }

    public function createSkill($skill_name, $level, $skill_level, $category_id, $status)
    {
        return $this->skillsModel->createSkill($skill_name, $level, $skill_level, $category_id, $status);
    }

    public function updateSkill($skill_name, $level, $skill_level, $category_id, $id, $status)
    {
        return $this->skillsModel->updateSkill($skill_name, $level, $skill_level, $category_id, $id, $status);
    }

    public function deleteSkill($id)
    {
        return $this->skillsModel->deleteSkill($id);
    }
}
?>