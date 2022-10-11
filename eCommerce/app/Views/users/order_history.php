<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<?php if ($orders) { ?>
<table class="table table-bordered table-hover">
    <tbody>  
       <tr>  
          <td>Product Name</td>  
          <td>Product Price</td> 
          <td>Order Quantity</td> 
          <td>Order Total</td>
          <td>Purchase Date</td> 
       </tr>  
       
       
       <?php foreach($orders as $order){ ?>
       
       <tr>  
          <td><?php echo $order->product_name; ?></td>  
          <td><?php echo $order->product_price; ?></td> 
          <td><?php echo $order->order_quantity; ?></td>
          <td><?php echo $order->orderdetails_total; ?></td>
          <td><?php echo $order->updated_at; ?></td>
       </tr>  
          
       <?php } ?>
       
    </tbody>  
 </table>  
<?php } else { ?>
<h1>No Purchases made yet</h1>
<?php } ?>
