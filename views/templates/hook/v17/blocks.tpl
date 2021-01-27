{**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2021-01-27
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.7
 *}

{if $elements}
  <div id="mdghomecategorypush-wrap" class="row">
    <ul class="col-xs-12">
      {foreach $elements as $element}
        {include "module:mdghomecategorypush/views/templates/hook/v17/block.tpl"}
      {/foreach}
    </ul>
  </div>
{/if}