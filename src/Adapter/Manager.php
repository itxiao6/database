<?php


namespace itxiao6\SwooleDatabase\Adapter;

use Illuminate\Database\Connection;
use itxiao6\SwooleDatabase\PDOConfig;
use itxiao6\SwooleDatabase\Utils\Context;

/**
 * Class Manager
 * @package itxiao6\SwooleDatabase\Adapter
 */
class Manager extends \Illuminate\Database\Capsule\Manager
{
    /**
     * Get a fluent query builder instance.
     *
     * @param  \Closure|\Illuminate\Database\Query\Builder|string  $table
     * @param  string|null  $as
     * @param  string|null  $connection
     * @return QueryBuilder
     */
    public static function table($table, $as = null, $connection = null)
    {
        return static::connection($connection)->table($table, $as);
    }
    /**
     * Get a schema builder instance.
     *
     * @param  string|null  $connection
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function schema($connection = null)
    {
        return static::connection($connection)->getSchemaBuilder();
    }
    /**
     * Get a connection instance from the global manager.
     *
     * @param  string|null  $connection
     * @return \Illuminate\Database\Connection
     */
    public static function connection($name = null)
    {
        if($name === null){
            $name = 'default';
        }
        return ConnectionFactory::getConnection($name);
    }
    /**
     * Dynamically pass methods to the default connection.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return static::connection()->$method(...$parameters);
    }
}