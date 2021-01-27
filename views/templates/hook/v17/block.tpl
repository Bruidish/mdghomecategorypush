{**
 * @author:  Michel Dumont <michel.dumont.io>
 * @version: 1.0.0 - 2021-01-27
 * @license: http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @package: prestashop 1.7
 *}

{if $element}
    <li class="mdghomecategorypush-item {if $element->image_hover}hasImgHover{/if}">
        <a class="mdghomecategorypush-link" href="{$element->category_link}">
            <img class="img-fluid" src="{$element->image}" alt="{$element->title}" />
            {if $element->image_hover}
                <img class="img-fluid" src="{$element->image_hover}" alt="{$element->title}" />
            {/if}
            <div class="pt-3">
                <h4 clas="h4">{$element->title}</h4>
                <div>{$element->text nofilter}</div>
            </div>
        </a>
    </li>
{/if}