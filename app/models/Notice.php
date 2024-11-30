<?php

class Notice{
    use Model;

    protected $table = 'notice';

    protected $allowedColumns = [
        'noticeid',
        'title',
        'content',
        'publishdate',
        'publishtime',
        'userid'
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['title'])){
            $this->errors['title'] = 'Title is required';
        }


        if(empty($data['content'])){
            $this->errors['username'] = 'content is required';
        }

        if(empty($data['password'])){
            $this->errors['password'] = 'Password is required';}

    }
}