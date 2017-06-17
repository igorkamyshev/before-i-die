<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
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
        /** @var Form $form */
        $form = $this
            ->createFormBuilder()
            ->setAction($this->generateUrl('homepage'))
            ->setMethod('POST')
            ->add('text', TextType::class,
                [
                    'attr' => [
                        'placeholder' => 'Прежде чем умру, я ...',
                    ],
                ]
            )
            ->getForm();

        $newPost = false;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $post = (new Post())
                ->setText($data['text']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $newPost = true;
        }

        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findLastPosts(15);

        return $this->render(
            'landing.html.twig',
            [
                'posts'   => $posts,
                'newPost' => $newPost,
                'form'    => $form->createView(),
            ]
        );
    }
}
