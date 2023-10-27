<?php

namespace App\Models;

use CodeIgniter\Model;


class CartModel extends Model
{
    protected $table = 'cart'; // Update this with your table name
    protected $allowedFields = ['product_id', 'user_id','quantity', 'price']; // Adjust this based on your form fields

    public function getCartItems()
    {
        // Assuming you have the appropriate model for the 'cart' and 'product' tables
        $builder = $this->db->table('cart');
        
        $query = $builder
            ->select('cart.id, cart.quantity, cart.price, product.product_name, product.description, product.price, product.tax, product.discount')
            ->join('product', 'product.product_id = cart.product_id')
            ->get();
    
        if ($query === false) {
            return array(); // Return an empty array or handle the error as needed
        } else {
            return $query->getResultArray();
        }
    }
    
    


    public function addToCart($product_id, $user_id, $quantity, $price)
    {
        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'quantity' => $quantity,
            'price' => $price
        ];

        return $this->insert($data);
    }
}
