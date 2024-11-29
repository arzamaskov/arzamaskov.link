<?php

namespace App\Users\Infrastructure\Adapter;

use App\Trainings\Infrastructure\Api\Api;

class TrainingsAdapter
{
    // в классах адаптера можно использовать любые зависимости от внешних модулей
    // но важно понимать, что использовать их можно только в рамках адаптера
    public function __construct(private readonly Api $trainingsApi)
    {
    }

    public function getSomeData(): array
    {
        $this->trainingsApi->getSomeData();

        // маппинг, обработка
        return [];
    }
}
