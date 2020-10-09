<?php


namespace itxiao6\SwooleDatabase\Adapter;

use Illuminate\Database\Connection;
use InvalidArgumentException;


use Illuminate\Database\Connectors\MySqlConnector;
use Illuminate\Database\Connectors\PostgresConnector;
use Illuminate\Database\Connectors\SQLiteConnector;
use Illuminate\Database\Connectors\SqlServerConnector;
use itxiao6\SwooleDatabase\Adapter\Connectors\MySqlConnection;
use itxiao6\SwooleDatabase\Adapter\Connectors\PostgresConnection;
use itxiao6\SwooleDatabase\Adapter\Connectors\SQLiteConnection;
use itxiao6\SwooleDatabase\Adapter\Connectors\SqlServerConnection;
use itxiao6\SwooleDatabase\PDOConfig;
use itxiao6\SwooleDatabase\PoolManager;
use itxiao6\SwooleDatabase\Utils\Context;

/**
 * 链接工厂类
 * Class ConnectionFactory
 * @package itxiao6\SwooleDatabase\Adapter
 */
class ConnectionFactory
{
    /**
     * 获取连接
     * @param string $name
     * @return mixed|null
     */
    public static function getConnection($name='default')
    {
        $conifg = PDOConfig::getConfig($name);
        if(!(($connection = Context::get(Connection::class.$name.$conifg->getDriver())) instanceof \Illuminate\Database\Connection)){
            $pool = PoolManager::getPool($name);
            $pdo = $pool->get();
            $lists = Context::get(PoolManager::class.'_connection')===null?[]:Context::get(PoolManager::class.'_connection');
            $lists[] = [
                'name'=>$name,
                'pdo'=>$pdo
            ];
            Context::put(PoolManager::class.'_connection',$lists);
            $connection = self::createConnection($pdo,$conifg);
            Context::put(Connection::class.$name.$conifg->getDriver(),$connection);
        }
        return $connection;
    }
    /**
     * @param $pod
     * @param PDOConfig $config
     * @return MySqlConnection|PostgresConnection|SQLiteConnection|SqlServerConnection
     */
    public static function createConnection($pod, PDOConfig $config)
    {
        if (!in_array($config->getDriver(), ['mysql', 'pgsql', 'sqlite', 'sqlsrv'])) {
            throw new InvalidArgumentException('A driver must be specified.');
        }

        switch ($config->getDriver()) {
            case 'mysql':
                return new MySqlConnection($pod, $config->getDbname(), $config->getTablePrefix(), []);
            case 'pgsql':
                return new PostgresConnection($pod, $config->getDbname(), $config->getTablePrefix(), []);
            case 'sqlite':
                return new SQLiteConnection($pod, $config->getDbname(), $config->getTablePrefix(), []);
            case 'sqlsrv':
                return new SqlServerConnection($pod, $config->getDbname(), $config->getTablePrefix(), []);
        }

        throw new InvalidArgumentException("Unsupported driver [{$config['driver']}].");
    }
}