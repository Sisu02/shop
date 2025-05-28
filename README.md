add_shortcode('custom_coupon_form', 'custom_coupon_form_shortcode');
function custom_coupon_form_shortcode() {
    ob_start();
    ?>
    <form id="custom-coupon-form">
        <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code">
        <button type="submit">Apply Coupon</button>
        <button type="button" id="remove_coupon">Remove Coupon</button>
        <div id="coupon-message"></div>
    </form>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#custom-coupon-form').on('submit', function(e) {
                e.preventDefault();
                var coupon = $('#coupon_code').val();
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'apply_custom_coupon',
                        coupon_code: coupon
                    },
                    success: function(response) {
                        $('#coupon-message').html(response.data.message);
                        if (response.success) {
                            location.reload(); // to update cart totals
                        }
                    }
                });
            });

            $('#remove_coupon').on('click', function() {
                $.ajax({
                    url: '<?php echo admin_url("admin-ajax.php"); ?>',
                    type: 'POST',
                    data: {
                        action: 'remove_custom_coupon'
                    },
                    success: function(response) {
                        $('#coupon-message').html(response.data.message);
                        if (response.success) {
                            location.reload(); // to update cart totals
                        }
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}



_-------

add_action('wp_ajax_apply_custom_coupon', 'apply_custom_coupon');
add_action('wp_ajax_nopriv_apply_custom_coupon', 'apply_custom_coupon');

function apply_custom_coupon() {
    $coupon_code = sanitize_text_field($_POST['coupon_code']);
    if (WC()->cart->has_discount($coupon_code)) {
        wp_send_json_error(['message' => 'Coupon already applied.']);
    }

    $applied = WC()->cart->apply_coupon($coupon_code);
    if ($applied) {
        wp_send_json_success(['message' => 'Coupon applied successfully!']);
    } else {
        wp_send_json_error(['message' => 'Invalid or expired coupon.']);
    }
}

add_action('wp_ajax_remove_custom_coupon', 'remove_custom_coupon');
add_action('wp_ajax_nopriv_remove_custom_coupon', 'remove_custom_coupon');

function remove_custom_coupon() {
    $coupons = WC()->cart->get_applied_coupons();
    if (!empty($coupons)) {
        foreach ($coupons as $code) {
            WC()->cart->remove_coupon($code);
        }
        wp_send_json_success(['message' => 'Coupon removed.']);
    } else {
        wp_send_json_error(['message' => 'No coupons to remove.']);
    }
}
