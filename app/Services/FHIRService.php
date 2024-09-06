<?php

namespace App\Services;

use DCarbone\PHPFHIR\Config;

class FHIRService {
    public static function renderFHIRDefinition() {
        $configArray = config('phpFHIR');
        // $configArray = [
        //     'outputPath' => storage_path('fhir'),
        //     'version' => 'R4',
        //     'definition' => [
        //         'namespace' => 'App\\FHIR',
        //         'useCache' => true
        //     ]
        // ];
        // dd($configArray);
        $config = new Config($configArray);

        // dd($config->getVersion('R4'));
        foreach ($config->getVersion('R4') as $versionConfig) {
            dd($versionConfig);
            $versionConfig->getDefinition()->getBuilder()->render();
        }
    }
}