<div class="d-flex" id="wrapper">
		
    <!-- Sidebar-->
                <div class="border-end bg-white" id="sidebar-wrapper">
                    <div class="sidebar-heading border-bottom bg-light">Sort by Categories</div>
                    <div class="list-group list-group-flush">
                        <div class="container">
                            <form action="/home/category" method="post">
                                <?= csrf_field() ?>
                                
                                <label for="category">Choose Category:</label>
                                <select class="form-select" id="category" name="category" onchange="this.form.submit()">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="all">All</option>
                                    <?php foreach($categories as $category){ ?>
                                    <option <?php echo set_select('category', $category->category_id);?> value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                                    <?php } ?>
                                </select>
                           </form>
                        </div>   
                        <div class="container">
                            <form action="/home/subcategory" method="post">
                                <?= csrf_field() ?>
                                
                                <label for="subcategory_id">Choose Subcategory:</label>
                                <select class="form-select" id="subcategory_id" name="subcategory_id" onchange="this.form.submit()">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <?php foreach($subcategories as $subcategory){ ?>
                                    <option <?php echo set_select('subcategory_id', $subcategory->subcategory_id);?> value="<?php echo $subcategory->subcategory_id; ?>"><?php echo $subcategory->subcategory_name; ?></option>
                                    <?php } ?>
                                </select>
                           </form>
                        </div>
                    </div>
                </div>

    <!-- Page content wrapper-->
    <div id="page-content-wrapper">

        <!-- Navbar -->