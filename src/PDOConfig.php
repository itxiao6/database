<?php

namespace itxiao6\SwooleDatabase;
/**
 * 配置实例
 * Class PDOConfig
 * @package itxiao6\SwooleDatabase
 */
class PDOConfig
{
    /**
     * 默认驱动
     */
    const DRIVER_MYSQL = 'mysql';

    /**
     * 驱动
     * @var string
     */
    protected $driver = self::DRIVER_MYSQL;
    /**
     * 主机
     * @var string
     */
    protected $host = '127.0.0.1';

    /**
     * 端口
     * @var int
     */
    protected $port = 3306;

    /**
     * unixSocket
     * @var string
     */
    protected $unixSocket;

    /**
     * 数据库名称
     * @var string
     */
    protected $dbname = '';
    /**
     * 表前缀
     * @var string
     */
    protected $tablePrefix = '';

    /**
     * 编码
     * @var string
     */
    protected $charset = 'utf8mb4';

    /**
     * 账号
     * @var string
     */
    protected $username = 'root';

    /**
     * 密码
     * @var string
     */
    protected $password = 'root';

    /**
     * POD 附带参数
     * @var array
     */
    protected $options = [];
    /**
     * 全局配置数组
     * @var array
     */
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
        if (!(isset(self::$configs[$name]) && self::$configs[$name] instanceof static)) {
            throw new \Exception('not found config');
        }
        return self::$configs[$name];
    }

    /**
     * 获取表前缀
     * @return string
     */
    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    /**
     * 设置表前缀
     * @param string $tablePrefix
     */
    public function setTablePrefix($tablePrefix = '')
    {
        $this->tablePrefix = $tablePrefix;
    }

    /**
     * 获取编码
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }

    /**
     * 获取数据库名称
     * @return string
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }

    /**
     * 获取驱动
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * 获取主机
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * 获取PDO参数
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * 获取密码
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * 获取端口
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * 获取 UnixSocket
     * @return string
     */
    public function getUnixSocket(): string
    {
        return $this->unixSocket;
    }

    /**
     * 获取用户名
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * 是否存在UnixSocket
     * @return bool
     */
    public function hasUnixSocket(): bool
    {
        return isset($this->unixSocket);
    }

    /**
     * 设置编码
     * @param string $charset
     * @return $this
     */
    public function withCharset(string $charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * 设置数据库名称
     * @param string $dbname
     * @return $this
     */
    public function withDbname(string $dbname)
    {
        $this->dbname = $dbname;
        return $this;
    }

    /**
     * 设置驱动
     * @param string $driver
     * @return $this
     */
    public function withDriver(string $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     * 设置主机
     * @param $host
     * @return $this
     */
    public function withHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * 设置PDO链接参数
     * @param array $options
     * @return $this
     */
    public function withOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * 设置密码
     * @param string $password
     * @return $this
     */
    public function withPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * 设置端口
     * @param int $port
     * @return $this
     */
    public function withPort(int $port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * 设置UnixSocket
     * @param string|null $unixSocket
     * @return $this
     */
    public function withUnixSocket(?string $unixSocket)
    {
        $this->unixSocket = $unixSocket;
        return $this;
    }

    /**
     * 设置用户名
     * @param string $username
     * @return $this
     */
    public function withUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * 获取可用的驱动
     * @return string[]
     */
    public static function getAvailableDrivers()
    {
        return [
            self::DRIVER_MYSQL,
        ];
    }

    /**
     * 设置编码
     * @param string $charset
     */
    public function setCharset(string $charset): void
    {
        $this->charset = $charset;
    }

    /**
     * 设置数据库名称
     * @param string $dbname
     */
    public function setDbname(string $dbname): void
    {
        $this->dbname = $dbname;
    }

    /**
     * 设置驱动
     * @param string $driver
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * 设置主机
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * 设置PDO链接参数
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * 设置密码
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * 设置端口
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * 设置unixSocket
     * @param string|null $unixSocket
     */
    public function setUnixSocket(?string $unixSocket): void
    {
        $this->unixSocket = $unixSocket;
    }

    /**
     * 设置用户名
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}