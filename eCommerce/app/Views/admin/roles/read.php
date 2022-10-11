<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/roles/create">Add new role</a>
</div>

<table class="table table-bordered table-hover">
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>Role Name</td> 
          <td>Is Deleted?</td> 
          <td>Edit</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($roles as $role){ ?>
       
       <tr>  
          <td><?php echo $role->role_id; ?></td>  
          <td><?php echo $role->role_name; ?></td> 
          <td><?php echo $role->is_deleted; ?></td>
          <td><a class="btn btn-sm btn-primary" href="/roles/edit/<?= $role->role_id; ?>">Edit</a></td>
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/roles/delete/<?= $role->role_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table>  
