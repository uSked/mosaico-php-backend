# Mosaico PHP Backend

This is a PHP backend for Mosaico

Mosaico can be found at https://github.com/voidlabs/mosaico

First, install and set up Mosaico.  Then install these files on top of the Mosaico installation.

## Dependencies

It is expected that you are running Apache with mod_rewrite support enabled.

You also do need to have Imagemagick support enabled in your PHP configuration.

This project also requires Premailer (http://premailer.dialect.ca/).  Premailer is used to inline the CSS styles.  If that service is ever taken down, we will have to find an alternate solution.  Or, if you have an alternate solution that does not require dependencies on a web service, feel free to contribute!

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
