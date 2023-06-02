<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    //Metodo 1: POO
    // #[Route('insert1/post', name: 'insert_post')]
    // public function insert(){
    //     $post = new Post();
    //     //Trayendo al usuario
    //     $user = $this->em->getRepository(User::class)->find(id:1);
    //     $post ->setTitle(title: 'My Inserted Post')
    //         ->setDescription(description: 'Hellow My Inserted Post')
    //         ->setCreationDate(new \DateTime())
    //         ->setUrl(url: 'Inserter.com')
    //         ->setFile(file: 'newInsertedFile.txt')
    //         ->setType(type: 'Inserted')
    //         ->setUser($user);
    //     $this->em->persist($post);
    //     //Escribiendo en DB
    //     $this->em->flush();

    //     return new JsonResponse(['success' => true]);
    // }

    //Metodo 1: Trayendo el Constructor del Entity
    #[Route('insert2/post', name: 'insert_post')]
    public function insert(){
        $post = new Post(title: 'My Inserted Post',type: 'Inserted',description: 'Hellow My Inserted Post', file: 'newInsertedFile.txt', url: 'Inserter.com');
        //Trayendo al usuario
        $user = $this->em->getRepository(User::class)->find(id:1);
        $post->setUser($user);

        $this->em->persist($post);
        //Escribiendo en DB
        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }
}
