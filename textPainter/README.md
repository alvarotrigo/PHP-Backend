README:
=========
![preview](https://github.com/alvarotrigo/PHP-Backend/blob/master/textPainter/textPainter.jpg?raw=true)

textPainter class
-------------------------------------------
This class allows to print text over a given image.
It requires a TrueType font file (.ttf).
 
The resulting image will be show on the same format as the input/background image. 
Supported formats: jpeg, jpg, png, gif, wbmp

Usage
=========
##Adding the class
	require_once 'class.textPainter.php';

##Creating the object
	$img = new textPainter('./imgs/image.jpg', 'Hello world!!', './Franklin.ttf', 50);
	
What I did was:
- I want to write over the "image.jpg" image placed inside the "imgs" folder.
- I want to write "Hello world!!"
- I want to write it with "Franklin.ttf" TrueType font, placed on the current directory.
- I want to write it with a size of 50.
- I saved the object on the $img variable.

##Showing the image
	$img->show();
	
Optinal actions
==============
This class allows us to modify some features such as:

##Text position
By default, the text will be displayed on the middle of the image.
We can change it using this:

	$img->setPosition("center", "top);
	
Where the first parameter is the X position and the second one, the Y.
Available values:
- X position: left, center, right or custom 
- Y position: top, center, bottom or custom

##Text color:
By default, it will be grey.
We can change it with this function:

	$img->setTextColor(13,167,244);
	
It works using RGB values.

##JPEG generated image quality
By default, it quality will be 85.
If we are using a JPEG or JPG format image to write over it, we can determine the quality of the resulting image with this method:

	$img->setQuality(30);
	
This method should only be applied over JPG or JPEG image formats as it won't have any effect on any other format.

##Changing the font file
We could be able to change it after creating the object by doing:

	$img->setFontFile('text.ttl');
	
##Changing the font size
We could be able to change it after creating the object by doing:

	$img->setFontSize(78);