<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/categories/create">Add new category</a>
</div>

<table class="table table-bordered table-hover">
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>Category Name</td> 
          <td>Is Deleted?</td> 
          <td>Edit</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($categories as $category){ ?>
       
       <tr>  
          <td><?php echo $category->category_id; ?></td>  
          <td><?php echo $category->category_name; ?></td> 
          <td><?php echo $category->is_deleted; ?></td>
          <td><a class="btn btn-sm btn-primary" href="/categories/edit/<?= $category->category_id; ?>">Edit</a></td>
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/categories/delete/<?= $category->category_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table>  
