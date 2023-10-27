<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Controllers\BaseController;

class ProductController extends BaseController
{

    public function __construct() {
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }

    public function index() {
        $model = new ProductModel();
        $session = session();
        $data['products'] = $model->getProducts();
        $data['cart'] = $session->get('cart');
        $data['grand_total'] = $this->calculateGrandTotal($data['cart'], $data['products']);
        // print_r($data['grand_total']);die;
        return view('products', $data);
    }

    private function calculateGrandTotal($cart, $products) {
        $grand_total = $total_discount = $delivery_charge = $total_tax = 0;
        if(!empty($cart)){
            foreach ($cart as $product_id => $quantity) {
                if (isset($products[$product_id])) {
                    $product = $products[$product_id];
                    $total_price = $product['price'] * $quantity;
                    $total_discount = $product['discount'] * $quantity;
                    $delivery_charge = $product['delivery_charge'] * $quantity;
                    $total_tax = $product['tax'] * $quantity;
                    $grand_total += $total_price;
                    $total_discount += $total_discount;
                    $delivery_charge += $delivery_charge;
                    $total_tax += $total_tax;
                }
            }
        }
        $grand_total = ["grand_total" => $grand_total,"total_discount" => $total_discount,"delivery_charge" => $delivery_charge,"total_tax" => $total_tax];
        return $grand_total;
    }

    public function addProduct(): string
    {
        return view('add-products');
    }

    public function submitForm() {
        helper(['form', 'url', 'validation']);
        // Set validation rules for your form fields, e.g., required fields
        $validation = \Config\Services::validation();
        // Specify the custom error messages for each field
        $customMessages = [
            'product_name' => [
                'required' => 'The Product Name field is required.',
            ],
            'description' => [
                'required' => 'The Description field is required.',
            ],
            'category' => [
                'required' => 'The Category field is required.',
            ],
            'price' => [
                'required' => 'The Price field is required.',
            ],
            // Add more custom messages for other fields as needed
        ];
        $validation->setRules([
            'product_name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            // Add more validation rules as needed
        ]);        
        if (!$validation->run()) {
            if ($this->request->isAJAX()) {
                $data = $this->request->getPost();
                if(!empty($data['price']) && isset($data['price'])){
                        $price = $data['price'] ?? 0.00;
                        $tax = $data['tax'] ?? 0.00;
                        $rs = $data['rs'] ?? 0.00;
                        $per = $data['per'] ?? 0.00;
                        $perValue = ( $price * ($per / 100 ) );
                        $taxValue = ( $price * ($tax / 100 ) );
                        // $priceValue = $price + ( $price * ($tax / 100 ) ) + $rs - ( $price * ($per / 100 ) );
                        // $data['price'] = $priceValue;
                        $data['price'] = $price;
                        $data['delivery_charge'] = $rs;
                        $data['discount'] = $perValue;
                        $data['tax'] = $taxValue;
                }
                $image = $this->request->getFile('file');

                if ($image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/uploads', $newName);
                    $data['image'] = 'uploads/' . $newName; // Store the file path in the database
                }
                // Validate and process the data as needed
                // Insert data into the table product
                $productModel = new ProductModel();
                $productModel->insert($data); // Adjust this as per your database structure
                return $this->response->setJSON(['success' => 'Data saved successfully']);
            }
        } else {
            // Form validation failed, return an error response or redirect back to the form
            return view('add-products');
        }
    }

    public function addToCart($product_id) {
        $session = session();
        $cart = $session->get('cart');
        if (!isset($cart[$product_id])) {
            $cart[$product_id] = 1;
        } else {
            $cart[$product_id]++;
        }
        $session->set('cart', $cart);
        return redirect()->to('/products');
    }

    public function removeFromCart($product_id) {
        $session = session();
        $cart = $session->get('cart');
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }
        $session->set('cart', $cart);
        return redirect()->to('/products');
    }

}
