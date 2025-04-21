<?php

class Enhancementucsc{
    use Model;
    protected $errors;
    protected $table = 'enhancementucsc';

    protected $allowedColumns = [
        'ID',
        'Name',
        'IndexNumber',
        'RegistrationNumber',
        'SportName',
        'YearOfAchievement',
        'AchievementLevel'
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['Name'])){
            $this->errors['Name'] = 'Name is required';
        }

        if(empty($data['IndexNumber'])){
            $this->errors['IndexNumber'] = 'IndexNumber is required';
        }

        if(empty($data['RegistrationNumber'])){
            $this->errors['RegistrationNumber'] = 'RegistrationNumber is required';
        }

        if(empty($data['SportName'])){
            $this->errors['SportName'] = 'SportName is required';
        }

        if(empty($data['YearOfAchievement'])){
            $this->errors['YearOfAchievement'] = 'YearOfAchievement is required';
        }

        if(empty($data['AchievementLevel'])){
            $this->errors['AchievementLevel'] = 'AchievementLevel is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

  
}