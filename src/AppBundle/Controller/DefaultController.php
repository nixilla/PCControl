<?php

namespace AppBundle\Controller;

use AppBundle\Service\HostHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController
{
    /** @var Session */
    private $session;

    /** @var HostHelper */
    private $hostHelper;

    /**
     * DefaultController constructor.
     * @param Session $session
     * @param HostHelper $hostHelper
     */
    public function __construct(Session $session, HostHelper $hostHelper)
    {
        $this->session = $session;
        $this->hostHelper = $hostHelper;
    }

    public function indexAction()
    {
        if( ! $this->session->has('token'))
            $this->session->set('token', hash('sha256',uniqid()));

        return new JsonResponse([
            'status' => 'running',
            'hostname' => gethostname(),
            'boottime' => $this->hostHelper->getUptime(true),
            'token' => $this->session->get('token')
        ]);
    }

    public function shutdownAction(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        if($content['token'] && $content['token'] == $this->session->get('token'))
        {
            $this->hostHelper->shutdown($areYouSure = true);

            return new JsonResponse(['status' => 'shutting down']);
        }
        else {
            return new Response('Forbidden', 403);
        }
    }
}
