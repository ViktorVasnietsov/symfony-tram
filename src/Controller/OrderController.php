<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Section;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\SectionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
#[Route('/o')]

class OrderController extends AbstractController
{

    public function __construct(
        protected OrderRepository $orderRepository,
        protected ProductRepository $productRepository,
        protected Security $security,
        protected UserRepository $userRepository)
    {

    }

    #[Route('/newOrder/{id}', methods:['GET'],name: 'order')]
    public function order($id): Response
    {
        $user = $this->security->getUser();
        $product = $this->productRepository->find(['id'=>$id]);
        $order = new Order($user,$product);
        $this->orderRepository->save($order);
        return $this->render('order/order.html.twig',[
            'order'=>$order
        ]);
    }

    #[Route('/myOrders',name: 'myOrders')]
    public function myOrders(): Response
    {
        $user = $this->security->getUser();
        $userId = $this->userRepository->find(['id'=>$user])->getId();
        $orders = $this->orderRepository->findBy(['user'=>$userId]);
//        $products = $this->productRepository->findBy(['id'=>$orders]);
        return $this->render('order/bucket.html.twig',[
            'orders'=>$orders,
            'user'=>$user
        ]);
    }

}
