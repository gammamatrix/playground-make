<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Concerns;

/**
 * \Playground\Make\Configuration\Concerns\Classes
 */
trait Classes
{
    public function addClassTo(
        string $property,
        mixed $fqdn
    ): self {

        if (empty($property)) {
            throw new \RuntimeException(__('playground-make::configuration.addClassTo.property.required', [
                'class' => static::class,
                'property' => $property,
                'fqdn' => is_string($fqdn) ? $fqdn : gettype($fqdn),
            ]));
        }

        if (empty($fqdn) || ! is_string($fqdn)) {
            throw new \RuntimeException(__('playground-make::configuration.addClassTo.fqdn.required', [
                'class' => static::class,
                'property' => $property,
                'fqdn' => is_string($fqdn) ? $fqdn : gettype($fqdn),
            ]));
        }

        if (! property_exists($this, $property)
            || ! is_array($this->{$property})
        ) {
            throw new \RuntimeException(__('playground-make::configuration.addClassTo.property.missing', [
                'class' => static::class,
                'property' => $property,
                'fqdn' => $fqdn,
            ]));
        }

        if (! in_array($fqdn, $this->{$property})) {
            $this->{$property}[] = $fqdn;
        }

        return $this;
    }

    /**
     * @param mixed $value Provide a string value, such as an FQDN or a path to a file.
     */
    public function addMappedClassTo(
        string $property,
        mixed $key,
        mixed $value
    ): self {
        if (empty($property)) {
            throw new \RuntimeException(__('playground-make::configuration.addMappedClassTo.property.required', [
                'class' => static::class,
                'key' => is_string($key) ? $key : gettype($key),
                'property' => $property,
                'value' => is_string($value) ? $value : gettype($value),
            ]));
        }

        if (empty($key) || ! is_string($key)) {
            // dump([
            //     '$property' => $property,
            //     '$key' => $key,
            //     '$value' => $value,
            //     '$this' => $this,
            // ]);
            throw new \RuntimeException(__('playground-make::configuration.addMappedClassTo.key.required', [
                'class' => static::class,
                'key' => is_string($key) ? $key : gettype($key),
                'property' => $property,
                'value' => is_string($value) ? $value : gettype($value),
            ]));
        }

        if (empty($value) || ! is_string($value)) {
            throw new \RuntimeException(__('playground-make::configuration.addMappedClassTo.value.required', [
                'class' => static::class,
                'key' => is_string($key) ? $key : gettype($key),
                'property' => $property,
                'value' => is_string($value) ? $value : gettype($value),
            ]));
        }

        if (! property_exists($this, $property)
            || ! is_array($this->{$property})
        ) {
            throw new \RuntimeException(__('playground-make::configuration.addMappedClassTo.property.missing', [
                'class' => static::class,
                'key' => is_string($key) ? $key : gettype($key),
                'property' => $property,
                'value' => $value,
            ]));
        }

        $this->{$property}[$key] = $value;

        return $this;
    }

    public function addClassFileTo(
        string $property,
        string $file
    ): self {

        if (empty($property)) {
            throw new \RuntimeException(__('playground-make::configuration.addClassFileTo.property.required', [
                'class' => static::class,
                'property' => $property,
                'file' => $file,
            ]));
        }

        if (empty($file)) {
            throw new \RuntimeException(__('playground-make::configuration.addClassFileTo.file.required', [
                'class' => static::class,
                'property' => $property,
                'file' => $file,
            ]));
        }

        if (! property_exists($this, $property)
            || ! is_array($this->{$property})
        ) {
            throw new \RuntimeException(__('playground-make::configuration.addClassFileTo.property.missing', [
                'class' => static::class,
                'property' => $property,
                'file' => $file,
            ]));
        }

        if (! in_array($file, $this->{$property})) {
            $this->{$property}[] = $file;
        }

        return $this;
    }

    public function addToUse(
        string $class,
        string $key = null
    ): self {

        if (empty($class)) {
            throw new \RuntimeException(__('playground-make::configuration.addToUse.class.required', [
                'class' => static::class,
                'use_class' => $class,
                'key' => $key ?? '',
            ]));
        }

        if (is_string($key)) {
            $this->uses[$key] = $class;
        } else {
            if (! in_array($class, array_values($this->uses))) {
                $this->uses[] = $class;
            }
        }

        return $this;
    }
}
