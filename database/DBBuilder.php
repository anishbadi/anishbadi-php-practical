<?php

class DBBuilder
{
    public $pdo;

    private static $instance = null;

    private function __construct()
    {
        require_once ROOT . "/database/DBConnecttion.php";
        $this->pdo = DBConnecttion::getInstance()->pdo;
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
     * Fetch all data from pdo.
     *
     * @param string $sql
     * @return array
     */
    public function select($sql): array
    {
        $sth = $this->pdo->query($sql);
        return $sth->fetchAll();
    }

    /**
     * Fetch row data from pdo.
     *
     * @param string $sql
     * @return array
     */
    public function fetch($sql): array
    {
        $sth = $this->pdo->query($sql);
        $data = $sth->fetch();
        return !empty($data) ? $data : [];
    }

    /**
     * Prepare query for pdo.
     *
     * @param string $sql
     * @param array @param
     * @return object
     */
    public function prepareQuery($sql, $param): object
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);
        return $stmt;
    }

    /**
     * Fetch last insert id from the table.
     *
     * @return int
     */
    public function lastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}
