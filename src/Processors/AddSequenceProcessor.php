<?php

namespace Ludovicose\Logger\Processors;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

class AddSequenceProcessor implements ProcessorInterface
{
    private $sequence;

    public function __invoke(LogRecord $record):LogRecord
    {
        $record->extra =  array_merge(['sequence' => $this->getSequence()] + $record->extra);

        return $record;
    }

    protected function getSequence(): string
    {
        if (null === $this->sequence) {
            $sequence       = app()->make('sequence-uuid');
            $this->sequence = $sequence;
        }

        return $this->sequence;
    }
}
