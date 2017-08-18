<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Memcached-bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Memcached;

use Vainyl\Cache\CacheInterface;
use Vainyl\Core\AbstractIdentifiable;

/**
 * Class MemcachedCache
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MemcachedCache extends AbstractIdentifiable implements CacheInterface
{
    private $name;

    private $connection;

    /**
     * MemcachedCache constructor.
     *
     * @param string              $name ;
     * @param MemcachedConnection $connection
     */
    public function __construct(string $name, MemcachedConnection $connection)
    {
        $this->name = $name;
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        return $this->connection->establish()->flush();
    }

    /**
     * @inheritDoc
     */
    public function delete($key)
    {
        return $this->connection->establish()->delete($key);
    }

    /**
     * @inheritDoc
     */
    public function deleteMultiple($keys)
    {
        return $this->connection->establish()->deleteMulti($keys);
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        if (false === ($result = $this->connection->establish()->get($key))) {
            return $default;
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getMultiple($keys, $default = null)
    {
        return $this->connection->establish()->getMulti($keys);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return (false !== $this->connection->establish()->get($key));
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->connection->establish()->set($key, $value, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function setMultiple($values, $ttl = null)
    {
        return $this->connection->establish()->setMulti($values, $ttl);
    }
}