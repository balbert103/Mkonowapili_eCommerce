<?php if (session()->get('message')): ?>
    <div class="alert <?= session()->get('alert-class') ?>" role="alert">
      <?= session()->get('message') ?>
    </div>
<?php endif; ?>
<br />
<div class="container">
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="/subcategories/create">Add new subcategory</a>
</div>
<div class="form-group">
    <form action="/subcategories" method="post">
        <label for="category">Filter by Category:</label>
        <select class="form-select" id="category" name="category" onchange="this.form.submit()">
          <option value="" selected disabled hidden>Choose here</option>
          <option value="all">All</option>
          <?php foreach($categories as $category){ ?>
          <option <?php echo set_select('category', $category->category_id);?> value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
          <?php } ?>
        </select>
    </form>
</div>
<table class="table table-bordered table-hover">
    <tbody>  
       <tr>  
          <td>ID</td>  
          <td>Subcategory Name</td> 
          <td>Category</td> 
          <td>Is Deleted?</td> 
          <td>Edit</td>  
          <td>Delete</td>  
       </tr>  
       
       <?php foreach($subcategories as $subcategory){ ?>
       
       <tr>  
          <td><?php echo $subcategory->subcategory_id; ?></td>  
          <td><?php echo $subcategory->subcategory_name; ?></td> 
          <td><?php echo $subcategory->category; ?></td> 
          <td><?php echo $subcategory->is_deleted; ?></td>
          <td><a class="btn btn-sm btn-primary" href="/subcategories/edit/<?= $subcategory->subcategory_id; ?>">Edit</a></td>
          <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="/subcategories/delete/<?= $subcategory->subcategory_id; ?>">Delete</a></td>
       </tr>  
          
       <?php } ?>
    </tbody>  
 </table> 
</div>
