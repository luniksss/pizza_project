<?php
declare(strict_types=1);
namespace App\Controller;

use App\Service\OrdersServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class OrderForm extends AbstractController
{
    private OrdersServiceInterface $ordersService;
    public function __construct(OrdersServiceInterface $ordersService)
    {
       $this->ordersService = $ordersService;
    }

    public function index(Request $request): Response
    {
        $userId = $request->get('id');
        $pizzaId = $request->get('pizza_id');
        $pizzaName = $request->get('name');
        $pizzaPrice = $request->get('price');
        $pizzaPic = $request->get('picture');
        return $this->render('user/basket.html.twig', [
            'user_id' => $userId, 'pizza_id' => $pizzaId, 'pizza_name' => $pizzaName, 'pizza_price' => $pizzaPrice, 'pizza_picture' => $pizzaPic
         ]);
    }

    public function placeOrder(Request $request): Response
    {
        $userId = intval($request->get('user_id'));
        $pizzaId = intval($request->get('pizza_id'));
        $pizzaPrice = intval($request->get('price'));
        $this->ordersService->placeOrder(
             $userId,
            $pizzaId,
            $pizzaPrice,
            $request->get('address')
        );
        return $this->render('showThankYou.html.twig');
    }

}