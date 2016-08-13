<div class="card">
    <div class="card-header" style="background: #1D2127;color: white;">
        Settings
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item @if($active == 'profile') active @endif">
            <a href="{{ action('AccountController@getProfileSettings') }}">Profile</a>
        </li>
        <li class="list-group-item @if($active == 'security') active @endif">
            <a href="{{ action('AccountController@getSecuritySettings') }}">Security</a>
        </li>
        <li class="list-group-item @if($active == 'note') active @endif">
            <a href="{{ action('AccountController@getNoteSettings') }}">Note</a>
        </li>
    </ul>
</div>
