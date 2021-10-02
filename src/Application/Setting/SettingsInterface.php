<?php
declare(strict_types=1);

namespace App\Application\Setting;

interface SettingsInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key = '');
}
