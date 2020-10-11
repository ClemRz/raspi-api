<?php


namespace Gateways;


class CsvFileGateway
{

    /**
     * Path to the CSV file
     * @var string
     */
    private $_path;

    /**
     * CsvFileGateway constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->_path = $path;
    }

}