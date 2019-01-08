<div class="wpb_wrapper">
    <div class="row">
        <div class="col-md-4">
            <h3 style="color:#a4a4a4;" class=" subtitle left">
                Total Return : {$page_item_begin}-{$page_item_end}/{$pagination.total}
            </h3>
        </div>
        <div class="col-md-8 ">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">

                    <li class="page-item {if $page_current ==1 }disabled{/if}">
                        <a class="page-link" href="{site_url uri=$uri_string q=['p'=>$page_current-1]}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    {for $i=1;$i<=3;$i++}
                        <li class="page-item {if $i == $page_current}disabled{/if}"><a class="page-link" href="{site_url uri=$uri_string q=['p'=>$i]}">{$i}</a></li>
                    {/for}

                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>

                    {for $i=$pagination.page_last-1;$i<=$pagination.page_last;$i++}
                        <li class="page-item {if $i == $page_current}disabled{/if}"><a class="page-link" href="{site_url uri=$uri_string q=['p'=>$i]}">{$i}</a></li>
                    {/for}

                    <li class="page-item {if $page_current ==$pagination.page_last }disabled{/if}">
                        <a class="page-link" href="{site_url uri=$uri_string q=['p'=>$page_current+1]}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
    <div class="nicdark_divider  left big ">
        <span style="background-color:#ec774b;" class="nicdark_radius"></span>
    </div>
</div>