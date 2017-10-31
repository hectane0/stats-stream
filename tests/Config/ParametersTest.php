<?php

namespace StatsStream\Test\Config;

use StatsStream\Config\Parameters;
use PHPUnit\Framework\TestCase;

class ParametersTest extends TestCase
{
    public function testIsYouTubeApiKeyProperlyType()
    {
        $this->assertTrue(is_string(Parameters::getYouTubeApiKey()));
    }

    public function testIsTwitchApiKeyProperlyType()
    {
        $this->assertTrue(is_string(Parameters::getTwitchApiKey()));
    }
}
