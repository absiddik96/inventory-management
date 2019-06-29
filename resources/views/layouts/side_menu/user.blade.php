<!-- Stock -->
<li class="nav-item">
    <a href="{{ route('user.sell-products.index') }}" class="nav-link {{ Request::is('sell-products*') ? 'active' : '' }}">
        <i class="fas fa-luggage-cart"></i>
        <p>Sell Product</p>
    </a>
</li>