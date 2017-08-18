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

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Connection\Factory\ConnectionFactoryInterface;
use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Memcached\MemcachedConnection;

/**
 * Class MemcachedConnectionFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MemcachedConnectionFactory extends AbstractIdentifiable implements ConnectionFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createConnection(string $name, array $configData): ConnectionInterface
    {
        return new MemcachedConnection($name, $configData['hosts'], $configData['options']);
    }
}