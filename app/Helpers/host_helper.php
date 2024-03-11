<?php

/**
 * Récuperer le nom de domaine
 * @return string
 */
function getHost(): string
{
    $host = $_SERVER["HTTP_HOST"];
    $names = explode(".", $host);
    return sizeof($names) == 2 ? "" : $names[0];
}
