<?php

namespace Formz;

use Formz\Contracts\IRule;
use Symfony\Component\Finder\Finder;

class RulesLibrary
{

    /**
     * @param $name
     * @param array $params
     * @return IRule
     * @throws \ReflectionException
     */
    public static function makeRule($name, $params = [])
    {
        return self::get($name, $params);
    }

    /**
     * Returns an array of rules from the Rules folder in the same namespace
     *
     * @param null $name
     * @param array $params
     * @return IRule|IRule[]
     * @throws \ReflectionException
     */
    public static function get($name = null, $params = [])
    {
        $rules = [];

        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/Rules');

        foreach ($finder as $file) {
            $ns = __NAMESPACE__ . '\\Rules';

            if ($relativePath = $file->getRelativePath()) {
                $ns .= '\\'.strtr($relativePath, '/', '\\');
            }

            $class = $ns.'\\'.$file->getBasename('.php');
            $r = new \ReflectionClass($class);

            if ($r->isAbstract()) {
                continue;
            }

            // Return the rule if the name is present and matches the rule name
            if (!is_null($name)) {
                /** @var IRule $rule */
                $rule = new $class(...array_values($params));
                if ($rule->name() === $name) {
                    return $rule;
                }
            }

            /** @var IRule $rule */
            $rule = new $class();
            $rules[$rule->name()] = $rule;
        }

        return $rules;
    }
}
