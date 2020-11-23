<!-- /. WRAPPER  -->

<!-- active href -->
<script>
    $(function () {
        $('#collapse').click(function () {
            $('#page-wrapper').css({
                "marginLeft": "80px",
                "transition": "1s"
            });
            $('#main-menu').hide(300);
            $('#to').show(300);
            $('#collapse').hide(300);
        });
        $('#to').click(function () {
            $('#main-menu').show(300);
            $('#page-wrapper').css({
                "marginLeft": "260px",
                "transition": "1s"
            });
            $('#to').hide();
            $('#collapse').show(300);
        });
    });
</script>
<script>
    $(function () {
        var path = window.location.href;
        $('.nav li a').each(function () {
            if (this.href === path) {
                $(this).addClass('active-menu');
            }
        });
    })
</script>

<!-- Bootstrap Js -->
<script src="{{asset('Admin/assets/js/bootstrap.min.js')}}"></script>
<!-- Metis Menu Js -->
<script src="{{asset('Admin/assets/js/jquery.metisMenu.js')}}"></script>
<!-- Morris Chart Js -->
<script src="{{asset('Admin/assets/js/morris/raphael-2.1.0.min.js')}}"></script>
<script src="{{asset('Admin/assets/js/morris/morris.js')}}"></script>
<!-- Custom Js -->

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
