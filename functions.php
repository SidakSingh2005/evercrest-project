<?php
/**
 * EverCrest Creative Studio - Theme Functions
 * 
 * This file registers theme support, custom post types,
 * shortcodes, and styles for the EverCrest WordPress theme.
 * 
 * @author Sidak Singh
 * @version 1.0.0
 */

// =============================================
// THEME SETUP
// Registers block template and block style support
// required for Full Site Editing (FSE) themes
// =============================================
function custom_theme_setup() {
    add_theme_support('block-templates');
    add_theme_support('wp-block-styles');
}
add_action('after_setup_theme', 'custom_theme_setup');

// =============================================
// SINGLE POST STYLES
// Outputs CSS only on single post pages to avoid
// loading unnecessary styles on other pages
// =============================================
function custom_single_post_styles() {
    if(is_single()) { ?>
        <style>
        /* ===== SINGLE POST WRAPPER =====
         * Centers the post content with a max width
         * and adds consistent padding on all screens */
        .single-post-wrapper { max-width:780px; margin:60px auto; padding:0 20px; font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif; }

        /* ===== CATEGORY BADGE =====
         * Pill-shaped badge showing post category
         * Each category has its own brand color */
        .post-category-wrap { text-align:center; margin-bottom:20px; }
        .cat-badge { display:inline-block; padding:6px 18px; border-radius:20px; font-size:13px; font-weight:600; color:#fff !important; text-transform:capitalize; }

        /* Category color assignments */
        .cat-wordpress-development { background-color:#F59E0B !important; } /* Amber for WordPress Development */
        .cat-web-design { background-color:#3B82F6 !important; }            /* Blue for Web Design */
        .cat-css-styling { background-color:#10B981 !important; }           /* Green for CSS & Styling */
        .cat-performance { background-color:#8B5CF6 !important; }           /* Purple for Performance */

        /* ===== POST TITLE =====
         * Large centered heading for the post title */
        .post-title { font-size:38px !important; font-weight:800 !important; text-align:center !important; line-height:1.25 !important; margin-bottom:16px !important; color:#111 !important; }

        /* ===== POST META =====
         * Displays author, date and read time in one line
         * Uses flexbox to keep items centered and inline */
        .post-meta { display:flex !important; flex-direction:row !important; justify-content:center !important; align-items:center !important; gap:8px !important; font-size:14px !important; color:#999 !important; margin-bottom:48px !important; }
        .post-meta span { white-space:nowrap; }

        /* ===== FEATURED IMAGE =====
         * Full viewport width image that breaks out of
         * the constrained wrapper for visual impact */
        .post-featured-image { width:100vw !important; position:relative !important; left:50% !important; transform:translateX(-50%) !important; margin-bottom:56px !important; height:480px !important; overflow:hidden !important; }
        .post-featured-image img { width:100% !important; height:100% !important; object-fit:cover !important; }

        /* ===== POST CONTENT =====
         * Styles for the main post body content
         * including headings, paragraphs, lists and images */
        .post-content { font-size:16px !important; line-height:1.85 !important; color:#444 !important; margin-bottom:56px !important; }
        .post-content h2 { font-size:26px !important; font-weight:700 !important; color:#111 !important; margin:48px 0 16px !important; }
        .post-content h3 { font-size:19px !important; font-weight:600 !important; color:#111 !important; margin:36px 0 12px !important; }
        .post-content p { margin-bottom:22px !important; }
        .post-content ul { padding-left:22px !important; margin-bottom:22px !important; }
        .post-content ul li { margin-bottom:10px !important; line-height:1.75 !important; color:#444 !important; }

        /* Content images with rounded corners and captions */
        .post-content figure { margin:36px 0 !important; }
        .post-content figure img { width:100% !important; border-radius:14px !important; display:block !important; }
        .post-content figcaption { text-align:center !important; font-size:13px !important; color:#aaa !important; margin-top:10px !important; }

        /* ===== AUTHOR BIO BOX =====
         * Card showing author avatar, name, role and bio
         * Uses flexbox for horizontal layout */
        .author-bio-box { display:flex !important; flex-direction:row !important; align-items:flex-start !important; gap:20px !important; background:#f8f8f8 !important; border-radius:16px !important; padding:28px !important; margin-bottom:70px !important; }
        .author-avatar { flex-shrink:0 !important; }
        .author-avatar img { width:72px !important; height:72px !important; border-radius:50% !important; object-fit:cover !important; display:block !important; }
        .author-info { flex:1 !important; }
        .author-name { font-size:17px !important; font-weight:700 !important; color:#111 !important; margin-bottom:4px !important; }
        .author-role { font-size:13px !important; color:#999 !important; margin-bottom:10px !important; }
        .author-desc { font-size:14px !important; color:#666 !important; line-height:1.65 !important; margin:0 !important; }

        /* ===== RELATED ARTICLES =====
         * 3 column grid of related post cards
         * shown at the bottom of each single post */
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

        /* ===== RESPONSIVE: SINGLE POST =====
         * Adjusts layout for mobile screens under 768px
         * - Smaller title font size
         * - Shorter featured image height
         * - Single column related articles
         * - Stacked author bio box */
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
// Renders the full single post layout including
// category badge, title, meta, featured image,
// content, author bio and related articles
// =============================================
function custom_single_post_content() {
    global $post;
    if(!$post) return '';

    // Get post category data
    $categories = get_the_category($post->ID);
    $cat_name = '';
    $cat_slug = '';
    if($categories) {
        $cat_name = $categories[0]->name;
        $cat_slug = $categories[0]->slug;
    }

    // Calculate estimated reading time (avg 200 words per minute)
    $content = $post->post_content;
    $word_count = str_word_count(strip_tags($content));
    $read_time = ceil($word_count / 200);

    // Get author data
    $author_id = $post->post_author;
    $desc = get_the_author_meta('description', $author_id);
    if(!$desc) $desc = 'Passionate about creating modern digital experiences through clean design and efficient development. Specializing in WordPress and WooCommerce solutions.';

    // Query related posts from the same category
    $cats = wp_get_post_categories($post->ID);
    $related = new WP_Query(array(
        'category__in' => $cats,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3,
        'post_status' => 'publish',
    ));

    // Build related posts HTML
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

    // Get featured image HTML
    $featured_img = '';
    if(has_post_thumbnail($post->ID)) {
        $featured_img = '<div class="post-featured-image">' . get_the_post_thumbnail($post->ID, 'full') . '</div>';
    }

    ob_start(); ?>
    <div class="single-post-wrapper">
        <!-- Category Badge -->
        <div class="post-category-wrap">
            <span class="cat-badge cat-<?php echo esc_attr($cat_slug); ?>"><?php echo esc_html($cat_name); ?></span>
        </div>

        <!-- Post Title -->
        <h1 class="post-title"><?php echo get_the_title($post->ID); ?></h1>

        <!-- Post Meta: Author, Date, Read Time -->
        <div class="post-meta">
            <span>By <?php echo get_the_author_meta('display_name', $author_id); ?></span>
            <span>•</span>
            <span>Published <?php echo get_the_date('F j, Y', $post->ID); ?></span>
            <span>•</span>
            <span><?php echo $read_time; ?> min read</span>
        </div>

        <!-- Featured Image -->
        <?php echo $featured_img; ?>

        <!-- Post Content -->
        <div class="post-content">
            <?php echo apply_filters('the_content', $post->post_content); ?>
        </div>

        <!-- Author Bio Box -->
        <div class="author-bio-box">
            <div class="author-avatar"><?php echo get_avatar($author_id, 72); ?></div>
            <div class="author-info">
                <h4 class="author-name"><?php echo get_the_author_meta('display_name', $author_id); ?></h4>
                <p class="author-role">Web Designer And Developer</p>
                <p class="author-desc"><?php echo esc_html($desc); ?></p>
            </div>
        </div>

        <!-- Related Articles -->
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
// Outputs CSS only on blog, archive, paged and
// search pages to keep styles scoped correctly
// =============================================
function custom_blog_page_styles() {
    if(is_home() || is_archive() || is_paged() || is_search()) { ?>
        <style>
        /* ===== FIX WORDPRESS BLOCK PADDING =====
         * Removes default padding WordPress adds to
         * block groups that contain our blog layout */
        .wp-block-group:has(.blog-hero) {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* ===== BLOG INNER GRID =====
         * Forces correct grid layout overriding
         * any WordPress default constraints */
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

        /* Hide empty paragraph tags WordPress auto-inserts inside grid */
        .blog-inner > p { display: none !important; }

        /* ===== HERO SECTION =====
         * Full width banner at top of blog page
         * with light gray background and centered text */
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

        /* ===== OUTER CONTAINER =====
         * Full width wrapper for blog content
         * with top and bottom padding */
        .blog-outer {
            width: 100%;
            padding: 60px 0 80px 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ===== INNER GRID LAYOUT =====
         * Two column layout: posts on left, sidebar on right
         * Max width 1200px centered on the page */
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

        /* ===== POST CARD GRID =====
         * Two column grid of post cards
         * in the main content area */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            width: 100%;
        }

        /* ===== BLOG CARD =====
         * Individual post card with rounded corners,
         * shadow and hover lift animation */
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

        /* Card thumbnail image area */
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

        /* Card body padding and flex layout */
        .blog-card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* ===== BLOG CATEGORY BADGES =====
         * Colored pill badges for each category
         * Uses different colors per category slug */
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

        /* Blog page category colors */
        .blog-cat-wordpress-development { background-color: #F59E0B; } /* Amber */
        .blog-cat-web-design { background-color: #3B82F6; }            /* Blue */
        .blog-cat-css-styling { background-color: #10B981; }           /* Green */
        .blog-cat-performance { background-color: #8B5CF6; }           /* Purple */

        /* Card title and link styles */
        .blog-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #111;
            margin: 0 0 10px 0;
            line-height: 1.4;
        }
        .blog-card-title a { text-decoration: none; color: inherit; }
        .blog-card-title a:hover { color: #3B82F6; }

        /* Card excerpt text */
        .blog-card-excerpt {
            font-size: 14px;
            color: #777;
            line-height: 1.65;
            margin: 0 0 12px 0;
            flex: 1;
        }

        /* Card meta: author, date, read time */
        .blog-card-meta { font-size: 13px; color: #aaa; margin: 0 0 16px 0; }

        /* ===== READ ARTICLE BUTTON =====
         * Outlined button at bottom of each card
         * Fills dark on hover for clear CTA */
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
        .blog-read-btn:hover { background: #111; color: #fff; border-color: #111; }

        /* ===== PAGINATION =====
         * Centered row of page number buttons
         * Current page highlighted in blue */
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

        /* ===== SIDEBAR =====
         * Sticky sidebar with search, categories
         * and recent posts widgets */
        .blog-sidebar { position: sticky; top: 20px; }

        /* Search input with icon */
        .blog-search { position: relative; margin-bottom: 36px; }
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

        /* Sidebar section titles */
        .sidebar-title { font-size: 20px; font-weight: 700; color: #111; margin: 0 0 16px 0; }

        /* Categories list with count on right */
        .sidebar-categories { list-style: none !important; padding: 0 !important; margin: 0 0 36px !important; }
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
        .sidebar-categories li .cat-count { font-size: 13px; color: #aaa; }

        /* Recent posts with thumbnail */
        .sidebar-recent { margin-bottom: 40px; }
        .recent-post-item { display: flex; gap: 12px; align-items: flex-start; margin-bottom: 16px; }
        .recent-post-thumb {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #f0f0f0;
        }
        .recent-post-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .recent-post-info h5 { font-size: 14px; font-weight: 600; color: #111; margin: 0 0 4px 0; line-height: 1.4; }
        .recent-post-info h5 a { text-decoration: none; color: inherit; }
        .recent-post-info h5 a:hover { color: #3B82F6; }
        .recent-post-info span { font-size: 12px; color: #aaa; }

        /* ===== RESPONSIVE: BLOG PAGE =====
         * Tablet (max 968px): Stack sidebar below posts
         * Mobile (max 600px): Single column cards, smaller hero */
        @media(max-width: 968px) {
            /* Stack blog layout vertically on tablet */
            .blog-inner {
                grid-template-columns: 1fr !important;
                padding: 0 20px !important;
            }
            .blog-sidebar {
                position: relative !important;
                top: 0 !important;
            }

            /* Stack blog layout on all blog-related pages */
            body.home .blog-inner,
            body.archive .blog-inner,
            body.search .blog-inner,
            body.paged .blog-inner {
                display: flex !important;
                flex-direction: column !important;
                padding: 0 16px !important;
            }

            /* Show sidebar below posts on mobile */
            body.home .blog-sidebar,
            body.archive .blog-sidebar,
            body.search .blog-sidebar,
            body.paged .blog-sidebar {
                width: 100% !important;
                position: relative !important;
                top: 0 !important;
                order: 2 !important;
            }

            /* Posts show first above sidebar */
            body.home .blog-main,
            body.archive .blog-main,
            body.search .blog-main,
            body.paged .blog-main {
                width: 100% !important;
                order: 1 !important;
            }

            /* Single column cards on tablet */
            body.home .blog-grid,
            body.archive .blog-grid,
            body.search .blog-grid,
            body.paged .blog-grid {
                grid-template-columns: 1fr !important;
            }
        }

        @media(max-width: 600px) {
            /* Smaller hero text on mobile */
            .blog-grid { grid-template-columns: 1fr !important; }
            .blog-hero h1 { font-size: 28px !important; }
            .blog-hero p { font-size: 14px !important; }
            .blog-inner { padding: 0 16px !important; }
            .blog-card-img { height: 160px !important; }

            /* Smaller pagination buttons on mobile */
            .blog-pagination { gap: 4px !important; }
            .blog-pagination a,
            .blog-pagination span { padding: 6px 10px !important; font-size: 12px !important; }
        }
        </style>
    <?php }
}
add_action('wp_head', 'custom_blog_page_styles');

// =============================================
// BLOG PAGE SHORTCODE
// Renders the full blog listing page including
// hero, post grid, pagination and sidebar
// =============================================
function custom_blog_page_content() {
    // Get current page number for pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

    // Get search query if present
    $search = get_search_query() ? get_search_query() : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '');

    // Get category filter if present
    $cat_filter = get_query_var('cat') ? get_query_var('cat') : (isset($_GET['cat']) ? intval($_GET['cat']) : 0);

    // Build query arguments
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => $paged,
    );

    if($search) $args['s'] = $search;
    if($cat_filter) $args['cat'] = $cat_filter;

    $blog_query = new WP_Query($args);

    // Get categories excluding Uncategorized for sidebar
    $categories = get_categories(array('hide_empty' => false, 'exclude' => get_cat_ID('Uncategorized')));

    // Get 3 most recent posts for sidebar
    $recent_posts = new WP_Query(array('posts_per_page' => 3, 'post_status' => 'publish'));

    ob_start();
    // Remove extra paragraph tags WordPress auto-adds
    add_filter('the_content', function($content) { return $content; });
    remove_filter('the_content', 'wpautop');
    ?>

    <!-- Blog Hero Section -->
    <div class="blog-hero">
        <h1>Our Blog</h1>
        <p>Insights, tutorials, and industry news</p>
    </div>

    <!-- Blog Main Layout: Posts + Sidebar -->
    <div class="blog-outer">
        <div class="blog-inner">

            <!-- Left Column: Post Grid + Pagination -->
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

                <!-- Pagination Controls -->
                <?php
                $total_pages = $blog_query->max_num_pages;
                if($total_pages > 1) : ?>
                <div class="blog-pagination">
                    <?php
                    $current = max(1, $paged);

                    // Previous page link
                    if($current > 1) echo '<a href="' . get_pagenum_link($current - 1) . '">← Previous</a>';
                    else echo '<span style="opacity:0.4;">← Previous</span>';

                    // Page number links
                    for($i = 1; $i <= $total_pages; $i++) {
                        if($i == $current) echo '<span class="current">' . $i . '</span>';
                        elseif($i <= 3 || $i == $total_pages) echo '<a href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                        elseif($i == 4 && $total_pages > 4) echo '<span>...</span>';
                    }

                    // Next page link
                    if($current < $total_pages) echo '<a href="' . get_pagenum_link($current + 1) . '">Next →</a>';
                    else echo '<span style="opacity:0.4;">Next →</span>';
                    ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="blog-sidebar">

                <!-- Article Search Form -->
                <form class="blog-search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <span class="blog-search-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    </span>
                    <input type="text" name="s" placeholder="Search Article..." value="<?php echo esc_attr($search); ?>">
                </form>

                <!-- Categories Widget -->
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

                <!-- Recent Posts Widget -->
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

// =============================================
// FIX BLOG PAGINATION QUERY
// Forces 4 posts per page on the main blog query
// to match our custom shortcode pagination
// =============================================
function custom_fix_blog_pagination($query) {
    if(!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('posts_per_page', 4);
    }
}
add_action('pre_get_posts', 'custom_fix_blog_pagination');

// =============================================
// CUSTOM POST TYPE: SERVICES
// Registers a custom post type for agency services
// Supports title, editor, thumbnail and excerpt
// =============================================
function evercrest_register_services_post_type() {
    $labels = array(
        'name'               => 'Services',
        'singular_name'      => 'Service',
        'menu_name'          => 'Services',
        'add_new'            => 'Add New Service',
        'add_new_item'       => 'Add New Service',
        'edit_item'          => 'Edit Service',
        'view_item'          => 'View Service',
        'all_items'          => 'All Services',
        'search_items'       => 'Search Services',
        'not_found'          => 'No services found',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true, // Required for Gutenberg editor support
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'        => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'rewrite'            => array('slug' => 'services'),
    );

    register_post_type('services', $args);
}
add_action('init', 'evercrest_register_services_post_type');