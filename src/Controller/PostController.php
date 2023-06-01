<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    //Metodo Repositorio
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/post/{id}', name: 'app_post')]
    public function index(Post $post, $id): Response
    {
        //Metodo Repositorio
        $post = $this->em->getRepository(Post::class)->find(id:1);
        $custom_post = $this->em->getRepository(Post::class)->findPost($id);

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'user_name' => 'Miguel Angel',
            'cadena' => ['Value1'=> 'Primer valor','Value2'=> 'Segundo valor'],
            'post' => $post, //Este lo traemos como objeto con toda la info
            'custom_post' => $custom_post //Este lo traemos como arreglo con info especifica
        ]);
    }
}
