<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('AdminLTE-3.0.5/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('AdminLTE-3.0.5/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item listen">
                            <a href="{{route('Rooms.index')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room</p>
                            </a>
                        </li>
                        <li class="nav-item listen">
                            <a href="{{route('RoomImage.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Image</p>
                            </a>
                        </li>
                        <li class="nav-item listen">
                            <a href="{{route('RoomType.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Type</p>
                            </a>
                        </li>
                        <li class="nav-item listen">
                            <a href="{{route('Facility.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Facility</p>
                            </a>
                        </li>
                        <li class="nav-item listen">
                            <a href="{{route('RoomFacility.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Facility</p>
                            </a>
                        </li>
                        <li class="nav-item listen">
                            <a href="{{route('Guest.index2')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Guest</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <script type="text/javascript">
        var btnContainer = document.getElementsByClassName("listen");

        // Get all buttons with class="btn" inside the container
        for (var i = 0; i < btnContainer.length; i++){
            var btns = btnContainer.getElementsByClassName("nav-link");
        }
        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
    <!-- /.sidebar -->
</aside>
