<?php

namespace App\Presenters;

use App\Model\Entity\Post;
use App\Model\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Presenter;

class UserPresenter extends Presenter
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function actionDefault()
    {
        $users = $this->em->getRepository(User::class)->findAll();
        $this->getTemplate()->users = $users;

        /** @var User $user */
       /* $user = $this->em->getRepository(User::class)->find(2);

        $posts = $user->getPosts()->filter(function (Post $post) {
            return $post->getIsPublished();
        });*/
        //bdump($posts->toArray());
    }

    public function actionAddUser()
    {
        $user = new User();
        $user->setName("Test");
        $user->setSurname("Test 2");
        $user->setEmail("test@test.com");

        $this->em->persist($user);
        $this->em->flush();
        
        $this->redirect("default");
    }

}
