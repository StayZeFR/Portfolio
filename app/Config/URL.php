<?php

namespace Config;

class URL
{
    private static string $protocol = "http://";
    private static string $baseURL = "portfolio.lan/";

    /**
     * Permet de récupérer l'URL de base
     * @param string $host
     * @return string
     */
    public static function getBaseURL(string $host = ""): string
    {
        return self::$protocol . (empty($host) ? "" : ($host . ".")) .  self::$baseURL;
    }

}