<style>
    .sidebar {
        padding:0;
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

#gform_wrapper_10 {
    position: absolute;
    z-index: -100;
    opacity: 0;
    pointer-events: none;
}
    </style>
    <?php 
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        the_content();
    endwhile; 
endif; 
?>
    <div class="video">
        <video width="800" controls="true"
            poster="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/vidplaceholderimg-rounds.jpg" id="video">
            <source type="video/mp4"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/videos/Stress-First_aid.mp4">
            </source>
        </video>
    </div>

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

    <script>
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
    </script>