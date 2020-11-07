<?php

namespace itxiao6\SwooleDatabase;

use PDO;
use Swoole\ConnectionPool;
use Swoole\Database\PDOProxy;

/**
 * POD 连接池
 * @method PDO|PDOProxy get()
 * @method void put(PDO|PDOProxy $connection)
 */
class PDOPool extends ConnectionPool
{
    /** @var int */
    protected $size = 64;

    /** @var PDOConfig */
    protected $config;

    /**
     * PDOPool constructor.
     * @param $config
     * @param int $size
     */
    public function __construct(PDOConfig $config, int $size = self::DEFAULT_SIZE)
    {
        $this->config = $config;
        parent::__construct(function () {
            return new PDO(
                "{$this->config->getDriver()}:" .
                (
                $this->config->hasUnixSocket() ?
                    "unix_socket={$this->config->getUnixSocket()};" :
                    "host={$this->config->getHost()};" . "port={$this->config->getPort()};"
                ) .
                "dbname={$this->config->getDbname()};" .
                "charset={$this->config->getCharset()}",
                $this->config->getUsername(),
                $this->config->getPassword(),
                $this->config->getOptions()
            );
        }, $size, PDOProxy::class);
    }
}