<?php
// Reads the variables sent via POST
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$text = $_POST["text"];
//This is the first menu screen
if ($text == "") {
    $response  = "Hello welcome to Edutel, Need help with services we deliver \n";
    $response .= "1. Enter 1 to continue";
}
// Menu for a user who selects '1' from the first menu
// Will be brought to this second menu screen
else if ($text == "1") {
    $response  = "EDUTEL  Pick a Services below \n";
    $response .= "1. Education Service\n";
    $response .= "2. Farming Service \n";
    $response .= "3. Medical Service \n";
    $response .= "4. Transport Service \n";
}
//Menu for a user who selects '1' from the second menu above
// Will be brought to this third menu screen
else if ($text == "1*1") {
    $response = "EDUTEL Youre welcome to Edutel Educational Services \n";
    $response .= "Please Enter 1 to confirm \n";
}
