<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findLastPosts(15);

        return $this->render(
            'landing.html.twig',
            [
                'posts' => $posts,
                // TODO: Когда сделаю форму тут передавать тру и показывать аккое-нибудь уведомление об этом
                'newPost' => false,
            ]
        );
    }
}
