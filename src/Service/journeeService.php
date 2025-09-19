<?php

namespace App\Service;

use App\Entity\Journee;
use App\Repository\JourneeRepository;

class journeeService
{
    private JourneeRepository $journeeRepository;
    public function __construct(JourneeRepository $journeeRepository)
    {
        $this->journeeRepository = $journeeRepository;

    }

    public function allInfo(): ?Journee
    {
        $journee = $this->journeeRepository->activeJournee();

        return $journee;
    }
}