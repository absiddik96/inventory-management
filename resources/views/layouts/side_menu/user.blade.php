{{--Stock --}}
<li class="nav-item">
    <a href="{{ route('user.sell-products.index') }}" class="nav-link {{ Request::is('admin/sell-products*') ? 'active' : '' }}">
        <i class="fas fa-database"></i>
        <p>Sell Product</p>
    </a>
</li>