<?php

namespace App\Consumer;

use PhpAmqpLib\Message\AMQPMessage;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;

class EmailService implements ConsumerInterface
{
    public function execute(AMQPMessage $msg){
        $body = $msg->body;

        $response = json_decode($msg->body, true);

        $type = $response["Type"];

        if ($type === "Verification") $this->sendVerification($response);

    }


    private function sendVerification($response){
        var_dump($response);
    }
}