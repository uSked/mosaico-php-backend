# Mosaico PHP Backend

This is a PHP backend for Mosaico

Mosaico can be found at https://github.com/voidlabs/mosaico

## Getting started

1. install and set up Mosaico
2. copy `mosaico/dist` to your webserver, e.g. to `myserver/mosaico/dist`
3. copy `mosaico/templates` to youer webserver, e.g. to `myserver/mosaico/templates`
4. copy `index.html`, `editor.html`, `dl`, `img`, `upload` from this project on top of the Mosaico installation e.g. `myserver/mosaico/*`
5. run `php composer.phar install` if you want to use InlineStyle on your server. (See https://getcomposer.org/doc/00-intro.md how to get and use composer.)
    You can do this offline and copy `vendor`to e.g. `myserver/mosaico`; The results of this installation are not checked in to this project.
6. adapt `config.php` according to your needs and copy it to e.g. `myserver/mosaico`
7. goto `{url of your server}/mosaico`


## Dependencies

It is expected that you are running Apache with mod_rewrite support enabled.

You also do need to have Imagemagick support enabled in your PHP configuration.

This project also requires Premailer (http://premailer.dialect.ca/).  Premailer is used to inline the CSS styles.  If that service is ever taken down, we will have to find an alternate solution.  Or, if you have an alternate solution that does not require dependencies on a web service, feel free to contribute!

Alternatively you can use InlineStyle (https://github.com/christiaan/InlineStyle) which runs ony your own server. You need to install it via composer. This is experimental, we will have to investigate if it works well with mosaico.

## New folders and files
```
backend-php/config.php
```
In this file are a few variables that you can adjust if necessary.  Please check this file and make sure all the paths are correct for your Mosaico installation, and that PHP can write files to those paths.  If they are wrong or PHP cannot write files to those paths, your image uploads *will not* work.

```
/backend-php/index.php
```
This is the PHP backend engine that handles the required functions:
* image uploads
* retrieving of a list of uploaded images
* downloading of the HTML email
* sending of the test email
* generating the placeholder images
* the resizing of images

The PHP backend also generates static resized images when downloading the HTML email or sending the test email.

```
/backend-php/premailer.php
```
This premailer.php file came from here: https://gist.github.com/barock19/1591053

## Modified files

```
editor.html
```
This example file has been slightly modified to work with the php backend. You may possibly need to configure this file as well.
