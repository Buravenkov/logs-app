<?php


namespace Services;


use Amp\Loop;
use Interfaces\LeadsInterface;
use Repositories\LeadsRepository;

class LeadsService implements LeadsInterface
{
    public const PAUSE_TIME = 2000;
    public const SUCCESS_LOG_FILE = 'log.txt';
    public const ERROR_LOG_FILE = 'errors.txt';
    public array $validLeads = [];

    public function exceptionsHandler(array $invalidLeads): void
    {
        foreach ($invalidLeads as $lead) {
            LeadsRepository::writeLead($lead, self::ERROR_LOG_FILE);
        }
    }

    /**
     * async execution of leads recording
     * @param array $leads
     * @return bool
     */
    public function leadsWriter(array $leads): bool
    {
        $this->validLeads = $leads;
        Loop::run(function () {
            Loop::repeat(100, function ($watcherId) {
                static $i = 0;
                foreach ($this->validLeads as $lead) {
                    if ($i++ < $count = count($this->validLeads)) {
                        $this->fakePause(function () use ($i, $watcherId, $lead, $count) {
                            LeadsRepository::writeLead($lead, self::SUCCESS_LOG_FILE);
                            if ($i === $count) $this->stopWriting($watcherId);
                        });
                    }
                }
            });
        });
        return true;
    }

    /**
     * @param string|null $watcherId
     */
    private function stopWriting (?string $watcherId = null): void
    {
        Loop::cancel($watcherId);
    }

    /**
     * @param callable $leadsRun
     */
    private function fakePause (callable $leadsRun): void
    {
        Loop::delay(self::PAUSE_TIME, $leadsRun);
    }
}
