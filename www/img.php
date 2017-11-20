<?php
//Send a generated image to the browser
create_image();
exit();

function create_image()
{
    //Let's generate a totally random string using md5
    $md5 = md5(rand(0,999));
    //We don't need a 32 character long string so we trim it down to 5
    $pass = substr($md5, 10, 5);

    //Set the image width and height
    $width = 100;
    $height = 20;

    //Create the image resource
    $image = ImageCreate($width, $height);

    //We are making three colors, white, black and gray
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 0, 0, 0);

    //Make the background black
    ImageFill($image, 0, 0, $white);

    //Add randomly generated string in white to the image
    ImageString($image, 3, 30, 3, $pass, $black);


    //Tell the browser what kind of file is come in
    header("Content-Type: image/png");

    //Output the newly created image in jpeg format
    ImagePng($image);

    //Free up resources
    ImageDestroy($image);
}
?>
