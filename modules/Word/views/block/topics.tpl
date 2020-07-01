{if $topics|count > 0}
    {foreach $topics AS $topic}
        <div class="vc_wp_text wpb_content_element">
            <div class="widget widget_text">
                <h2>{anchor uri="word/topic/"|cat:$topic.alias txt=$topic.name class="white"}</h2>
                <div class="textwidget">
                    dddddd
                </div>
            </div>
        </div>
    {/foreach}
{/if}
