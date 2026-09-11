<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings')) active @endif" href="{{ url('admin/settings') }}" role="tab" aria-selected="true">Gernal</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings-product')) active @endif" href="{{ url('admin/settings') }}" role="tab" aria-selected="true">Product</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings-shipping')) active @endif" href="{{ url('admin/settings-shipping') }}" role="tab" aria-selected="true">Shipping</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings-gateway')) active @endif" href="{{ url('admin/settings-gateway') }}" role="tab" aria-selected="false">Gateway</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings-account')) active @endif" href="{{ url('admin/settings-gateway') }}" role="tab" aria-selected="false">Account & Privacy</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(Request::is('admin/settings-email')) active @endif" href="{{ url('admin/settings-email') }}" role="tab" aria-selected="false">Email</a>
    </li>
</ul>