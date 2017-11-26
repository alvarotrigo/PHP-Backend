<?php
/**
 * TextPainter.php
 *
 * This class allows to print text over a given image.
 * It needs from a TrueType font format (ttf).
 *
 * The resulting image will be show in png format.
 *
 * https://github.com/alvarotrigo/PHP-Backend/tree/master/textPainter
 * @license MIT licensed
 *
 * Copyright (C) 2015 alvarotrigo.com - A project by Alvaro Trigo
 */
class textPainter{
    private $img;
    private $textColor;
    private $position = array();
    private $startPosition = array();

    private $imagePath;
    private $text;
    private $fontFile;
    private $fontSize;
    private $format;


    /**
     * Class Constructor
     *
     * @param string $imagePath background image path
     * @param string $text text to print
     * @param string $fontFile the .ttf font file (TrueType)
     * @param integer $fontSize font size
     *
     * @access public
     */
    public function __construct($imagePath, $text, $fontFile, $fontSize){
        $this->imagePath = $imagePath;
        $this->text = $text;
        $this->fontFile = $fontFile;
        $this->fontSize = $fontSize;

        $this->setFormat();
        $this->setQuality();
        $this->createImage();
        $this->setTextColor();
        $this->setPosition();
    }

    /**
     * Sets the text color using the RGB color scale.
     *
     * @param unknown_type $R red quantity
     * @param unknown_type $G gren quantity
     * @param unknown_type $B blue quantity
     *
     * @access public
     */
    public function setTextColor($R=230, $G=240, $B=230){
        $this->textColor = imagecolorallocate ($this->img, $R, $G, $B);
    }

    /**
     * Shows the resulting image (background image + text)
     * @access public
     */
    public function show(){
        //show thumb
        header("Content-type: image/".$this->format);

        imagettftext($this->img, $this->fontSize, 0, $this->startPosition["x"], $this->startPosition["y"], $this->textColor, $this->fontFile, $this->text);

        switch ($this->format){
            case "JPEG":
                imagejpeg($this->img, NULL, $this->jpegQuality);
                break;
            case "PNG":
                imagepng($this->img);
                break;
            case "GIF":
                imagegif($this->img);
                break;
            case "WBMP":
                imagewbmp($this->img);
                break;
            default:
                imagepng($this->img);
        }
    }


    public function setQuality($value=85){
        $this->jpegQuality = $value;
    }

    public function setPosition($x="center", $y="center"){
        $this->position["x"] = $x;
        $this->position["y"] = $y;

        $dimensions = $this->getTextDimensions();

        if($x=="left"){
            $this->startPosition["x"] = 0;
        }
        else if($x=="center"){
            $this->startPosition["x"] = imagesx($this->img)/2 - $dimensions["width"]/2;
        }
        else if($x=="right"){
            $this->startPosition["x"] = imagesx($this->img) - $dimensions["width"];
        }
        //custom
        else{
            $this->startPosition["x"] = $x;
        }

        if($y=="top"){
            $this->startPosition["y"] = 0 + $dimensions["heigh"];
        }
        else if($y=="center"){
            $this->startPosition["y"]  = imagesy($this->img)/2 + $dimensions["heigh"]/2;
        }
        else if($y=="bottom"){
            $this->startPosition["y"]  = imagesy($this->img);
        }
        //custom
        else{
            $this->startPosition["y"] = $y;
        }

    }

    private function setFormat(){
        $pathInfo = pathinfo($this->imagePath);
        $extension = $pathInfo['extension'];
        $this->format = strtoupper($extension);

        if($this->format=="JPG" || $this->format=="JPEG"){
            $this->format="JPEG";
        }
        else if($this->format=="PNG"){
            $this->format="PNG";
        }
        else if ($this->format=="GIF"){
            $this->format="GIF";
        }
        else if ($this->format=="WBMP"){
            $this->format="WBMP";
        }else{
            echo "Not Supported File";
            exit();
        }
    }

    private function createImage(){
        if($this->format=="JPEG"){
            $this->img = imagecreatefromjpeg($this->imagePath);
        }
        else if($this->format=="PNG"){
            $this->img = imagecreatefrompng($this->imagePath);
        }
        else if ($this->format=="GIF"){
            $this->img = imagecreatefromgif($this->imagePath);
        }
        else if ($this->format="WBMP"){
            $this->img = imagecreatefromwbmp($this->imagePath);
        }else{
            echo "Not Supported File";
            exit();
        }
    }

    /**
     * Sets the font file for the text.
     *
     * @param string $fontFile the .ttf font file (TrueType)
     * @access public
     */
    public function setFontFile($fontFile){
        $this->fontFile = $fontFile;
        $this->setPosition($this->position["x"], $this->position["y"]);
    }

    /**
     * Sets the font size for the text.
     *
     * @param integer $fontSize
     * @access public
     */
    public function setFontSize($fontSize){
        $this->fontSize = $fontSize;
        $this->setPosition($this->position["x"], $this->position["y"]);
    }

    /**
     * It returns the dimensions of the text to print with the given
     * size and font.
     *
     * @return array containing the width and height (width,heigh) of the text to print.
     * @access public
     */
    public function getTextDimensions(){
        $dimensions = imagettfbbox($this->fontSize, 0, $this->fontFile, $this->text);

        $minX = min(array($dimensions[0],$dimensions[2],$dimensions[4],$dimensions[6]));
        $maxX = max(array($dimensions[0],$dimensions[2],$dimensions[4],$dimensions[6]));

        $minY = min(array($dimensions[1],$dimensions[3],$dimensions[5],$dimensions[7]));
        $maxY = max(array($dimensions[1],$dimensions[3],$dimensions[5],$dimensions[7]));

        return array(
            'width' => $maxX - $minX,
            'heigh' => $maxY - $minY
        );
    }
}
