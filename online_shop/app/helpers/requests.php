<?php

class Requests
{
    /**
     * returns post data
     * @return array
     */
    public static function post()
    {
        return self::xss($_POST);
    }

    /**
     * returns get data
     * @return array
     */
    public static function get()
    {
        return self::xss($_GET);
    }

    /**
     * return request data
     * @return array
     */
    public static function request()
    {
        return self::xss($_REQUEST);
    }

    /**
     * Anti-XSS Sanitization
     * Recursively sanitizes incoming data to make it safe for HTML output.
     * @param mixed $data Input data (string or array)
     * @return mixed Sanitized data
     */
    private static function xss($data)
    {
        if (is_array($data)) {
            $sanitized = [];
            foreach ($data as $key => $value) {
                $sanitized[$key] = self::xss($value); // Recursive sanitization
            }
            return $sanitized;
        }

        // Directly sanitize scalar data
        return trim(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
    }

}