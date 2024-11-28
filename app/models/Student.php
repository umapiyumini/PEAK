<?php

class Student{
    use Model;

    protected $table = 'student';
    protected $allowedColumns = [
        'registration_number',
        'userid',
        'name',
        'faculty',
        'id_start_date',
        'id_expiry_date',
        'date_of_birth',
        'nic',
        'email',
        'gender', 
        'contact_number',
        'address',
        
    ];
    

}