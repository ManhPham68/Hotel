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
                    @can('list_room')
                        <li class="xtlab-ctmenu-item">
                            <i class="fa fa-arrow-down" style="margin-right: 5px"></i>
                            Room Managament
                        </li>
                    @endcan
                    <li class="xtlab-ctmenu-sub" style="display:none;padding-left: 25px">
                        <a href="{{route('Rooms.index')}}">
                            <i class="fa fa-home"></i>List Room
                        </a>
                        <a href="{{route('Room_Booking')}}">
                            <i class="fa fa-bookmark"></i>Room Booking
                        </a>
                        <a href="{{route('Room_Booked')}}">
                            <i class="fa fa-key"></i>Room Booked
                        </a>
                        <a href="{{route('Room_Finish_Booking')}}">
                            <i class="fa fa-list"></i>List Finished Booking
                        </a>
                    </li>
                </ul>
            </li>
            @can('list_guest')
                <li>
                    <a href="{{route('Guest.index')}}">
                        <i class="fa fa-send"></i>Guest - SendEmail
                    </a>
                </li>
            @endcan
            @can('list_facility')
                <li>
                    <a href="{{route('Facility.index')}}">
                        <i class="fa fa-bar-chart-o"></i>
                        Facility
                    </a>
                </li>
            @endcan
            @can('list_RoomImage')
                <li>
                    <a href="{{route('RoomImage.index')}}">
                        <i class="fa fa-instagram"></i>Room Image
                    </a>
                </li>
            @endcan
            @can('list_RoomType')
                <li>
                    <a href="{{route('RoomType.index')}}">
                        <i class="fa fa-barcode"></i>
                        Room Type
                    </a>
                </li>
            @endcan
            @can('list_RoomFacility')
                <li>
                    <a href="{{route('RoomFacility.index')}}">
                        <i class="fa fa-qrcode"></i>
                        Room Facility
                    </a>
                </li>
            @endcan
            @can('list_booking')
                <li>
                    <a href="{{route('Booking.index2')}}">
                        <i class="fa fa-chain"></i>
                        Booking
                    </a>
                </li>
            @endcan
            @can('list_slider')
                <li>
                    <a href="{{route('Slider.index')}}">
                        <i class="fa fa-quote-left"></i>
                        Slider
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>


        </ul>

    </div>

</nav>














