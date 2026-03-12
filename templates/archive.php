<?php
/**
 * Template Name: Blog Archive
 * Description: Blog archive page with sidebar
 */

get_header(); ?>

<!-- Hero Section -->
<div style="background-color: #F8FAFC; padding: 80px 40px;">
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        <h1 style="font-size: 48px; font-weight: 700; color: #1E293B; margin-bottom: 16px;">Our Blog</h1>
        <p style="font-size: 18px; color: #6B7280;">Insights, tutorials, and industry news</p>
    </div>
</div>

<!-- Main Content -->
<div style="background-color: #FFFFFF; padding: 80px 40px;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 70% 30%; gap: 64px;">
        
        <!-- Blog Posts Grid - LEFT SIDE -->
        <div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <!-- Blog Card -->
                <div style="background-color: #F8FAFC; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="width: 100%; height: 200px; background-color: #E5E7EB; overflow: hidden;">
                            <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                        </div>
                    <?php else : ?>
                        <div style="width: 100%; height: 200px; background-color: #E5E7EB; display: flex; align-items: center; justify-content: center;">
                            <span style="color: #6B7280;">Image</span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Card Content -->
                    <div style="padding: 20px;">
                        <!-- Category Badge -->
                        <?php 
                        $categories = get_the_category();
                        if (!empty($categories)) :
                            $cat = $categories[0];
                            $cat_color = ($cat->slug == 'design') ? '#F59E0B' : '#2563EB';
                        ?>
                        <span style="display: inline-block; background-color: rgba(245, 158, 11, 0.2); color: <?php echo $cat_color; ?>; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 4px; margin-bottom: 12px;">
                            <?php echo esc_html($cat->name); ?>
                        </span>
                        <?php endif; ?>
                        
                        <!-- Post Title -->
                        <h3 style="font-size: 20px; font-weight: 600; color: #1F2937; margin: 12px 0;">
                            <a href="<?php the_permalink(); ?>" style="color: #1F2937; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <!-- Excerpt -->
                        <p style="font-size: 14px; color: #6B7280; line-height: 1.6; margin: 12px 0;">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>
                        
                        <!-- Meta Info -->
                        <div style="font-size: 12px; color: #6B7280; margin-top: 16px;">
                            By <?php the_author(); ?> • <?php echo get_the_date('M d, Y'); ?> • 12 min read
                        </div>
                        
                        <!-- Read Article Button -->
                        <a href="<?php the_permalink(); ?>" style="display: inline-block; margin-top: 12px; color: #2563EB; font-size: 14px; font-weight: 600; text-decoration: none;">
                            Read Article →
                        </a>
                    </div>
                </div>
                
                <?php endwhile; endif; ?>
                
            </div>
            
            <!-- Pagination -->
            <div style="margin-top: 48px; text-align: center;">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>
            </div>
        </div>
        
        <!-- Sidebar - RIGHT SIDE -->
        <div>
            <!-- Search Box -->
            <div style="background-color: #F8FAFC; border-radius: 12px; padding: 24px; margin-bottom: 32px;">
                <form role="search" method="get" action="<?php echo home_url('/'); ?>">
                    <input type="text" name="s" placeholder="Search Article..." style="width: 100%; padding: 12px; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 14px;">
                </form>
            </div>
            
            <!-- Categories Widget -->
            <div style="background-color: #F8FAFC; border-radius: 12px; padding: 24px; margin-bottom: 32px;">
                <h3 style="font-size: 20px; font-weight: 700; color: #1E293B; margin-bottom: 16px;">Categories</h3>
                <div style="font-size: 14px;">
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $cat) :
                    ?>
                    <div style="margin-bottom: 12px;">
                        <a href="<?php echo get_category_link($cat->term_id); ?>" style="color: #1F2937; text-decoration: none; display: flex; justify-content: space-between;">
                            <span><?php echo $cat->name; ?></span>
                            <span style="color: #6B7280;">(<?php echo $cat->count; ?>)</span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Recent Posts Widget -->
            <div style="background-color: #F8FAFC; border-radius: 12px; padding: 24px;">
                <h3 style="font-size: 20px; font-weight: 700; color: #1E293B; margin-bottom: 16px;">Recent Posts</h3>
                <?php
                $recent_posts = wp_get_recent_posts(array('numberposts' => 3));
                foreach ($recent_posts as $post) :
                ?>
                <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                    <?php if (has_post_thumbnail($post['ID'])) : ?>
                        <div style="width: 64px; height: 64px; border-radius: 6px; overflow: hidden; flex-shrink: 0;">
                            <?php echo get_the_post_thumbnail($post['ID'], 'thumbnail', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                        </div>
                    <?php else : ?>
                        <div style="width: 64px; height: 64px; background-color: #E5E7EB; border-radius: 6px; flex-shrink: 0;"></div>
                    <?php endif; ?>
                    <div>
                        <h4 style="font-size: 14px; font-weight: 600; color: #1F2937; margin: 0 0 4px 0; line-height: 1.4;">
                            <a href="<?php echo get_permalink($post['ID']); ?>" style="color: #1F2937; text-decoration: none;">
                                <?php echo $post['post_title']; ?>
                            </a>
                        </h4>
                        <p style="font-size: 12px; color: #6B7280; margin: 0;">
                            <?php echo get_the_date('M d, Y', $post['ID']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
    </div>
</div>

<?php get_footer(); ?>