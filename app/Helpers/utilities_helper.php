<?php
function activeRoute($name){

    $routes = base_url().''.route_to($name);

    if(current_url() == $routes){
        return  'active';
    }

}
?>
