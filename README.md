# Trigger Netlify Build - WordPress Plugin

This plugin allows you to trigger a Netlify build with the click of a button within the WordPress Dashboard.

## Setup

1. Follow the Netlify instructions to create a "Build hook" for your Netlify site: https://docs.netlify.com/configure-builds/build-hooks/
1. Copy the URL value
1. Open up your site's `wp-config.php` file
1. Create a new constant called `NETLIFY_BUILD`

`define('NETLIFY_BUILD', 'https://api.netlify.com/build_hooks/xxxxxxxxx');`
