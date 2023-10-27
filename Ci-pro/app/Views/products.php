<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <style>
         * {
         overflow-x: hidden;
         padding: 0;
         margin: 0;
         box-sizing: border-box;
         font-family: Arial, Helvetica, sans-serif;
         }
         .m_responsible-table {
         padding: 10px;
         }
         table {
         width: 100%;
         border-collapse: collapse;
         }
         th, td {
         border: 1px solid #dddddd;
         padding: 8px;
         text-align: center;
         }
         th {
         background-color: #f2f2f2;
         }
         table {
         width: 100%;
         border-collapse: collapse;
         }
         th, td {
         border: 1px solid #dddddd;
         padding: 8px;
         }
         th {
         background-color: #f2f2f2;
         }
         .m_description-content {
         max-height: 140px;
         overflow: hidden;
         text-align: left;
         }
         .m_read-more {
         color: blue;
         }
         .m_popup {
         display: none;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         }
         .m_popup-content {
         background-color: #fff;
         padding: 20px;
         max-width: 600px;
         max-height: 80vh;
         overflow-y: auto;
         }
         .m_close {
         color: #aaa;
         float: right;
         font-size: 28px;
         font-weight: bold;
         }
         .m_close:hover {
         color: black;
         text-decoration: none;
         }
         .m_description-content.m_collapsed {
         max-height: 140px;
         overflow: hidden;
         }
         .m_quantity-input {
         display: flex;
         }
         .m_quantity-btn {
         display: flex;
         width: 30px;
         height: 30px;
         background-color: #f2f2f2;
         border: none;
         font-size: 18px;
         }
         .m_quantity-btn:hover {
         background-color: #e0e0e0;
         }
         .m_quantity-field {
         width: 50px;
         padding: 5px;
         text-align: center;
         border: 1px solid #dddddd;
         }
         /* for popup */
         /* CSS for styling the modal */
         .modal {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.7);
         }
         .modal-content {
         background-color: #fff;
         max-width: 400px;
         margin: 100px auto;
         padding: 20px;
         position: relative;
         border-radius: 5px;
         }
         .close {
         position: absolute;
         top: 10px;
         right: 10px;
         font-size: 24px;
         cursor: pointer;
         }
      </style>
   </head>
   <body>
      <u></u>
      <div>
         <header style="padding: 10px; text-align: center;">
            <div class="m_col-sm-12 m_col-md-12">
               <h3 style="font-weight: 700">Task 2 - Cart View Page</h3>
            </div>
         </header>
         <div class="m_wrapper">
            <div class="m_content-wrapper" style="padding: 0 25px;">
               <section class="m_content">
                  <div class="m_row">
                     <div class="m_box m_box-solid" style="padding: 0 10px; margin: 0 10px;">
                        <div class="m_box-body" style="padding: 0 10px; margin: 0 10px;">
                           <hr>
                           <div class="m_responsible-table">
                              <table>
                                 <thead>
                                    <tr>
                                       <th>Sl no.</th>
                                       <th>Product Name</th>
                                       <th>Description</th>
                                       <th>Quantity</th>
                                       <th>Price</th>
                                       <th>Tax</th>
                                       <th>Discount</th>
                                       <th>Actual Price</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach ($products as $product): ?>
                                    <tr>
                                       <td><?= $product['product_id']; ?></td>
                                       <td><?= $product['product_name']; ?></td>
                                       <td>
                                          <img src="<?= base_url($product['image']); ?>" alt="Image Description" width="100px" height="100px">
                                          <?= $product['description']; ?>
                                          <a href="#" id="openModalBtn" class="view-more" data-image-src="<?= base_url($product['image']); ?>" data-description="<?= $product['description']; ?>">View more</a>
                                       </td>
                                       <td>
                                          <a href="/cart/add/<?= $product['product_id']; ?>">Add</a>
                                          <span id="quantity_<?= $product['product_id']; ?>"><?= isset($cart[$product['product_id']]) ? $cart[$product['product_id']] : 0; ?>
                                          </span>
                                          <a href="/cart/remove/<?= $product['product_id']; ?>">Remove</a>
                                       </td>
                                       <td><?= $product['price']; ?></td>
                                       <td><?= $product['tax']; ?></td>
                                       <td><?= $product['discount']; ?></td>
                                       <td>$<?= isset($cart[$product['product_id']]) ? number_format($product['price'] * $cart[$product['product_id']], 2) : '0.00'; ?></td>
                                       <td>
                                          <form id="add-to-cart-form">
                                             <input type="hidden" name="pro_id" id="pro_id" value="<?= $product['product_id']; ?>">
                                             <input type="hidden" name="price_val" id="price_val" value="<?= $product['price']; ?>">
                                             <a class="add-to-cart-button" href="javascript:void(0);" onclick="addToCart();">Add To Cart</a>
                                          </form>
                                       </td>
                                    </tr>
                                    <?php endforeach; ?>
                                 </tbody>
                              </table>
                              <div>
                                 <table>
                                    <tr>
                                       <td><b>Grand Total:</b></td>
                                       <td style="padding-left: 20px;">$<?= !empty($grand_total) ? number_format($grand_total['grand_total'], 2) : 0.00; ?></td>
                                    </tr>
                                    <tr>
                                       <td><b>Delivery Charge:</b></td>
                                       <td style="padding-left: 20px;"><?= isset($grand_total['delivery_charge']) ? number_format($grand_total['delivery_charge'], 2) : 0.00; ?></td>
                                    </tr>
                                    <tr>
                                       <td><b>Tax Price:</b></td>
                                       <td style="padding-left: 20px;"><?= isset($grand_total['total_tax']) ? number_format($grand_total['total_tax'], 2) : 0.00; ?></td>
                                    </tr>
                                    <tr>
                                       <td><b>Total Discount:</b></td>
                                       <td style="padding-left: 20px;"><?= isset($grand_total['total_discount']) ? number_format($grand_total['total_discount'], 2) : 0.00; ?></td>
                                    </tr>
                                    <tr>
                                       <td><b>Total Price:</b></td>
                                       <td style="padding-left: 20px;">
                                          <?= 
                                             ( ( $grand_total['grand_total'] + $grand_total['delivery_charge'] + $grand_total['total_tax'])
                                             - $grand_total['total_discount'] )
                                             ?>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                              <a href="/cart/checkout">Checkout</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
      </div>
      <!-- Hidden popup -->
      <!-- Hidden Modal -->
      <div id="myModal" class="modal">
         <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <img id="modalImage" alt="Product Image" width="300px" height="300px">
            <p id="modalDescription"></p>
         </div>
      </div>
   </body>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $('.add-to-cart-button').click(function() {
      // Find the closest row to the clicked button
      var row = $(this).closest('tr');
      
      // Get product ID, price, and any other data you need from the row
      var productID = row.find('input[name="pro_id"]').val();
      var price = row.find('input[name="price_val"]').val();
      // var quantity = row.find('input[name="price_val"]').val();
      var quantity = $('#quantity_' + productID).text().trim();
      // Perform the AJAX request with the product ID and price
      $.ajax({
          url: '/cart/addToCart',
          method: 'POST',
          data: {
              product_id: productID,
              user_id: 1, // Set the user ID, e.g., from session data
              quantity: quantity, // Set the quantity, or you can have an input field for this
              price: price
          },
          success: function(response) {
              // Handle the response, e.g., show a success message to the user
              window.location.href = '/cart'; 
          },
          error: function(xhr, status, error) {
              // Handle errors, e.g., show an error message to the user
          }
      });
      });
      
      // for popup 
      $(document).ready(function() {
      // Handle "View More" link clicks
      $(".view-more").click(function() {
          // Get the image source and description data from the clicked link
          var imageSrc = $(this).data('image-src');
          var description = $(this).data('description');
      
          // Set the image source and description in the modal
          $("#modalImage").attr("src", imageSrc);
          $("#modalDescription").text(description);
      
          // Show the modal
          $("#myModal").show();
      });
      
      // Close the modal when the close button is clicked
      $("#closeModal").click(function() {
          $("#myModal").hide();
      });
      
      // Close the modal if the background is clicked
      $(window).click(function(event) {
          if (event.target === document.getElementById('myModal')) {
              $("#myModal").hide();
          }
      });
      });
      
      
   </script>
</html>