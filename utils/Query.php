<?php

class Query
{
    public $sql;
    public $db;

    private static $instance = null;

    private function __construct()
    {
        require_once ROOT . "/database/DBBuilder.php";
        $this->db = DBBuilder::getInstance();
    }

    /**
     * Create or retrieve the instance of Class.
     *
     * @return object
     */
    public static function getInstance(): object
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    /**
     * Function use for select column in database for select query.
     *
     * @param array $cols
     * @return object
     */
    public function select($cols): object
    {
        $this->sql .= "SELECT " . implode(',',$cols);
        return $this;
    }

    /**
     * Function use for select table in database for select query.
     *
     * @param string $cols
     * @return object
     */
    public function from($table): object
    {
        $this->sql .= PHP_EOL . "FROM " . $table;
        return $this;
    }

    /**
     * Function use for join table in database for select query.
     *
     * @param string $params
     * @return object
     */
    public function leftJoin($params): object
    {
        $this->sql .= PHP_EOL . "LEFT JOIN " . $params;
        return $this;
    }

    /**
     * Function use for where condition in table for select query.
     *
     * @param string $params
     * @return object
     */
    public function where($params): object
    {
        $this->sql .= PHP_EOL . "WHERE " . $params;
        return $this;
    }

    /**
     * Function use for group by in table for select query.
     *
     * @param string $params
     * @return object
     */
    public function groupBy($params): object
    {
        $this->sql .= PHP_EOL . "GROUP BY " . $params;
        return $this;
    }

    /**
     * Fecth all data from table
     *
     * @return array
     */
    public function get(): array
    {
        $data = $this->db->select($this->sql);
        $this->sql = "";
        return $data;
    }

    /**
     * Fetch row data from table
     *
     * @return array
     */
    public function fetch(): array
    {
        $data = $this->db->fetch($this->sql);
        $this->sql = "";
        return $data;
    }

    /**
     * Insert record into table
     *
     * @param string $table
     * @param array $params
     * @return int
     */
    public function insert($table, $params): int
    {
        $fields = array_keys($params);
        $sql =
            "INSERT INTO $table (" .
            implode(",", $fields) .
            ") VALUES (:" .
            implode(",:", $fields) .
            ")";
        $this->db->prepareQuery($sql, $params);
        return $this->db->lastInsertId();
    }

    /**
     * Delete record from table
     *
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function delete($table, $id): bool
    {
        $sql = "DELETE FROM $table WHERE `id`= :id";
        $param = [
            "id" => $id,
        ];
        $this->db->prepareQuery($sql, $param);
        return true;
    }
}

?>
