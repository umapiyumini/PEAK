<?php

class Noticeboard{
    use Model;

    protected $table = 'noticeboard';

    protected $allowedColumns = [
        'noticeid',
        'title',
        'content',
        'publishdate',
        'publishtime',
        'visibility',
        'userid'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['title'])){
            $this->errors['title'] = 'Title is required';
        }

        if(empty($data['content'])){
            $this->errors['content'] = 'content is required';
        }

        if(empty($data['publishdate'])){
            $this->errors['publishdate'] = 'publishdate is required';
        }

        if(empty($data['publishtime'])){
            $this->errors['publishtime'] = 'publlishtime is required';
        }

        //var_dump($this->errors);
        return empty($this->errors);
    }

    public function findall(){
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return $result;
    }

    public function find($id){
        $query = "SELECT * FROM $this->table WHERE noticeid = :noticeid";
        $param = [
            'noticeid' => $id
        ];
        $result = $this->query($query,$param);
        return $result[0];
    }

    public function findStudentNotices(){
        $query= "SELECT * FROM $this->table WHERE visibility='students'";
        $result = $this->query($query);
        return $result;

    }
}