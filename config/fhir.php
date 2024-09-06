<?php

return [

    'outputPath' => public_path('fhir'),
    'classesPath' => app_path('FHIR\Classes'),
    'schemaPath' => public_path('fhir-schemas'),
    'versions' => [
        'R4' =>[
            'name'         => 'R4',
            'url'          => 'https://hl7.org/fhir/R4/fhir-all-xsd.zip',
            'namespace'    => '\\HL7\\FHIR\\R4',
            'testEndpoint' => 'https://hapi.fhir.org/baseR4',
        ]
    ],
    'definition' => [
        'namespace' => 'App\\FHIR',
        'useCache' => true
    ]

];
