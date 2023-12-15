<?php

namespace BoredProgrammers\LaraGrid;

class BaseLaraGridClass
{

    public function __construct()
    {
        $this->bootTraits();
    }

    public function bootTraits()
    {
        $class = static::class;

        // Get all traits used by the class and its parents
        do {
            $traits = class_uses($class);

            foreach ($traits as $trait) {
                // Get the "boot" method for the trait, if it exists
                $method = 'boot' . class_basename($trait);

                if (method_exists($class, $method)) {
                    $this->{$method}();
                }
            }
        } while ($class = get_parent_class($class));
    }

}