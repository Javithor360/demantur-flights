<?php

$dotenv = fopen(__DIR__ . '/../.env', 'r');
if ($dotenv) {
    while (($line = fgets($dotenv)) !== false) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            $_ENV[$key] = $value;
        }
    }
    fclose($dotenv);
}