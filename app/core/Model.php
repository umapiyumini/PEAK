<?php

trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "userid";

    // Test function
    public function test()
    {
        $query = "SELECT * FROM user";
        $result = $this->query($query);
        show($result);
    }

    // where function (single, cleaned)
    public function where($data, $options = [])
    {
        $conditions = [];
        $params = [];

        foreach ($data as $key => $value) {
            if (preg_match('/(>=|<=|>|<|!=)/', $key, $matches)) {
                $operator = $matches[0];
                $cleanKey = str_replace($operator, '', $key);
                $paramKey = str_replace(['>', '<', '=', ' '], '', $key);
                $conditions[] = "$cleanKey $operator :$paramKey";
            } else {
                $conditions[] = "$key = :$key";
                $paramKey = $key;
            }
            $params[':' . str_replace(['>', '<', '=', ' '], '', $paramKey)] = $value;
        }

        $query = "SELECT * FROM $this->table";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        if (!empty($options['order_by'])) {
            $order_column = $options['order_by'];
            $order_type = $options['order_type'] ?? 'ASC';
            $query .= " ORDER BY $order_column $order_type";
        }

        if (!empty($options['limit'])) {
            $query .= " LIMIT " . (int)$options['limit'];

            if (!empty($options['offset'])) {
                $query .= " OFFSET " . (int)$options['offset'];
            }
        } else {
            $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        }

        return $this->query($query, $params);
    }

    // Find all
    public function findAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

    // First
    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= "$key = :$key AND ";
        }

        foreach ($keys_not as $key) {
            $query .= "$key != :$key AND ";
        }

        $query = rtrim($query, " AND ");
        $query .= " LIMIT $this->limit OFFSET $this->offset";

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        }

        return false;
    }

    // Insert
    public function insert($data)
    {
        if (!empty($this->allowed_columns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";
        return $this->query($query, $data);
    }

    // Update
    public function update($id, $data, $id_column = 'userid')
    {
        if (!empty($this->allowed_columns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowed_columns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= "$key = :$key, ";
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";

        $data[$id_column] = $id;
        $this->query($query, $data);
        return false;
    }

    // Delete
    public function delete($id, $id_column = 'userid')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        $this->query($query, $data);
        return false;
    }

    // Get user ID from session
    public function getUserId()
    {
        if (!isset($_SESSION['userid'])) {
            die("User not logged in");
        }
        return $_SESSION['userid'];
    }

    // Execute any query
    public function executeQuery($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        if ($stm->execute($data)) {
            return true;
        } else {
            echo "SQL Error: " . implode(", ", $stm->errorInfo());
            return false;
        }
    }

    // Get last insert ID
    public function lastInsertId()
    {
        $result = $this->query("SELECT LAST_INSERT_ID()");
        return $result[0]->{"LAST_INSERT_ID()"};
    }
}
