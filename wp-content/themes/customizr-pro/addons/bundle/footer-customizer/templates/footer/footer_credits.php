<?php
/**
 * The template for displaying the footer credits
 *
 */
?>
<div id="footer__credits" class="footer__credits credits" <?php czr_fn_echo('element_attributes') ?>>
  <p class="czr-copyright">
    <span class="fc-copyright">
      <span class="fc-copyright-text"><?php czr_fn_echo( 'fc_copyright_text' ) ?></span>
      <?php
        $link_target_property = czr_fn_get_property( 'fc_site_link_target' );
        printf('<span class="fc-copyright-link"><a href="%1$s" title="%2$s" rel="%3$s" %4$s>%5$s</a></span>',
            czr_fn_get_property('fc_site_link'),
            czr_fn_get_property('fc_site_name'),
            '_blank' === $link_target_property ? 'noopener noreferrer' : 'bookmark',
            '_blank' === $link_target_property ? 'target="_blank"' : '',
            czr_fn_get_property('fc_site_name')
        );
      ?>
    <?php if ( czr_fn_get_property( 'fc_show_copyright_after' ) ) : ?>
      <span class="fc-separator <?php czr_fn_echo( 'fc_copyright_after_sep_class' )?>">&ndash;</span>
      <span class="fc-copyright-after-text"><?php czr_fn_echo( 'fc_copyright_after_text' ) ?></span>
    <?php endif; ?>
    </span>
  </p>
  <?php

    /* Designer credits and powered by WP*/
    if ( czr_fn_get_property( 'fc_show_designer_credits' ) || czr_fn_get_property( 'fc_show_wp_powered' ) ) :

  ?>
  <p class="czr-credits">
  <?php

    if ( czr_fn_get_property( 'fc_show_designer_credits' ) ) :

  ?>
    <span class="fc-designer <?php czr_fn_echo( 'fc_designer_class' )?>">
      <span class="fc-credits-text"><?php czr_fn_echo( 'fc_credit_text' ) ?></span>
      <?php
      $d_link_target_property = czr_fn_get_property( 'fc_designer_link_target' );
      printf('<span class="fc-credits-link"><a href="%1$s" title="%2$s" rel="%3$s" %4$s>%5$s</a></span>',
          czr_fn_get_property('fc_designer_link'),
          czr_fn_get_property('fc_designer_name'),
          '_blank' === $d_link_target_property ? 'noopener noreferrer' : 'bookmark',
          '_blank' === $d_link_target_property ? 'target="_blank"' : '',
          czr_fn_get_property('fc_designer_name')
      );
      ?>
    </span>

  <?php

    endif; //end fc_show_designer_credits

    if ( czr_fn_get_property( 'fc_show_wp_powered' ) ):
  ?>
    <span class="fc-separator <?php czr_fn_echo( 'fc_wp_powered_sep_class' )?>">&ndash;</span>
    <span class="fc-wp-powered <?php czr_fn_echo( 'fc_wp_powered_class' )?>">
      <span class="fc-wp-powered-text"><?php _e( 'Powered by', 'customizr-pro' ) ?></span>
      <span class="fc-wp-powered-link"><a class="fab fa-wordpress" href="https://www.wordpress.org" title="<?php _e( 'Powered by WordPress', 'customizr-pro' ) ?>" target="_blank" rel="noopener noreferrer"></a></span>
    </span>
  <?php

    endif; //end fc_show_wp_powered

  ?>
  </p>
  <?php

    /* end fc_show_designer_credits || fc_show_wp_powered*/
    endif;

  ?>
</div>
