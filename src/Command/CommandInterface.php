<?php

namespace OmekaCli\Command;

use OmekaCli\Application;

interface CommandInterface
{
    /**
     * @return array Command options specifications.
     *
     * ```php
     * array(
     *   'optionName' => array(
     *     'short' => 'o',
     *     'long' => 'option-name',
     *     'parameter' => true,
     *   ),
     *   // ...
     * )
     * ```
     */
    public function getOptionsSpec();

    /**
     * Returns a short description of the command.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Returns usage text.
     *
     * @return string
     */
    public function getUsage();

    /**
     * Run the command.
     *
     * @param string[]    $options     An associative array of command line options
     * @param string[]    $arguments   Command line arguments
     * @param Application $application The OmekaCli Application
     *
     * @return int exit code
     */
    public function run($options, $arguments, Application $application);
}