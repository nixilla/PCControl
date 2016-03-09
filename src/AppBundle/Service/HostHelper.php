<?php

namespace AppBundle\Service;

use Salavert\Twig\Extension\TimeAgoExtension;

class HostHelper
{
    /** @var TimeAgoExtension */
    private $timeHelper;

    /**
     * HostHelper constructor.
     * @param TimeAgoExtension $timeHelper
     */
    public function __construct(TimeAgoExtension $timeHelper)
    {
        $this->timeHelper = $timeHelper;
    }

    public function getBootTime()
    {
        $tmp = explode(' ', file_get_contents('/proc/uptime'));
        return time() - intval($tmp[0]);
    }

    public function getUptime($asHumanReadable = false)
    {
        $tmp = explode(' ', file_get_contents('/proc/uptime'));
        if( ! $asHumanReadable)
            return intval($tmp[0]);
        else
            return $this->timeHelper->timeAgoInWordsFilter(time() - intval($tmp[0]));
    }

    public function shutdown($areYouSure = false)
    {
        if($areYouSure)
            shell_exec('sudo shutdown -h now');
    }
}
