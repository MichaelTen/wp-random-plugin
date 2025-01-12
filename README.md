# wp-random-plugin
wp random plugin short code for widget (for WordPress)

# My Random Post Shortcode Plugin

**Description**  
A simple WordPress plugin that provides a `[my_random_link]` shortcode. When placed on any page, post, or widget, it displays a **“Random”** link that opens a randomly selected published post. After each click (including Ctrl+Click to open in a new window), the link updates itself via AJAX so the next click leads to a different random post.

---

## Files in This Repository

- **my-random-post.php**  
  Main plugin file. Contains the AJAX handler and shortcode logic.
- **README.md**  
  This file with setup steps and usage instructions.

---

## Installation

1. Create a new folder in your WordPress `wp-content/plugins` directory called `my-random-post`.  
2. Download or open `my-random-post.php` from this repository.  
3. Using a text editor, copy the code from `my-random-post.php` and paste it into a file of the same name inside the `my-random-post` folder.  
4. Log in to your WordPress Admin. Go to **Plugins → Installed Plugins** and locate **My Random Post Shortcode**. Click **Activate**.

---

## Usage

1. Edit any post, page, or text widget in WordPress.  
2. Add the shortcode `[my_random_link]` wherever you want the “Random” link to appear.  
3. View the post or page. You’ll see a link labeled “Random.”  
4. Hover over it to see the randomly fetched post URL. Clicking (or Ctrl+Clicking) will open that random post. Each subsequent click triggers a fresh random post URL.

---

## Frequently Asked Questions

**Q: Why do I see “No posts available”?**  
A: Ensure you have at least one published “post” in the default **Posts** section of WordPress (not Pages or custom post types). Also check if any security plugin might be blocking AJAX calls.

**Q: How do I style the link?**  
A: By default, it uses your theme’s normal link styling. If you want a custom style, wrap the shortcode in a `<div>` with a custom class, or add your own CSS rules targeting `#mrp-random-link`.

---

## Contributing

Feel free to open an issue. 

---

## License

Distributed under the MIT License. See [LICENSE](LICENSE) for more details.

--- 

For full source code details, check the individual files in this repository.
