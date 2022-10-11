<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div class="container">
    <div style="text-align: center;">
        <a style="text-align: center;" class="btn btn-success" href="/products/create">Add new Product</a>
    </div>

    <table class="table table-bordered table-hover">
        <tbody>  
           <tr>  
              <td>ID</td>  
              <td>Product Name</td>
              <td>Product Description</td>
              <td>Product Image</td>
              <td>Product Price</td>
              <td>Available Quantity</td> 
              <td>Subcategory (ID)</td> 
              <td>Created At</td> 
              <td>Updated At</td>
              <td>Added By</td>
              <td>Is Deleted?</td>
              <td>Edit</td>  
              <td>Delete</td>  
           </tr>  

           <?php foreach($products as $product){ ?>

           <tr>  
              <td><?php echo $product->product_id; ?></td>  
              <td><?php echo $product->product_name; ?></td>
              <td><?php echo $product->product_description; ?></td> 
              <td>
                  <img src="<?= base_url("uploads/".$product->product_image);?>" height="100px" width="100px" alt="product image">
              </td> 
              <td><?php echo $product->product_price; ?></td> 
              <td><?php echo $product->available_quantity; ?></td> 
              <td><?php echo $product->subcategory_id; ?></td> 
              <td><?php echo $product->created_at; ?></td> 
              <td><?php echo $product->updated_at; ?></td> 
              <td><?php echo $product->added_by; ?></td> 
              <td><?php echo $product->is_deleted; ?></td>
              <td><a class="btn btn-sm btn-primary" href="/products/edit/<?= $product->product_id; ?>">Edit</a></td>
              <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/products/delete/<?= $product->product_id; ?>">Delete</a></td>
           </tr>  

           <?php } ?>
        </tbody>  
     </table> 
</div>
