<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CartModel;
use App\Controllers\BaseController;

class CartController extends BaseController
{

    public function __construct() {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }

    public function index()
    {
        $cartModel = new CartModel();
        $cartItems = $cartModel->getCartItems(); // Replace with your logic to get cart items
        return view('carts', ['cartItems' => $cartItems]);
    }

    // app/Controllers/CartController.php

    public function addToCart()
    {
        $cartModel = new CartModel();

        // Retrieve data from the request (e.g., POST data)
        $product_id = $this->request->getPost('product_id');
        $user_id = $this->request->getPost('user_id');
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('price');

        // Add the product to the cart
        $result = $cartModel->addToCart($product_id, $user_id, $quantity, $price);

        if ($result) {
            return $this->response->setJSON(['success' => 'Product added to the cart']);
        } else {
            return $this->response->setJSON(['error' => 'Failed to add the product to the cart']);
        }
    }

    
}
