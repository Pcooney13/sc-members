<footer class="content-info" role="contentinfo">
  <div class="container">
  	<div class="row">
        <div class="col-md-12 address cf">
            <ul>
            	<li><img src="<?php bloginfo('url'); ?>/media/footer-logo.png" alt="The Schwartz Center" />
                <li>&copy; <?php echo date('Y'); ?> The Schwartz Center</li>
                <li>100 Cambridge St., Ste. 2100</li>
                <li>Boston, Massachusetts 02114-2792</li>
            </ul>
        </div>
        <div class="col-md-12 social">
            <ul>
                <li><a target="_blank" href="http://www.facebook.com/theschwartzcenter"><i class="fa fa-facebook-square fa-2x"></i></a></li>
                <li><a target="_blank" href="http://www.youtube.com/theschwartzcenter"><i class="fa fa-youtube-square fa-2x"></i></a></li>
                <li><a target="_blank" href="https://www.linkedin.com/company/the-schwartz-center-for-compassionate-healthcare?trk=top_nav_home"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
                <li><a target="_blank" href="http://www.twitter.com/kschwartzcenter"><i class="fa fa-twitter-square fa-2x"></i></a></li>
            </ul>
        </div>
        <div class="col-md-12 contact cf">
            <ul> 
                <li><i class="fa fa-phone"></i>(617) 724-4746</li>
                <li><i class="fa fa-fax"></i>(617) 643-6123</li>
                <li><i class="fa fa-envelope"></i><a href="mailto: membership@theschwartzcenter.org">membership@theschwartzcenter.org</a></li>
            </ul>
        </div>
        <?php if(!is_page('login') && !is_front_page() && get_field('newsletter_signup', 'option')): ?>
        <div class="col-md-12 newsletter cf">
            <?php 
				$form_object = get_field('newsletter_form', 5);
				gravity_form_enqueue_scripts($form_object['id'], true);
				gravity_form($form_object['id'], false, false, false, '', true, 1); 
			?>
        </div>
        <?php endif; ?>
        <div class="col-md-12 navigation cf">
            <nav class="nav-footer" role="navigation">
              <?php
                if (has_nav_menu('footer_navigation') && is_page('login')) :
                  wp_nav_menu(array('theme_location' => 'footer_navigation'));
                endif;
              ?>
            </nav>
        </div>
  	</div>
  </div>
</footer>
<?php wp_footer(); ?>

<?php
	if(is_page('schwartz-center-rounds-topic-ideas')):
	$taxonomy = 'rounds_topics';
	$custom_terms = get_terms($taxonomy); 
	foreach ($custom_terms as $custom_term) { $topics .= "." . $custom_term->slug . ", "; } 
	$topics = substr($topics, 0, -2);
?>
<script type="text/javascript">
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "checkboxFilter".

var checkboxFilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
    
    self.$filters = $('#filters');
    self.$reset = $('#filter-reset');
    self.$container = $('#topic-list');
    
    self.$filters.find('fieldset').each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
		    tracker: false
      });
    });
    
    self.bindHandlers();
  },
  
  // The "bindHandlers" method will listen for whenever a form value changes. 
  
  bindHandlers: function(){
    var self = this;
    
    self.$filters.on('change', function(){
      self.parseFilters();
    });
    
    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filters[0].reset();
      self.parseFilters();
    });
  },
  
  // The parseFilters method checks which filters are active in each group:
  
  parseFilters: function(){
    var self = this;
 
    // loop through each filter group and add active filters to arrays
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){ 
        $(this).is(':checked') && group.active.push(this.value);
      });
	    group.active.length && (group.tracker = 0);
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){
    var self = this,
		  cache = '',
		  crawled = false,
		  checkTrackers = function(){
        var done = 0;
        
        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++; 
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };
    
    self.outputArray = []; // reset output array

	  do{
		  crawl();
	  }
	  while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();
    
    // If the output string is empty, show all rather than none:
    
    !self.outputString.length && (self.outputString = 'all'); 
    
    //console.log(self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
    
	  if(self.$container.mixItUp('isLoaded')){
    	self.$container.mixItUp('filter', self.outputString);
	  }
  }
};
  
// On document ready, initialise our code.

$(function(){
      
  // Initialize checkboxFilter code
      
  checkboxFilter.init();
      
  // Instantiate MixItUp
      
  $('#topic-list').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    animation: {
      easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
      duration: 600
    }
  });    
});
</script>
<?php endif; ?>