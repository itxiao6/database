<?php


namespace itxiao6\SwooleDatabase;


/**
 * 连接池管理(全局)
 * Class PoolManager
 * @package itxiao6\SwooleDatabase
 */
class PoolManager
{
    protected static $pool = [];

    /**
     * 新增连接池
     * @param int $size
     * @param string $name
     * @throws \Exception
     */
    public static function addPool($size = 64, $name = 'default')
    {
        if (isset(self::$pool[$name]) && self::$pool[$name] instanceof PDOPool) {
            throw new \Exception('Pool Exist');
        }
        $config = PDOConfig::getConfig($name);
        self::$pool[$name] = $pool = new PDOPool($config, $size);
    }

    /**
     * 获取连接池
     * @param string $name
     * @return PDOPool
     * @throws \Exception
     */
    public static function getPool($name = 'default')
    {
        if (!(isset(self::$pool[$name]) && self::$pool[$name] instanceof PDOPool)) {
            self::addPool();
        }
        return self::$pool[$name];
    }

    /**
     * 归还当前协程内的所有连接
     * @throws \Exception
     */
    public static function recoveryConnection()
    {
        $lists = \itxiao6\SwooleDatabase\Utils\Context::get(\itxiao6\SwooleDatabase\PoolManager::class . '_connection') === null ? [] : \itxiao6\SwooleDatabase\Utils\Context::get(\itxiao6\SwooleDatabase\PoolManager::class . '_connection');
        foreach ($lists as $item) {
            \itxiao6\SwooleDatabase\PoolManager::getPool($item['name'])->put($item['pdo']);
        }
    }
}