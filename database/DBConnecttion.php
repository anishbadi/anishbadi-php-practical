<?php

class DBConnecttion
{
    public $pdo;
    private $config;

    private static $instance = null;

    private function __construct()
    {
        $this->config = include "config.php";
        $this->createConnection();
    }

    /**
     * Disable the cloning of this class.
     *
     * @return void
     */
    protected function __clone()
    {
        throw new \Exception("Cannot cloneable a singleton.");
    }

    /**
     * Disable the wakeup of this class.
     *
     * @return void
     */
    public function __wakeup(): void
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * Create or retrieve the instance of our database client.
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
     * Create a DSN string from a configuration.
     *
     * @return string
     */
    private function getDsn(): string
    {
        return "mysql:dbname=" .
            $this->config["dbname"] .
            ";host=" .
            $this->config["host"] .
            ";charset=utf8";
    }

    /**
     * Create a new PDO connection.
     *
     * @return \PDO
     * @throws \Exception
     */
    private function createConnection() : void
    {
        try {
            $dsn = $this->getDsn();
            $user = $this->config["user"];
            $password = $this->config["pass"];
            $this->pdo = new \PDO($dsn, $user, $password);
        } catch (\Exception $e) {
			die($e->getMessage());
        }
    }
}
 
?>