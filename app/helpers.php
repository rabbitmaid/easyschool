<?php

if (!function_exists("first2Words")) {

    /**
     * Return the first 2 letters of the first 2 words of a name
     *
     * @param string $firstname
     * @param string $lastname
     * @return string
     */
    function first2Words(string $firstname, string $lastname): string
    {
        $name = $firstname.' '.$lastname;
        $newName = ucwords($name);
        $arrayOfWords = explode(" ", $newName);

        // If only one name
        if (count($arrayOfWords) > 1) {
            return $arrayOfWords[0][0] . "+" . $arrayOfWords[1][0];
        }

        return $arrayOfWords[0][0];
    }
}
