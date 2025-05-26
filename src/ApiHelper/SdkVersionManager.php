<?php

namespace Api\ApiHelper;

class SdkVersionManager
{
    private static $apiVersion = 'v3';
    private static $allowedVersions = ['v1', 'v2', 'v3'];

    /**
     * Get the current API version
     * @return string
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * Set the API version with validation
     * @param string $apiVersion
     * @throws \InvalidArgumentException if the version is not allowed
     */
    public static function setApiVersion($apiVersion)
    {
        if (!in_array($apiVersion, self::$allowedVersions)) {
            throw new \InvalidArgumentException(
                "Invalid API version: '$apiVersion'. Allowed versions are: " . implode(', ', self::$allowedVersions)
            );
        }

        self::$apiVersion = $apiVersion;
    }

    /**
     * Get the list of allowed versions
     * @return array
     */
    public static function getAllowedVersions()
    {
        return self::$allowedVersions;
    }
}
