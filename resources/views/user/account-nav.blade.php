<ul class="account-nav">
    <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
    <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Narudžbe</a></li>
    <li><a href="{{route('wishlist.index')}}" class="menu-link menu-link_us-s">Omiljeni artikli</a></li>
    <li><a href="{{route('user.addresses')}}" class="menu-link menu-link_us-s">Adrese</a></li>
    <li>
        <form method="POST" action="{{route('logout')}}" id="logout-form">
            @csrf
            <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Odjava</a>
        </form>
    </li>
</ul>
