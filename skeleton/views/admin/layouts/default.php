<nav class="navbar navbar-expand-lg navbar-admin">
	<div class="container">
		<?php
		/**
		 * Apply filter on the displayed brand on dashboard.
		 * @since 	1.4.0
		 */
		$brand = apply_filters('admin_logo', get_option('site_name', 'Skeleton'));
		echo admin_anchor('', $brand, 'class="navbar-brand"');
		?>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-admin" aria-controls="navbar-admin" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-fw fa-bars"></i></button>

		<div class="collapse navbar-collapse" id="navbar-admin">
			<?php
			// ------------------------------------------------------------------------
			// Dashboard main menu.
			// ------------------------------------------------------------------------
			echo '<ul class="navbar-nav mr-auto">',

			// 1. System dropdown.
			'<li class="nav-item dropdown">',
			html_tag('a', array(
				'href'        => '#',
				'class'       => 'nav-link dropdown-toggle',
				'data-toggle' => 'dropdown',
			), line('CSK_ADMIN_SYSTEM')),
			'<div class="dropdown-menu">',

				// Dashboard anchor.
				admin_anchor(
					'',
					line('CSK_ADMIN_ADMIN_PANEL'),
					'class="dropdown-item"'
				),
				'<div class="dropdown-divider"></div>',

				// Global settings.
				admin_anchor(
					'settings',
					line('CSK_ADMIN_GLOBAL_SETTINGS'),
					'class="dropdown-item"'
				);

				/**
				 * Fires inside the settings menu.
				 * @since 	2.0.0
				 */
				if (has_action('settings_menu')) {
					echo '<div class="dropdown-divider"></div>';
					do_action('settings_menu');
				}

				echo '<div class="dropdown-divider"></div>',
				admin_anchor(
					'settings/sysinfo',
					line('CSK_ADMIN_SYSTEM_INFORMATION'),
					'class="dropdown-item"'
				);

			// Closing tag.
			echo '</div>',

			// 2. Users menu.
			'<li class="nav-item dropdown">',
			admin_anchor('users', line('CSK_ADMIN_USERS'), array(
				'class' => 'nav-link dropdown-toggle',
				'data-toggle' => 'dropdown',
			)),
			'<div class="dropdown-menu">',
			admin_anchor('users', line('CSK_ADMIN_USERS_MANAGE'), 'class="dropdown-item"'),
			admin_anchor('users/groups', line('CSK_ADMIN_USERS_GROUPS'), 'class="dropdown-item"'),
			admin_anchor('users/levels', line('CSK_ADMIN_USERS_LEVELS'), 'class="dropdown-item"');

			/**
			 * Fires inside users menu.
			 * @since   2.0.0
			 */
			if (has_action('users_menu')) {
				echo '<div class="dropdown-divider"></div>';
				do_action('users_menu');;
			}

			// Closing tag (users menu).
			echo '</div></li>';

			/**
			 * Display menu for modules with content controller.
			 * @since 	2.0.0
			 */
			if (has_action('content_menu')) {
				// Menu opening tag.
				echo '<li class="nav-item dropdown">',
				html_tag('a', array(
					'href' => '#',
					'class'       => 'nav-link dropdown-toggle',
					'data-toggle' => 'dropdown',
				), line('CSK_ADMIN_CONTENT')),
				'<div class="dropdown-menu">';

				// Do the actual action.
				do_action('content_menu');

				// Menu closing tag.
				echo '</div></li>';
			}

			/**
			 * Display menu for modules with admin controller.
			 * @since 	2.0.0
			 */
			if (has_action('admin_menu')) {
				// Menu opening tag.
				echo '<li class="nav-item dropdown">',
				html_tag('a', array(
					'href' => '#',
					'class'       => 'nav-link dropdown-toggle',
					'data-toggle' => 'dropdown',
				), line('CSK_ADMIN_COMPONENTS')),
				'<div class="dropdown-menu">';

				// Do the actual action.
				do_action('admin_menu');

				// Menu closing tag.
				echo '</div></li>';
			}

			/**
			 * Display menu for modules with extensions controller.
			 * @since 	2.0.0
			 */
			echo '<li class="nav-item dropdown">',
			html_tag('a', array(
				'href' => '#',
				'class'       => 'nav-link dropdown-toggle',
				'data-toggle' => 'dropdown',
			), line('CSK_ADMIN_EXTENSIONS')),
			'<div class="dropdown-menu">',
			admin_anchor('modules', line('CSK_ADMIN_MODULES'), 'class="dropdown-item"'),
			admin_anchor('plugins', line('CSK_ADMIN_PLUGINS'), 'class="dropdown-item"'),
			admin_anchor('themes', line('CSK_ADMIN_THEMES'), 'class="dropdown-item"'),
			admin_anchor('languages', line('CSK_ADMIN_LANGUAGES'), 'class="dropdown-item"'),
			'</div></li>';

			/**
			 * Display menu for modules with reports controller.
			 * @since 	2.0.0
			 */
			if (has_action('reports_menu')) {
				// Menu opening tag.
				echo '<li class="nav-item dropdown">',
				html_tag('a', array(
					'href' => '#',
					'class'       => 'nav-link dropdown-toggle',
					'data-toggle' => 'dropdown',
				), line('CSK_ADMIN_REPORTS')),
				'<div class="dropdown-menu">';

				// Do the actual action.
				do_action('reports_menu');

				// Menu closing tag.
				echo '</div></li>';
			} else {
				echo '<li class="nav-item dropdown">',
				admin_anchor('reports', line('CSK_ADMIN_REPORTS'), 'class="nav-link"'),
				'</li>';
			}

			/**
			 * Help menu.
			 * @since 	2.0.0
			 */
			// Menu opening tag.
			echo '<li class="nav-item dropdown">';
			echo html_tag('a', array(
				'href'        => '#',
				'class'       => 'nav-link dropdown-toggle',
				'data-toggle' => 'dropdown',
			), line('CSK_ADMIN_HELP')),
			'<div class="dropdown-menu">';

			// Skeleton documentation.
			$csk_wiki_url = apply_filters('csk_wiki_url', 'https://goo.gl/WuLdkt');
			if ( ! empty($csk_wiki_url)) {
				echo html_tag('a', array(
					'href'   => $csk_wiki_url,
					'class'  => 'dropdown-item',
					'target' => '_blank',
				), line('CSK_ADMIN_DOCUMENTATION'));
			}

			/**
			 * Display modules with "Help.php" controllers.
			 * @since 	2.0.0
			 */
			if (has_action('help_menu')) {
				echo '<div class="dropdown-divider"></div>';
				do_action('help_menu');
			}

			/**
			 * Various CodeIgniter Skeleton URLS.
			 * @since 	2.0.0
			 */
			echo '<div class="dropdown-divider"></div>',

			// Link to extensions page.
			html_tag('a', array(
				'href' => '#',
				'class' => 'dropdown-item',
			), line('CSK_ADMIN_EXTENSIONS')),

			// Link to translations page.
			html_tag('a', array(
				'href' => '#',
				'class' => 'dropdown-item',
			), line('CSK_ADMIN_TRANSLATIONS')),

			// Link to shop page.
			html_tag('a', array(
				'href' => '#',
				'class' => 'dropdown-item',
			), line('CSK_ADMIN_SKELETON_SHOP'));
			
			// Menu closing tag.
			echo '</div></li>',

			// Dashboard main menu closing tag.
			'</ul>',

			// ------------------------------------------------------------------------
			// Dashboard right menu.
			// ------------------------------------------------------------------------
			'<ul class="navbar-nav my-2 my-lg-0">';

			// 1. Languages dropdown.
			if ($site_languages) {
				echo '<li class="nav-item dropdown" id="lang-dropdown">',
				
				html_tag('a', array(	// Dropdown toggler.
					'href'        => '#',
					'class'       => 'nav-link dropdown-toggle',
					'data-toggle' => 'dropdown',
				), $current_language['name']),
				'<div class="dropdown-menu dropdown-menu-right">';

				// Language list.
				foreach ($site_languages as $folder => $lang) {
					echo html_tag('a', array(
						'href' => site_url('process/set_language/'.$folder),
						'class' => 'dropdown-item',
					), $lang['name_en'].html_tag('span', array(
						'class' => 'text-grey pull-right'
					), $lang['name']));
				}
				unset($lang);

				echo '</div></li>';
			} else {
				echo '<li id="lang-dropdown"></li>';
			}

			// 2. View site anchor.
			echo html_tag('li', array(
				'class' => 'nav-item csk-view-site'
			), html_tag('a', array(
				'href' => site_url(),
				'class' => 'nav-link'
			), line('CSK_ADMIN_VIEW_SITE'))),

			// 3. User dropdown.
			'<li class="nav-item dropdown user-menu">',
			
			html_tag('a', array(
				'href' => '#',
				'class' => 'nav-link dropdown-toggle',
				'data-toggle' => 'dropdown',
			), $c_user->first_name.user_avatar(24, $c_user->id, 'class="rounded-circle"')),
			
			'<div class="dropdown-menu dropdown-menu-right">',

				// View profile anchor.
				anchor(
					$c_user->username,
					line('CSK_ADMIN_USER_VIEW_PROFILE'),
					'class="dropdown-item"'
				),

				// Edit account anchor.
				admin_anchor(
					'users/edit/'.$c_user->id,
					line('CSK_ADMIN_USER_EDIT_PROFILE'),
					'class="dropdown-item"'
				),

				'<div class="dropdown-divider"></div>',

				// Logout anchor.
				anchor('logout', line('CSK_ADMIN_LOGOUT'), 'class="dropdown-item"'),
			'</div></li>',

			// Closing tag (right menu).
			'</ul>';
			?>
		</div><!--/.navbar-collapse-->
	</div><!--/..container-->
</nav>

<header class="header" id="header" role="banner">
	<div class="container">
		<?php
		/**
		 * Fires on page header.
		 * @since 	2.0.0
		 */
		// Default Icon and Title.
		$default_icon  = 'home';
		$default_title = line('CSK_ADMIN_DASHBOARD');

		// Provided Icon and title.
		$page_icon  = isset($page_icon) ? $page_icon : $default_icon;
		$page_title = isset($page_title) ? $page_title : $default_title;

		// Filtered icon and title.
		$page_icon  = apply_filters('admin_page_icon', $page_icon);
		$page_title = apply_filters('admin_page_title', $page_title);

		if (empty($page_title) OR $page_title === $default_title) {
			$page_title = $default_title;
		}
		if (empty($page_icon) OR $page_icon === $default_icon) {
			$page_icon = $default_icon;
		}
		$page_icon .= ' page-icon';

		echo '<h1 class="page-title">'.fa_icon($page_icon).$page_title.'</h1>';

		/**
		 * Skeleton logo filter.
		 * @since 	2.0.0
		 */
		$skeleton_logo_src = apply_filters('skeleton_logo_src', get_common_url('img/logo.png'));
		$skeleton_logo_alt = apply_filters('skeleton_logo_alt', 'Skeleton');
		if ( ! empty($skeleton_logo_src)) {
			echo html_tag(
				'div',
				'class="logo-container"',
				html_tag('img', array(
					'src'   => $skeleton_logo_src,
					'class' => 'logo',
					'alt'   => $skeleton_logo_alt,
				))
			);
		}
		?>
	</div>
</header><!--/.header-->

<?php
/**
 * Subhead section.
 * @since 	2.0.0
 */
if (has_action('admin_subhead') OR true === $module['has_help'] OR isset($page_help)) {

	// Opening tags.
	echo '<div class="navbar navbar-expand-lg subhead">',
	'<div class="container">';

		/**
		 * Fires inside the admin subhead section.
		 * @since 	2.0.0
		 */
		echo '<div class="navbar-nav d-block">';
		do_action('admin_subhead');
		echo '</div>';

		/**
		 * Display help/settings for the current section.
		 * @since 	2.0.0
		 */
		echo '<div class="my-2 my-lg-0">';
		
		if (true === $module['has_help']) {
			echo html_tag('a', array(
				'href'   => (true === $module['contexts']['help'] ? admin_url('help/'.$module['folder']) : $module['contexts']['help']),
				'target' => '_blank',
				'class'  => 'btn btn-white btn-sm btn-icon',
			), fa_icon('question-circle').line('help'));
		} elseif (isset($page_help)) {
			echo html_tag('a', array(
				'href'   => $page_help,
				'target' => '_blank',
				'class'  => 'btn btn-white btn-sm btn-icon',
			), fa_icon('question-circle').line('CSK_ADMIN_HELP'));
		}

		if (true === $module['has_settings']) {
			echo html_tag('a', array(
				'href'  => admin_url('settings/'.$module['folder']),
				'class' => 'btn btn-white btn-sm btn-icon ml5',
			), fa_icon('cog').line('CSK_ADMIN_BTN_SETTINGS'));
		}

		if (isset($page_donate)) {
			echo html_tag('a', array(
				'href'  => $page_donate,
				'class' => 'btn btn-olive btn-sm btn-icon ml15',
			), fa_icon('money').line('CSK_ADMIN_BTN_DONATE'));
		}

		echo '</div>';

	// Closing tags.
	echo '</div></div>';
}
?>

<main class="wrapper" id="wrapper" role="main">
	<div class="container">
		<?php
		// Bootstrap alert.
		the_alert();

		/**
		 * Fires at the top of page content.
		 * @since 	1.4.0
		 */
		do_action('admin_page_header');

		// Display the page content.
		the_content();

		/**
		 * Fires at the end of page content.
		 * @since 	1.4.0
		 */
		do_action('admin_page_footer');
		?>
	</div>
</main>

<footer class="footer" id="footer" role="contactinfo">
	<div class="container">
		<?php
		/**
		 * Fires right after the opening tag of the admin footer.
		 * @since 	1.4.0
		 */
		do_action('in_admin_footer');

		/**
		 * Footer thank you line.
		 * @since 	1.3.3
		 * This line can be removed/overridden using the "admin_footer_text".
		 */
		echo '<span class="text-muted" id="footer-thankyou">';
		$thankyou = sprintf(line('CSK_ADMIN_FOOTER_TEXT'), 'https://goo.gl/jb4nQC');
		/**
		 * Filters the "Thank you" text displayed in the admin footer.
		 * @since 	1.3.3
		 */
		echo apply_filters('admin_footer_text', $thankyou),
		'</span>',

		/**
		 * Footer version text.
		 * @since 	1.4.0
		 * Can be removed or overridden using the "admin_version_text" fitler.
		 */
		'<span class="text-muted pull-right" id="footer-upgrade">';
		$version = sprintf(line('CSK_ADMIN_VERSION_TEXT'), KB_VERSION);
		echo apply_filters('admin_version_text', $version),
		'</span>';
		?>
	</div>
</footer>
<script type="text/x-handlebars-template" id="csk-alert-template">
<div class="alert alert-{{type}} alert-dismissible fade show" role="alert" id="csk-alert">
	{{{message}}}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
</script>