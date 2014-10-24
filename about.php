<?php
/**
 * About page
 *
 * A page that describes the organization/project/website
 *
 * @author Crystal Carr
 * @since 0.1.0
 *
 * @todo Validate input fields
 */

global $the_title;
$the_title = 'About';

include_once ('header.php'); ?>

<div id="primary" class="content-area container">
      <div id="content" class="site-content col-lg-12 col-md-12" role="main">
        <div class="row">
          <article class="page type-page status-draft hentry col-lg-12 col-md-12 col-sm-12">
            <header class="entry-header">
              <h1 class="entry-title"><?php echo $the_title; ?></h1>
            </header><!-- .entry-header -->
              <div class="entry-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consequat neque et ante semper, sed pharetra mauris viverra. Curabitur ultrices tellus elit, in euismod nulla bibendum at. Proin congue vehicula est vel posuere. Curabitur volutpat at magna non sagittis. Mauris mauris sapien, sollicitudin vitae tempor et, volutpat vehicula libero. Donec venenatis diam a pulvinar bibendum. Donec sodales sem enim, at pretium libero tempor vitae. Nullam velit lectus, ullamcorper vitae tempor sed, euismod ut nisi. Sed ut sagittis lorem. Cras ipsum odio, ornare vel ante quis, feugiat maximus risus. Fusce sem risus, fermentum non blandit eget, pharetra in libero. Quisque rutrum, ligula at pellentesque faucibus, neque risus malesuada felis, ac interdum lectus nisi non tortor. Cras sed nunc et diam elementum semper sit amet sed mauris. Nunc fringilla placerat velit, sit amet tempus lacus bibendum nec. Nullam nulla ante, commodo eget lacinia non, posuere at turpis.</p>

                <p>Donec egestas vehicula quam non malesuada. Sed fermentum erat et consectetur efficitur. Vivamus iaculis suscipit felis eu auctor. Donec porta ut ante et mattis. Nullam sit amet felis nibh. Vivamus nec elit euismod, aliquet neque vitae, ullamcorper risus. Nullam eget fermentum tortor. Quisque ligula enim, interdum a mauris quis, auctor porta tortor. Sed vel massa hendrerit, maximus nunc eget, aliquam nunc. Fusce a arcu vitae libero mattis blandit. Duis consequat urna at sapien convallis, ut feugiat ipsum viverra. Vestibulum nec massa at mauris ullamcorper bibendum ac non risus. Integer congue ante nulla, id finibus velit porta ut. Nulla et feugiat augue. Proin in tortor vel velit tempor porttitor.</p>
            </div> <!--.entry-content -->
          </article>
        </div> <!--.row -->
      </div> <!-- #content -->
    </div> <!-- #primary -->



<?php include_once ('footer.php'); ?>
