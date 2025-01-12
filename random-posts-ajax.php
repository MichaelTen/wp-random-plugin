<?php
/**
 * Plugin Name: WP Random Post Shortcode v0.2
 * Description: Adds a [my_random_link] shortcode that links to a random published post, updated each time you click.
 * Version: 0.2
 * Author: Michael
 */

if (!defined('ABSPATH')) {
    exit; // No direct access.
}

/**
 * AJAX handler for returning a random published post.
 */
function mrp_get_random_post_ajax() {
    // Fetch one random published post (of type 'post')
    $random_post = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ]);

    if (!empty($random_post)) {
        $url = get_permalink($random_post[0]->ID);
        wp_send_json_success(['url' => $url]);
    }

    // If no posts were found
    wp_send_json_error(['message' => 'No posts available.']);
}
add_action('wp_ajax_mrp_get_random_post', 'mrp_get_random_post_ajax');
add_action('wp_ajax_nopriv_mrp_get_random_post', 'mrp_get_random_post_ajax');

/**
 * Shortcode: [my_random_link]
 * Outputs a link labeled "Random" and inline JS that updates the link each time you click.
 */
function mrp_random_link_shortcode($atts) {
    ob_start(); ?>
    <a id="mrp-random-link" href="#">Random</a>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const link = document.getElementById('mrp-random-link');

            // 1. Fetch an initial random post on page load, so the user sees an actual URL on hover.
            fetchRandomLink();

            // 2. Each click: we *don't* call e.preventDefault(), so normal/ctrl-click opens it,
            //    but we still fetch a new random link for the next click.
            link.addEventListener('click', function(e) {
                // If user Ctrl+Clicks (or Cmd+Clicks on Mac) they remain on this page.
                // After a short delay, we fetch a new link so next time it will be different.
                setTimeout(() => {
                    fetchRandomLink();
                }, 300);
            });

            function fetchRandomLink() {
                const ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>?action=mrp_get_random_post';
                fetch(ajaxUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            link.href = data.data.url;
                        } else {
                            alert(data.data.message);
                            // If you prefer disabling the link:
                            // link.removeAttribute('href');
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching random post:', err);
                    });
            }
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('my_random_link', 'mrp_random_link_shortcode');
