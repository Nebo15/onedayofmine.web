<?php
$conf = array(
    'logs' => array(
        'default' => array(
            'file://'.lmb_var_dir().'/logs/error.log',
        ),
        'test_request' => array(
            'file://'.lmb_var_dir().'/logs/test_request.log',
        ),
        'request' => array(
            'CSVFile://'.lmb_var_dir().'/logs/request.log',
        ),
    )
);
