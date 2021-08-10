<div class="row">
	<div class="col-sm-12">
    
		<?php if(get_the_content != ''): ?>
        <div class="row">
            <div class="col-sm-12">
            <?php the_content(); ?>
            </div>
        </div>
    	<?php endif; ?>
        <div class="row">
        	<div class="col-sm-12">
            
            	<?php /*
					$args = array( 'post_type' => 'scr_topics', 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					  echo '<h3>' . get_the_title() . '</h3>';
					endwhile;
					*/
				?>
                
                <?php 
					$taxonomy = 'rounds_topics';
					$custom_terms = get_terms($taxonomy); 
				?>
                
                <form class="controls" id="filters">
                	<fieldset>
                        <h4>Category Filter:</h4>
                        <div class="filter-wrap">
                        	<div class="row">
								<?php foreach ($custom_terms as $custom_term){ ?>
                                <div class="checkbox-wrap col-sm-3">
                                    <div class="checkbox">
                                        <input type="checkbox" value=".<?php echo $custom_term->slug; ?>"><label><?php echo $custom_term->name; ?> (<?php echo $custom_term->count; ?>)</label>
                                    </div>
                                </div>
                        	<?php } ?>
                          </div>
                        </div>
                	</fieldset>
                    <button class="btn btn-success pull-right" id="filter-reset">Clear Filters</button>
                </form>
                
                <div id="topic-list" class="panel-group">
				<?php 
					$count = 1;
					foreach($custom_terms as $custom_term) {
						wp_reset_query();
						$args = array(
							'post_type' => 'scr_topics',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'rounds_topics',
									'field' => 'slug',
									'terms' => $custom_term->slug,
								),
							),
						 );
					
						 $loop = new WP_Query($args);
						 
						 if($loop->have_posts()): ?>
						 <div class="panel panel-default  mix <?php echo $custom_term->slug; ?>" data-myorder="<?php echo $count; ?>">
                         	<div class="panel-heading"><a class="panel-title" data-toggle="collapse" href="#panel-<?php echo $custom_term->slug; ?>"><?php echo $custom_term->name; ?><span class="badge"><?php echo $custom_term->count; ?></span></a></div>
                            <div id="panel-<?php echo $custom_term->slug; ?>" class="panel-collapse collapse">
								<ul class="list-group">
									<?php while($loop->have_posts()) : $loop->the_post(); ?>
									<li class="list-group-item"><?php echo get_the_title(); ?></li>
								<?php endwhile; ?>
								</ul>
						 	</div>
                         </div>
						 <?php endif; ?>
					
				<?php 
					$count++;
					} 
				?>
                </div><!-- /.panel-group -->
                
            </div>
        </div>

	</div>
</div>