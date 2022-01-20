{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<link
        rel="stylesheet"
        href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
/>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>



{if $homeslider.slides}

  <div class="carousel carousel-inner" id="carousel">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      {foreach from=$homeslider.slides item=slide name='homeslider'}
        <li class="carousel-item swiper-slide {if $smarty.foreach.homeslider.first}active{/if}" role="option" aria-hidden="{if $smarty.foreach.homeslider.first}false{else}true{/if}">
          <a href="{$slide.url}">
            <figure>
              <img src="{$slide.image_url}" alt="{$slide.legend|escape}" loading="lazy" width="1110" height="340">
              {if $slide.title || $slide.description}
                <figcaption class="caption">
                  <h2 class="display-1 text-uppercase">{$slide.title}</h2>
                  <div class="caption-description">{$slide.description nofilter}</div>
                </figcaption>
              {/if}
            </figure>
          </a>
        </li>
      {/foreach}
{*      <div class="swiper-slide">Slide 1</div>*}
{*      <div class="swiper-slide">Slide 2</div>*}
{*      <div class="swiper-slide">Slide 3</div>*}
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

  </div>

{*  <div id="carousel" data-ride="carousel" class="carousel slide" data-interval="{$homeslider.speed}" data-wrap="{(string)$homeslider.wrap}" data-pause="{$homeslider.pause}" data-touch="true">*}
{*      <h1>OKAY LET'S GO, DES PRODUITS DE HAUTE QUALITÉ</h1>*}
{*    <ol class="carousel-indicators">*}
{*      {foreach from=$homeslider.slides item=slide key=idxSlide name='homeslider'}*}
{*      <li data-target="#carousel" data-slide-to="{$idxSlide}"{if $idxSlide == 0} class="active"{/if}></li>*}
{*      {/foreach}*}
{*    </ol>*}
{*    <ul class="carousel-inner" role="listbox" aria-label="{l s='Carousel container' d='Shop.Theme.Global'}">*}
{*      {foreach from=$homeslider.slides item=slide name='homeslider'}*}
{*        <li class="carousel-item swiper-slide {if $smarty.foreach.homeslider.first}active{/if}" role="option" aria-hidden="{if $smarty.foreach.homeslider.first}false{else}true{/if}">*}
{*          <a href="{$slide.url}">*}
{*            <figure>*}
{*              <img src="{$slide.image_url}" alt="{$slide.legend|escape}" loading="lazy" width="1110" height="340">*}
{*              {if $slide.title || $slide.description}*}
{*                <figcaption class="caption">*}
{*                  <h2 class="display-1 text-uppercase">{$slide.title}</h2>*}
{*                  <div class="caption-description">{$slide.description nofilter}</div>*}
{*                </figcaption>*}
{*              {/if}*}
{*            </figure>*}
{*          </a>*}
{*        </li>*}
{*      {/foreach}*}
{*    </ul>*}
{*    <div class="direction" aria-label="{l s='Carousel buttons' d='Shop.Theme.Global'}">*}
{*      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev" aria-label="{l s='Previous' d='Shop.Theme.Global'}">*}
{*        <span class="icon-prev hidden-xs" aria-hidden="true">*}
{*          <i class="material-icons">&#xE5CB;</i>*}
{*        </span>*}
{*      </a>*}
{*      <a class="right carousel-control" href="#carousel" role="button" data-slide="next" aria-label="{l s='Next' d='Shop.Theme.Global'}">*}
{*        <span class="icon-next" aria-hidden="true">*}
{*          <i class="material-icons">&#xE5CC;</i>*}
{*        </span>*}
{*      </a>*}
{*    </div>*}
{*  </div>*}
{/if}

<style>
  .carousel{
    list-style-type: none;
  }
</style>
