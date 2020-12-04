<style>
    .xt-ct-menu {
        position: relative;
        display: none;
    }

    .xtlab-ctmenu-item {
        background-color: #09192a;
        color: white;
        padding: 10px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .xtlab-ctmenu-item:hover, .xtlab-ctmenu-item:focus {
        background-color: #9c3328;
    }

    .xtlab-ctmenu-sub {
        display: none;
        position: absolute;
        background-color: #09192a;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    }

    .xtlab-ctmenu-sub a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: none;
    }

    .xtlab-ctmenu-sub a:hover {
        background-color: #225081;
        border: none;

    }
</style>

<a id="to" href="#" style="display: none;font-size: 30px;margin-left: 20px">
    <i class="fa fa-arrow-right"></i>
</a>
<nav class="navbar-default navbar-side" id="sidebar_test" style="font-size: 16px">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="menu1 xt-ct-menu">
                <ul class="nav">
                    <li class="xtlab-ctmenu-item">
                        <a href="{{route('frontend_index')}}">
                            <i class="fa fa-arrow-left" style="margin-right: 5px"></i>
                            Home
                        </a>

                    </li>
                </ul>
            </li>

        </ul>

    </div>

</nav>














