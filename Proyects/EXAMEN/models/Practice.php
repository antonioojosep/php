<?php
class Practice{
    private int $id;
    private int $user_id;
    private string $company_nif;
    private int $teacher_id;
    private DateTime $start;
    private DateTime $end;

    public function __construct(int $id, int $user_id, string $company_nif, int $teacher_id, string $start, string $end) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->company_nif = $company_nif;
        $this->teacher_id = $teacher_id;
        $this->start = new DateTime($start);
        $this->end =  new DateTime($end);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(){
        return UserRepository::getUserById($this->user_id);
    }

    public function getCompany(){
        return CompanyRepository::getCompanyByNif($this->company_nif);
    }
    public function getTeacher(){
        return UserRepository::getUserById($this->teacher_id);
    }

    public function getDateStart(){
        return $this->start;
    }

    public function getDateEnd(){
        return $this->end;
    }
}