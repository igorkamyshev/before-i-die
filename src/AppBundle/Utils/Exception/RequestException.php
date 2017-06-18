<?php

namespace AppBundle\Utils\Exception;


class RequestException extends \Exception
{
    /**
     * @var integer
     */
    protected $httpCode;
    /**
     * @var array|string
     */
    protected $parameters;
    /**
     * @var string
     */
    protected $curlError;
    /**
     * @var string
     */
    protected $url;

    /**
     * @param $httpCode
     * @param $parameters
     * @param $curlError
     * @param $url
     * @return $this
     */
    public function setPayload($httpCode, $parameters, $curlError, $url) {
        $this->httpCode = $httpCode;
        $this->parameters = $parameters;
        $this->curlError = $curlError;
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return array|string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getCurlError()
    {
        return $this->curlError;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}