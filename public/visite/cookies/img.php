
<?php
// HEADLINE TO BROWSER
echo '<pre><h1>PHP Convert a Text-File to a PNG (and reverse)</h1>';

// DEBUG INFOS TO BROWSER
echo '<h2>INPUT (img.txt)</h2><b>TEXT</b><br>';

// MAIN FUNCTION CALL TO WRITE TEXT TO IMAGE
$textInput = text2image( 'img.txt', 'img.png' );

// DEBUG INFOS TO BROWSER
echo $textInput . '<br><b>BINARY</b><br>';
echo implode( ' ', str_split( ascii2hex($textInput), 2) );
echo '<h2>OUTPUT (img.png)</h2>';
echo '<b>IMAGE (1x1 Pixel)</b><br>';
echo '<img border="1" src="img.png">';

// MAIN FUNCTION CALL TO GET TEXT FROM IMAGE
$textOutput = image2text( 'img.png' );

// DEBUG INFOS TO BROWSER
echo '<br><br><b>TEXT</b><br>' . $textOutput;
echo '<br><b>BINARY</b><br>';
echo implode( ' ', str_split( ascii2hex($textOutput), 2) );
echo '<br><br><b>"L o r e m" - Controll Values</b><br>';
echo strtoupper( dechex( ord( 'L' ) ) ) . ' ';
echo strtoupper( dechex( ord( 'o' ) ) ) . ' ';
echo strtoupper( dechex( ord( 'r' ) ) ) . ' ';
echo strtoupper( dechex( ord( 'e' ) ) ) . ' ';
echo strtoupper( dechex( ord( 'm' ) ) );

// HELPER FUNCTIONS
function ascii2hex( $ascii ) {

  // ini var
  $string = '';

  // loop string each digit
  for ($i = 0 ; $i < strlen( $ascii ) ; $i ++ ) {

    // convert ascii value to hex
    $byte = strtoupper( dechex( ord( substr( $ascii, $i, 1 ) ) ) );

    // add hex value two-digits
    $string .= str_repeat( '0', 2 - strlen( $byte ) ) . $byte;

  // end loop
  }

  // give back
  return $string;
}

function hex2ascii( $hex ) {

  // ini var
  $string = '';

  // loop string each two digits
  for ($i = 0 ; $i < strlen( $hex ) ; $i += 2 ) {

    // add each two digits hex2dec and then to ascii
    $string .= chr( hexdec( substr( $hex, $i, 2 ) ) );

  // end loop
  }

  // give back
  return $string;
}

function text2image( $textFilename, $imageFilename ) {

  // READ TEXT FILE TO STRING
  $string = file_get_contents( $textFilename );

  // OPEN PNG-IMAGE FOR WRITING DATA
  $fileHandl = fopen( $imageFilename, 'wb' );

  // WRITE PNG-IMAGE-PART
  fwrite( $fileHandl, hex2bin( '89504e470d0a1a0a0000000d494844520000000100000001010300000025db56ca00000003504c5445000000a77a3dda0000000174524e530040e6d8660000000a4944415408d76360000000020001e221bc330000000049454e44ae426082' ) );

  // WRITE CONVERTET DATA TO IMAGE FILE
  fwrite( $fileHandl, ascii2hex($string) );

  // CLOSE IMAGE FILE AFTER WRITING
  fclose( $fileHandl );

  // give back clear ascii text from file
  return $string;

}

function image2text( $imageFilename ) {

  // get image data (with offset of 95 chars for the PNG-Image Part)
  $binaryData = file_get_contents( 'img.png', FALSE, NULL, 95 );

  // convert data from hex to ascii string
  $text = hex2ascii( $binaryData );

  // give back
  return $text;

}