<?php

namespace AppBundle\Utils;

use AppBundle\Utils\Exception\RequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Requester
{
    public function call($url, $params = [], $headers = [],  $method = Request::METHOD_GET, $username = '', $password = '', $curlOptions = [])
    {
        if (is_array($params)) {
            $params = http_build_query($params);
        }

        $ch = curl_init();

        switch ($method) {
            case Request::METHOD_GET:
                $url .= '?' . $params;
                break;
            case Request::METHOD_POST:
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        foreach ($curlOptions as $option => $value) {
            curl_setopt($ch, $option, $value);
        }

        if ($username && $password) {
            curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_errno($ch);
        curl_close($ch);

        if ($curlError || $code != Response::HTTP_OK) {
            throw (new RequestException('Curl returned error: ' . $error . ', code: ' . $code . ', params: ' . $params))
                ->setPayload($code, $params, $curlError, $url);
        }

        return $response;
    }
}