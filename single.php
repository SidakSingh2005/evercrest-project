<?php
/**
 * Template Name: Single Post
 * Description: Single blog post template
 */

get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>

    <!-- Article Hero -->
    <div style="background-color: #F8FAFC; padding: 64px 40px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Category Badge -->
            <?php
            $categories = get_the_category();
            if (!empty($categories)):
                $cat = $categories[0];
                ?>
                <span
                    style="display: inline-block; background-color: rgba(245, 158, 11, 0.2); color: #F59E0B; font-size: 14px; font-weight: 600; padding: 6px 16px; border-radius: 6px;">
                    <?php echo esc_html($cat->name); ?>
                </span>
            <?php endif; ?>

            <!-- Post Title -->
            <h1 style="font-size: 56px; font-weight: 700; line-height: 1.2; color: #1E293B; margin: 20px 0;">
                <?php the_title(); ?>
            </h1>

            <!-- Meta Info -->
            <div style="font-size: 16px; color: #6B7280; margin-top: 24px;">
                By
                <?php the_author(); ?> • Published
                <?php echo get_the_date('F d, Y'); ?> • 12 min read
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()): ?>
        <div style="width: 100%; height: 500px; overflow: hidden;">
            <?php the_post_thumbnail('full', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
        </div>
    <?php else: ?>
        <div
            style="width: 100%; height: 500px; background-color: #E5E7EB; display: flex; align-items: center; justify-content: center;">
            <span style="color: #6B7280; font-size: 24px;">Image</span>
        </div>
    <?php endif; ?>

    <!-- Article Content -->
    <div style="background-color: #FFFFFF; padding: 64px 40px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="font-size: 18px; line-height: 1.8; color: #1F2937;">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <!-- Author Bio Section -->
    <div style="background-color: #F8FAFC; padding: 64px 40px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div
                style="background-color: #FFFFFF; border-radius: 12px; padding: 32px; display: flex; gap: 24px; align-items: center;">
                <!-- Author Avatar -->
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; background-color: #E5E7EB; flex-shrink: 0; overflow: hidden;">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>

                <!-- Author Info -->
                <div>
                    <h3 style="font-size: 24px; font-weight: 700; color: #1E293B; margin: 0 0 4px 0;">
                        <?php the_author(); ?>
                    </h3>
                    <p style="font-size: 14px; color: #6B7280; margin: 0 0 12px 0;">
                        Web Designer And Developer
                    </p>
                    <p style="font-size: 16px; line-height: 1.6; color: #1F2937; margin: 0;">
                        <?php echo get_the_author_meta('description') ? get_the_author_meta('description') : 'Passionate about creating modern, user-friendly web experiences.'; ?>
                    </p>
                </div>
            </div>

            <!-- Related Articles -->
            <h2 style="font-size: 32px; font-weight: 700; color: #1E293B; margin: 64px 0 32px 0;">Related Articles</h2>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <?php
                $related = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID)
                ));
                foreach ($related as $post):
                    setup_postdata($post);
                    ?>

                    <div
                        style="background-color: #FFFFFF; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                        <?php if (has_post_thumbnail()): ?>
                            <div style="width: 100%; height: 160px; overflow: hidden;">
                                <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                            </div>
                        <?php else: ?>
                            <div
                                style="width: 100%; height: 160px; background-color: #E5E7EB; display: flex; align-items: center; justify-content: center;">
                                <span style="color: #6B7280;">Image</span>
                            </div>
                        <?php endif; ?>

                        <div style="padding: 16px;">
                            <?php
                            $cats = get_the_category();
                            if (!empty($cats)):
                                ?>
                                <span
                                    style="display: inline-block; background-color: rgba(37, 99, 235, 0.2); color: #2563EB; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 4px; margin-bottom: 8px;">
                                    <?php echo esc_html($cats[0]->name); ?>
                                </span>
                            <?php endif; ?>

                            <h3 style="font-size: 16px; font-weight: 600; color: #1F2937; margin: 8px 0;">
                                <a href="<?php the_permalink(); ?>" style="color: #1F2937; text-decoration: none;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <p style="font-size: 12px; color: #6B7280; margin: 8px 0 0 0;">
                                <?php echo get_the_date('M d, Y'); ?>
                            </p>
                        </div>
                    </div>

                <?php endforeach;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>