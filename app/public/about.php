<?php
session_start();

require("../view/about.phtml");


if (!isset($_SESSION['show_about'])) {
    $_SESSION['show_about'] = false;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['menu'])) {
        if ($_SESSION['show_about'] && $_SESSION['show_about'] == true) {
            $_SESSION['show_about'] = false;
        } else {
            $_SESSION['show_about'] = true;
            showAbout();
        }
    } else {        echo "menu not exist in 'POST'";
    }
} else {
    echo "Form is not sent by POST method";
}

function showAbout()
        {
            foreach ($_SERVER as $key => $value) {
                echo "{$key} = {$value} <br>";
            }
        }