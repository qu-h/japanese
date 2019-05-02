<textarea class="showdown grammar d-none">{$grammar}</textarea>
<div class="showdown-out"></div>
<script>
    jQuery( document ).ready(function() {
        var converter = new showdown.Converter(),
            grammar      = jQuery('.showdown.grammar').html();
        converter.setOption('headerLevelStart', 3);
        converter.setOption('noHeaderId', true);

        jQuery('.showdown-out').html(converter.makeHtml(grammar));
    });
</script>