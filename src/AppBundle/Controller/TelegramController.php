<?php

namespace AppBundle\Controller;


use AppBundle\Entity\TelegramChat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    /**
     * @Route("/telegram/{apiKey}", name="telegram")
     */
    public function telegramAction($apiKey)
    {
        $telegramApiKey = $this->getParameter('app.channel.telegram_api_key');

        if ($apiKey != $telegramApiKey) {
            throw $this->createAccessDeniedException();
        }

        $request = (new Api($telegramApiKey))->getWebhookUpdates();

        $chatId = $request["message"]["chat"]["id"];

        $em = $this->getDoctrine()->getEntityManager();

        $chat = $em->getRepository(TelegramChat::class)->findOneBy(['chat' => $chatId]);

        if (!$chat) {
            $chat = (new TelegramChat())->setChat($chatId);
        }

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