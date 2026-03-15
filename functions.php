<?php
function custom_theme_setup() {
    add_theme_support('block-templates');
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'custom_theme_setup');

// =============================================
// SINGLE POST STYLES
// =============================================
function custom_single_post_styles() {
    if(is_single()) { ?>
        <style>
        .single-post-wrapper { max-width:780px; margin:60px auto; padding:0 20px; font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; }
        .post-category-wrap { text-align:center; margin-bottom:20px; }
        .cat-badge { display:inline-block; padding:6px 18px; border-radius:20px; font-size:13px; font-weight:600; color:#fff !important; text-transform:capitalize; }
        .cat-wordpress-development { background-color:#F59E0B !important; }
        .cat-web-design { background-color:#3B82F6 !important; }
        .cat-css-styling { background-color:#10B981 !important; }
        .cat-performance { background-color:#8B5CF6 !important; }
        .post-title { font-size:38px !important; font-weight:800 !important; text-align:center !important; line-height:1.25 !important; margin-bottom:16px !important; color:#111 !important; }
        .post-meta { display:flex !important; flex-direction:row !important; justify-content:center !important; align-items:center !important; gap:8px !important; font-size:14px !important; color:#999 !important; margin-bottom:48px !important; }
        .post-meta span { white-space:nowrap; }
        .post-featured-image { width:100vw !important; position:relative !important; left:50% !important; transform:translateX(-50%) !important; margin-bottom:56px !important; height:480px !important; overflow:hidden !important; }
        .post-featured-image img { width:100% !important; height:100% !important; object-fit:cover !important; }
        .post-content { font-size:16px !important; line-height:1.85 !important; color:#444 !important; margin-bottom:56px !important; }
        .post-content h2 { font-size:26px !important; font-weight:700 !important; color:#111 !important; margin:48px 0 16px !important; }
        .post-content h3 { font-size:19px !important; font-weight:600 !important; color:#111 !important; margin:36px 0 12px !important; }
        .post-content p { margin-bottom:22px !important; }
        .post-content ul { padding-left:22px !important; margin-bottom:22px !important; }
        .post-content ul li { margin-bottom:10px !important; line-height:1.75 !important; color:#444 !important; }
        .post-content figure { margin:36px 0 !important; }
        .post-content figure img { width:100% !important; border-radius:14px !important; display:block !important; }
        .post-content figcaption { text-align:center !important; font-size:13px !important; color:#aaa !important; margin-top:10px !important; }
        .author-bio-box { display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:20px !important; background:#f8f8f8 !important; border-radius:16px !important; padding:28px !important; margin-bottom:70px !important; }
        .author-avatar { flex-shrink:0 !important; }
        .author-avatar img { width:72px !important; height:72px !important; border-radius:50% !important; object-fit:cover !important; display:block !important; }
        .author-info { flex:1 !important; }
        .author-name { font-size:17px !important; font-weight:700 !important; color:#111 !important; margin-bottom:4px !important; }
        .author-role { font-size:13px !important; color:#999 !important; margin-bottom:10px !important; }
        .author-desc { font-size:14px !important; color:#666 !important; line-height:1.65 !important; margin:0 !important; }
        .related-articles { margin-bottom:80px !important; }
        .related-title { font-size:26px !important; font-weight:700 !important; color:#111 !important; margin-bottom:28px !important; }
        .related-grid { display:grid !important; grid-template-columns:repeat(3,1fr) !important; gap:22px !important; }
        .related-card { border-radius:14px !important; overflow:hidden !important; background:#fff !important; box-shadow:0 2px 16px rgba(0,0,0,0.07) !important; transition:transform 0.25s ease !important; }
        .related-card:hover { transform:translateY(-5px) !important; }
        .related-img { width:100% !important; height:155px !important; overflow:hidden !important; }
        .related-img-placeholder { background:#f0f0f0 !important; }
        .related-img img { width:100% !important; height:100% !important; object-fit:cover !important; }
        .related-card-body { padding:14px !important; }
        .related-card .cat-badge { font-size:11px !important; margin-bottom:10px !important; display:inline-block !important; }
        .related-post-title { font-size:15px !important; font-weight:600 !important; color:#111 !important; margin-bottom:8px !important; line-height:1.4 !important; }
        .related-post-title a { text-decoration:none !important; color:inherit !important; }
        .related-post-title a:hover { color:#F59E0B !important; }
        .related-date { font-size:12px !important; color:#bbb !important; }
        @media(max-width:768px) {
            .post-title { font-size:26px !important; }
            .post-featured-image { height:260px !important; }
            .related-grid { grid-template-columns:1fr !important; }
            .author-bio-box { flex-direction:column !important; align-items:center !important; text-align:center !important; }
        }
        </style>
    <?php }
}
add_action('wp_head', 'custom_single_post_styles');

// =============================================
// SINGLE POST SHORTCODE
// =============================================
function custom_single_post_content() {
    global $post;
    if(!$post) return '';

    $categories = get_the_category($post->ID);
    $cat_name = '';
    $cat_slug = '';
    if($categories) {
        $cat_name = $categories[0]->name;
        $cat_slug = $categories[0]->slug;
    }

    $content = $post->post_content;
    $word_count = str_word_count(strip_tags($content));
    $read_time = ceil($word_count / 200);
    $author_id = $post->post_author;
    $desc = get_the_author_meta('description', $author_id);
    if(!$desc) $desc = 'Passionate about creating modern digital experiences through clean design and efficient development. Specializing in WordPress and WooCommerce solutions.';

    $cats = wp_get_post_categories($post->ID);
    $related = new WP_Query(array(
        'category__in' => $cats,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3,
        'post_status' => 'publish',
    ));

    $related_html = '';
    if($related->have_posts()) {
        while($related->have_posts()) {
            $related->the_post();
            $rel_cats = get_the_category();
            $rel_cat = $rel_cats ? $rel_cats[0] : null;
            $rel_badge = $rel_cat ? '<span class="cat-badge cat-' . esc_attr($rel_cat->slug) . '">' . esc_html($rel_cat->name) . '</span>' : '';
            $rel_img = has_post_thumbnail() ? '<div class="related-img">' . get_the_post_thumbnail(null, 'medium') . '</div>' : '<div class="related-img related-img-placeholder"></div>';
            $related_html .= '
            <div class="related-card">
                ' . $rel_img . '
                <div class="related-card-body">
                    ' . $rel_badge . '
                    <h4 class="related-post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
                    <p class="related-date">' . get_the_date('M j, Y') . '</p>
                </div>
            </div>';
        }
        wp_reset_postdata();
    } else {
        $related_html = '<p style="color:#999;font-size:14px;">More posts coming soon!</p>';
    }

    $featured_img = '';
    if(has_post_thumbnail($post->ID)) {
        $featured_img = '<div class="post-featured-image">' . get_the_post_thumbnail($post->ID, 'full') . '</div>';
    }

    ob_start(); ?>
    <div class="single-post-wrapper">
        <div class="post-category-wrap">
            <span class="cat-badge cat-<?php echo esc_attr($cat_slug); ?>"><?php echo esc_html($cat_name); ?></span>
        </div>
        <h1 class="post-title"><?php echo get_the_title($post->ID); ?></h1>
        <div class="post-meta">
            <span>By <?php echo get_the_author_meta('display_name', $author_id); ?></span>
            <span>•</span>
            <span>Published <?php echo get_the_date('F j, Y', $post->ID); ?></span>
            <span>•</span>
            <span><?php echo $read_time; ?> min read</span>
        </div>
        <?php echo $featured_img; ?>
        <div class="post-content">
            <?php echo apply_filters('the_content', $post->post_content); ?>
        </div>
        <div class="author-bio-box">
            <div class="author-avatar"><?php echo get_avatar($author_id, 72); ?></div>
            <div class="author-info">
                <h4 class="author-name"><?php echo get_the_author_meta('display_name', $author_id); ?></h4>
                <p class="author-role">Web Designer And Developer</p>
                <p class="author-desc"><?php echo esc_html($desc); ?></p>
            </div>
        </div>
        <div class="related-articles">
            <h3 class="related-title">Related Articles</h3>
            <div class="related-grid"><?php echo $related_html; ?></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('single_post_content', 'custom_single_post_content');

// =============================================
// BLOG PAGE STYLES
// =============================================
function custom_blog_page_styles() {
    if(is_home()) { ?>
        <style>
            /* ===== FIX WORDPRESS PADDING ===== */
        .wp-block-group:has(.blog-hero) {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .blog-outer .blog-inner {
        display: grid !important;
        grid-template-columns: 1fr 280px !important;
        gap: 48px !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding: 0 40px !important;
        box-sizing: border-box !important;
        width: 100% !important;
        align-items: start !important;
    }

        /* Hide extra p tags WordPress adds inside grid */
        .blog-inner > p {
            display: none !important;
        }

        /* ===== HERO ===== */
        .blog-hero {
            background: #f0f2f5;
            text-align: center;
            padding: 80px 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .blog-hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: #111;
            margin: 0 0 12px 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        .blog-hero p {
            font-size: 16px;
            color: #888;
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ===== OUTER ===== */
        .blog-outer {
            width: 100%;
            padding: 60px 0 80px 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ===== INNER GRID ===== */
        .blog-inner {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 48px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px;
            align-items: start;
            box-sizing: border-box;
        }

        /* ===== POST GRID ===== */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            width: 100%;
        }

        .blog-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            transition: transform 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover { transform: translateY(-5px); }

        .blog-card-img {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #f0f0f0;
        }

        .blog-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .blog-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* ===== CATEGORY BADGES ===== */
        .blog-cat-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            text-transform: capitalize;
            margin-bottom: 12px;
            width: fit-content;
        }

        .blog-cat-wordpress-development { background-color: #F59E0B; }
        .blog-cat-web-design { background-color: #3B82F6; }
        .blog-cat-css-styling { background-color: #10B981; }
        .blog-cat-performance { background-color: #8B5CF6; }

        .blog-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #111;
            margin: 0 0 10px 0;
            line-height: 1.4;
        }

        .blog-card-title a {
            text-decoration: none;
            color: inherit;
        }

        .blog-card-title a:hover { color: #3B82F6; }

        .blog-card-excerpt {
            font-size: 14px;
            color: #777;
            line-height: 1.65;
            margin: 0 0 12px 0;
            flex: 1;
        }

        .blog-card-meta {
            font-size: 13px;
            color: #aaa;
            margin: 0 0 16px 0;
        }

        .blog-read-btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
            background: transparent;
            box-sizing: border-box;
        }

        .blog-read-btn:hover {
            background: #111;
            color: #fff;
            border-color: #111;
        }

        /* ===== PAGINATION ===== */
        .blog-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .blog-pagination a,
        .blog-pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            color: #333;
            border: 1.5px solid #e5e5e5;
            background: #fff;
            transition: all 0.2s ease;
        }

        .blog-pagination a:hover { background: #f5f5f5; }
        .blog-pagination .current { background: #3B82F6; color: #fff; border-color: #3B82F6; }

        /* ===== SIDEBAR ===== */
        .blog-sidebar { position: sticky; top: 20px; }

        .blog-search {
            position: relative;
            margin-bottom: 36px;
        }

        .blog-search input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1.5px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            color: #333;
            outline: none;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        .blog-search input:focus { border-color: #3B82F6; }

        .blog-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: 700;
            color: #111;
            margin: 0 0 16px 0;
        }

        .sidebar-categories {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 0 36px !important;
        }

        .sidebar-categories li {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 10px 0 !important;
            border-bottom: 1px solid #f0f0f0 !important;
            font-size: 14px !important;
            color: #444 !important;
            background: none !important;
        }

        .sidebar-categories li a {
            text-decoration: none !important;
            color: #444 !important;
            background: none !important;
            padding: 0 !important;
            border: none !important;
            font-size: 14px !important;
        }

        .sidebar-categories li a:hover { color: #3B82F6 !important; }

        .sidebar-categories li .cat-count {
            font-size: 13px;
            color: #aaa;
        }

        .sidebar-recent { margin-bottom: 40px; }

        .recent-post-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .recent-post-thumb {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #f0f0f0;
        }

        .recent-post-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recent-post-info h5 {
            font-size: 14px;
            font-weight: 600;
            color: #111;
            margin: 0 0 4px 0;
            line-height: 1.4;
        }

        .recent-post-info h5 a {
            text-decoration: none;
            color: inherit;
        }

        .recent-post-info h5 a:hover { color: #3B82F6; }

        .recent-post-info span {
            font-size: 12px;
            color: #aaa;
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width: 968px) {
            .blog-inner { grid-template-columns: 1fr; }
        }
        @media(max-width: 600px) {
            .blog-grid { grid-template-columns: 1fr; }
            .blog-hero h1 { font-size: 32px; }
            .blog-inner { padding: 0 20px; }
        }
        </style>
    <?php }
}
add_action('wp_head', 'custom_blog_page_styles');

// =============================================
// BLOG PAGE SHORTCODE
// =============================================
function custom_blog_page_content() {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    $cat_filter = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => $paged,
    );

    if($search) $args['s'] = $search;
    if($cat_filter) $args['cat'] = $cat_filter;

    $blog_query = new WP_Query($args);
    $categories = get_categories(array('hide_empty' => false, 'exclude' => get_cat_ID('Uncategorized')));
    $recent_posts = new WP_Query(array('posts_per_page' => 3, 'post_status' => 'publish'));

    ob_start(); 
    // Remove extra p tags added by WordPress
    add_filter('the_content', function($content) { return $content; });
    remove_filter('the_content', 'wpautop');
    ?>
    <div class="blog-hero">

        <h1>Our Blog</h1>
        <p>Insights, tutorials, and industry news</p>
    </div>

    <div class="blog-outer">
        <div class="blog-inner">

            <!-- Left: Post Grid + Pagination -->
            <div class="blog-main">
                <div class="blog-grid">
                    <?php if($blog_query->have_posts()) :
                    while($blog_query->have_posts()) : $blog_query->the_post();
                    $cats = get_the_category();
                    $cat = $cats ? $cats[0] : null;
                    $badge = $cat ? '<span class="blog-cat-badge blog-cat-' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</span>' : '';
                    $thumb = has_post_thumbnail() ? '<div class="blog-card-img">' . get_the_post_thumbnail(null, 'medium_large') . '</div>' : '<div class="blog-card-img"></div>';
                    $word_count = str_word_count(strip_tags(get_the_content()));
                    $read_time = ceil($word_count / 200);
                    ?>
                    <div class="blog-card">
                        <?php echo $thumb; ?>
                        <div class="blog-card-body">
                            <?php echo $badge; ?>
                            <h2 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <p class="blog-card-meta">By <?php the_author(); ?> • <?php echo get_the_date('M j, Y'); ?> • <?php echo $read_time; ?> min read</p>
                            <a href="<?php the_permalink(); ?>" class="blog-read-btn">Read Article</a>
                        </div>
                    </div>
                    <?php endwhile;
                    else : ?>
                    <p style="color:#999;">No posts found.</p>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>

                <!-- Pagination -->
                <?php
                $total_pages = $blog_query->max_num_pages;
                if($total_pages > 1) : ?>
                <div class="blog-pagination">
                    <?php
                    $current = max(1, $paged);
                    if($current > 1) echo '<a href="' . get_pagenum_link($current - 1) . '">← Previous</a>';
                    else echo '<span style="opacity:0.4;">← Previous</span>';

                    for($i = 1; $i <= $total_pages; $i++) {
                        if($i == $current) echo '<span class="current">' . $i . '</span>';
                        elseif($i <= 3 || $i == $total_pages) echo '<a href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                        elseif($i == 4 && $total_pages > 4) echo '<span>...</span>';
                    }

                    if($current < $total_pages) echo '<a href="' . get_pagenum_link($current + 1) . '">Next →</a>';
                    else echo '<span style="opacity:0.4;">Next →</span>';
                    ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: Sidebar -->
            <div class="blog-sidebar">

                <!-- Search -->
                <form class="blog-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <span class="blog-search-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    </span>
                    <input type="text" name="s" placeholder="Search Article..." value="<?php echo esc_attr($search); ?>">
                </form>

                <!-- Categories -->
                <h3 class="sidebar-title">Categories</h3>
                <ul class="sidebar-categories">
                    <li>
                        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">All Posts</a>
                        <span class="cat-count"><?php echo wp_count_posts()->publish; ?></span>
                    </li>
                    <?php foreach($categories as $category) : ?>
                    <li>
                        <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo esc_html($category->name); ?></a>
                        <span class="cat-count">(<?php echo $category->count; ?>)</span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Recent Posts -->
                <div class="sidebar-recent">
                    <h3 class="sidebar-title">Recent Posts</h3>
                    <?php while($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <div class="recent-post-item">
                        <div class="recent-post-thumb">
                            <?php if(has_post_thumbnail()) echo get_the_post_thumbnail(null, 'thumbnail'); ?>
                        </div>
                        <div class="recent-post-info">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <span><?php echo get_the_date('M j, Y'); ?></span>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('blog_page_content', 'custom_blog_page_content');