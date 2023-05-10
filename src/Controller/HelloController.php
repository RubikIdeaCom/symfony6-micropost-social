<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    private array $messages = [
        ['message'=>'Hello!', 'created'=>'2022/06/12'],
        ['message'=>'Hi!', 'created'=>'2022/04/12'],
        ['message'=>'Bye!', 'created'=>'2021/06/12'],
    ];

    #[Route('/', name: 'app_index')]
    public function index(MicroPostRepository $posts, CommentRepository $comments):Response
    {
        $post = $posts->find(1);
        $comment = $post->getComments()[0];

        $post->removeComment($comment);
        $posts->save($post, true);





        // $comment = new Comment();
        // $comment->setText('Hello Comment');
        // $comment->setPost($post);

        // $comments->save($comment, true);


        // $user = new User();
        // $user->setEmail('email@email.com');
        // $user->setPassword('123456');

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $profile->setName('Jack Ma');
        // $profile->setBio('I am good!');
        // $profiles->save($profile, true);


        return $this->render(
            'hello/index.html.twig', 
            [
                'messages' => $this->messages,
                'limit' => 3
            ]
        );
        // return new Response(implode(',', array_slice($this->messages, 0, $limit)));
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): Response
    {
        return $this->render(
            'hello/show_one.html.twig', [
                'message' => $this->messages[$id]
            ]
        );
        
        // return new Response($this->messages[$id]);
    }
}