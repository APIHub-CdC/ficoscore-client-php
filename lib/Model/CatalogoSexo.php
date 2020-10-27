<?php

namespace FS\MX\Client\Model;
use \FS\MX\Client\ObjectSerializer;

class CatalogoSexo
{
    
    const F = 'F';
    const M = 'M';
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::F,
            self::M,
        ];
    }
}
