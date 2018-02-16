{foreach from=$pages item=pageItem}
    <div class="well">
    	<div class="media">
    		{if isset($pageItem.image)}
		    <a class="pull-left" href="{$pageItem.path}">
		    	<img class="media-object" width="100px" src="{$pageItem.image}">
		    </a>
		    {/if}
		    <div class="media-body">
		    <h4 class="media-heading">{$pageItem.title}</h4>
		    {$pageItem.small_content}
		    </div>
		</div>
		<div class="pull-right"><a href="{$pageItem.path}" style="font-weight:bold;">Подробнее</a></div>
    </div>
{/foreach}