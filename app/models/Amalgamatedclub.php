<?php
class Amalgamatedclub
{
    use Model;
    protected $table = 'amalgamatedclub';
    protected $allowed_columns = [
        'regno',
        'userid',
        'post'
    ];

    public function clubReg($data)
    {
        $query = "INSERT INTO amalgamatedclub (regno, userid, post, year) VALUES (:regno, :userid, :post, :year)";
        $params = [
            ':regno' => $data['regno'],
            ':userid' => $data['userid'],
            ':post' => $data['post'],
            ':year' => $data['year']
        ];
        return $this->query($query, $params);
    }
}
?>