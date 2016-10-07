# User Mage

User authentication, management and authorization with PHP

##Requirements
- php7
- Imagick
- Yaml

##Install

Installation can be done via composer usage

##Usage
###Configuration
This image processor is configured via yaml configuration file which has to have
following structure as in example:
```
non-profit-logo:
  small:
    size:
      height: 200
      width: 200
    location:
      path: tests/test-data/images/non-profit/logo/small
  large:
    size:
      height: 239
      width: 424
    location:
      path: tests/test-data/images/non-profit/logo/large
users-logo:
  size:
    height: 200
    width: 200
  location:
    path: tests/test-data/images/users/logo
event:
  cover:
    blur-size: 8
    size:
      height: 572
      width: 1440
    location:
      path: tests/test-data/images/event/cover
  small:
    size:
      height: 158
      width: 278
    location:
      path: tests/test-data/images/event/small
```

As it can be seen configuration file contains information about the image sizes and the image location for each specific
 raffleometer image processing requirement.

Which acutally means that a event image needs to be available in a cover format and blured out and also it needs to be 
available as a thumbnail for raffle dashboards and raffle details. And also so it goes with the rest of the images..

### Image preparation
Image preparation class
```
Raffleometer\Image\PrepareImages`
```
Handles image transformations as image resizing and image effects as bluring out images using Imagick extentions.
Besides the transformations it also stores images in the respective locations as per indicated in the config.

### Image reader
Image reader class
```
Raffleometer\Image\PrepareImages
```
In order to avoid manual read out of the image locations we created a small wrapper to read the image paths.
This class needs to know the config file location and also the image name and it will return the image location.

##Misc
Different todos:
- pack the configuration into a different class avoiding duplication
- instead of having a class which handles image transformation and storage it should be two distinct classes
