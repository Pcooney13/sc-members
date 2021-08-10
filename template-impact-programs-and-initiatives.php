<?php
/*
 * Template Name: Impact Programs & Initiatives Template
 * Description: Impact Programs & Initiatives Template
 */
?>
<h1 style="text-align: center; color:#4d85c5;"><strong><?php the_field('title'); ?></strong></h1>
<p style="text-align: center;"><?php the_field('subtext'); ?></p>

<style>
    .hm-flex {
        display:flex;
        align-items:center;
        padding:30px;
        max-width:850px;
        margin:0 auto;
    }
    .hm-logo {
        width:350px;
        padding-right:30px;
    }
    .hm-info {
        flex:1;
    }
    .hm-title {
        font-weight:bold;
        font-size:21px;
        margin-bottom:0;
    }
    .hm-subtitle {
        text-transform:uppercase;
        opacity: 0.65;
        font-size: 17px;
        margin-bottom:0;
    }
    .hm-story{
        margin:15px 0;
    }
    @media (max-width:900px) {
        body.page-template-template-honorable-mentions {
            background-color:#f7f7f7;
        }
        .hm-flex {
            flex-direction:column;
            background-color:#fff;
            margin-bottom:30px;
            box-shadow:4px 4px 4px #eee;
        }
        .hm-logo {
            padding:0;
            margin-bottom:30px;
        }
        .hm-info {
            width: 100%;
            text-align: center;
        }
    }
</style>

<?php

//creates new Array to organize by ACF value ['title']
$repeater = get_field('program');
$order = array();
foreach ($repeater as $i => $row) {
    $order[ $i ] = $row['title'];
}
// alphabetizing by ACF value ['title']
array_multisort($order, SORT_ASC, $repeater);
// loop through new alphabetized Array of repeater values
if ($repeater): ?>
    <?php foreach( $repeater as $i => $row ): ?>
        <?php if ($row['title']) : ?>
	        <div class="hm-flex">
                <div class="hm-logo">
                <?php if ($row['image']): ?>
                    <img class="img-responsive" src="<?php echo $row['image']['sizes']['medium']; ?>" alt="">
                <?php endif; ?>
                </div>
                <div class="hm-info">
                    <p class="hm-title"><?php echo $row['title']; ?><?php if ($row['location']) echo ', ' . $row['location']; ?></p>
                    <p class="hm-subtitle"><?php echo $row['concentration_of_care']; ?></p>
                    <?php if ($row['show_bio']) : ?>
                        <span style="color: #000000;">
                            <?php echo $row['bio'];?>
                        </span>
                    <?php endif; ?>  
                </div>
            </div>
        <?php endif; ?>            
    <?php endforeach; ?>
<?php endif; ?>