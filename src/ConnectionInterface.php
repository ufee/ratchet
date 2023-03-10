<?php
namespace Ratchet;

/**
 * The version of Ratchet being used
 * @var string
 */
const VERSION = 'Ratchet/0.5.1';

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
    function send($data);

    /**
     * Get resource ID.
     *
     * @return int
     */
    function getResourceId(): int;

    /**
     * Get remote address.
     *
     * @param bool $full Get full address
     * @return string
     */
    function getRemoteAddress(bool $full = false): string;

    /**
     * Close the connection
     */
    function close();
}
