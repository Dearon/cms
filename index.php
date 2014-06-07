<?php

require_once __DIR__ . '/vendor/autoload.php';
use \Michelf\Markdown;
config('dispatch.views', __DIR__ . '/views');

// Get the site file and build the navigation
$site = json_decode(file_get_contents(__DIR__ . '/content/site.json'));
$local = array();
$locals['site_name'] = $site->site_name;
$locals['nav'] = array();

foreach ($site->pages as $page) {
    $locals['nav'][] = array('url' => $page->url, 'title' => $page->title);
}

// Routes
on('GET', '/contact', function() {
    echo 'Contact';
});

on('GET', ':url@*', function ($url) use ($locals, $site) {
    foreach ($site->pages as $page) {
        if ('/' . $url == $page->url) {
            $locals['title'] = $page->title;

            if (isset($page->markdown)) {
                $locals['article'] = Markdown::defaultTransform($page->markdown);
            } else if (isset($page->markdown_file)) {
                $locals['article'] = Markdown::defaultTransform(file_get_contents(__DIR__ . '/content/' . $page->markdown_file));
            }
        }
    }

    render('page', $locals);
});

dispatch();
