<?php
//Begärs via $_POST koll av om födelsedatum finns sparat, beräkna rätt tecken och spara i $_SESSION --
//Uppdatera det sparade horoskopet som finns i $_SESSION - Retur true/false

function zodiac($month, $day) { 

    $zodiac = "";

    if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 20)) {
        $zodiac = "Stenbock";  
    }
    elseif (($month == 1 && $day >= 21) || ($month == 2 && $day <= 18)) {
        $zodiac = "Vattuman";
    }
    elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        $zodiac = "Fisk";
    }
    elseif (($month == 3 && $day >= 21) || ($month == 4 && $day <= 20)) {
        $zodiac = "Vädur";
    }
    elseif (($month == 4 && $day >= 21) || ($month == 5 && $day <= 21)) {
        $zodiac = "Oxe";
    }
    elseif (($month == 5 && $day >= 22) || ($month == 6 && $day <= 21)) {
        $zodiac = "Tvilling";
    }
    elseif (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
        $zodiac = "Kräfta";
    }
    elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 23)) {
        $zodiac = "Lejon";
    }
    elseif (($month == 8 && $day >= 24) || ($month == 9 && $day <= 22)) {
        $zodiac = "Jungfru";
    }
    elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
        $zodiac = "Våg";
    }
    elseif (($month == 10 && $day >= 24) || ($month == 11 && $day <= 22)) {
        $zodiac = "Skorpion";
    }
    elseif (($month == 11 && $day >= 23) || ($month == 12 && $day <= 21)) {
        $zodiac = "Skytt";
    } 
    return $zodiac;
}

try {
    session_start();

    if(isset($_SERVER["REQUEST_METHOD"])) {

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            //key set in the request-body - check if saved in body
            if(isset($_POST["month"]) && isset($_POST["day"])) {

                $yourZodiac = zodiac($_POST["month"], $_POST["day"]);

                $_SESSION["zodiac"] = serialize($yourZodiac);

                echo json_encode(true);
                exit; 

            }  else {
                throw new Exception("No dates is set to body...", 500);
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
            "Status" => $error -> getCode()
        )
    );
}
?>