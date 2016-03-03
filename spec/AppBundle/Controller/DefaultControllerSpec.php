<?php

namespace spec\AppBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultControllerSpec extends ObjectBehavior
{
    function let(Session $session)
    {
        $this->beConstructedWith($session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Controller\DefaultController');
    }

    function it_has_indexAction(Session $session)
    {
        $session->has('token')->willReturn(false);
        $session->set('token', Argument::any())->shouldBeCalled();
        $session->get('token', Argument::any())->shouldBeCalled();

        $this->indexAction()->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\JsonResponse');
    }

    function it_has_shutdownAction(Request $request)
    {
        $this->shutdownAction($request)->shouldReturnAnInstanceOf('Symfony\Component\HttpFoundation\Response');
    }
}
