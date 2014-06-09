<?php

require_once __DIR__ . '/vendor/autoload.php';
use \Michelf\Markdown;
config('dispatch.views', __DIR__ . '/views');

// Get the site file and set the variables used on every page
$site = json_decode(file_get_contents(__DIR__ . '/content/site.json'));
$local = array();

config('dispatch.url', $site->site_url);
$locals['base_url'] = $site->site_url;

$locals['site_name'] = $site->site_name;
$locals['nav'] = array();

foreach ($site->pages as $page) {
    $locals['nav'][] = array('url' => $page->url, 'title' => $page->title);
}

// Routes
on('GET', '/contact', function() use ($locals, $site) {
    if (!array_key_exists('email', $site)) {
        error(404);
    }

    $locals['title'] = 'Contact';
    $locals['current_url'] = '/contact';

    if (flash('email')) {
        $locals['email'] = html(flash('email'));
    }

    if (flash('message')) {
        $locals['message'] = html(flash('message'));
    }

    render('contact', $locals);
});

on('POST', '/contact', function() use ($site) {
    if (!array_key_exists('email', $site)) {
        error(404);
    }

    $to = $site->email;
    $from = params('email');
    $message = params('message');

    $valid = true;

    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        flash('error-email', 'Enter a valid email address');
        $valid = false;
    }

    if (empty($message)) {
        flash('error-message', 'Enter a message');
        $valid = false;
    }

    if ($valid) {
        $headers  = 'From: ' . $from . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        $mail = mail($to, 'Message sent through contact form', $message, $headers);

        if ($mail) {
            flash('success', 'Your message has been sent');
        } else {
            flash('error', 'We could not send the message, please try again later.');
        }
    } else {
        flash('email', $from);
        flash('message', $message);
    }

    redirect($site->site_url . '/contact');
});

on('GET', ':url@*', function ($url) use ($locals, $site) {
    $url = basename($url);
    foreach ($site->pages as $page) {
        if ('/' . $url == $page->url) {
            $locals['title'] = $page->title;
            $locals['current_url'] = $page->url;

            if (isset($page->markdown)) {
                $locals['article'] = Markdown::defaultTransform($page->markdown);
            } else if (isset($page->markdown_file)) {
                $locals['article'] = Markdown::defaultTransform(file_get_contents(__DIR__ . '/content/' . $page->markdown_file));
            }
        }
    }

    if (!array_key_exists('title', $locals)) {
        error(404);
    }

    render('page', $locals);
});

error(404, function() use ($locals) {
    $locals['title'] = 'Page not found';
    render('404', $locals);
});

dispatch();
