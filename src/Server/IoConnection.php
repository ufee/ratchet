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
     * @var string
     */
    protected $remoteAddress;
    /**
     * @var int
     */
    protected $resourceId;
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
        $this->resourceId = (int)$this->conn->stream;

        $uri = $conn->getRemoteAddress();
        $this->remoteAddress = trim(
            parse_url((strpos($uri, '://') === false ? 'tcp://' : '') . $uri, PHP_URL_HOST),
            '[]'
        );
    }

    /**
     * @return React\Socket\ConnectionInterface
     */
    public function getReactConn(): ReactConn {
        return $this->conn;
    }
	
    /**
     * {@inheritdoc}
     */
    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceId(): int {
        return $this->resourceId;
    }

    /**
     * {@inheritdoc}
     */
    public function getRemoteAddress(bool $full = false): string {
        return $full === false ? $this->remoteAddress : $this->conn->getRemoteAddress();
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

    /**
     * Get value of hidden property
	 * @param string $target
     */
	public function __get($target)
	{
		if (property_exists($this, $target)) {
			return $this->{$target};
		}
	}
}
