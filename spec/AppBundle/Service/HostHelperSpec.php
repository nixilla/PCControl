<?php

namespace spec\AppBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Salavert\Twig\Extension\TimeAgoExtension;

class HostHelperSpec extends ObjectBehavior
{
    function let(TimeAgoExtension $timeAgoExtension)
    {
        $this->beConstructedWith($timeAgoExtension);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Service\HostHelper');
    }

    function it_knows_the_host_boot_time()
    {
        $this->getBootTime()->shouldNotReturn(null);
    }

    function it_knows_uptime()
    {
        $this->getUptime()->shouldNotReturn(null);
    }

    function it_knows_uptime_as_human_readable(TimeAgoExtension $timeAgoExtension)
    {
        $timeAgoExtension->timeAgoInWordsFilter(Argument::any())->willReturn('1h ago');
        $this->getUptime($asHumanReadable = true)->shouldReturn('1h ago');
    }

    function it_can_shutdown_the_host()
    {
        $this->shutdown();
    }
}
