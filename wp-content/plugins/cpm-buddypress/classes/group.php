<?php

/**
 * BuddyPress Groups integration functions
 */


/**
 * Implementation of BP_Group_Extension
 *
 * @since 0.1
 */
if ( class_exists( 'BP_Group_Extension' ) ) :

    class CPM_BP_Group_Extension extends BP_Group_Extension {

        private $parent_path;

        /**
         * Constructor
         * @since 0.1
         */
        function __construct() {

            $this->parent_path = CPM_PATH;

            $this->name = __( 'Projects', 'cpmbp' );
            $this->slug = sanitize_title( __( cpm_bp_slug_name(), 'cpmbp' ) );

            $this->includes();
            $this->form_actions();

        }

        /**
         * Attach fom actions in every form in frontend
         *
         * @since 1.0
         * @return void
         */
        function form_actions() {
            if ( ! bp_is_group()  ) {
                return;
            }
            if ( is_admin() && ! isset( $_POST['cpm_bp_url'] ) ) {
                return;
            }

            // run `form_hidden_input`
            $form_actions = array(
                'cpm_project_form',
                'cpm_message_form',
                'cpm_tasklist_form',
                'cpm_task_new_form',
                'cpm_milestone_form',
                'cpm_comment_form',
                'cpm_project_duplicate'
            );

            foreach ( $form_actions as $action ) {
                add_action( $action, array( $this, 'form_hidden_input' ) );
            }
        }


        /**
         * Adds a hidden input on frontend forms
         *
         * This function adds a hidden permalink input in all forms in the frontend
         * to apply url filters correctly when doing ajax request.
         *
         * @since 1.0
         */
        function form_hidden_input() {

            if ( isset( $_POST['cpm_bp_url'] ) && ! empty( $_POST['cpm_bp_url'] ) ) {
                $url = $_POST['cpm_bp_url'];
            } else {
                $url = bp_get_group_permalink( groups_get_current_group() );
            }

            printf( '<input type="hidden" name="cpm_bp_url" value="%s" />', $url );
        }

        /**
         * Includes all required files if the parent plugin is intalled
         *
         * @since 1.0
         */
        function includes() {

            if ( ! is_admin() ) {

                require_once $this->parent_path . '/includes/functions.php';
                require_once $this->parent_path . '/includes/urls.php';
                require_once $this->parent_path . '/includes/html.php';
                require_once $this->parent_path . '/includes/shortcodes.php';
            }

            $base_url = isset( $_REQUEST['cpm_bp_url'] ) ? $_REQUEST['cpm_bp_url'] : bp_get_group_permalink( groups_get_current_group() );

            // load url filters
            if ( bp_is_group() && bp_is_active( 'groups' ) ) {
                require_once dirname( __FILE__ ) . '/urls.php';
                new CPM_BP_Frontend_URLs( $base_url, $this->slug );

            }

            if ( isset( $_REQUEST['cpm_bp_url'] ) ) {
                require_once dirname( __FILE__ ) . '/urls.php';
                new CPM_BP_Frontend_URLs( $base_url, $this->slug );
            }

        }

        /**
         * Loads the content of the tab
         *
         * This function does a few things. First, it loads the subnav, which is visible on every
         * CP BP subtab. Then, it decides which template should be loaded, based on the current
         * view (determined by the URL). It then checks to see whether the template in question
         * has been overridden in the active theme or its parent, using locate_template(). Finally,
         * the proper template is loaded.
         *
         * @package    CollabPress
         * @subpackage CP BP
         * @since      1.2
         */
        function display( $group_id = NULL ) {

            if ( ! class_exists( 'WeDevs_CPM' ) ) {
                return __( 'Sorry, main plugin is not installed', 'cpmf' );
            }

            if ( ! is_user_logged_in() ) {
                return wp_login_form( array( 'echo' => false ) );
            }

            if ( ! is_user_logged_in() ) {
                return wp_login_form( array( 'echo' => false ) );
            }

            if ( ! groups_is_user_member( get_current_user_id(), $group_id )) {
                echo '<div id="message" class="info"><p>';
                _e( 'Only group members are authorized to access this page.', 'cpmf' );
                echo '</p></div>';
                return;
            }

            $project_id = isset( $_GET['project_id'] ) ? intval( $_GET['project_id'] ) : 0;
            ?>

            <div class="cpm cpm-front-end">
                <?php
                if ( $project_id ) {
                    $this->single_project( $project_id );
                } else {
                    $this->list_projects();
                }
                ?>
            </div> <!-- .cpm -->
        <?php

        }

        /**
         * List all projects
         *
         * @since 1.0
         */
        function list_projects() {

            $project_obj    = CPM_Project::getInstance();
            $projects       = $project_obj->get_projects();
            $total_projects = $projects['total_projects'];
            $limit          = 10;
            $pagenum        = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

            unset( $projects['total_projects'] );
            $status_class = isset( $_GET['status'] ) ? $_GET['status'] : 'active';

            if ( function_exists( 'cpm_project_count' ) ) {
                $count = cpm_project_count();
            }
      //      require_once CPM_PRO_PATH . '/views/project/project_list.php' ;
            }

        /**
         * Display a single project
         *
         * @since 1.0
         *
         * @param int $project_id
         */
        function single_project( $project_id ) {
            remove_filter( 'comments_clauses', 'cpm_hide_comments', 99 );

            $pro_obj    = CPM_Project::getInstance();
            $activities = $pro_obj->get_activity( $project_id, array() );

            $tab    = isset( $_GET['tab'] ) ? $_GET['tab'] : 'activity';
            $action = isset( $_GET['action'] ) ? $_GET['action'] : 'index';

            switch ( $tab ) {

                case 'project':
                     switch ( $action ) {
                     case 'index':
                        cpm_get_header( __( 'Overview', 'cpm' ), $project_id );
                        $this->project_overview( $project_id );
                     break;

                     case 'activity':
                        cpm_get_header( __( 'Activities', 'cpm' ), $project_id );
                        $this->project_activity( $project_id );
                     break;

                    default:
                        cpm_get_header( __( 'Overview', 'cpm' ), $project_id );
                        $this->project_overview( $project_id );
                     }
                    break;
               case 'settings':
                    cpm_get_header( __( 'Settings', 'cpm' ), $project_id );

                    $this->project_settings( $project_id );
                    break;

                case 'message':

                    switch ( $action ) {
                        case 'single':
                            $message_id = isset( $_GET['message_id'] ) ? intval( $_GET['message_id'] ) : 0;
                            $this->message_single( $project_id, $message_id );

                            break;
                        default:
                            $this->message_index( $project_id );
                            break;
                    }

                    break;

                case 'task':

                    switch ( $action ) {
                        case 'single':
                            $list_id = isset( $_GET['list_id'] ) ? intval( $_GET['list_id'] ) : 0;

                            $this->tasklist_single( $project_id, $list_id );
                            break;

                        case 'todo':
                            $list_id = isset( $_GET['list_id'] ) ? intval( $_GET['list_id'] ) : 0;
                            $task_id = isset( $_GET['task_id'] ) ? intval( $_GET['task_id'] ) : 0;

                            $this->task_single( $project_id, $list_id, $task_id );
                            break;

                        default:
                            cpm_get_header( __( 'To-do Lists', 'cpm' ), $project_id );
                            $this->tasklist_index( $project_id );
                            break;
                    }

                    break;

                case 'milestone':
                    $this->milestone_index( $project_id );
                    break;

                case 'files':
                    $this->files_index( $project_id );
                    break;

                default:
                    break;
            }

            do_action( 'cpmf_project_tab', $project_id, $tab, $action );

            // add the filter again
            add_filter( 'comments_clauses', 'cpm_hide_comments', 99 );
        }

        function  project_overview( $project_id ){
            require_once CPM_PATH . '/views/project/overview.php';
        }

        function message_index( $project_id ) {
            require_once $this->parent_path . '/views/message/index.php';
        }

        function message_single( $project_id, $message_id ) {
            require_once $this->parent_path . '/views/message/single.php';
        }

        function tasklist_index( $project_id ) {
            require_once $this->parent_path . '/views/task/index.php';
        }

        function tasklist_single( $project_id, $tasklist_id ) {
            require_once $this->parent_path . '/views/task/single.php';
        }

        function task_single( $project_id, $tasklist_id, $task_id ) {
            require_once $this->parent_path . '/views/task/task-single.php';
        }

        function milestone_index( $project_id ) {
            require_once $this->parent_path . '/views/milestone/index.php';
        }

        function files_index( $project_id ) {
            require_once $this->parent_path . '/views/files/index.php';
        }

        function project_settings( $project_id ) {
            $file = CPM_PRO_PATH. '/views/project/settings.php';

            if ( file_exists( $file ) ) {
                include_once $file;
            } else {
                _e( 'Settings file does not exist', 'cpm' );
            }
        }

        /**
         * Display activities for a project
         *
         * @since 1.0
         *
         * @param int $project_id
         */
        function project_activity( $project_id ) {
            require_once CPM_PATH . '/views/project/single.php';
        }

    }

endif;
