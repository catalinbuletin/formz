<?php


namespace Formz;


use Dflydev\DotAccessData\Data;

class AttributesHelper
{
    /**
     * Merges
     *
     * @param Data|array $attr1
     * @param Data|array $attr2
     * @return Data
     */
    public static function merge($attr1, $attr2): Data
    {
        if ($attr1 instanceof Data) {
            $finalAttributes = $attr1;
        } else {
            $finalAttributes = new Data();
            foreach ($attr1 as $key => $value) {
                $finalAttributes->set($key, $value);
            }
        }

        if ($attr2 instanceof Data) {
            foreach ($attr2->export() as $key => $value) {
                if (!$finalAttributes->has($key)) {
                    $finalAttributes->set($key, $value);
                }
            }
        } else {
            foreach ($attr2 as $key => $value) {
                if (!$finalAttributes->has($key)) {
                    $finalAttributes->set($key, $value);
                }
            }
        }

        return $finalAttributes;
    }
}
