{*
* Sovendus Admin Settings Template
*}

<div class="panel">
  <div class="panel-heading">
    <i class="icon-cogs"></i> {l s='Sovendus Settings' mod='ps_sovendus'}
  </div>

  <div class="panel-body">
    <div id="sovendus-settings-container" data-save-url="{$saveUrl|escape:'html':'UTF-8'}"
      data-nonce="{$nonce|escape:'html':'UTF-8'}">
      <!-- React app will be rendered here -->
    </div>
  </div>
</div>

<script type="text/javascript">
  window.sovendusSettings = {
    settings: {if isset($sovendusSettings.settings)}{$sovendusSettings.settings|@json_encode}{else}{ldelim}"version":"3"{rdelim}{/if},
    ajaxurl: "{if isset($sovendusSettings.ajaxurl)}{$sovendusSettings.ajaxurl|escape:'javascript':'UTF-8'}{else}{$saveUrl|escape:'javascript':'UTF-8'}{/if}",
    nonce: "{if isset($sovendusSettings.nonce)}{$sovendusSettings.nonce|escape:'javascript':'UTF-8'}{else}{$nonce|escape:'javascript':'UTF-8'}{/if}"
  };
</script>

<script type="text/javascript"
  src="{if isset($baseUrl)}{$baseUrl}{else}{$smarty.const._PS_BASE_URL_}{$smarty.const.__PS_BASE_URI__}{/if}modules/ps_sovendus/views/js/admin_settings.js">
</script>