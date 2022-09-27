<script src="<?php echo $base_url_js;?>vendor/jquery-min.js"></script>
<script src="<?php echo $base_url_js;?>vendor/js.cookie.js"></script>
<!--Including Javascript-->
<script src="<?php echo $base_url_js;?>plugins.js"></script>
<script src="<?php echo $base_url_js;?>main.js"></script>

<?php include  $full_path_2.'common/common-function.php';?>
<script type="text/javascript">
$(document).ready(function(){    
    var count = 0;
    $('#Nnav, #dd').mouseenter(function() {
        count++;
        $('#dd').show();
    });
    
    $('#Nnav, #dd').mouseleave(function() {
        count--;
        if (count == 0) { 
            $('#dd').hide();
        }
    });
});

function closeModel()
{
    $("div").removeClass("modal-backdrop fade show");
    $('#minicart-drawer').css('display','none');
    $('#shipping_address_model').css('display','none');
    $('#edit_address_model').css('display','none');
}

</script>

<script type="text/javascript" src="<?php echo $base_url_js;?>plugins/growl/jquery.growl.js"></script>
<script type="text/javascript" src="<?php echo $base_url_js;?>plugins/parsley/parsley.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url_js;?>plugins/loaders/blockui.min.js"></script>
<script src="<?php echo $base_url_js;?>plugins/notifybar/jquery.notifyBar.js"></script>