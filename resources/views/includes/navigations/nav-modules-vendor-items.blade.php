<a class="mdl-navigation__link" href="{{ route($module->route, [ 'api_token' => Auth::user()->api_token ]) }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">{{ $module->icon_label }}</i>{{ $module->name }}</a>