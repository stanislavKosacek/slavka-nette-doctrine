<?php

namespace App\Presenters;

use App\Model\Entity\Product;
use App\Model\Facade\ProductFacade;
use Doctrine\ORM\EntityManagerInterface;
use Nette\Application\UI\Presenter;

class ProductPresenter extends Presenter
{

    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected ProductFacade $productFacade
    )
    {
        parent::__construct();
    }

    public function actionDefault()
    {
        $this->getTemplate()->products = $this->productFacade->findAllProducts();
    }

    public function handleAddProduct()
    {
        $product = new Product();
        $product->setName("Test " . random_int(1, 100));
        $product->setPrice(random_int(100, 5000));

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        $this->redirect("this");
    }

}
