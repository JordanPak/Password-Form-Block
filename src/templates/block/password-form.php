<?php
/**
 * Password form block template
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

namespace Password_Form_Block;

?>
<div <?php do_attrs_class( 'pfb-password-form', $className ?? '' ); ?>>
	<h2>YEET</h2>
	<?php echo get_the_password_form(); // phpcs:ignore xss ?>
</div>
