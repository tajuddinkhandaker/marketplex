
<li class="mdl-menu__item">
    <a class="mdl-navigation__link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
        <i class="material-icons" role="presentation">exit_to_app</i>Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>