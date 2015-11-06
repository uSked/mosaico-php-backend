# Mosaico PHP Backend

This is a PHP backend for Mosaico

Mosaico can be found at https://github.com/voidlabs/mosaico

First, install Mosaico.  Then install these files on top of the Mosaico installation.  This project contains 3 new folders, 4 new files, and one modified file.  You do need to have Imagemagick support enabled in your PHP configuration.

## New folders and files
```
config.php
```
At the top of this file are a few variables that you can adjust if necessary.

```
/dl/index.php
```
This is the PHP backend that handles downloading of the HTML email and also sending of the test email.

```
/img/index.php
```
This is the PHP backend that handles generating the placeholder images and also the resizing of images.

```
/upload/index.php
```
This is the PHP backend that handles image uploads and retrieving of a list of uploaded images.

## Modified files

```
editor.html
```
This example file has been slightly modified in the following ways:

1) The three URL paths to the backend (/img, /dl, and /upload) has been made into the full URL path instead to make it possible to use this example editor.html file in subdirectories.

2) A trailing slash (/) has been added to /dl and /upload to avoid 301 redirects which Mosaico does not handle well.  The /img backend does not need a trailing slash added because the Mosaico code already adds one when this is used.
