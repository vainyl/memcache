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

use Vainyl\Connection\AbstractConnection;

/**
 * Class MemcachedConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method \Memcached establish
 */
class MemcachedConnection extends AbstractConnection
{
    private $hosts;

    private $options;

    /**
     * MemcachedConnection constructor.
     *
     * @param string $name
     * @param array  $hosts
     * @param array  $options
     */
    public function __construct(string $name, array $hosts, array $options = [])
    {
        $this->hosts = $hosts;
        $this->options = $options;
        parent::__construct($name);
    }

    /**
     * @inheritDoc
     */
    public function doEstablish()
    {
        $memcached = new \Memcached();
        $memcached->addServers($this->hosts);
        if ([] !== $this->options) {
            $memcached->setOptions($this->options);
        }

        return $memcached;
    }
}