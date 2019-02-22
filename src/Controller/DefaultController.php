<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("create")
     */
    public function create(Request $request)
    {
        $message = [
            "Type" => "Verification",
            "Message" => "Sou uma fila",
            "Name" => $request->get('name')
        ];

        $rabbitMessage = json_encode($message);

        $this->get('old_sound_rabbit_mq.emailing_producer')
            ->setContentType('application/json');
        
        $this->get('old_sound_rabbit_mq.emailing_producer')
            ->publish($rabbitMessage);

        return new JsonResponse(array('status' => 'ok'));
    }
}