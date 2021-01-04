{extends file="main.tpl"}

{block name=content}

<h3>Kalkulator v6</h2>

<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
		<label for="x">Kwota kredytowania</label>
		<input id="kwota" type="number" placeholder="" name="kwota" value="{$form->kwota}">
                <label for="x">Liczba lat</label>
		<input id="lata" type="number" placeholder="" name="lata" value="{$form->lata}">
                <label for="x">Oprocentowanie</label>
		<input id="procent" type="number" placeholder="" name="procent" value="{$form->procent}">

	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->result}
	</p>
{/if}

</div>

{/block}