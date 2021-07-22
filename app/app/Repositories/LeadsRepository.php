<?php

namespace Repositories;

class LeadsRepository
{
    /**
     * @param object $lead
     * @param string $file
     * @param string|null $message
     * @return bool
     */
    public static function writeLead (object $lead, string $file, ?string $message = null): bool
    {
        $date = date('d.m.Y H:i:s');
        $newRecord = "$lead->id | $lead->categoryName | $date";
        if ($file === 'log.txt') {
            $newRecord .= "\n";
        } else {
            $message ? $newRecord .= "| $message\n" : $newRecord .= " | category_name of this lead is invalid or empty\n";
        }
        $filename = __DIR__ .'/../../Storage/'. $file;
        file_put_contents($filename, $newRecord, FILE_APPEND);
        return true;
    }


}
