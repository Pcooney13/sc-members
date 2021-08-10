<style>
    .sidebar {display:none!important;}
    .sitemap-container {
        padding: 45px 0
    }
    .sitemap-ul {
        column-count: 3;
        padding-left: 0;
        margin-left: 0
    }
    .sitemap-ul a {
        text-decoration: none
    }
    .sitemap-ul>.page_item {
        text-decoration: none
    }
    .page_item>ul .page_item, .sitemap-ul>.page_item {
        list-style: none
    }
    .page_item {
        margin: 0
    }
    .page_item>ul .page_item::before {
        content: '\2010';
        color: #4d85c5;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
        margin-bottom: 8px
    }
    .sitemap-ul ul {
        padding-left: 20px;
        margin-left: 0
    }
    .sitemap-ul>.page_item>a {
        font-size: 24px;
        text-decoration: underline;
        margin-bottom: 15px;
        display: block
    }
</style>

<div id="page-content">
    <?php get_template_part('includes/hero'); ?>
    <div class="container sitemap-container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="sitemap-ul"><?php wp_list_pages("title_li=" ); ?></ul>  
            </div>
        </div>
    </div>
</div>
