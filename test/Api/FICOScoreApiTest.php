<?php

namespace FicoscoreV2\Client;

use \FicoscoreV2\Client\Configuration;
use \FicoscoreV2\Client\ApiException;
use \FicoscoreV2\Client\ObjectSerializer;

class FICOScoreApiTest extends \PHPUnit_Framework_TestCase
{

    
    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        
        $this->signer = new \FicoscoreV2\Client\Interceptor\KeyHandler(null, null, $password);     

        $events = new \FicoscoreV2\Client\Interceptor\MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));

        $client = new \GuzzleHttp\Client(['handler' => $handler, 'verify' => false]);
        $config = new \FicoscoreV2\Client\Configuration();
        $config->setHost('the_url');
        
        $this->apiInstance = new \FicoscoreV2\Client\Api\FICOScoreApi($client,$config);
    }
    
    
    
    public function testGetReporte()
    {
        $x_api_key = "your_api_key";
        $username = "your_username";
        $password = "your_password";


        $request = new \FicoscoreV2\Client\Model\Peticion();

        $request->setFolio("XXXXXX");

        $persona = new \FicoscoreV2\Client\Model\Persona();
        $persona->setNombres("XXXXXX");
        $persona->setApellidoPaterno("XXXXXX");
        $persona->setApellidoMaterno("XXXXXX");
        $persona->setFechaNacimiento("DD-MM-YYYY");
        $persona->setRFC("XXXXXX");

        $domicilio = new \FicoscoreV2\Client\Model\Domicilio();
        $domicilio->setDireccion("XXXXXX");
        $domicilio->setColoniaPoblacion("XXXXXX");
        $domicilio->setCiudad("XXXXXX");
        $domicilio->setCP("XXXXXX");
        $domicilio->setDelegacionMunicipio("XXXXXX");
        $domicilio->setEstado("XXXXXX");

        $persona->setDomicilio($domicilio);

        $request->setPersona($persona);



        try {
            $result = $this->apiInstance->getReporte($x_api_key, $username, $password, $request);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->pld: ', $e->getMessage(), PHP_EOL;
        }
    }
}
