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

namespace Vainyl\Memcached\Factory;

use Vainyl\Cache\CacheInterface;
use Vainyl\Cache\Factory\CacheFactoryInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Memcached\MemcachedCache;

/**
 * Class MemcachedCacheFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MemcachedCacheFactory extends AbstractIdentifiable implements CacheFactoryInterface
{
    private $connectionStorage;

    /**
     * MemcachedCacheFactory constructor.
     *
     * @param \ArrayAccess $connectionStorage
     */
    public function __construct(\ArrayAccess $connectionStorage)
    {
        $this->connectionStorage = $connectionStorage;
    }

    /**
     * @inheritDoc
     */
    public function createCache(string $cacheName, string $connectionName, array $options = []): CacheInterface
    {
        return new MemcachedCache($cacheName, $this->connectionStorage[$connectionName]);
    }
}