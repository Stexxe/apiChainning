<?php
<<<<<<< HEAD:src/ebredy/apiResponse.php
namespace ebredy;
=======

namespace apiChain;
>>>>>>> 0b43bcd482798a4d35169e6a3037ac9a14961163:inc/apiResponse.php

class apiResponse {
    public $href;
    public $method;
    public $status;
    public $response;

    function __construct($resource, $method, $status, $headers, $body, $return) {
        $this->href = $resource;
        $this->method = $method;
        $this->status = $status;

        $this->response = new HTTPResponse();
        $this->response->setHeaders($headers);
        $this->response->setBody($body);

        $this->processBody($return);
    }

    public function processBody($return) {
        if ($return !== true || is_array($return)) {
            $body = [];

<<<<<<< HEAD:src/ebredy/apiResponse.php
            foreach ($return as $propertyPath => $alias) {
                if ( is_numeric($propertyPath) ) {
                    $propertyPath = $alias;
=======
            foreach ($return as $alias => $propertyPath) {
                if ( is_numeric($alias) ) {
                    $alias = $propertyPath;
>>>>>>> c5fbf5610871e2b01253b15d72ce7ef48b6a40d6:inc/apiResponse.php
                }

                $value = $this->valueFromBody($propertyPath);
                $body = $this->response->assignValueByPath($body, $alias, $value);
            }

            $this->response->setBody( $this->normalizeBody($body) );
        }
    }

    public function valueFromBody($path) {
        $value = $this->response->getValue('body.' . $path);
        return ($value === null ? $this->response->getValueByPath($path) : $value);
    }

    private function normalizeBody($body) {
        ArrayUtils::walkValues($body, function (&$val) {
            if ( is_array($val) && ArrayUtils::allNumericKeys($val) && !ArrayUtils::isSequential($val) ) {
                $val = ArrayUtils::fillMissingNumericKeys($val, null);
                ksort($val);
            }
        });

        return json_decode( json_encode($body) );
    }

    public function getUrl() {
        return $this->href;
    }

    public function asJSON() {
        return json_encode($this->response->body);
    }

    public function valueFromBody($name) {
        return $this->response->getValue('body.' . $name);
    }

    public function retrieveData($property) {
        return $this->response->getValue($property);
    }
}