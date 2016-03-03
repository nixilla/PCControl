<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController
{
    /** @var Session */
    private $session;

    /**
     * DefaultController constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function indexAction()
    {
        if( ! $this->session->has('token'))
            $this->session->set('token', hash('sha256',uniqid()));

        return new JsonResponse([
            'status' => 'running',
            'token' => $this->session->get('token')
        ]);
    }

    public function shutdownAction(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        if($content['token'] && $content['token'] == $this->session->get('token'))
        {
            shell_exec('sudo shutdown -h now');

            return new JsonResponse(['status' => 'shutting down']);
        }
        else {
            return new Response('Forbidden', 403);
        }
    }
}
