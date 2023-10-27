<?php

namespace App\Models;

use CodeIgniter\Model;


class ProductModel extends Model
{
    protected $table = 'product'; // Update this with your table name
    protected $allowedFields = ['product_name', 'image','category', 'price', 'Description', 'tax', 'delivery_charge', 'discount']; // Adjust this based on your form fields

    public function getProducts() {
        return $this->findAll();
    }
}
