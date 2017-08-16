<?php

namespace App\Support;

class Slugger
{
    const DEFAULT_SEPARATOR = '-';

    /**
     * Returns the slugified version of the string.
     *
     * @param string $string
     * @param string $separator
     * @return string
     */
    public function slugify($string, $separator = self::DEFAULT_SEPARATOR)
    {
        if (empty($string)) {
            return null;
        }

        return $this->replaceInvalidCharacters(
            $this->toLowercase(
                $this->replaceExtendedCharacters(
                    $this->removeNewLines($string)
                )
            ),
            $this->sanitizeSeparator($separator)
        );
    }

    /**
     * @param string $string
     * @return string
     */
    protected function removeNewLines($string)
    {
        return (string)str_replace(array("\r", "\n"), '', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    protected function replaceExtendedCharacters($string)
    {
        $replacements = array(
            'a' => array('à', 'á', 'â', 'ã', 'å', 'À', 'Á', 'Â', 'Ã', 'Å'),
            'ae' => array('æ', 'Æ', 'ä', 'Ä'),
            'and' => array('&amp;', '&'),
            'c' => array('ç', 'Ç', '©'),
            'd' => array('∂'),
            'e' => array('è', 'é', 'ê', 'ë', 'È', 'É', 'Ê', 'Ë', '€'),
            'i' => array('ì', 'í', 'î', 'ï', 'Ì', 'Í', 'Î', 'Ï'),
            'n' => array('ñ', 'Ñ'),
            'o' => array('ò', 'ó', 'ô', 'õ', 'ø', 'Ò', 'Ó', 'Ô', 'Õ', 'Ø'),
            'oe' => array('œ', 'Œ', 'ö', 'Ö'),
            'r' => array('®'),
            's' => array('$'),
            'ss' => array('ß'),
            'u' => array('ù', 'ú', 'û', 'µ', 'Ù', 'Ú', 'Û'),
            'ue' => array('ü', 'Ü'),
            'y' => array('ÿ', 'Ÿ', '¥'),
            'tm' => array('™'),
            'pi' => array('∏', 'π', 'Π'),
            ' ' => array("'", "`"),
        );

        foreach ($replacements as $output => $input) {
            $string = str_replace($input, $output, $string);
        }

        return $string;
    }

    /**
     * @param string $string
     * @return string
     */
    protected function toLowercase($string)
    {
        return mb_strtolower($string, mb_internal_encoding());
    }

    /**
     * @param string $string
     * @param string $separator
     * @return string
     */
    protected function replaceInvalidCharacters($string, $separator)
    {
        return preg_replace('#(' . $separator . '+)#', $separator, preg_replace('#[\s]+#', $separator, rtrim(trim(preg_replace('#[^a-z0-9\s]#', ' ', $string)))));
    }

    /**
     * @param string $separator
     * @return string
     */
    protected function sanitizeSeparator($separator)
    {
        if ($separator == self::DEFAULT_SEPARATOR) {
            return $separator;
        }

        if ($separator == rawurlencode($separator)) {
            return $separator;
        }

        return self::DEFAULT_SEPARATOR;
    }
}