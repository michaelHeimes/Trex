<?php

if (class_exists('WP_Session')) {

	/**
	* this file saves/loads localstorage values to/from wp_session
	* everything is loaded through ajax to avoid caching issues
	* Modernizr and wp_session are required for this
	*/
	class dg_localstorage {

		var $items = array();
		var $items_set = array();
		var $sessions_post_type = 'cart_sessions';
		var $has_cart = true;
		
		function __construct() {

			$wp_session = WP_Session::get_instance();
			
			// setup all items to store here
			/**
			 * field - name of the field
			 * namespace - added to the beginning of the field ex searchnamespace.field_name (optional)
			 * value - ex $_GET['searchparam'] or $wp_session['searchparam']
			 * filter_var - which sanitize filter to use ex FILTER_SANITIZE_STRING or FILTER_SANITIZE_NUMBER_INT
			 */
			if ($this->has_cart) {
				$this->items[] = array(
				'field' => 'wp_session_id',
				'namespace' => 'session',
				'value' => substr( filter_input( INPUT_COOKIE, WP_SESSION_COOKIE, FILTER_SANITIZE_STRING ), 0, 32 ),
				'filter_var' => 'FILTER_SANITIZE_STRING'
				);
			}

			/*$this->items[] = array(
				'field' => 'contact-email',
				'namespace' => 'test',
				'value' => $wp_session['cart_status'],
				'filter_var' => 'FILTER_SANITIZE_STRING'
				);*/

        	add_action( 'wp_ajax_nopriv_dg_set_localstorage_items', array( $this, 'dg_set_localstorage_items' ) );
        	add_action( 'wp_ajax_dg_set_localstorage_items', array( $this, 'dg_set_localstorage_items' ) ); 

        	add_action( 'wp_ajax_nopriv_dg_load_localstorage_items', array( $this, 'dg_load_localstorage_items' ) );
        	add_action( 'wp_ajax_dg_load_localstorage_items', array( $this, 'dg_load_localstorage_items' ) ); 

			add_action( 'wp_head', array( $this, 'set_items_ajax' ) );

		}

		function set_items_ajax() {
			?>
			<script>
			$(function() {
				if (Modernizr.localstorage) {
					dg_set_localstorage();
				}
			});
			</script>
			<?php
		}

		// save items to localstorage setItem()
		function set_items() {
			foreach ($this->items as $key => $item):
				$value = $item['value'];
				if ($value === false) continue;

				// skip session, will handle later
				if ($item['field'] == 'wp_session_id') {
					$this->items_set[$item['namespace']][$item['field']] = '';
					continue;
				}

				switch ($item['filter_var']) {
					case 'FILTER_SANITIZE_STRING':
						$value = filter_var($value, FILTER_SANITIZE_STRING);
						break;
					case 'FILTER_SANITIZE_NUMBER_INT':
						$value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
						break;
				}
				$value = (is_array($value) ? json_encode($value) : $value);
				?>
				localStorage.setItem('<?php echo $item['namespace'].'.'.$item['field']; ?>', '<?php echo $value; ?>');
				<?php
				$this->items_set[$item['namespace']][$item['field']] = $value;
			endforeach;
		}

		// save item to localstorage setItem()
		function set_item($args) {
			foreach ($this->items as $key => $item):
				if ($item['field'] != $args['field'] && $item['namespace'] != $args['namespace']) continue;

				$value = $args['value'];
				if ($value === false) continue;
				switch ($item['filter_var']) {
					case 'FILTER_SANITIZE_STRING':
						$value = filter_var($value, FILTER_SANITIZE_STRING);
						break;
					case 'FILTER_SANITIZE_NUMBER_INT':
						$value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
						break;
				}
				$value = (is_array($value) ? json_encode($value) : $value);
				?>
				localStorage.setItem('<?php echo $item['namespace'].'.'.$item['field']; ?>', '<?php echo $value; ?>');
				<?php
				$this->items_set[$item['namespace']][$item['field']] = $value;
			endforeach;
		}


		function set_wp_session_items() {
			?>
			dg_local = <?php echo json_encode($this->items_set); ?>;
			<?php
			foreach ($this->items_set as $namespace => $namespaces):
				foreach ($namespaces as $key => $value):
					if (empty($value)):
			?>
				value = localStorage.getItem('<?php echo $namespace.'.'.$key; ?>');
				try {
					value = jQuery.parseJSON(value);
			    } catch (e) {
			        value = localStorage.getItem('<?php echo $namespace.'.'.$key; ?>');
			    }
			    dg_local['<?php echo $namespace; ?>']['<?php echo $key; ?>'] = value;
			<?php endif; endforeach; endforeach; ?>

			//console.log(dg_local);
			
			ajaxurl = "/wp-admin/admin-ajax.php";
			jQuery.post(ajaxurl, {action : 'dg_load_localstorage_items', 'localstorage':dg_local}, function(response){jQuery('body').append(response);});

			<?php
		}

		// wrapper function to keep things unique
		function dg_set_localstorage_items() {
			?>
			<script>
			//$(function() {
				if (Modernizr.localstorage) {
					<?php $this->set_items(); ?>
					<?php $this->set_wp_session_items(); ?>
				}
			//});
			</script>
			<?php

			// kill
			die();
		}

		function load_wp_session() {
			$wp_session = WP_Session::get_instance();

			$localstorage = (isset($_POST['localstorage']) ? $_POST['localstorage'] : array() );

			foreach ($this->items as $key => $item):
				if (isset($localstorage[$item['namespace']][$item['field']])) {
					$value = $localstorage[$item['namespace']][$item['field']];
					if ($value === false) continue;

					// skip session, handled elsewhere
					if ($item['field'] == 'wp_session_id') continue;

					switch ($item['filter_var']) {
						case 'FILTER_SANITIZE_STRING':
							$value = filter_var($value, FILTER_SANITIZE_STRING);
							break;
						case 'FILTER_SANITIZE_NUMBER_INT':
							$value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
							break;
					}
					$value = (is_array($value) ? json_decode($value) : $value);
					$wp_session[$item['namespace']][$item['field']] = $value;
				}
			endforeach;

			// kill
			return false;
		}

		function load_cart_wp_session() {
			$wp_session = WP_Session::get_instance();

			$localstorage = (isset($_POST['localstorage']) ? $_POST['localstorage'] : array() );
			$wp_session_id = (isset($_POST['localstorage']['session']['wp_session_id']) ? $_POST['localstorage']['session']['wp_session_id'] : array() );

			// check if current session matches saved
			$session_id = substr( filter_input( INPUT_COOKIE, WP_SESSION_COOKIE, FILTER_SANITIZE_STRING ), 0, 32 );
			if ($session_id == $wp_session_id && !empty($wp_session_id)) {
				return false;
			}

			// check if cart exists
			$args = array(
				'post_type' => $this->sessions_post_type,
				'posts_per_page' => -1,
				'name' => $wp_session_id
			);
			$posts = get_posts($args);
				$post = false;
				if (count($posts) > 0) $post = current($posts);

			// if cart post exists
			if ($post) {
				$postmeta = get_post_meta($post->ID);

				// load session from old cart
				foreach ($postmeta as $key => $value) {
					$value = current($value);
					if (is_serialized($value)) {
						//print_r($value);
						$value = maybe_unserialize($value);
					}
					$wp_session[$key] = $value;
				}
			}

			// save session id to local storage
			$args = array(
				'field' => 'wp_session_id',
				'namespace' => 'session',
				'value' => $session_id
				);
			?>
			<script>
			//$(function() {
				if (Modernizr.localstorage) {
					<?php $this->set_item($args); ?>
					jQuery('.toggle-cart').trigger('mouseover');
				}
			//});
			</script>
			<?php			

			//$wp_session_items = $wp_session->toArray();
			//print_r($wp_session_items);

			// kill
			return false;
		}

		// wrapper function to keep things unique
		function dg_load_localstorage_items() {
			$this->load_wp_session();

			if ($this->has_cart) $this->load_cart_wp_session();

			die();
		}

	}

	$dg_localstorage = new dg_localstorage();

}