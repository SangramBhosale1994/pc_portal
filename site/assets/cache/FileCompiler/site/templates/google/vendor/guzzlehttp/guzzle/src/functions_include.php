<?php

// Don't redefine the functions if included multiple times.
if (!function_exists('GuzzleHttp\uri_template')) {
 require(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/google/vendor/guzzlehttp/guzzle/src' . '/functions.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
