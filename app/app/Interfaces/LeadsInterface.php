<?php

namespace Interfaces;


interface LeadsInterface
{
    public const VALID_TYPES_OF_LEADS = [
        'Buy auto',
        'Buy house',
        'Get loan',
        'Cleaning',
        'Learning',
        'Car wash',
        'Repair smth',
        'Barbershop',
        'Pizza',
        'Car insurance',
        'Life insurance'
    ];

    public function exceptionsHandler (array $invalidLeads): void;
    public function leadsWriter (array $leads): bool;
}

