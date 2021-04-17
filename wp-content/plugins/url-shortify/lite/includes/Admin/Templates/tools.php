<?php

use Kaizen_Coders\Url_Shortify\Helper;

$nav_menus = Helper::get_data( $template_data, 'links', array() );

$tab    = ! empty( $_GET['tab'] ) ? Helper::clean( $_GET['tab'] ) : 'import';
$action = ! empty( $_GET['action'] ) ? Helper::clean( $_GET['action'] ) : '';

$current_url = \Kaizen_Coders\Url_Shortify\Common\Utils::get_current_page_url();

$nonce = wp_create_nonce( 'kc_us_import' );

$valid_imports = array( 'pretty_links', 'mts_links' );

$current_url = add_query_arg( 'nonce', $nonce, $current_url );

$received_nonce   = ! empty( $_GET['nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
$is_valid_request = wp_verify_nonce( $received_nonce, 'kc_us_import' );

$import_status = Helper::get_request_data( 'import_status', '' );

?>

<div class="wrap">
    <h2>Tools</h2>
    <h2 class="nav-tab-wrapper">
		<?php foreach ( $nav_menus as $id => $menu ) { ?>
            <a href="<?php echo $menu['link']; ?>" class="nav-tab wpsf-tab-link <?php if ( $id === $tab ) {
				echo "nav-tab-active";
			} ?>">
				<?php echo $menu['title']; ?>
            </a>
		<?php } ?>
    </h2>

    <div class="bg-white shadow-md meta-box-sortables">

        <!-- First Screen - List all import section -->
		<?php if ( 'import' === $tab && '' === $action ) {


			if ( 'success' === $import_status ) { ?>
                <div class="notice notice-success is-dismissible"><p><?php _e( 'Import successfully completed!' ); ?></p></div>
			<?php } elseif ( 'error' === $import_status ) { ?>
                <div class="notice notice-error is-dismissible"><p><?php _e( 'Error occurred!' ); ?></p></div>
			<?php } ?>

            <!--
            <div class="flex-row pt-2 pb-2 ml-5 mr-4 text-left item-center">
                <div class="flex flex-row border-b border-gray-100">
                    <div class="flex w-4/5">
                        <label for="">
                            <span class="block pt-1 pb-2 pr-4 ml-4 text-sm font-medium text-gray-600">
                                <?php  _e( 'Import From CSV File', 'url-shortify' ); ?>
                            </span>
                        </label>
                    </div>
                    <div class="flex w-1/5">
                        <a href="<?php echo esc_url_raw( $current_url ); ?>&action=csv" class="px-4 py-2 mx-2 my-2 text-sm font-medium leading-5 align-middle transition duration-150 ease-in-out border border-indigo-600 rounded-md cursor-pointer hover:shadow-md focus:outline-none focus:shadow-outline-indigo">
	                        <?php _e( 'Import', 'url-shortify' ); ?>
                        </a>
                    </div>
                </div>
            </div>
            -->

			<?php if ( Helper::is_pretty_links_table_exists() ) { ?>
                <div class="flex-row pt-2 pb-2 ml-5 mr-4 text-left item-center">
                    <div class="flex flex-row border-b border-gray-100">
                        <div class="flex w-4/5">
                            <label for="">
                            <span class="block pt-1 mb-2 pr-4 ml-4 text-sm font-medium text-gray-600">
                                <?php echo sprintf( __( 'Import Short Links From <a href="%s" target="_blank">Pretty Links</a> WordPress Plugin', 'url-shortify' ), 'https://wordpress.org/plugins/prettylinks' ); ?>
                            </span>
                            </label>
                        </div>
                        <div class="flex w-1/5">
                            <a href="<?php echo esc_url_raw( $current_url ); ?>&action=pretty_links" class="px-4 py-2 mx-2 my-2 text-sm font-medium leading-5 align-middle transition duration-150 ease-in-out border border-indigo-600 rounded-md cursor-pointer hover:shadow-md focus:outline-none focus:shadow-outline-indigo">
								<?php _e( 'Import', 'url-shortify' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
			<?php }


			if ( Helper::is_mts_short_links_table_exists() ) { ?>

                <div class="flex-row pt-1 mb-2 ml-5 mr-4 text-left item-center">
                    <div class="flex flex-row border-b border-gray-100">
                        <div class="flex w-4/5">
                            <label for="">
                            <span class="block pt-1 pb-2 pr-4 ml-4 text-sm font-medium text-gray-600">
                                <?php echo sprintf( __( 'Import Short Links From <a href="%s" target="_blank">URL Shortener by MyThemeShop</a> WordPress Plugin', 'url-shortify' ), 'https://wordpress.org/plugins/mts-url-shortener/' ); ?>
                            </span>
                            </label>
                        </div>
                        <div class="flex w-1/5">
                            <a href="<?php echo esc_url_raw( $current_url ); ?>&action=mts_links" class="px-4 py-2 mx-2 my-2 text-sm font-medium leading-5 align-middle transition duration-150 ease-in-out border border-indigo-600 rounded-md cursor-pointer hover:shadow-md focus:outline-none focus:shadow-outline-indigo">
								<?php _e( 'Import', 'url-shortify' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
			<?php } ?>
		<?php } elseif ( 'import' === $tab && 'csv' === $action ) { ?>

            <div class="flex-row pt-2 pb-2 ml-5 mr-4 text-left item-center">
                <div class="flex flex-row border-b border-gray-100">
                    <div class="flex w-2/5">
                        <label for="">
                            <span class="block pt-1 pb-2 pr-4 ml-4 text-sm font-medium text-gray-600">Select CSV File</span>
                        </label>
                    </div>
                    <div class="flex w-3/5">

                    </div>
                </div>
            </div>

		<?php } elseif ( 'import' === $tab && in_array( $action, $valid_imports ) && $is_valid_request ) {

			if ( 'pretty_links' === $action ) {
				$import    = new \Kaizen_Coders\Url_Shortify\Admin\Controllers\ImportController();
				$do_import = $import->import_pretty_links();
			} elseif ( 'mts_links' === $action ) {
				$import    = new \Kaizen_Coders\Url_Shortify\Admin\Controllers\ImportController();
				$do_import = $import->import_mts_short_links();
			} else {
				$do_import = false;
			}

			$current_url = remove_query_arg( 'action' );
			if ( $do_import ) {
				$current_url = add_query_arg( array( 'import_status' => 'success' ), $current_url );
			} else {
				$current_url = add_query_arg( array( 'import_status' => 'error' ), $current_url );
			}

			wp_safe_redirect( $current_url );
			exit;
		} ?>


    </div>

</div>
