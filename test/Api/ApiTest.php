<?php

namespace FS\MX\Client;

use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack as handlerStack;

use Signer\Manager\ApiException;
use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;

use \FS\MX\Client\Configuration;
use \FS\MX\Client\ObjectSerializer;
use \FS\MX\Client\Api\FSApi as Instance;
use \FS\MX\Client\Model\Peticion;
use \FS\MX\Client\Model\Persona;
use \FS\MX\Client\Model\Domicilio;
use \FS\MX\Client\Model\CatalogoEstados;

class ApiTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        $config = new Configuration();
        $config->setHost('the_url');
        $password = getenv('KEY_PASSWORD');
        $this->signer = new KeyHandler(null, null, $password);
        $events = new MiddlewareEvents($this->signer);
        $handler = HandlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));
        $handler->push($events->verify_signature_header('x-signature'));
        $client = new Client(['handler' => $handler]);
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your_api_key";
        $this->username = "your_username";
        $this->password = "your_password";
    }  
    
    public function testGetReporte() {

        $request = new Peticion();
        $persona = new Persona();
        $domicilio = new Domicilio();
        $estado = new CatalogoEstados();

        $request->setFolio("00000001");

        $persona->setNombres("JUAN");
        $persona->setApellidoPaterno("PRUEBA");
        $persona->setApellidoMaterno("SIETE");
        $persona->setFechaNacimiento("1980-01-07");
        $persona->setRFC("PUAC800107");

        $domicilio->setDireccion("INSURGENTES SUR 1001");
        $domicilio->setColoniaPoblacion("INSURGENTES SUR");
        $domicilio->setCiudad("CIUDAD DE MEXICO");        
        $domicilio->setDelegacionMunicipio("CIUDAD DE MEXICO");
        $domicilio->setEstado($estado::DF);
        $domicilio->setCP("11230");

        $persona->setDomicilio($domicilio);

        $request->setPersona($persona);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $this->username, $this->password, $request);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling ApiTest->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
}
