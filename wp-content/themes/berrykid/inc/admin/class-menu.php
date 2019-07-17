<?php
defined('ABSPATH') || exit();

if (!class_exists("Wpopalbootstrap_Core_Admin_Menu")) {
    /**
     * @Class Wpopal_Core_Admin_Menu
     *
     * Entry point class to setup load all files and init working on frontend and process something logic in admin
     */
    class Wpopalbootstrap_Core_Admin_Menu
    {

        public $page_slug = 'wpopal_dashboard';

        public $project;

        public $theme_uri;


        public function after_active_theme()
        {
            global $pagenow;
            // Redirect to Opal welcome page after activating theme.
            if ('themes.php' == $pagenow && isset($_GET['activated']) && $_GET['activated'] == 'true') {
                // Redirect
                $key = sanitize_key('wpopal_available_demos');
                delete_transient($key);
                wp_redirect(admin_url('admin.php?page=dashboard'));
            }

        }

        public function __construct()
        {
            add_action('admin_menu', array($this, 'register_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'), 999);
            add_action('init', array($this, 'after_active_theme'));
            add_filter('wpopal_admin_menu_args', array($this, 'wpopal_admin_menu_args'));

            if (isset($_GET['page']) && $_GET['page'] == 'help') {
                add_action('wpopal_importer_help_tabs', array($this, 'render_theme_support'), 10);
            }
        }


        public function wpopal_admin_menu_args($args)
        {
            $args['name'] = 'ThemeLexus';
            return $args;
        }

        public function edit_tgmpa_notice_action_links($action_links)
        {
            $current_screen = get_current_screen();

            if ('opal-theme-plugins' == $current_screen->id) {
                $link_template = '<a id="manage-plugins" class="button-primary" style="margin-top:1em;" href="#opal-install-plugins">' . esc_attr__('Manage Plugins Below', 'arden') . '</a>';
            } else {
                $link_template = '<a id="manage-plugins" class="button-primary" style="margin-top:1em;" href="' . esc_url(self_admin_url('admin.php?page=opal-theme-plugins')) . '#opal-install-plugins">' . esc_attr__('Go Manage Plugins', 'arden') . '</a>';
            }

            $action_links = array('install' => $link_template, 'dismiss' => $action_links['dismiss']);

            return $action_links;
        }

        public function enqueue_scripts()
        {
            wp_enqueue_style('admin_css_style', get_stylesheet_directory_uri() . '/inc/admin/assets/admin.css', array());
        }

        /**
         * Retrieves the admin menu args
         *
         * @return array  Admin menu args
         */
        public function get_admin_menu_args()
        {

            $menu_name = esc_html__('Wpopal', 'arden');

            return apply_filters('wpopal_admin_menu_args', array(
                'name' => $menu_name,
                'title' => esc_html__('Welcome', 'arden'),
                'compatibility' => 'manage_options',
            ));
        }

        /**
         * Register the admin menu
         *
         * @return void
         */
        public function register_admin_menu()
        {

            $menu_args = $this->get_admin_menu_args();

            /*  Register welcome submenu
            /*---------------------------*/

            add_theme_page(
                $menu_args['title'],
                esc_html__('WpOpal', 'arden'),
                $menu_args['compatibility'],
                'dashboard',
                array($this, 'render')
            );

            do_action('wpopal_admin_menu_setup_after');
        }

        public function get_header_title()
        {
            return esc_html__('Welcome to Use %s', 'arden');
        }

        /**
         * Header section
         *
         * @param  string $type The current tab
         * @return void
         */
        protected function the_header($type = '')
        {
            global $wpopal_version;

            $this->theme_uri = get_template_directory_uri();
            $url = '';

            $the_theme = wp_get_theme();
            ?>

            <section class="jumbotron text-center p-4">
                <a class="theme-logo" href="#"><img
                            src="<?php echo esc_attr($this->theme_uri . '/inc/admin/assets/images/theme-logo.png'); ?>"></a>


                <div class="container">
                    <h1 class="jumbotron-heading"><?php echo sprintf('Welcome, Thanks for installing : %s', $the_theme->get('Name')); ?></h1>
                    <ul class="subtitle">
                        <li> 
                            <?php echo esc_html__('Version', 'arden'); ?>
                            : <?php echo esc_html($the_theme->get('Version')); ?> </li>
                        <li> <?php echo esc_html__('Information', 'arden'); ?>: 
                            <a class="theme-info-detail" href="<?php echo esc_attr($the_theme->get('ThemeURI')); ?>">
                                <?php esc_html_e('Click here', 'arden') ?>  
                            </a>
                        </li>
                    </ul>

                    <p class="lead text-muted"><?php echo trim( $the_theme->get('Description') ); ?></p>

                    <div class="wpopal-navigation">
                        <?php echo trim( $this->the_navigator() ); ?>
                    </div>

                </div>
            </section>
            <?php
        }

        public function get_menus()
        {
            $menu = array();

            $menus['dashboard'] = array(
                'url' => admin_url("admin.php?page=dashboard"),
                'title' => esc_html__('Dashboard', 'arden'),
            );

            $menus['tgmpa-install-plugins'] = array(
                'url' => admin_url("admin.php?page=tgmpa-install-plugins"),
                'title' => esc_html__('Install Plugins', 'arden'),
            );

            return apply_filters("wpopal_admin_menu_navigator", $menus);
        }

        /**
         *
         */
        public function the_navigator()
        {
            $menus = $this->get_menus();

            $active = isset($_GET['page']) ? $_GET['page'] : "";
            ?>
            <nav class="navbar">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php foreach ($menus as $page => $menu): ?>
                            <li class="nav-item <?php if ($page == $active) : ?>active<?php endif; ?>">
                                <a class="nav-link"
                                   href="<?php echo esc_attr($menu['url']); ?>"><?php echo esc_attr($menu['title']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </nav>
        <?php }

        public function the_footer()
        {

        }

        public function the_content()
        {
            $status = array();
            $status['plugin_required'] = 1;
            $theme = wp_get_theme();
            ?>

            <div class="theme-dashboard">
                <div class="dashboard-top theme-box-content  bg-white box-shadow">
                    <div class="row">
                        <div class="dashboard-intro wp-col-4">
                            <div class="theme-box-content">
                                <h3><?php esc_html_e('Import Demo', 'arden') ?></h3>
                                <?php if ($status['plugin_required']) { ?>
                                    <p class="text-description">
                                        <?php esc_html_e('Please check and make sure that all required plugins are set up on your website', 'arden') ?></p>
                                    <p>
                                        <a href="<?php echo esc_url(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
                                           class="button-second"><?php esc_html_e('Install Plugins', 'arden') ?></a>
                                    </p>
                                <?php } else { ?>
                                    <p class="text-description"><?php esc_html_e('Clone a demo site in few clicks', 'arden') ?></p>
                                    <a href="<?php echo esc_url(admin_url('admin.php?page=pt-one-click-demo-import')); ?>"
                                       class="button-second"><?php esc_html_e('Run Importer', 'arden') ?></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="theme-preview wp-col-4">
                            <div class="theme-box-content-image"><img class="mw-100 pr-lg-3"
                                                                      src="<?php echo esc_url($theme->get_screenshot()); ?>"
                                                                      alt="<?php echo esc_attr__('Screenshots', 'arden'); ?>">
                            </div>
                        </div>
                        <div class="wp-col-4">
                            <div class="theme-box-content">
                                <?php $this->system_check(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->render_theme_support(); ?>
        <?php }

        public function render()
        { ?>
            <div class="wpopal-admin-menu mr-4">
                <?php $this->the_header(); ?>
                <div class="page-menu-content">
                    <div class=""><?php echo trim($this->the_content()); ?></div>
                </div>
                <?php $this->the_footer(); ?>
            </div>
        <?php }

        public function system_check()
        {

            $data = array(
                'memory_limit' => wp_convert_hr_to_bytes(@ini_get('memory_limit')),
                'time_limit' => ini_get('max_execution_time'),
                'max_input_vars' => ini_get('max_input_vars'),
            );

            $status = array(
                'fs' => (WP_Filesystem()) ? true : false,
                'zip' => class_exists('ZipArchive'),
                'suhosin' => extension_loaded('suhosin'),
                'memory_limit' => $data['memory_limit'] >= 268435456,
                'time_limit' => (($data['time_limit'] >= 180) || ($data['time_limit'] == 0)) ? true : false,
                'max_input_vars' => $data['max_input_vars'] >= 5000
            );

            ?>
            <h2 class="medium-title pb-3 mt-lg-0"><?php esc_html_e('System Status', 'arden') ?></h2>
            <table class="table-check-status">
                <tbody>
                <tr>
                    <td>WP File System</td>
                    <td><span class="<?php echo esc_attr($status['fs'] ? 'pass' : 'fail') ?>"></span></td>
                    <td></td>
                </tr>
                <tr>
                    <td>ZipArchive</td>
                    <td><span class="<?php echo esc_attr($status['zip'] ? 'pass' : 'fail') ?>"></span></td>
                </tr>
                <tr>
                    <td>
                        PHP Memory Limit
                    </td>
                    <td>
                        <span class="<?php echo esc_attr($status['memory_limit'] ? 'pass' : 'fail') ?>"></span>
                    </td>
                    <td><?php echo size_format($data['memory_limit']); ?></td>
                </tr>
                <?php if ($status['memory_limit']) { ?>
                    <tr>
                        <td colspan="3" class="status-messenger">
                            <span class="status-rerequired"> <?php esc_html_e('Current memory limit is OK, however <u>256 MB</u> is recommended.', 'arden'); ?></span>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="status-messenger">
                            <?php esc_html_e('Minimum <u>128 MB</u> is required, <u>256 MB</u> is recommended.', 'arden'); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>
                        <?php esc_html_e(' PHP Time Limit', 'arden'); ?>
                    </td>
                    <td>
                        <span class="<?php echo esc_attr($status['time_limit'] ? 'pass' : ($data['time_limit'] >= 60) ? 'warning' : 'fail'); ?>"></span>
                    </td>
                    <td><?php echo esc_html($data['time_limit']); ?></td>
                </tr>
                <?php if ($data['time_limit'] < 60) { ?>
                    <tr>
                        <td colspan="3" class="status-messenger">
                            <span class="status-rerequired"> <?php esc_html_e('Minimum <u>60</u> is required, <u>180</u> is recommended.', 'arden'); ?></span>
                        </td>
                    </tr>
                <?php } elseif ($data['time_limit'] < 180) { ?>
                    <tr>
                        <td colspan="3" class="status-messenger">
                            <span class="status-rerequired"><?php esc_html_e('Current time limit is OK, however <u>180</u> is recommended.', 'arden'); ?> </span>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td><?php esc_html_e('PHP Max Input Vars', 'arden'); ?></td>
                    <td>
                        <span class="<?php echo esc_attr($status['max_input_vars'] ? 'pass' : 'fail') ?>"></span>
                    </td>
                    <td><?php echo esc_html($data['max_input_vars']) ?></td>
                </tr>
                </tbody>
            </table>

        <?php }

        public function render_theme_support()
        {
            global $wp_filesystem;
            $project = json_decode($wp_filesystem->get_contents(get_template_directory() . '/project.json'), true);

            ?>

            <div class="theme-dashboard">
                <div class="row">
                    <div class="wp-col-4">
                        <div class="bg-white box-shadow theme-box-content">


                            <img class="img-auto"
                                 src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/support.png')); ?>"
                                 title="wp opal">
                            <h3><?php esc_html_e('Support Cover', 'arden') ?></h3>
                            <p><?php esc_html_e('We give you a reply within 24 hours except during weekends.', 'arden') ?></p>
                            <div class="box-footer">
                                <a href="<?php echo esc_attr($project['support']); ?>" target="_blank"
                                   class="button button-primary"><?php esc_html_e('Submit Ticket', 'arden') ?></a>
                            </div>


                        </div>
                    </div>
                    <div class="wp-col-4">
                        <div class="bg-white box-shadow theme-box-content">

                            <img class="img-auto"
                                 src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/documentation.png')); ?>"
                                 title="wp opal">
                            <h3><?php esc_html_e('Documentation', 'arden') ?></h3>
                            <p><?php esc_html_e('Read all documentation for our themes. Any questions or training needed for WordPress themes can be  found here.', 'arden') ?></p>
                            <div class="box-footer">
                                <a href="<?php echo esc_attr($project['document']); ?>"
                                   class="button button-primary"><?php esc_html_e('Explore Now', 'arden') ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="wp-col-4">
                        <div class="bg-white box-shadow theme-box-content box-info">

                            <img class="img-auto"
                                 src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/information.png')); ?>"
                                 title="wp opal">
                            <h3><?php esc_html_e('Our Information', 'arden') ?></h3>

                            <p>
                                <?php esc_html_e('Checkout our site and social for more information.', 'arden') ?>

                            </p>

                            <div class="box-footer social">
                                <ul class="list-social">
                                    <li>
                                        <a target="_blank" href="<?php echo esc_attr($project['envato']); ?>">
                                            <img src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/social/evanto.png')); ?>"
                                                 alt="<?php echo esc_attr__('Envato', 'arden'); ?>">
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_attr($project['facebook']); ?>">
                                            <img src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/social/facebook.png')); ?>"
                                                 alt="<?php echo esc_attr__('Facebook', 'arden'); ?>">
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_attr($project['twitter']); ?>">
                                            <img src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/social/twiter.png')); ?>"
                                                 alt="<?php echo esc_attr__('Tweeter', 'arden'); ?>">
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="<?php echo esc_attr($project['youtube']); ?>">
                                            <img src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/social/youtube.png')); ?>"
                                                 alt="<?php echo esc_attr__('Youtube', 'arden'); ?>">
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="mailto:<?php echo esc_attr($project['email']); ?>">
                                            <img src="<?php echo esc_url(get_theme_file_uri('inc/admin/assets/images/social/email.png')); ?>"
                                                 alt="<?php echo esc_attr__('Email', 'arden'); ?>">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php }

    }

    new Wpopalbootstrap_Core_Admin_Menu();
}
?>