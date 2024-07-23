<?php

namespace App\Application\Tasks;

interface BaseTaskContract
{
    /**
     * @param array $data
     * @return bool|null
     */
    public function execute(array $data): null|bool;
}
