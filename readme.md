# Wp API Featured images

A simple class to add featured images to the Wordpress API. Essentially, we're just modifying the response endpoint via `register_rest_field`.

Of course, you can just append `?_embed` onto your request to return a ton of `featured_media` info. But, I just needed a single url, so here we are.

## More

[Here's a little post](http://stephenscaff.com/articles/2018/02/add-featured-images-to-wordpress-api/) on the matter.
