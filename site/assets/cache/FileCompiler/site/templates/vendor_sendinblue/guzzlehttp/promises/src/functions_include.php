<?php

// Don't redefine the functions if included multiple times.
if (!function_exists('GuzzleHttp\Promise\promise_for')) {
 require(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/vendor_sendinblue/guzzlehttp/promises/src' . '/functions.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
