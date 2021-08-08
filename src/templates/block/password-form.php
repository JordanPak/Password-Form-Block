<?php
/**
 * Password form block template
 *
 * @since   1.0.0
 * @package Password_Form_Block
 */

namespace Password_Form_Block;

if (
	! is_block_editor()
	&& ! instance()->password_handler->get_unfiltered_post_password_required()
) {
	return;
}
?>
<div <?php do_attrs_class( 'pfb-password-form', $className ?? '' ); ?>>
	<?php echo get_the_password_form(); // phpcs:ignore xss ?>
</div>
