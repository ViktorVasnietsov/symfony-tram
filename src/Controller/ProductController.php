<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Section;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\ProductRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductController extends AbstractController
{
    public function __construct(protected ProductRepository $productRepository)
    {

    }
    #[Route('/product/{id}', methods:['GET'],name: 'product')]
    public function home($id): Response
    {
//        $sections = $sectionRepository->findAll();
        $products = $this->productRepository->findBy(['section'=>$id]);
        return $this->render('product/product.html.twig',[
            'products'=>$products
        ]);

    }
}
