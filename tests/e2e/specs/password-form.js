/**
 * Test Password Form block in editor
 *
 * @since .0.0
 */

import {
	activatePlugin,
	createNewPost,
	deactivatePlugin,
	enablePageDialogAccept,
	getEditedPostContent,
	insertBlock,
	publishPost,
	trashAllPosts,
} from '@wordpress/e2e-test-utils';

/**
 * Create a demo post and page
 */
const createDemoPosts = async () => {
	await createNewPost( { postType: 'post', title: 'PFB Demo Post' } );
	await publishPost();

	await createNewPost( { postType: 'page', title: 'PFB Demo Page' } );
	await publishPost();
};

/**
 * Trash posts and pages
 */
const trashPosts = async () => {
	await trashAllPosts();
	await trashAllPosts( 'page' );
};

describe( 'Password Form Block', () => {
	// make sure editor dialogs are skipped and posts/pages are reset
	beforeAll( async () => {
		await activatePlugin( 'password-form-block' );
		await enablePageDialogAccept();
		await trashPosts();
	} );

	afterAll( async () => {
		await trashPosts();
		await deactivatePlugin( 'password-form-block' );
	} );

	it( 'Can be added', async () => {
		await createNewPost();
		await insertBlock( 'Posts' );

		// make sure it was inserted
		expect(
			await page.$( '[data-type="password-form-block/password-form"]' )
		).not.toBeNull();

		// and that it matches the snapshot
		expect( await getEditedPostContent() ).toMatchSnapshot();
	} );

	// it( 'Displays the demo post and page', async () => {
	// 	await createDemoPosts();
	// 	await createNewPost();
	// 	await insertBlock( 'Posts' );

	// 	const postTitles = await page.$$( '.apb-post-title' );
	// 	const postTitlesText = [];

	// 	for ( let i = 0; i < postTitles.length; i++ ) {
	// 		postTitlesText.push(
	// 			await (
	// 				await postTitles[ i ].getProperty( 'innerText' )
	// 			 ).jsonValue()
	// 		);
	// 	}

	// 	expect( postTitlesText ).toStrictEqual( [
	// 		'APB Demo Page',
	// 		'APB Demo Post',
	// 	] );
	// }, 60000 ); // Demo post creation takes sooooooooo long :(
} );
