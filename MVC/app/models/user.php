<?php

class user {

    use Model;

    protected $table = 'users';

    protected $allowedColumns = ['name', 'age'];
}