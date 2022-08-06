<?php

declare(strict_types=1);

namespace App\Graph;

/**
 * Give a class attributes.
 */
trait Attributes
{
    /**
     * get a single attribute with the given $name (or return $default if
     * attribute was not found).
     *
     * @param string $name
     * @param mixed  $default to return if attribute was not found
     *
     * @return mixed
     */
    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * get all attribute with the given $name (or return $default if attribute
     * was not found).
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Get array of attributes with a given prefix. The prefix is removed from
     * the keys.
     *
     * @param string $prefix
     *
     * @return mixed[]
     */
    public function getAttributesWithPrefix(string $prefix): array
    {
        $attributes = array_filter($this->attributes, static function ($key) use ($prefix) {
            return strpos($key, $prefix) === 0;
        }, ARRAY_FILTER_USE_KEY);

        $scoped = [];
        $prefix_length = strlen($prefix);

        foreach ($attributes as $key => $value) {
            $scoped[substr($key, $prefix_length)] = $value;
        }

        return $scoped;
    }

    /**
     * set a single attribute with the given $name to given $value.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public function setAttribute(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    /**
     * set a array of attributes.
     *
     * @param mixed[] $attributes
     *
     * @return void
     */
    public function setAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * Removes a single attribute with the given $name.
     *
     * @param string $name
     *
     * @return void
     */
    public function removeAttribute(string $name): void
    {
        unset($this->attributes[$name]);
    }
}
