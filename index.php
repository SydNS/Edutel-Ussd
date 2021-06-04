<?php
// Reads the variables sent via POST
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$text = $_POST["text"];
//This is the first menu screen
if ($text == "") {
    $response  = "CON Hello welcome to Edutel, Need help with services we deliver \n";
    $response .= "1. Enter 1 to continue the service menu";
}
// Menu for a user who selects '1' from the first menu
// Will be brought to this second menu screen
else if ($text == "1") {
    $response  = "CON EDUTEL  Pick a Services below \n";
    $response .= "1. Education Service\n";
    $response .= "2. Farming Service \n";
    $response .= "3. Medical Service \n";
    $response .= "4. Transport Service \n";
    $response .= "5. Account Setting \n";
}
//Menu for a user who selects '1' from the second menu above
// Will be brought to this third menu screen
else if ($text == "1*1") {
    $response = "CON EDUTEL Youre welcome to Edutel Educational Services \n";
    $response .= "Please Enter 1 to confirm \n";
} else if ($text == "1*1*1") {
    $response = "CON EDUTEL Education Services\n";
    $response .= "Enter 1 to continue \n";
    $response .= "Enter 0 to cancel";
} else if ($text == "1*1*1*1") {
    $response = "CON EDUTEL Enter Your Education Level\n";
    $response .= "Enter 1 to choose Primary \n";
    $response .= "Enter 2 to choose Secondary \n";
    $response .= "Enter 3 to choose Tertiary \n";
    $response .= "Enter 0 to cancel";
} else if ($text == "1*1*1*1*1") {
    $response = "CON EDUTEL Education Level for Primary enter Class\n";
    $response .= "Enter 1 to choose Primary One\n";
    $response .= "Enter 2 to choose Primary Two\n";
    $response .= "Enter 3 to choose Primary Three\n";
    $response .= "Enter 4 to choose Primary Four\n";
    $response .= "Enter 5 to choose Primary Five\n";
    $response .= "Enter 6 to choose Primary Six\n";
    $response .= "Enter 7 to choose Primary SEven\n";
    $response .= "Enter 0 to cancel";
} else if ($text == "1*1*1*1*1*1") {
    $response = "CON EDUTEL Education Primary One Level\n";
    $response .= "Enter 1 to confirm\n";
    $response .= "Enter 0 to cancel";
} else if ($text == "1*1*1*1*1*1*1") {
    $response = "CON EDUTEL Education Primary One Level\n";
    $response .= "You have Joined Class P-1";
    $response .= "Enter 0 to cancel";
} else if ($text == "1*1*1*0") {
    $response = "CON END Your Education services application has canceled";
}
