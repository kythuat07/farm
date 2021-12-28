<!-- <script src="<?=URLPATH ?>assets/jquery/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>
<script src="<?=URLPATH ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script src="<?=URLPATH?>assets/bootbox/bootbox.all.min.js"></script>
<script src="<?=URLPATH ?>assets/my/scripts/all.min.js?v=<?= time() ?>"></script> -->


    
<script src='assets/jquery.min.js' type='text/javascript'></script>
    <script>
        window.shop = {
            template: "index",
            moneyFormat: "{{amount}}₫",
            shopCurrency: "VND",
            shopSetting: {},
            collectionSortBy: "manual",
        };
    </script>
<script>
jQuery(document).ready(function($) {
    setTimeout(function() {
        if (sessionStorage.mega_popup == null) {
            $('#insPopupNewletter').addClass('active');
        }
    }, 500)
    $("#popup-newletter form").submit(function(e) {
        e.preventDefault();
        $.post('/account/contact', {
            form_type: "customer",
            utf8: "✓",
            "contact": {
                "tags": "Khách hàng đăng ký nhận bản tin",
                "first_name": '',
                "last_name": '',
                "email": $(this).find('input[name="contact[email]"]').val()
            }
        }, function(r) {
            $('#insPopupNewletter').removeClass('active');
            swal({
                title: "Hoàn thành!",
                text: "Đăng ký bản tin thành công...",
                icon: "success",
                button: "Đóng",
            })
        });
    });
});
$(document).on('click', '.overlay, .close_newletter', function(e) {
    e.preventDefault();
    $('#insPopupNewletter').removeClass('active');
    sessionStorage.mega_popup = 'show';
})
</script>
<script src='assets/jquery.countdown.min.js' type='text/javascript'></script>
<script src='assets/plugins.js' type='text/javascript'></script>
<script src='assets/inspired.js' type='text/javascript'></script>