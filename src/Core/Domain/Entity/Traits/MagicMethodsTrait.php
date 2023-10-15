<?php

namespace Core\Domain\Entity\Traits;

trait MagicMethodsTrait
{
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Property {$name} not found in " . get_class($this) . " class");
        }
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        $method = 'is' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
        $this->$name = $value;
    }


}