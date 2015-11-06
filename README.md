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
This example file has been slightly modified.

1) The leading slashes in the three paths to the back end (/dl, /img, and /upload) has been removed so that Mosaico can be used in subfolders and not have to be at the root

2) trailing slashes have been added to /dl and /upload to avoid 301 redirects which Mosaico does not handle well.  The /img backend path here does not need a trailing slash added because the Mosaico code already adds one when this is used.
