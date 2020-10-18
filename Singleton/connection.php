<?php

class Credentials
{
    /**
     * @var string
     */
    private $hostName;
    /**
     * @var int
     */
    private $port;
    /**
     * @var string
     */
    private $charset;
    /**
     * @var string
     */
    private $database;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    public function __construct()
    {
        $this->hostName = 'localhost';
        $this->port = 3306;
        $this->charset = 'utf8';
        $this->database = 'database';
        $this->username = 'user';
        $this->password = 'pass';
    }

    public function getHostName(): string
    {
        return $this->hostName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }
}

class PDOConnection
{
    /**
     * @var \PDOConnection
     */
    private static $instance = null;

    /**
     * @var \PDO
     */
    private $connection;

    private function __construct(Credentials $credentials)
    {
        $this->connection = $this->createConnection(
            $credentials->getHostName(),
            $credentials->getPort(),
            $credentials->getDatabase(),
            $credentials->getCharset(),
            $credentials->getUsername(),
            $credentials->getPassword()
        );
    }

    public static function getInstance(Credentials $credentials): PDOConnection
    {
        if (!self::$instance) {
            self::$instance = new PDOConnection($credentials);
        }

        return self::$instance;
    }

    /**
     * @return \PDO|null
     */
    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    public function closeConnection(): void
    {
        $this->connection = null;
    }

    private function createConnection(string $hostName, int $port, string $database,
                                      string $charset, string $username, string $password): PDO
    {
        $dataSourceName = "mysql:host=$hostName;port=$port;dbname=$database;charset=$charset";

        try {
            return new PDO($dataSourceName, $username, $password);
        } catch (PDOException $exception) {
            die("Error with the database connection");
        }
    }
}

$credentials = new Credentials();
$instance = PDOConnection::getInstance($credentials);

var_dump($instance->getConnection());

$instance->closeConnection();

var_dump($instance->getConnection());

/*
The output:

designpatternsphp\Singleton\connection.php:133:
object(PDO)[3]

designpatternsphp\Singleton\connection.php:147:null
*/