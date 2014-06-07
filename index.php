<?php

require_once __DIR__ . '/vendor/autoload.php';

on('GET', '/contact', function() {
    echo 'Contact';
});

on('GET', ':page@*', function ($page) {
    echo $page;
});

dispatch();
