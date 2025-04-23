<?php

class Notifications {
    use Model;
    protected $table = 'notifications';
    protected $fillable = ['notificationid', 'title', 'content', 'to_user_id', 'from_user_id','time','date','created_at','is_read','expiery_date'];

   
}
