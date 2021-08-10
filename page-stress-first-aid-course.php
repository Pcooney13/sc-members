    <style>
    .sidebar {
        background:white;
    }
.video {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    margin-bottom: 20px;
}

.video video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

#status span.status {
    display: none;
    font-weight: bold;
}

span.status.complete {
    color: green;
}

span.status.incomplete {
    color: red;
}

#status.complete span.status.complete {
    display: inline;
}

#status.incomplete span.status.incomplete {
    display: inline;
}

#gform_wrapper_11, #gform_wrapper_12 {
    position: absolute;
    z-index: -100;
    opacity: 0;
    pointer-events: none;
}
    </style>

    <div class="row">
	<div class="col-sm-12">
    <?php if(get_the_content() != ''): ?>
    <div class="row">
		<div class="col-sm-12">
        <?php the_content(); ?>
        </div>
    </div>
    <?php endif; ?>


    <h3><span style="color: #3d85c5;"><strong>Course Video</strong></span></h3>
    <div class="video">
        <video width="800" controls="true" poster="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/video-slide.png" id="video">
            <source type="video/mp4"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/videos/Stress-First-Aid.mp4">
        </source>
    </video>
</div>
                <!-- src="<?php echo get_stylesheet_directory_uri(); ?>/assets/videos/Stress-First-Aid.mp4"> -->
                <!-- src="<?php echo get_stylesheet_directory_uri(); ?>/assets/videos/rounds-program-intro.mp4"> -->

    <div style="opacity:0; pointer-events:none;">
        <div id="status" class="incomplete">
            <span>Play status: </span>
            <span class="status complete">COMPLETE</span>
            <span class="status incomplete">INCOMPLETE</span>
            <br />
        </div>
        <div>
            <span id="played">0</span> seconds out of
            <span id="duration"></span> seconds. (only updates when the video pauses)
        </div>
    </div>

    <?php if (get_post_meta($post->ID, 'menu_page', true)): $count=1; ?>
        <div class="row">
        <?php
			$mypages = get_pages(array('child_of' => $post->ID, 'parent' => $post->ID,'sort_column' => 'menu_order', 'sort_order' => 'asc'));
			foreach( $mypages as $page ):	
		?>
            <div class="col-md-6">
            	<div class="menu-block">
                    <div class="img-wrapper">
                    	<a href="<?php echo get_page_link($page->ID); ?>">
                        <h3><?php echo $page->post_title; ?></h3>
                        <?php 
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'menu-thumb' ); 
                            $thumb = $thumb['0'];
                        ?>
                        <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $page->post_title; ?>" title="<?php echo $page->post_title; ?>">
                        <span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-angle-right fa-stack-1x fa-inverse"></i></span>
                        <span class="gradient"></span>
                        </a>
                        
                    </div>
                    <p><?php the_field('page_summary', $page->ID); ?></p>
            	</div>
            </div>
        <?php if($count % 2 === 0): ?>
		</div>
        <div class="row">
		<?php endif; ?>
		<?php $count++; endforeach; ?>
        </div>
    <?php else: ?>
		<?php
            if( have_rows('custom_content') ):
            while ( have_rows('custom_content') ) : the_row();
        ?>
        
                <?php if( get_row_layout() == 'content_block' ): ?>
                
                <div class="row">
                    <div class="col-sm-12">
                    <?php the_sub_field('content'); ?>
                    </div>
                </div>
                
                <?php elseif( get_row_layout() == 'accordian_content' ): ?>
                
                    <div class="accordian">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php if(have_rows('accordian_block')): $count = 0;
                        while (have_rows('accordian_block')) : the_row(); ?>
                        
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p class="panel-title"><a data-toggle="collapse"<?php if($count != 0) echo ' class="collapsed"' ?> data-parent="#accordion" href="#collapse<?php echo $count; ?>"><?php the_sub_field('title'); ?></a></p>
                                </div>
                                <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse <?php if($count != 0) { echo 'collapsed'; } else { echo 'in'; } ?>">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php the_sub_field('content'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php $count++;endwhile;endif; ?>
                        </div>
                    </div>        
                    
                <?php endif; ?>
        
        <?php endwhile; endif; ?>
    <?php endif; ?>
	</div>
</div>

    <script>
        var video = document.getElementById("video");
        var requestOnce = 0

        video.addEventListener("click", function() {
            console.log("clicked");
        })

        var timeStarted = -1;
        var timePlayed = 0;
        var duration = 0;
        // If video metadata is laoded get duration
        if (video.readyState > 0)
            getDuration.call(video);
        //If metadata not loaded, use event to get it
        else {
            video.addEventListener('loadedmetadata', getDuration);
        }
        // remember time user started the video
        function videoStartedPlaying() {  
            if (requestOnce === 0) {
                console.log("sending data...");
                if (document.getElementById('gform_12')) {
                    document.getElementById('gform_12').submit(function(e) {
                        e.preventDefault();
                    });
                }
                requestOnce++
            }              
            console.log("user clicked play")
            timeStarted = new Date().getTime() / 1000;
        }

        function videoStoppedPlaying(event) {
            // Start time less then zero means stop event was fired vidout start event
            if (timeStarted > 0) {
                var playedFor = new Date().getTime() / 1000 - timeStarted;
                timeStarted = -1;
                // add the new ammount of seconds played
                timePlayed += playedFor;
            }
            document.getElementById("played").innerHTML = Math.round(timePlayed) + "";
            // Count as complete only if end of video was reached
            if (timePlayed >= duration && event.type == "ended") {
                document.getElementById("status").className = "complete";
                document.getElementById('gform_11').submit(function(e) {
                    e.preventDefault();
                });
            }
        }

        function getDuration() {
            duration = video.duration;
            document.getElementById("duration").appendChild(new Text(Math.round(duration) + ""));
            console.log("Duration: ", duration);
        }

        video.addEventListener("play", videoStartedPlaying);
        video.addEventListener("playing", videoStartedPlaying);

        video.addEventListener("ended", videoStoppedPlaying);
        video.addEventListener("pause", videoStoppedPlaying);
    </script>
     <!-- <script>
        var video = document.getElementById("video");

        var timeStarted = -1;
        var timePlayed = 0;
        var duration = 0;
        // If video metadata is laoded get duration
        if (video.readyState > 0)
            getDuration.call(video);
        //If metadata not loaded, use event to get it
        else {
            video.addEventListener('loadedmetadata', getDuration);
        }
        // remember time user started the video
        function videoStartedPlaying() {
            timeStarted = new Date().getTime() / 1000;
        }

        function videoStoppedPlaying(event) {
            // Start time less then zero means stop event was fired vidout start event
            if (timeStarted > 0) {
                var playedFor = new Date().getTime() / 1000 - timeStarted;
                timeStarted = -1;
                // add the new ammount of seconds played
                timePlayed += playedFor;
            }
            document.getElementById("played").innerHTML = Math.round(timePlayed) + "";
            // Count as complete only if end of video was reached
            if (timePlayed >= duration && event.type == "ended") {
                document.getElementById("status").className = "complete";
                document.getElementById('gform_10').submit();
            }
        }

        function getDuration() {
            duration = video.duration;
            document.getElementById("duration").appendChild(new Text(Math.round(duration) + ""));
            console.log("Duration: ", duration);
        }

        video.addEventListener("play", videoStartedPlaying);
        video.addEventListener("playing", videoStartedPlaying);

        video.addEventListener("ended", videoStoppedPlaying);
        video.addEventListener("pause", videoStoppedPlaying);
    </script> -->