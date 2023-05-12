<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class LikeController extends AbstractController
{
    #[Route('/like/{id}', name: 'app_like')]
    public function like(MicroPost $post, MicroPostRepository $posts, Request $request): Response
    {
        $currentUser = $this->getUser();
        $post->addLikedBy($currentUser);
        $posts->save($post, true);

        return $this->redirect($request->headers->get('referer'));
    }
    
    #[Route('/unlike/{id}', name: 'app_unlike')]
    public function unlike(MicroPost $post, MicroPostRepository $posts, Request $request): Response
    {
        $currentUser = $this->getUser();
        $post->removeLikedBy($currentUser);
        $posts->save($post, true);

        return $this->redirect($request->headers->get('referer'));
    }
}
