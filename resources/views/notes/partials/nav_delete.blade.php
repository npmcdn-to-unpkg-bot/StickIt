<nav class="navbar navbar-light navbar-full bg-faded" style="border-bottom: 1px solid #1D2127; background-color: #39444b;position: static;color: white">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <button class="btn btn-danger" v-on:click="permDeleteAll">Permanently Delete All</button>
        </li>
    </ul>
    <ul class="nav navbar-nav pull-xs-right">
        <li class="nav-item text-xs-center" style="width: 40px;padding-top: 3px;padding-left: 10px;">
            <i class="fa fa-refresh fa-spin fa-2x fa-fw" v-show="loading"></i>
        </li>
    </ul>
</nav>