<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class TelegramChat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $chat;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param string $chat
     * @return TelegramChat
     */
    public function setChat($chat)
    {
        $this->chat = $chat;

        return $this;
    }
}