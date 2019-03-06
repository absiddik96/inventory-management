<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('product/categories*') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        <p>Category</p>
    </a>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
    <i class="fas fa-tachometer-alt"></i>
        <p>
            Starter Pages
            <i class="right fa fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-circle-notch"></i>
                <p>Active Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-circle-notch"></i>
                <p>Inactive Page</p>
            </a>
        </li>
    </ul>
</li>