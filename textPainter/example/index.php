
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Floating window with tabs</title>

<style>
/*
This defines the workspace where i place the demo.
*/
#container {
    text-align: left;
    background: #FFF;
    width: 865px;
    margin: 20px auto;
    padding: 20px;
    border-left: 1px solid #CCC;
    border-right: 1px solid #CCC;
    -moz-box-shadow: 0px 0px 10px #BBB;
    -webkit-box-shadow: 0px 0px 10px #BBB;
    box-shadow: 0px 0px 10px #BBB;
}
</style>

</head>
<body>


<div id="container">
    <?php
        if(isset($_POST["sending"])){
            if(strlen($_POST["text"]) < 50){
                echo '
                    <img id="imgFinal" src="writingOverImage.php?size=50&text='.$_POST["text"].'" />

                    <img id="imgFinal" src="writingOverImage.php?x=right&y=center&size=30&r=74&g=50&b=170&text='.$_POST["text"].'" />

                    <img id="imgFinal" src="writingOverImage.php?x=left&y=bottom&size=90&text='.$_POST["text"].'" />
                ';
            }
            else{
                echo "The text is too large for my demo!! ";
            }
        }
        else{
            echo '
                <img id="imgFinal" src="writingOverImage.php?size=50&text=Hello world!!" />
            ';

        }
    ?>


    <form name="formulario" action="" method="post" class="contactoFormulario">
        <div class="caja"><input type="text" name="text" />Text you want to write over the image</div>

        <button class="botonFormulario" type="submit" name="Submit" value="Enviar" />Generate image</button>
        <input type="hidden" name="sending" value="yes" />
    </form>
</div>

</body>
</html>