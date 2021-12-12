<?php
//Begärs via $_GET, kollar om horoskop finns sparat i $_SESSION = retur tecken 
//Om inget finns sparat i $_SESSION = ingen utskrift 


try {
    
    session_start();

    if(isset($_SERVER['REQUEST_METHOD'])) {

        if($_SERVER['REQUEST_METHOD'] === 'GET') {

            if(isset($_SESSION["zodiac"])) {

                echo json_encode(unserialize($_SESSION["zodiac"]));
                exit;

            } else {
                //när datum saknas
                echo json_encode("No date is saved...?");
                exit;
            }
        } else {

            throw new Exception("No valid request...", 404);
        }
    }
} catch(Exception $error) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo json_encode(
        array(
            "Message" => $error -> getMessage(),
            "Status" => $error -> getCode())       
        );
        exit;
}
?>