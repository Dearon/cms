# Introduction

This is a tiny and simple PHP CMS inspired by static site generators like Jekyll. The main reason for building it was to be able to use a contact form and to play around with [Dispatch](https://github.com/noodlehaus/dispatch). Realistically I don't expect anyone to use this, but feel free to open a issue on Github if you encounter a bug or want to see a feature.

# Installation

Use [Composer](https://getcomposer.org/) to install the required libraries.

# Configuration

The content directory holds the content to the site. Here are some tweaks you can make to the site.json file:

* site_url: If your site will be hosted on a subdomain (e.g. www.example.com/cms/) then you can specify this here (in our previous example that would be "http://www.example.com/cms/"). Otherwise you can leave this empty.
* email: If you want to use the contact form you can enter the email address where those emails should go here. If you don't want the contact form you can leave it empty and /contact will trigger a 404.
* pages: The markdown or markdown_file fields are optional. This means that you could add a navigation item to a external website, you'd do this by setting url to (for example) "http://www.example.com" and the title to whatever you want.
