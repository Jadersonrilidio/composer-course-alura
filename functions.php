<?php

function env(string $name, string $default = '')
{
    return getenv($name) ? getenv($name) : $default;
}
