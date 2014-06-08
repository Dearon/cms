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
on('GET', '/contact', function() use ($locals, $site) {
    $locals['title'] = 'Contact';

    if (flash('email')) {
        $locals['email'] = html(flash('email'));
    }

    if (flash('message')) {
        $locals['message'] = html(flash('message'));
    }

    render('contact', $locals);
});

on('POST', '/contact', function() use ($site) {
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

    redirect('/contact');
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
