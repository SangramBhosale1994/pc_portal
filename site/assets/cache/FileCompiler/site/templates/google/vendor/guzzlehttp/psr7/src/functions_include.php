<?php

// Don't redefine the functions if included multiple times.
if (!function_exists('GuzzleHttp\Psr7\str')) {
 require(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/google/vendor/guzzlehttp/psr7/src' . '/functions.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
