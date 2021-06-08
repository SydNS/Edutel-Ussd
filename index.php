<?php
// Reads the variables sent via POST
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$text = $_POST["text"];
//This is the first menu screen
if ($text == "") {
    $response  = "CON Hello welcome-Edutel, Need help with services we deliver \n";
    $response .= "1. 1-continue the service menu";
}
// Menu for a user who selects '1' from the first menu
// Will be brought-this second menu screen
else if ($text == "1") {
    $response  = "CON EDUTEL  Pick a Services below \n";
    $response .= "1. Education Service\n";
    $response .= "2. Farming Service \n";
    $response .= "3. Medical Service \n";
    $response .= "4. Transport Service \n";
    $response .= "5. Account Setting \n";
}
//Menu for a user who selects '1' from the second menu above
// Will be brought-this third menu screen
else if ($text == "1*1") {
    $response = "CON EDUTEL Youre welcome-Edutel Educational Services \n";
    $response .= "Please 1-confirm \n";
} else if ($text == "1*1*1") {
    $response = "CON EDUTEL Education Services\n";
    $response .= "1-continue \n";
    $response .= "0-cancel";
} else if ($text == "1*1*1*1") {
    $response = "CON EDUTEL Your Education Level\n";
    $response .= "1-choose Primary \n";
    $response .= "2-choose Secondary \n";
    $response .= "3-choose Tertiary \n";
    $response .= "0-cancel";
} else if ($text == "1*1*1*1*1") {
    $response = "CON EDUTEL Education Level for Primary Class\n";
    $response .= "1-choose Primary One\n";
    $response .= "2-choose Primary Two\n";
    $response .= "3-choose Primary Three\n";
    $response .= "4-choose Primary Four\n";
    $response .= "5-choose Primary Five\n";
    $response .= "6-choose Primary Six\n";
    $response .= "7-choose Primary SEven\n";
    $response .= "0-cancel";
} else if ($text == "1*1*1*1*1*1") {
    $response = "CON EDUTEL Education Primary One Level\n";
    $response .= "1-confirm\n";
    $response .= "0-cancel";
} else if ($text == "1*1*1*1*1*1*1") {
    $response = "END EDUTEL Education Primary One Level\n";
    $response .= "You have Joined Class P-1";
    $response .= "0-cancel";
} else if ($text == "1*1*1*0") {
    $response = "END Your Education services application has canceled";
}


//farming Services

//Menu for a user who selects '2' from the second menu above
// Will be brought-this third menu screen
 else if ($text == "1*1*2") {
    $response = "CON EDUTEL Farming Services\n";
    $response .= "1-continue \n";
    $response .= "0-cancel";
} else if ($text == "1*1*2*1") {
    $response = "CON EDUTEL Your Farming Level\n";
    $response .= "1-choose Substancial Farming\n";
    $response .= "2-choose Commercial Farming\n";
    $response .= "3-choose Crop Farming \n";
    $response .= "3-choose Livestock Farming \n";
    $response .= "3-choose Poultry Farming \n";
    $response .= "0-cancel";
} else if ($text == "1*1*2*1*1") {
    $response = "CON EDUTEL Farming Services Join the Subsistence Farming Group\n";
    $response .= "1-Confirm\n";
    $response .= "0-cancel";
}  else if ($text == "1*1*2*1*2") {
    $response = "CON EDUTEL Farming Services Join the Commercial Farming Group\n";
    $response .= "1-Confirm\n";
    $response .= "0-cancel";
} else if ($text == "1*1*2*1*3") {
    $response = "CON EDUTEL Farming Services Join the Crop Farming Farming Group\n";
    $response .= "1-Confirm\n";
    $response .= "0-cancel";
}
else if ($text == "1*1*2*1*4") {
    $response = "CON EDUTEL Farming Services Join the LiveStock Farming Group\n";
    $response .= "1-Confirm\n";
    $response .= "0-cancel";
}
else if ($text == "1*1*2*1*1") {
    $response = "CON EDUTEL Welcomes You to the Subsistence Farming Group\n";
    $response .= "1-Confirm\n";
    $response .= "0-cancel";
}







// else if ($text == "1*1*1*1*1*1") {
//     $response = "CON EDUTEL Education Primary One Level\n";
//     $response .= "1-confirm\n";
//     $response .= "0-cancel";
// } else if ($text == "1*1*1*1*1*1*1") {
//     $response = "END EDUTEL Education Primary One Level\n";
//     $response .= "You have Joined Class P-1";
//     $response .= "0-cancel";
// } else if ($text == "1*1*1*0") {
//     $response = "END Your Education services application has canceled";
// }




//echo response
header('Content-type: text/plain');
echo $response