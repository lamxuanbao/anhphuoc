<?php

use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

if (!function_exists('response_api')) {
    function response_api($data = '', $code = Response::HTTP_OK, $message = null)
    {
        $responseApi = app(\Kizi\Core\Services\Provider\ResponseService::class);
        return $responseApi->send($data, $code, $message);
    }
}
if (! function_exists('bcrypt')) {
    /**
     * Hash the given value against the bcrypt algorithm.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->driver('bcrypt')->make($value, $options);
    }
}
if (!function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        if (is_array($key)) {
            return app('request')->only($key);
        }

        $value = app('request')->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('array_group_by')) {
    function array_group_by(array $arr, $key): array
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error('array_group_by(): The key should be a string, an integer, a float, or a function',
                E_USER_ERROR);
        }
        $isFunction = !is_string($key) && is_callable($key);
        $grouped    = [];
        foreach ($arr as $value) {
            $groupKey = null;
            if ($isFunction) {
                $groupKey = $key($value);
            } else {
                if (is_object($value)) {
                    $groupKey = $value->{$key};
                } else {
                    $groupKey = $value[$key];
                }
            }
            $grouped[$groupKey][] = $value;
        }
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $groupKey => $value) {
                $params             = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$groupKey] = call_user_func_array('array_group_by', $params);
            }
        }
        return $grouped;
    }
}

if (!function_exists('array_reset_index')) {
    function array_reset_index($array)
    {
        $array = $array instanceof Collection
            ? $array->toArray()
            : $array;

        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $array[$key] = array_reset_index($val);
            }
        }

        if (isset($key) && is_numeric($key)) {
            return array_values($array);
        }

        return $array;
    }
}

if (!function_exists('is_json')) {
    function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
if (!function_exists('slugify')) {
    /**
     * Generate a URL friendly "slug" from a given string
     *
     * @param  string  $value
     */
    function slugify($str, $options = [])
    {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str      = convert_vi_to_en($str);
        $str      = mb_convert_encoding(
            (string)$str,
            'UTF-8',
            mb_list_encodings()
        );
        $defaults = [
            'delimiter'     => '-',
            'limit'         => null,
            'lowercase'     => true,
            'replacements'  => [],
            'transliterate' => false,
        ];

        // Merge options
        $options = array_merge(
            $defaults,
            $options
        );

        $char_map = [
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'A',
            '??' => 'AE',
            '??' => 'C',
            '??' => 'E',
            '??' => 'E',
            '??' => 'E',
            '??' => 'E',
            '??' => 'I',
            '??' => 'I',
            '??' => 'I',
            '??' => 'I',
            '??' => 'D',
            '??' => 'N',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'O',
            '??' => 'U',
            '??' => 'U',
            '??' => 'U',
            '??' => 'U',
            '??' => 'U',
            '??' => 'Y',
            '??' => 'TH',
            '??' => 'ss',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'a',
            '??' => 'ae',
            '??' => 'c',
            '??' => 'e',
            '??' => 'e',
            '??' => 'e',
            '??' => 'e',
            '??' => 'i',
            '??' => 'i',
            '??' => 'i',
            '??' => 'i',
            '??' => 'd',
            '??' => 'n',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'u',
            '??' => 'u',
            '??' => 'u',
            '??' => 'u',
            '??' => 'u',
            '??' => 'y',
            '??' => 'th',
            '??' => 'y',
            '???' => 'a',
            '???' => 'a',
            '??' => 'd',

            // Latin symbols
            '??' => '(c)',

            // Greek
            '??' => 'A',
            '??' => 'B',
            '??' => 'G',
            '??' => 'D',
            '??' => 'E',
            '??' => 'Z',
            '??' => 'H',
            '??' => '8',
            '??' => 'I',
            '??' => 'K',
            '??' => 'L',
            '??' => 'M',
            '??' => 'N',
            '??' => '3',
            '??' => 'O',
            '??' => 'P',
            '??' => 'R',
            '??' => 'S',
            '??' => 'T',
            '??' => 'Y',
            '??' => 'F',
            '??' => 'X',
            '??' => 'PS',
            '??' => 'W',
            '??' => 'A',
            '??' => 'E',
            '??' => 'I',
            '??' => 'O',
            '??' => 'Y',
            '??' => 'H',
            '??' => 'W',
            '??' => 'I',
            '??' => 'Y',
            '??' => 'a',
            '??' => 'b',
            '??' => 'g',
            '??' => 'd',
            '??' => 'e',
            '??' => 'z',
            '??' => 'h',
            '??' => '8',
            '??' => 'i',
            '??' => 'k',
            '??' => 'l',
            '??' => 'm',
            '??' => 'n',
            '??' => '3',
            '??' => 'o',
            '??' => 'p',
            '??' => 'r',
            '??' => 's',
            '??' => 't',
            '??' => 'y',
            '??' => 'f',
            '??' => 'x',
            '??' => 'ps',
            '??' => 'w',
            '??' => 'a',
            '??' => 'e',
            '??' => 'i',
            '??' => 'o',
            '??' => 'y',
            '??' => 'h',
            '??' => 'w',
            '??' => 's',
            '??' => 'i',
            '??' => 'y',
            '??' => 'y',
            '??' => 'i',

            // Turkish
            '??' => 'S',
            '??' => 'I',
            '??' => 'C',
            '??' => 'U',
            '??' => 'O',
            '??' => 'G',
            '??' => 's',
            '??' => 'i',
            '??' => 'c',
            '??' => 'u',
            '??' => 'o',
            '??' => 'g',

            // Russian
            '??' => 'A',
            '??' => 'B',
            '??' => 'V',
            '??' => 'G',
            '??' => 'D',
            '??' => 'E',
            '??' => 'Yo',
            '??' => 'Zh',
            '??' => 'Z',
            '??' => 'I',
            '??' => 'J',
            '??' => 'K',
            '??' => 'L',
            '??' => 'M',
            '??' => 'N',
            '??' => 'O',
            '??' => 'P',
            '??' => 'R',
            '??' => 'S',
            '??' => 'T',
            '??' => 'U',
            '??' => 'F',
            '??' => 'H',
            '??' => 'C',
            '??' => 'Ch',
            '??' => 'Sh',
            '??' => 'Sh',
            '??' => '',
            '??' => 'Y',
            '??' => '',
            '??' => 'E',
            '??' => 'Yu',
            '??' => 'Ya',
            '??' => 'a',
            '??' => 'b',
            '??' => 'v',
            '??' => 'g',
            '??' => 'd',
            '??' => 'e',
            '??' => 'yo',
            '??' => 'zh',
            '??' => 'z',
            '??' => 'i',
            '??' => 'j',
            '??' => 'k',
            '??' => 'l',
            '??' => 'm',
            '??' => 'n',
            '??' => 'o',
            '??' => 'p',
            '??' => 'r',
            '??' => 's',
            '??' => 't',
            '??' => 'u',
            '??' => 'f',
            '??' => 'h',
            '??' => 'c',
            '??' => 'ch',
            '??' => 'sh',
            '??' => 'sh',
            '??' => '',
            '??' => 'y',
            '??' => '',
            '??' => 'e',
            '??' => 'yu',
            '??' => 'ya',

            // Ukrainian
            '??' => 'Ye',
            '??' => 'I',
            '??' => 'Yi',
            '??' => 'G',
            '??' => 'ye',
            '??' => 'i',
            '??' => 'yi',
            '??' => 'g',

            // Czech
            '??' => 'C',
            '??' => 'D',
            '??' => 'E',
            '??' => 'N',
            '??' => 'R',
            '??' => 'S',
            '??' => 'T',
            '??' => 'U',
            '??' => 'Z',
            '??' => 'c',
            '??' => 'd',
            '??' => 'e',
            '??' => 'n',
            '??' => 'r',
            '??' => 's',
            '??' => 't',
            '??' => 'u',
            '??' => 'z',

            // Polish
            '??' => 'A',
            '??' => 'C',
            '??' => 'e',
            '??' => 'L',
            '??' => 'N',
            '??' => 'o',
            '??' => 'S',
            '??' => 'Z',
            '??' => 'Z',
            '??' => 'a',
            '??' => 'c',
            '??' => 'e',
            '??' => 'l',
            '??' => 'n',
            '??' => 'o',
            '??' => 's',
            '??' => 'z',
            '??' => 'z',

            // Latvian
            '??' => 'A',
            '??' => 'C',
            '??' => 'E',
            '??' => 'G',
            '??' => 'i',
            '??' => 'k',
            '??' => 'L',
            '??' => 'N',
            '??' => 'S',
            '??' => 'u',
            '??' => 'Z',
            '??' => 'a',
            '??' => 'c',
            '??' => 'e',
            '??' => 'g',
            '??' => 'i',
            '??' => 'k',
            '??' => 'l',
            '??' => 'n',
            '??' => 's',
            '??' => 'u',
            '??' => 'z'
        ];

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        $str = str_replace(array_keys($char_map), $char_map, $str);

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/('.preg_quote($options['delimiter'], '/').'){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}
if (!function_exists('convert_vi_to_en')) {
    /**
     * Convert vi to en
     *
     * @param  string  $value
     */
    function convert_vi_to_en($str)
    {
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
        $str = preg_replace("/(??)/", 'd', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'A', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'E', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'I', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'O', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'U', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'Y', $str);
        $str = preg_replace("/(??)/", 'D', $str);
        return $str;
    }
}
if (!function_exists('toArray')) {
    function toArray($obj)
    {
        return json_decode(json_encode($obj), true);
    }
}
if (!function_exists('setting')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed, we'll assume you want to set settings.
     *
     * @param  string|array  $key
     * @param  mixed  $default
     * @return mixed
     */
    function setting($key = null, $default = null)
    {
        try {
            if (is_null($key)) {
                return app('setting')->all();
            }

            if (is_array($key)) {
                return app('setting')->set($key);
            }
            return app('setting')->get($key, $default);
        } catch (Exception $e) {
            return $default;
        }
    }
}
if (!function_exists('locale')) {
    function locale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('user')) {
    /**
     * Get the available auth instance.
     *
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function user()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            $user = null;
        }
        return $user;
    }
}
if (! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * This is a polyfill for the missing shorthand function in lumen.
     *
     * @param  string  $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath('config').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}


if (!function_exists('public_path')) {
    function public_path($path = null)
    {
        return rtrim(app()->basePath('public/'.$path), '/');
    }
}
if (!function_exists('swagger_asset')) {
    /**
     * Returns asset from vendor swagger.
     *
     * @param $asset string
     *
     * @return string
     */
    function swagger_asset($asset)
    {
        $file = realpath(__DIR__.'/../resources/vendor/').$asset;

        return route('swagger.asset', ['asset' => $asset, 'v' => md5($file)], app('request')->secure());
    }
}
