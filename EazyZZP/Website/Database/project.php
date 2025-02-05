<?php

require "../Database/db.php";

$projectDB = new Project();
class Project
{

    public $pdo;

    public function __construct()
    {

        $this->pdo = new Database();

    }

    // # PROJECTEN QUERIES

    // hier kan je projecten toevoegen
    public function insertProject($projectname, $description, $startdate, $enddate, $status, $total_cost, $account_id)
    {
        return $this->pdo->run(
            "INSERT INTO project (projectname, description, startdate, enddate, status, total_cost, account_id) VALUES (:projectname, :description, :startdate, :enddate, :status, :total_cost, :account_id)",
            ["projectname" => $projectname, "description" => $description, "startdate" => $startdate, "enddate" => $enddate, "status" => $status, "total_cost" => $total_cost, "account_id" => $account_id]
        );
    }

    // hier kan je de projecten zien
    public function getProjects($account_id)
    {
        $stmt = $this->pdo->run("SELECT * FROM project WHERE account_id = :account_id", ["account_id" => $account_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // project verwijderen
    public function deleteProject($id)
    {
        // eerste taken verwijderen en daarna project
        $this->pdo->run("DELETE FROM task WHERE project_id = :id", ["id" => $id]);
        return $this->pdo->run("DELETE FROM project WHERE id = :id", ["id" => $id]);
    }
    // voor projecten weergaven
    public function selectProject($id)
    {
        return $this->pdo->run("SELECT * FROM project WHERE id = :id", ["id" => $id])->fetch();
    }


    // # TAKEN QUERIES:

    // voeg taak toe aan project
    public function insertTask($project_id, $task_name, $rate_per_hour, $description, $status)
    {
        return $this->pdo->run(
            "INSERT INTO task (project_id, task_name, rate_per_hour, description, status) VALUES (:id, :name, :rate, :description, :status)",
            ["id" => $project_id, "name" => $task_name, "rate" => $rate_per_hour, "description" => $description, "status" => $status]
        );
    }

    // taken weergaven*
    public function selectTasks($id)
    {
        return $this->pdo->run("SELECT * FROM task WHERE project_id = :projectID", ["projectID" => $id])->fetchAll();
    }

    // verijwder taken
    public function deleteTask($id)
    {
        return $this->pdo->run("DELETE FROM task WHERE id = :id", ["id" => $id]);
    }
}
?>