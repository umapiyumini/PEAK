<?php

class Noticeboard {
    use Model;

    public $errors;

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

        if (empty($data['title'])) {
            $this->errors['title'] = 'Title is required';
        }

        if (empty($data['content'])) {
            $this->errors['content'] = 'Content is required';
        }

        if (empty($data['publishdate'])) {
            $this->errors['publishdate'] = 'Publish date is required';
        }

        if (empty($data['publishtime'])) {
            $this->errors['publishtime'] = 'Publish time is required';
        }

        return empty($this->errors);
    }

    public function findAll() {
        $query = "SELECT * FROM $this->table";
        return $this->query($query);
    }

    public function find($id) {
        $query = "SELECT * FROM $this->table WHERE noticeid = :noticeid";
        $param = ['noticeid' => $id];
        $result = $this->query($query, $param);
        return $result[0];
    }

    public function findStudentNotices() {
        $query = "SELECT * FROM $this->table WHERE visibility = 'students'";
        return $this->query($query);
    }

    public function addNotice($data) {
        $query = "INSERT INTO $this->table (title, content, publishdate, publishtime, visibility, userid) VALUES (:title, :content, :publishdate, :publishtime, :visibility, :userid)";
        $params = [
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':publishdate' => $data['publishdate'],
            ':publishtime' => $data['publishtime'],
            ':visibility' => $data['visibility'],
            ':userid' => $data['userid']
        ];
        return $this->query($query, $params);
    }

    public function updateNotice($data) {
        $query = "UPDATE $this->table SET title = :title, content = :content, visibility = :visibility WHERE noticeid = :noticeid";
        $params = [
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':visibility' => $data['visibility'],
            ':noticeid' => $data['noticeid']
        ];
        return $this->query($query, $params);
    }

    public function deleteNotice($noticeid) {
        $query = "DELETE FROM $this->table WHERE noticeid = :noticeid";
        $params = [':noticeid' => $noticeid];
        return $this->query($query, $params);
    }
}
?>
