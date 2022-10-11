<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<?php if (session()->get('role') == 1) { ?>
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/api-product-path/create">Add new API product path</a>
</div>
<?php }?>
<br />
<table class="table table-bordered table-hover">
    <h1 style="text-align: center;">API Product Paths Table</h1>
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>Path</td> 
          <td>Added By</td> 
          <td>Created At</td>
          <td>Updated At</td>
          <td>Is Deleted</td>
          <?php if (session()->get('role') == 1) {?>
            <td>Edit</td>  
            <td>Delete</td> 
          <?php } ?>
       </tr>  
       
       <?php foreach($api_productpaths as $api_productpath){ ?>
       
       <tr>  
          <td><?php echo $api_productpath->apiproductpath_id; ?></td>
          <td><?php echo $api_productpath->path; ?></td>
          <td><?php echo $api_productpath->added_by; ?></td>
          <td><?php echo $api_productpath->created_at; ?></td>
          <td><?php echo $api_productpath->updated_at; ?></td>
          <td><?php echo $api_productpath->is_deleted; ?></td>  
          <?php if (session()->get('role') == 1) {?>
            <td><a class="btn btn-sm btn-primary" href="/api-product-path/edit/<?= $api_productpath->apiproductpath_id; ?>">Edit</a></td>
            <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/api-product-path/delete/<?= $api_productpath->apiproductpath_id; ?>">Delete</a></td>
          <?php } ?>
       </tr>     
       <?php } ?>
    </tbody>  
 </table>  
