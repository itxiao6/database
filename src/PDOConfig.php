<?php

namespace itxiao6\SwooleDatabase;
/**
 * 配置实例
 * Class PDOConfig
 * @package itxiao6\SwooleDatabase
 */
class PDOConfig extends \Swoole\Database\PDOConfig
{
    public const DRIVER_MYSQL = 'mysql';

    /** @var string */
    protected $driver = self::DRIVER_MYSQL;

    /** @var string */
    protected $host = '127.0.0.1';

    /** @var int */
    protected $port = 3306;

    /** @var null|string */
    protected $unixSocket;

    /** @var string */
    protected $dbname = 'test';
    /**
     * @var string
     */
    protected $tablePrefix = '';

    /** @var string */
    protected $charset = 'utf8mb4';

    /** @var string */
    protected $username = 'root';

    /** @var string */
    protected $password = 'root';

    /** @var array */
    protected $options = [];
    public static $configs = [];

    /**
     * 设置配置
     * @param string $name
     * @return $this
     */
    public function setConfig($name = 'default')
    {
        self::$configs[$name] = $this;
        return $this;
    }
    /**
     * 获取配置
     * @param string $name
     * @return static
     * @throws \Exception
     */
    public static function getConfig($name = 'default')
    {
        if(!(isset(self::$configs[$name]) && self::$configs[$name] instanceof static)){
            throw new \Exception('not found config');
        }
        return self::$configs[$name];
    }

    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }
    public function setTablePrefix($tablePrefix = '')
    {
        $this->tablePrefix = $tablePrefix;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function getDbname(): string
    {
        return $this->dbname;
    }

    public function getDriver(): string
    {
        return $this->driver;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUnixSocket(): string
    {
        return $this->unixSocket;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function hasUnixSocket(): bool
    {
        return isset($this->unixSocket);
    }

    public function withCharset(string $charset): self
    {
        $this->charset = $charset;
        return $this;
    }

    public function withDbname(string $dbname): self
    {
        $this->dbname = $dbname;
        return $this;
    }

    public function withDriver(string $driver): self
    {
        $this->driver = $driver;
        return $this;
    }

    public function withHost($host): self
    {
        $this->host = $host;
        return $this;
    }

    public function withOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function withPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function withPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    public function withUnixSocket(?string $unixSocket): self
    {
        $this->unixSocket = $unixSocket;
        return $this;
    }

    public function withUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public static function getAvailableDrivers()
    {
        return [
            self::DRIVER_MYSQL,
        ];
    }

    /**
     * @param string $charset
     */
    public function setCharset(string $charset): void
    {
        $this->charset = $charset;
    }

    /**
     * @param string $dbname
     */
    public function setDbname(string $dbname): void
    {
        $this->dbname = $dbname;
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @param string|null $unixSocket
     */
    public function setUnixSocket(?string $unixSocket): void
    {
        $this->unixSocket = $unixSocket;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}