<?php

namespace PragmaPHP\Uid;

/**
* PHP Unique ID generator based on ULID (Universally Unique Lexicographically Sortable Identifier)
*/
class Uid {

    /**
    * @param    int     Time in milliseconds (optional). E.g. round(microtime(true) * 1000)
    * @return   string  Unique ID
    */
    public static function generate(int $millis = 0): string {
        if ($millis === 0) {
            $millis = round(microtime(true) * 1000);
        }
        $uid = self::encode($millis);
        if (strlen($uid) < 10) {
            $uid = '0' . $uid;
        }
        $uid = $uid . self::encode(random_int(100000000000, 999999999999)) . self::encode(random_int(100000000000, 999999999999));
        if (strlen($uid) != 26) {
            throw new \Exception('Error in Uid generation.');
        }
        return $uid;
    }

    public static function encode($str) {
        $str = strtoupper(base_convert($str, 10, 32));
        return strtr(
            $str,
            "ABCDEFGHIJKLMNOPQRSTUV",
            "ABCDEFGHJKMNPQRSTVWXYZ");
    }

    public static function decode($str) {
        $str = strtoupper($str);
        return base_convert(
            strtr($str, 
                "ABCDEFGHJKMNPQRSTVWXYZILO",
                "ABCDEFGHIJKLMNOPQRSTUV110"),
            32, 10);
    }

}