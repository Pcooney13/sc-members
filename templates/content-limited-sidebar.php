<aside class="sidebar menu <?php echo roots_sidebar_class(); ?>" role="complementary">
	
    <?php 
        $limited_sidebar = [];
        $topPage = get_post_top_ancestor_id();

	    if($post->post_parent || $topPage == get_the_ID()):
	        $children = wp_list_pages("title_li=&child_of=".$topPage."&echo=0");
	        $titlenamer = get_the_title($topPage);
	    endif; 
    ?>
    <?php $menu = wp_get_nav_menu_items(34);
    // SCHWARTZ ROUNDS LIMITED ACCESS PAGE
    if (is_page(20353)) : 
        array_push($limited_sidebar, 'rounds', 324);
    // Membership
    elseif (is_page(array(324, 14288, 14286, 8126, 17224, 17469, 11))) :
        array_push($limited_sidebar, 'membership', 324);
        // Schwartz Rounds
    elseif (is_page(array(324, 14288, 14286, 8126, 17224, 17469, 11))) :
        array_push($limited_sidebar, 'rounds', 14);
        // Schwartz First Aid
    elseif (is_page(array(19881, 19884))) :
        array_push($limited_sidebar, 'sfa', 19881);
        // Member Support
    elseif (is_page(array(17, 20252, 20264, 46, 50, 1234))) :
        array_push($limited_sidebar, 'support', 17);
        // Materials
    elseif (is_page('materials')) :
        array_push($limited_sidebar, 'materials', 20);
    endif;  ?>
        <?php if ($limited_sidebar[0] ==  'rounds') : ?>
        <h3>Schwartz Rounds<sup>®</sup></h3>
        <?php else: ?>
        <h3><?php echo get_the_title($limited_sidebar[1]); ?></h3>
        <?php endif;?>
        <?php 
            if ($limited_sidebar[0] == 'membership') : ?>
                <ul class="int-menu">
                    <li class="page_item page-item-14288 page_item_has_children"><a href="http://sc-members.launchpaddev.com/membership/impact/">The Corman IMPACT Honors</a>
                        <ul class="children">
                            <li class="page_item page-item-14286 page_item_has_children"><a href="http://sc-members.launchpaddev.com/membership/impact/2017-corman-impact-honorees/">2017 Corman IMPACT Honors</a>
                            <ul class="children">
                            	<li class="page_item page-item-8126"><a href="http://sc-members.launchpaddev.com/membership/impact/2017-corman-impact-honorees/2017-corman-impact-honors-programs-and-initiatives/">2017 Corman IMPACT Honors Programs &amp; Initiatives</a></li>
                            </ul>
                        </li>
                            <li class="page_item page-item-17224 page_item_has_children"><a href="http://sc-members.launchpaddev.com/membership/impact/2019-corman-impact-honorees/">2019 Corman IMPACT Honors</a>
                            <ul class="children">
                            	<li class="page_item page-item-17469"><a href="http://sc-members.launchpaddev.com/membership/impact/2019-corman-impact-honorees/2019-corman-impact-honors-programs-initiatives/">2019 Corman IMPACT Honors Programs &amp; Initiatives</a></li>
                            </ul>
                        </li>
                        </ul>
                        </li>
                        <li class="page_item page-item-11 page_item_has_children"><a href="http://sc-members.launchpaddev.com/membership/membership/">Member Benefits</a>
                        <ul class="children">
                            <li class="page_item page-item-20353"><a href="http://sc-members.launchpaddev.com/membership/membership/join-schwartz-rounds/">Schwartz Rounds<sup>®</sup></a></li>
                            <li class="page_item"><a href="https://www.theschwartzcenter.org/programs/unit-based-schwartz-rounds/">Unit-Based Schwartz Rounds</a></li>
                            <li class="page_item"><a href="https://www.theschwartzcenter.org/programs/schwartz-rounds/virtual-schwartz-rounds/">Virtual Schwartz Rounds</a></li>
                            <li class="page_item"><a href="https://www.theschwartzcenter.org/programs/facilitation-workshops/">Facilitation Workshops</a></li>
                        </ul>
                        </li>
                        </ul>
            <?php elseif ($limited_sidebar[0] == 'rounds') : ?>
                    <ul class="int-menu">
                        <li class="page_item page-item-19884"><a href="http://sc-members.launchpaddev.com/stress-first-aid/stress-first-aid-course/">Schwartz Rounds<sup>®</sup></a></li>
                    </ul>
            <?php elseif ($limited_sidebar[0] == 'sfa') : ?>
                    <ul class="int-menu">
                        <li class="page_item page-item-19884"><a href="http://sc-members.launchpaddev.com/stress-first-aid/stress-first-aid-course/">Stress First Aid Basics</a></li>
                    </ul>
            <?php elseif ($limited_sidebar[0] == 'support') : ?>
                    <ul class="int-menu">
                        <li class="page_item page-item-20252"><a href="http://sc-members.launchpaddev.com/educational-programming/online-learning/">Online Learning</a></li>
                        <li class="page_item page-item-20264"><a href="http://sc-members.launchpaddev.com/educational-programming/community-connections/">Community Connections</a></li>
                        <li class="page_item page-item-50"><a href="https://www.theschwartzcenter.org/join/healthcare-membership/creative-ways-to-fund-your-schwartz-center-membership/">Funding Your Membership</a></li>
                        <li class="page_item page-item-1234"><a href="http://sc-members.launchpaddev.com/educational-programming/compassion-action-webinars/">Compassion in Action Webinars</a></li>
                    </ul>
            <?php elseif ($limited_sidebar[0] == 'materials') : ?>
                    <ul class="int-menu">
                        <li class="page_item page-item-19884"><a href="/materials">Materials</a></li>
                    </ul>
            <?php endif;?>
  
</aside>