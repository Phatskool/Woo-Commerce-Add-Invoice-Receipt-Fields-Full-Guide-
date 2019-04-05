<script>
jQuery('select[name=parastatiko]').change(function(){
  if (jQuery('select[name=parastatiko]').val() == 'invoice'){
    jQuery('#parastatikoInfo_field').show();
    jQuery('#parastatikoInfo_field').show(function(){
            jQuery(this).addClass("validate-required");
            jQuery(this).addClass("woocommerce-validated");
            
    }); 

  }else{
    jQuery('#parastatikoInfo_field').hide();
    jQuery('#parastatikoInfo_field').hide(function(){
            jQuery(this).removeClass("validate-required");
            jQuery(this).removeClass("woocommerce-validated");
            
    });
  }
});
</script>