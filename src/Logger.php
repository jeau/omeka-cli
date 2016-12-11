<?php

namespace OmekaCli;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Psr\Log\InvalidArgumentException;

class Logger extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        if (!$this->isLogLevelKnown($level)) {
            throw new InvalidArgumentException("level $level is invalid");
        }

        $message = $this->interpolate($message, $context);
        error_log(sprintf('%s: %s', ucfirst($level), $message));
    }

    protected function isLogLevelKnown($level)
    {
        $known = false;

        switch ($level) {
            case LogLevel::EMERGENCY:
            case LogLevel::ALERT:
            case LogLevel::CRITICAL:
            case LogLevel::ERROR:
            case LogLevel::WARNING:
            case LogLevel::NOTICE:
            case LogLevel::INFO:
            case LogLevel::DEBUG:
                $known = true;
        }

        return $known;
    }

    protected function interpolate($message, array $context = array())
    {
        $replace = array();
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }
}