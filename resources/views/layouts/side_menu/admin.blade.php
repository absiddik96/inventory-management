<!-- User Management -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link {{ Request::is('admin/users*') || Request::is('admin/suppliers*') || Request::is('admin/dealers*') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <p>
            User Management
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Users -->
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i class="fa fa-circle-notch"></i>
                <p>Users</p>
            </a>
        </li>
        <!-- Suppliers -->
        <li class="nav-item">
            <a href="{{ route('admin.suppliers.index') }}"
                class="nav-link {{ Request::is('admin/suppliers*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Suppliers</p>
            </a>
        </li>
        <!-- Dealers -->
        <li class="nav-item">
            <a href="{{ route('admin.dealers.index') }}"
                class="nav-link {{ Request::is('admin/dealers*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Dealers</p>
            </a>
        </li>
        <!-- staff -->
        <li class="nav-item">
            <a href="{{ route('admin.staffs.index') }}"
                class="nav-link {{ Request::is('admin/staffs*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Staff</p>
            </a>
        </li>
    </ul>
</li>

<!-- Product Management -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link {{ Request::is('admin/packet-sizes*') || Request::is('admin/product/categories*') || Request::is('admin/products*') ? 'active' : '' }}">
        <i class="fab fa-product-hunt"></i>
        <p>
            Product Management
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Packet Sizes -->
        <li class="nav-item">
            <a href="{{ route('admin.packet-sizes.index') }}"
                class="nav-link {{ Request::is('admin/packet-sizes*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Packet Sizes</p>
            </a>
        </li>
        <!-- Product Category -->
        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}"
                class="nav-link {{ Request::is('admin/product/categories*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Category</p>
            </a>
        </li>
        <!-- Product -->
        <li class="nav-item">
            <a href="{{ route('admin.products.index') }}"
                class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Product</p>
            </a>
        </li>
    </ul>
</li>

<!-- Banks Management -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link {{ Request::is('admin/banks*') || Request::is('admin/bankbranchs*') || Request::is('admin/bank-accounts*') || Request::is('admin/bank-transactions*') ? 'active' : '' }}">
        <i class="fas fa-university"></i>
        <p>
            Banking System
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Banks -->
        <li class="nav-item">
            <a href="{{ route('admin.banks.index') }}"
                class="nav-link {{ Request::is('admin/banks*') ? 'active' : '' }}">
                <i class="fa fa-circle-notch"></i>
                <p>Banks</p>
            </a>
        </li>
        <!-- Bank Branchs -->
        <li class="nav-item">
            <a href="{{ route('admin.bankbranchs.index') }}"
                class="nav-link {{ Request::is('admin/bankbranchs*') ? 'active' : '' }}">
                <i class="fa fa-circle-notch"></i>
                <p>Bank Branchs</p>
            </a>
        </li>
        <!-- Bank Accounts -->
        <li class="nav-item">
            <a href="{{ route('admin.bank-accounts.index') }}"
                class="nav-link {{ Request::is('admin/bank-accounts*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Bank Accounts</p>
            </a>
        </li>
        <!-- Bank Transactions -->
        <li class="nav-item">
            <a href="{{ route('admin.bank-transactions.index') }}"
                class="nav-link {{ Request::is('admin/bank-transactions*') ? 'active' : '' }}">
                <i class="fas fa-circle-notch"></i>
                <p>Bank Transactions</p>
            </a>
        </li>
    </ul>
</li>

<!-- Bulk Stock -->
<li class="nav-item">
    <a href="{{ route('admin.bulk-stock.index') }}"
        class="nav-link {{ Request::is('admin/bulk-stock*') ? 'active' : '' }}">
        <i class="fab fa-bitbucket"></i>
        <p>Bulk Stock</p>
    </a>
</li>

<!--Stock -->
<li class="nav-item">
    <a href="{{ route('admin.stocks.index') }}" class="nav-link {{ Request::is('admin/stocks*') ? 'active' : '' }}">
        <i class="fas fa-layer-group"></i>
        <p>Stock</p>
    </a>
</li>