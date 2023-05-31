<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post')]
    public function index(Post $post): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'user_name' => 'Miguel Angel',
            'cadena' => ['Value1'=> 'Primer valor','Value2'=> 'Segundo valor'],
            'post' => $post,
        ]);
    }
}
