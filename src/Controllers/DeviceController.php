<?php

namespace Controllers;

use Exception;
use Gateways\CsvFileGateway;
use JsonException;

/**
 * Class BtcUsdController
 * @package Controllers
 */
class DeviceController
{
    /**
     * HTTP method
     * @var string
     */
    private $_method;

    /**
     * HTTP URI
     * @var string
     */
    private $_uri;

    /**
     * raw HTTP body
     * @var mixed
     */
    private $_body;

    /**
     * CSV file gateway
     * @var CsvFileGateway
     */
    private $_csvFileGateway;

    /**
     * BtcUsdController constructor.
     *
     * @param string $path
     * @param string $method
     * @param string $uri
     * @param string|false $body
     */
    public function __construct(string $path, string $method, string $uri, $body)
    {
        $this->_method = $method;
        $this->_uri = $uri;
        $this->_body = $body;
        $this->_csvFileGateway = new CsvFileGateway($path);
    }

    /**
     * Processes the request
     *
     * @throws Exception
     */
    public function processRequest(): void
    {
        try {
            $matches = array();
            if ($this->_method == "POST" && preg_match("/\/api\/device\/([^.\/]+)\/entry/", $this->_uri, $matches)) {
                $data = $this->addEntry($matches[1], json_decode($this->_body, true, 512, JSON_THROW_ON_ERROR));
                $this->render($data);
            } else {
                header("HTTP/1.1 404 Not Found");
            }
        } catch (JsonException $e) {
            $this->render($this->getErrorResponse($e));
        }
    }

    /**
     * Validates the device Id and the data, and saves them.
     *
     * @param string $deviceId
     * @param array $data
     * @return array
     * @throws Exception
     */
    private function addEntry(string $deviceId, array $data): array
    {
        //TODO clement
        return array("status" => "success",
            "device ID" => $deviceId,
            "data" => $data);
    }

    /**
     * Renders the data as a json
     *
     * @param array $data
     */
    private function render(array $data): void
    {
        header("HTTP/1.1 200 OK");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }

    /**
     * Create an error response object
     *
     * @param Exception $e
     * @return array
     */
    private function getErrorResponse(Exception $e): array
    {
        return array("error" => array(
            "message" => $e->getMessage(),
            "code" => $e->getCode()
        ));
    }
}