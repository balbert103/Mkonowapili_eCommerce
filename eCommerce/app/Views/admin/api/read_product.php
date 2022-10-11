<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/api-product/create">Add new API product</a>
</div>
<br />
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/api-product-path/read">View API Product Paths</a>
</div>
<br />

<table class="table table-bordered table-hover">
    <h1 style="text-align: center;">API Products Table</h1>
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>Product Name</td> 
          <td>Added By</td> 
          <td>Created At</td>
          <td>Updated On</td>
          <td>Is Deleted</td>
          <td>Edit</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($api_products as $api_product){ ?>
       
       <tr>  
          <td><?php echo $api_product->apiproduct_id; ?></td>
          <td><?php echo $api_product->productname; ?></td>  
          <td><?php echo $api_product->added_by; ?></td>  
          <td><?php echo $api_product->created_at; ?></td>  
          <td><?php echo $api_product->updated_on; ?></td>  
          <td><?php echo $api_product->is_deleted; ?></td>  
          <td><a class="btn btn-sm btn-primary" href="/api-product/edit/<?= $api_product->apiproduct_id; ?>">Edit</a></td>
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/api-product/delete/<?= $api_product->apiproduct_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table>  
