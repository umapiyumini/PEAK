<?php

class  Inventoryedit {
    use Model;
    protected $table = 'inventoryedit';
    protected $fillable = ['editid','equipmentid','quantity','reason'];
    
    }
