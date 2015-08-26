<?php

namespace TMSolution\GamificationBundle\Soap;

class SoapClientNG extends \SoapClient{


    public function __doRequest($request, $location, $action, $version = SOAP_1_1, $one_way = NULL){


        $xml = explode("\r\n", parent::__doRequest($request, $location, $action, $version, $one_way = NULL));

        dump($xml);
        $response = preg_replace( '/^(\x00\x00\xFE\xFF|\xFF\xFE\x00\x00|\xFE\xFF|\xFF\xFE|\xEF\xBB\xBF)/', "", $xml[5] );


        return $response;


    }


}