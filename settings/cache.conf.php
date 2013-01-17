<?php

$conf = array();
$conf['cache_enabled'] = true;
$conf['default_cache_dsn'] = "file:///".lmb_var_dir()."/default";
$conf['session_cache_dsn'] = "file:///".lmb_var_dir()."/sessions";
$conf['db_info_cache_dsn'] = "file:///".lmb_var_dir()."/db_info";
