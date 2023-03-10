<?php
namespace Ratchet\Server;
use Ratchet\ConnectionInterface;
use React\Socket\ConnectionInterface as ReactConn;

/**
 * {@inheritdoc}
 */
class IoConnection implements ConnectionInterface {
    /**
     * @var \React\Socket\ConnectionInterface
     */
    protected $conn;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $httpBuffer;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $httpHeadersReceived;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $remoteAddress;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $resourceId;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $WebSocket;
    /**
     * @var \React\Socket\ConnectionInterface
     */
    public $httpRequest;

    /**
     * @param \React\Socket\ConnectionInterface $conn
     */
    public function __construct(ReactConn $conn) {
        $this->conn = $conn;
    }

    /**
     * {@inheritdoc}
     */
    public function send($data) {
        $this->conn->write($data);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function close() {
        $this->conn->end();
    }

}
