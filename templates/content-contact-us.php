<div class="row">
  <?php if(get_the_content != ''): ?>
      <div class="col-sm-6">
      <?php the_content(); ?>
      </div>
      <div class="col-sm-6">
      <?php echo do_shortcode( '[gravityform id="2" title="true" description="true"]' ); ?>
      </div>
  <?php endif; ?>
</div>