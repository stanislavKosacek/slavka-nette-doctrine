<?php

namespace App\Presenters;

use App\Model\Entity\Post;
use App\Model\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Presenter;

class PostPresenter extends Presenter
{

    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function actionDefault()
    {
        $posts = $this->em->getRepository(Post::class)->findAll();
        $this->getTemplate()->posts = $posts;
    }

    public function actionAddPost()
    {
        $user = $this->em->getRepository(User::class)->find(2);
        $post = new Post();
        $post->setTitle("Nový článek");
        $post->setText("Můj text článku");
        $post->setAuthor($user);

        $this->em->persist($post);
        $this->em->flush();
        
        $this->redirect("default");
    }

    public function handleDeletePost(int $id)
    {
        $postToDelete = $this->em->getRepository(Post::class)->find($id);
        $this->em->remove($postToDelete);
        $this->em->flush();

        $this->redirect("this");
    }

    public function handleSwitchPost(int $id)
    {
        /** @var Post $postToSwith */
        $postToSwith = $this->em->getRepository(Post::class)->find($id);

     /*   if ($postToSwith->getIsPublished()) {
            $postToSwith->setPublished(false);
        } else {
            $postToSwith->setPublished(true);
        }
        */

        //$postToSwith->setPublished($postToSwith->getIsPublished() ? false : true);
        $postToSwith->setPublished(!$postToSwith->getIsPublished());

        $this->em->persist($postToSwith);
        $this->em->flush();


        $this->redirect("this");
    }

}
