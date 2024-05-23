<?php

declare(strict_types=1);

if (! function_exists('resolve_proxy')) {
    /**
     * Resolve proxy in case of IOC API changing or deprecations
     *
     * @param  class-string  $className
     * @param  array<mixed>  $args
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function resolve_proxy(string $className, array $args): mixed
    {
        return App()->makeWith($className, $args);
    }
}
