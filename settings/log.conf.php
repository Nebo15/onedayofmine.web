<?php
$conf = array(
    'logs' => array(
        'default' => array(
            'file://'.lmb_env_get('LIMB_VAR_DIR').'/logs/error.log',
        ),
        'test_request' => array(
            'file://'.lmb_env_get('LIMB_VAR_DIR').'/logs/test_request.log',
        ),
        'request' => array(
            'CSVFile://'.lmb_env_get('LIMB_VAR_DIR').'/logs/request.log',
        ),
    )
);
