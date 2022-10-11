<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/api-token/create">Subscribe to API Product</a>
</div>
<br />

<table style="table-layout: fixed;" class="table table-bordered table-hover">
    <h1 style="text-align: center;">Subscribed API Products Table</h1>
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>API User</td> 
          <td>API Product</td> 
          <td>Token</td>
          <td>Created At</td>
          <td>Expires On</td>
          <td>Is Deleted</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($api_tokens as $api_token){ ?>
       
       <tr>  
          <td><?php echo $api_token->apitoken_id; ?></td>
          <td><?php echo $api_token->username; ?></td>  
          <td><?php echo $api_token->productname; ?></td>  
          <td style="overflow: auto;"><?php echo $api_token->api_token; ?></td>  
          <td><?php echo $api_token->created_at; ?></td>  
          <td><?php echo $api_token->expires_on; ?></td> 
          <td><?php echo $api_token->is_deleted; ?></td>  
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/api-token/delete/<?= $api_token->apitoken_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table>  
