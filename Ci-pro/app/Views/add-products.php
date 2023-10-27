<!DOCTYPE html>
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
         header {
         padding: 10px;
         }
         .container {
         max-width: 800px;
         margin: 0 auto;
         padding: 20px;
         }
         h3 {
         font-weight: 700;
         }
         label {
         font-weight: 600;
         }
         .form-control {
         width: 100%;
         padding: 10px;
         margin-top: 5px;
         }
         textarea {
         width: 100%;
         padding: 10px;
         }
         input[type="checkbox"] {
         margin-right: 8px;
         }
         .tax-select,
         .delivery-input,
         .discount-input {
         display: none;
         }
         button {
         background-color: #007BFF;
         color: #fff;
         border: none;
         padding: 10px;
         cursor: pointer;
         }
         button:hover {
         background-color: #0056b3;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <header>
            <div class="row">
               <div class="col-sm-12 col-md-12">
                  <div class="col-sm-6 col-md-6" style="text-align: center">
                     <h3>Task 1 - Insert Product</h3>
                  </div>
               </div>
            </div>
         </header>
         <form action="<?= base_url('product/submitForm') ?>" id="product-form" name="product-form" method="post" enctype="multipart/form-data">
            <div class="row">
               <label for="product-name" class="col-sm-2 col-form-label">Product Name:</label>
               <div class="col-sm-10 col-md-4">
                  <input type="text" name="product_name" id="product_name" class="form-control" required>
               </div>
            </div>
            <div class="row">
               <label for="category" class="col-sm-2 col-form-label">Category:</label>
               <div class="col-sm-10 col-md-4">
                  <input type="text" name="category" id="category" class="form-control" required>
               </div>
            </div>
            <div class="row">
               <label for="price" class="col-sm-2 col-form-label">Price:</label>
               <div class="col-sm-10 col-md-4">
                  <input type="text" name="price" id="price" class="form-control" required>
               </div>
            </div>
            <div class="row">
               <label for="description" class="col-sm-2 col-form-label">Description:</label>
               <div class="col-sm-10 col-md-4">
                  <textarea class="form-control" rows="5" name="Description" id="Description" required></textarea>
               </div>
            </div>
            <div class="row">
               <label for="image" class="col-sm-2 col-form-label">Image:</label>
               <div class="col-sm-10 col-md-4">
                  <input class="form-control" name="file" id="file" type="file" style="width: 250px; display: inline">
               </div>
            </div>
            <div class="row">
               <div class="col-sm-10 col-md-4">
                  <div class="col-md-6">
                     <h5>
                        <input type="checkbox" name="tax-checkbox" id="tax-checkbox" class="checktax">
                        <b>Is Taxable</b>
                     </h5>
                  </div>
                  <div class="tax-select col-md-6 taxcheckbox">
                     <select name="tax" id="tax">
                        <option value="18">18%</option>
                        <option value="16">16%</option>
                        <option value="12">12%</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-10 col-md-4">
                  <div class="col-sm-12 col-md-6">
                     <h5>
                        <input type="checkbox" id="delivery-checkbox" name="delivery-checkbox" class="checkdelivery">
                        <b>Apply Delivery Charges</b>
                     </h5>
                  </div>
                  <div class="delivery-input col-sm-12 col-md-6 deliverycheckbox">
                     <b>Rs.</b>
                     <input type="text" id="rs" name="rs" class="form-control">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-10 col-md-4">
                  <div class="col-sm-12 col-md-6">
                     <h5>
                        <input type="checkbox" id="discount-checkbox" name="discount-checkbox" class="checkdiscount">
                        <b>Apply Discount
                        <span style="font-weight: 100"><b>(in %)</b></span></b>
                     </h5>
                  </div>
                  <div class="discount-input col-sm-12 col-md-6 discountcheckbox">
                     <input type="text" id="per" name="per" class="form-control">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6" style="margin-top: 8px; margin-left: 10px">
                  <div class="col-sm-6 col-md-4"></div>
                  <button type="submit" class="btn btn-primary" style="width: 100px">
                  Insert
                  </button>
               </div>
            </div>
         </form>
      </div>
   </body>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
          $('.checktax').click(function() {
              if($('#tax-checkbox').is(":checked")) {
                      $('.taxcheckbox').show();
              } else {
                  $('.taxcheckbox').hide();
              }
          });
          $('.checkdelivery').click(function() {
              if($('#delivery-checkbox').is(":checked")) {
                  $('.deliverycheckbox').show();
              } else {
                  $('.deliverycheckbox').hide();
              }
          });
          $('.checkdiscount').click(function() {
              if($('#discount-checkbox').is(":checked")) {
                  $('.discountcheckbox').show();
              } else {
                  $('.discountcheckbox').hide();
              }
          });
          $("#product-form").submit(function(e) {
              e.preventDefault(); // Prevent the default form submission
              $.ajax({
                  url: "<?= base_url('product/submitForm') ?>", // Update the URL to your CodeIgniter controller method
                  type: "POST",
                  data:  new FormData(this), 
                  processData: false, 
                  contentType: false,
                  dataType:"JSON",
                  cache:false, 
                  success: function(response) {
                  if (response.success) {
                          // Show a success message to the user
                          alert('Data saved successfully');
                          window.location.href = '/products'; 
                      } else {
                          // Handle errors, e.g., validation errors or database insertion issues
                          alert('Error: ' + response.message);
                      }
                  }
              });
          });
      });
   </script>
</html>