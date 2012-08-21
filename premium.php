<?php
if($_GET['td'] == 'hide') 
{
update_option('acx_widget_si_td', "hide");
?>
<style type='text/css'>
#acx_td
{
display:none;
}
</style>
<div class="error" style="background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
Thanks again for using the plugin. we will never show the mesage again.
</div>
<?php
}
?>
<div id="acx_help_page">
<p><b>This Plugin is the basic widget version of floating social media icon wordpress plugin. This plugin only support the icon pack and the widget. Premium Version of This plugin includes all the features of floating social media icon and a lot more. Premium version is same as the premium version of floating social media icon wordpress plugin.</b></p>
<?php 
socialicons_widget_comparison();
socialicons_widget_comparison(1);
?>
</div>