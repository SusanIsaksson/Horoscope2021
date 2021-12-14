<?php

try {
    session_start();

    if(isset($_SERVER["REQUEST_METHOD"])) {

        if($_SERVER["REQUEST_METHOD"] === "DELETE") {

            if(isset($_SESSION["zodiac"])) {
            
                unset($_SESSION["zodiac"]);

                echo json_encode(true);
                exit;

            } else {

                echo json_encode(false);
                exit;
            }
        } else {

            throw new Exception("No valid request...", 404);
        }
    }
     
} catch (Exception $error) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

    echo json_encode(
        array(
            "Message" => $error -> getMessage(),
            "Status" => $error -> getCode()
        )
        );
        exit;
}


?>