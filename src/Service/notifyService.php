<?php

namespace App\Service;

use App\Repository\NotifyRepository;
use App\Repository\FactureRepository;

class notifyService
{
//    private NotifyRepository $notifyRepository;
    private FactureRepository $factureRepository;

    public function __construct(NotifyRepository $notifyRepository, FactureRepository $factureRepository)
    {
//        $this->notifyRepository = $notifyRepository;
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


