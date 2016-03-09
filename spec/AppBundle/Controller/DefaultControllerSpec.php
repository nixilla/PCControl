<?php

namespace spec\AppBundle\Controller;

use AppBundle\Service\HostHelper;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultControllerSpec extends ObjectBehavior
{
    function let(Session $session, HostHelper $helper)
    {
        $this->beConstructedWith($session, $helper);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\DefaultController');
    }

    function it_has_indexAction(Session $session, HostHelper $helper)
    {
        $session->has('token')->willReturn(false);
        $session->set('token', Argument::any())->shouldBeCalled();
        $session->get('token', Argument::any())->shouldBeCalled();

        $helper->getUptime(true)->shouldBeCalled();

        $this->indexAction()->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\JsonResponse');
    }

    function it_has_shutdownAction(Request $request)
    {
        $this->shutdownAction($request)->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\Response');
    }
}
