<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TelegramChat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    /**
     * @Route("/telegram/{apiKey}", name="telegram")
     */
    public function telegramAction($apiKey)
    {
        $telegramApiKey = $this->getParameter('app.telegram_api_key');

        if ($apiKey != $telegramApiKey) {
            throw $this->createAccessDeniedException();
        }

        $request = (new Api($telegramApiKey))->getWebhookUpdates();

        $chatId = $request["message"]["chat"]["id"];

        $chat = (new TelegramChat())->setChat($chatId);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($chat);
        $em->flush();

        $test = new Api($telegramApiKey);
        $test->sendMessage([
            'chatId' => '@before_i_die',
            'text'   => 'from bot!',
        ]);

        return new Response('ok');
    }
}