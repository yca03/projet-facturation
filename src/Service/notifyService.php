<?php

namespace App\Service;


use App\Repository\FactureRepository;

class notifyService
{
    private FactureRepository $factureRepository;

    public function __construct(FactureRepository $factureRepository)
    {
        $this->factureRepository = $factureRepository;
    }

    public function infoNotify(): int
    {
        return $this->factureRepository->countFacturesPending();
    }

    public function getPendingFactures(): array
    {
        return $this->factureRepository->findFacturePending();
    }
}


