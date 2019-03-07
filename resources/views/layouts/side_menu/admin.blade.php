{{-- Banks --}}
<li class="nav-item">
    <a href="{{ route('admin.banks.index') }}" class="nav-link {{ Request::is('admin/banks*') ? 'active' : '' }}">
        <i class="fa fa-university"></i>
        <p>Banks</p>
    </a>
</li>

{{-- Bank Branchs --}}
<li class="nav-item">
    <a href="{{ route('admin.bankbranchs.index') }}" class="nav-link {{ Request::is('admin/bankbranchs*') ? 'active' : '' }}">
        <i class="fa fa-university"></i>
        <p>Bank Branchs</p>
    </a>
</li>

{{-- Bank Accounts --}}
<li class="nav-item">
    <a href="{{ route('admin.bank-accounts.index') }}" class="nav-link {{ Request::is('admin/bank-accounts*') ? 'active' : '' }}">
        <i class="fas fa-circle-notch"></i>
        <p>Bank Accounts</p>
    </a>
</li>