<?php

function register_my_menu() {
    register_nav_menu('new-menu',__( 'New Menu' ));
    }
    add_action( 'init', 'register_my_menu' );
//Stary plik functions 
?>
