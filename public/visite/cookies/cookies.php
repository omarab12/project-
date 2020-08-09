<?php
const CHARS = [
    'A', 'B', 'C', 'D', 'E',
    'F', 'G', 'H', 'I', 'J',
    'K', 'L', 'M', 'N', 'O',
    'P', 'Q', 'R', 'S', 'T',
    'U', 'V', 'W', 'X', 'Y',
    'Z', 'a', 'b', 'c', 'd',
    'e', 'f', 'g', 'h', 'i',
    'j', 'k', 'l', 'm', 'n',
    'o', 'p', 'q', 'r', 's',
    't', 'u', 'v', 'w', 'x',
    'y', 'z', '0', '1', '2',
    '3', '4', '5', '6', '7',
    '8', '9', '+', '/'
];

function charToInt($char) {
    return array_search($char, CHARS);
}

function textToBin($content) {
    $content_len = strlen($content);
    $bin = '';

    // Convert content into binary
    for ($a = 0; $a < $content_len; $a++) {
        $bin .= sprintf("%06d", decbin(charToInt($content[$a])));
    }

    // Fill rest of last chunk with zeros as padding and calculate offset
    $offset = 8 - (strlen($bin) % 8);
    $bin .= str_repeat("0", $offset);

    // Return binary string
    return $bin;
}

function makeImage($textFilePath) {
    //get text data and encode it to binary
    $data = base64_encode(file_get_contents($textFilePath));
    $binaryData = textToBin($data);

    //split binary data into 8 bit chunks
    $chunks = explode(" ", trim(chunk_split($binaryData, 8, " ")));

    // Add extra chunks to make total chuncks divisible by 3 for complete RGB pixels
    while (count($chunks) % 3 != 0) {
        $chunks[] = 0xFF;
    }
    // Calculate dimensions of image
    $dim = ceil(sqrt(count($chunks) / 3));
    $img = imagecreatetruecolor($dim, ceil(count($chunks) / $dim / 3));
    $colors = array();

    // Convert groups of 3 chunks into pixels
    for ($a = 0; $a < count($chunks); $a += 3) {
        array_push($colors, imagecolorallocate($img, bindec($chunks[$a]), bindec($chunks[$a+1]), bindec($chunks[$a+2])));
    }

    // Set color for each pixel
    for ($j = 0; $j < $dim; $j++) {
        for ($i = 0; $i < $dim; $i++) {
            @imagesetpixel($img, $i, $j, $colors[($j*$dim)+$i]);
        }
    }

    // Output image
    imagepng($img, 'output.png');
    imagedestroy($img);

}

makeImage($argv[1]);
