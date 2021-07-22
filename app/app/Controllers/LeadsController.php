<?php

namespace Controllers;

use LeadGenerator\Generator;
use LeadGenerator\Lead;
use Interfaces\LeadsInterface;
use Services\LeadsService;

class LeadsController
{
    public Generator $leadsGenerator;
    public array $validLeads = [];
    public array $invalidLeads = [];
    public LeadsService $leadsService;

    /**
     * LeadsController constructor.
     */
    public function __construct()
    {
        $this->leadsGenerator = new Generator();
        $this->leadsService = new LeadsService();
    }

    /**
     * the created leads are handled and sent for recording
     * @return bool
     */
    public function createLeads (): bool
    {
//        $this->leadsGenerator->generateLeads(10000, function (Lead $lead) {
            $this->leadsGenerator->generateLeadsWithFakes(10000, function (Lead $lead) {
            if (in_array($lead->categoryName, LeadsInterface::VALID_TYPES_OF_LEADS)) {
                array_push($this->validLeads, $lead);
            } else {
                array_push($this->invalidLeads, $lead);
            }
        });
        if (count($this->invalidLeads)) {
            $this->leadsService->exceptionsHandler($this->invalidLeads);
        }
        if (count($this->validLeads)) {
            return $this->leadsService->leadsWriter($this->validLeads);
        }
        return false;
    }
}

