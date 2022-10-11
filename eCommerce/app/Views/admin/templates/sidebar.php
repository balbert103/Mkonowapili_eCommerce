<div class="d-flex" id="wrapper">
		
    <!-- Sidebar-->
                <div class="border-end bg-white" id="sidebar-wrapper">
                    <div class="sidebar-heading border-bottom bg-light">Mkonowapili</div>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/dashboard">Dashboard</a>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/roles">Roles</a>' : "" ;?>
                        <?php echo (session()->get('role') == 2) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/wallet">My Wallet</a>' : "" ;?>
                        <?php echo (session()->get('role') == 2) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/purchase-history">Purchase History</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/categories">Categories</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/subcategories">Subcategories</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/products">Products</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/admin-user">Users</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/api-product/read">API</a>' : "" ;?>
                        <?php echo (session()->get('role') == 1) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="#">Reports</a>' : "" ;?> 
                        <?php echo (session()->get('role') == 3) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/api-user/read">API User</a>' : "" ;?>
                        <?php echo (session()->get('role') == 3) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/api-product-path/read">API Products Paths</a>' : "" ;?>
                        <?php echo (session()->get('role') == 3) ? '<a class="list-group-item list-group-item-action list-group-item-light p-3" href="/api-token/read">Subscribed API Products</a>' : "" ;?>
                    </div>
                </div>

    <!-- Page content wrapper-->
    <div id="page-content-wrapper">

        <!-- Navbar -->