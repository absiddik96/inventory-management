<li class="nav-item">
    <a href="{{ route('admin.banks.index') }}" class="nav-link {{ Request::is('admin/banks*') ? 'active' : '' }}">
        <i class="fa fa-university"></i>
        <p>Banks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.bankbranchs.index') }}" class="nav-link {{ Request::is('admin/bankbranchs*') ? 'active' : '' }}">
        <i class="fa fa-university"></i>
        <p>Bank Branchs</p>
    </a>
</li>