<?php

namespace APIHub\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\Event\BeforeEvent;
use \GuzzleHttp\Event\HasEmitterInterface;
use \GuzzleHttp\Event\Emitter;
use \GuzzleHttp\Middleware;
use \GuzzleHttp\HandlerStack;
use \GuzzleHttp\Psr7;

use \APIHub\Client\Configuration;
use \APIHub\Client\ApiException;
use \APIHub\Client\ObjectSerializer;
use \APIHub\Client\Interceptor\KeyHandler;


class FicoScoreApiTest extends \PHPUnit_Framework_TestCase
{

    protected $apiInstance;
    protected $signer;

    public function setUp()
    {
        $password = getenv('KEY_PASSWORD');
        $this->signer = new \APIHub\Client\Interceptor\KeyHandler(null, null, $password);
        $events = new \APIHub\Client\Interceptor\MiddlewareEvents($this->signer);
        $handler = \GuzzleHttp\HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));

        $client = new \GuzzleHttp\Client([
            'handler' => $handler
        ]);
        $this->apiInstance = new \APIHub\Client\Api\FicoScoreApi($client);
    }

    public function testFicoScore()
    {
        $x_api_key = "your_api_key";
        $username = "your_username";
        $password = "your_password";

        $request = new \APIHub\Client\Model\Persona();
        $request->setPrimerNombre("XXXXXXXX");
        $request->setSegundoNombre(null);
        $request->setApellidoPaterno("XXXXXXXX");
        $request->setApellidoMaterno("XXXXXXXX");
        $request->setApellidoAdicional(null);
        $request->setFechaNacimiento("YYYY-MM-DD");
        $request->setRfc("XXXXXXXX");
        $request->setCurp(null);

        $domicilio = new \APIHub\Client\Model\Domicilio();
        $domicilio->setDireccion("XXXXXXXX");
        $domicilio->setColonia("XXXXXXXX");
        $domicilio->setCiudad("XXXXXXXX");
        $domicilio->setCodigoPostal("XXXXXXXX");
        $domicilio->setMunicipio("XXXXXXXX");
        $domicilio->setEstado("XX");
        $request->setDomicilio($domicilio);

        try {
            $result = $this->apiInstance->ficoScore($x_api_key, $username, $password, $request);
            $this->signer->close();
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling FicoScoreApi->getFicoByDatosPersonaUsingPOST: ', $e->getMessage(), PHP_EOL;
        }
    }
}
