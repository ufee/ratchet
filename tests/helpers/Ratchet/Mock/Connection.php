<?php
namespace Ratchet\Mock;
use Ratchet\ConnectionInterface;

class Connection implements ConnectionInterface {
    public $last = array(
        'send'  => ''
      , 'close' => false
    );

    public $remoteAddress = '127.0.0.1';

    public function getResourceId(): int {
        return $this->getConnection()->getResourceId();
    }

    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    public function getRemoteAddress(bool $full = false): string {
        $remoteAddress = $this->getConnection()->getRemoteAddress();
        if ($full === true) {
            return $remoteAddress;
        }

        return trim(
            parse_url((strpos($remoteAddress, '://') === false ? 'tcp://' : '') . $remoteAddress, PHP_URL_HOST),
            '[]'
        );
    }

    public function send($data) {
        $this->last[__FUNCTION__] = $data;
    }

    public function close() {
        $this->last[__FUNCTION__] = true;
    }
}
