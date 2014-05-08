<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\lib;

/**
 * User authentication library
 * @package sys\lib
 */
abstract class auth
{

    const UNIQUE_SALT = 'Yellowcard';

    public static function hashPassword($clearPassword)
    {

        return md5(md5($clearPassword . self::UNIQUE_SALT));
    }
}