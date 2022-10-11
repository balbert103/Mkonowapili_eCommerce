<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div class="container">
    <div style="text-align: center;">
        <a style="text-align: center;" class="btn btn-success" href="/admin-user/create">Add New User</a>
    </div>

    <table class="table table-bordered table-hover">
        <tbody>  
           <tr>  
              <td>ID</td>  
              <td>First Name</td>
              <td>Last Name</td>
              <td>Email</td>
              <td>Gender</td>
              <td>Role</td> 
              <td>Is Deleted?</td>
              <td>Edit</td>  
              <td>Delete</td>  
           </tr>  

           <?php foreach($users as $user){ ?>

           <tr>  
              <td><?php echo $user->user_id; ?></td>  
              <td><?php echo $user->first_name; ?></td>
              <td><?php echo $user->last_name; ?></td> 
              <td><?php echo $user->email; ?></td> 
              <td><?php echo $user->gender; ?></td> 
              <td><?php echo $user->role; ?></td> 
              <td><?php echo $user->is_deleted; ?></td>
              <td><a class="btn btn-sm btn-primary" href="/admin-user/edit/<?= $user->user_id;; ?>">Edit</a></td>
              <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/admin-user/delete/<?= $user->user_id; ?>">Delete</a></td>
           </tr>  

           <?php } ?>
        </tbody>  
     </table> 
</div>
