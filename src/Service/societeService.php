<?php

namespace App\Service;

use App\Entity\Societe;
use App\Repository\SocieteRepository;

class societeService
{
    private SocieteRepository $societeRepository;
    public function __construct(SocieteRepository $societeRepository)
    {
        $this->societeRepository = $societeRepository;

    }

    public function info(): Societe
    {
        $societe = $this->societeRepository->getFirstResult();

        return $societe;
    }
}