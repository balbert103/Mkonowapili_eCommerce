<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />

<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/api-user/create">Add new API User</a>
</div>
<br />
<table style="table-layout: fixed;" class="table table-responsive table-bordered table-hover">
    <h1 style="text-align: center;">API User Table</h1>
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>username</td> 
          <td>key</td> 
          <td>Created At</td>
          <td>Updated On</td>
          <td>Added By</td>
          <td>Is Deleted</td>
          <td>Edit</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($api_users as $api_user){ ?>
       
       <tr>  
          <td><?php echo $api_user->apiuser_id; ?></td>
          <td><?php echo $api_user->username; ?></td>
          <td style="overflow: auto;"><?php echo $api_user->key; ?></td>
          <td><?php echo $api_user->created_at; ?></td>
          <td><?php echo $api_user->updated_on; ?></td>
          <td><?php echo $api_user->added_by; ?></td>
          <td><?php echo $api_user->is_deleted; ?></td>
          
          <td><a class="btn btn-sm btn-primary" href="/api-user/edit/<?= $api_user->apiuser_id; ?>">Edit</a></td>
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/api-user/delete/<?= $api_user->apiuser_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table>  
