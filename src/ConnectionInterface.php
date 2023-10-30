<?php
namespace Ratchet;

/**
 * The version of Ratchet being used
 * @var string
 */
const VERSION = 'Ratchet/0.5.2';

/**
 * A proxy object representing a connection to the application
 * This acts as a container to store data (in memory) about the connection
 */
interface ConnectionInterface {
    /**
     * Send data to the connection.
     *
     * @param string $data
     * @return \Ratchet\ConnectionInterface
     */
    public function send($data);

    /**
     * Get resource ID.
     *
     * @return int
     */
    public function getResourceId(): int;

    /**
     * Get remote address.
     *
     * @param bool $full Get full address
     * @return string
     */
    public function getRemoteAddress(bool $full = false): string;
	
    /**
     * Get the httprequest of the incoming connection
     * @return string
     */
    public function getHttpRequest();
	
    /**
     * Close the connection
     */
    public function close();
}
