<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];

    // TODO: search database for places matching $_GET["geo"], store in $places
    
    // Indeed I thought it may be more efficient to have a full-text index accross
    // all three relevant columns.
    $places = CS50::query("SELECT * FROM places
                            WHERE MATCH(postal_code, place_name, admin_name1)
                            AGAINST (?)", $_GET["geo"]);

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>