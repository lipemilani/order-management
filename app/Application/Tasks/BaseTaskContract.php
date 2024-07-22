<?php

namespace App\Application\Tasks;

interface BaseTaskContract
{
    /**
     * @param array $data
     * @return void
     */
    public function execute(array $data): void;
}
