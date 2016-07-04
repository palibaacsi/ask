<?php

/**
 * @package WordPress
 * @subpackage BP Auto Group Join
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'BP_Auto_Group_Join_Base' ) ):

	/**
	 *
	 * BP Auto Group Join Base
	 * ***********************************
	 */
    class BP_Auto_Group_Join_Base {

        public function BP_Auto_Group_Join_Base() {
            $this->hooks();
            $this->setup_actions();
        }

        public function hooks() {
            if( is_multisite() ){
                add_action( 'bp_core_activated_user', array($this, 'wpmu_auto_group_join_new_user'), 999, 3 );
            }else{
                add_action( 'user_register', array($this, 'auto_group_join_new_user'), 999, 1 );
            }

        }


        function wpmu_auto_group_join_new_user($user_id, $key, $user){
            if( !isset($user_id) || empty($user_id) ) return;
            $groups_args = array(
                'object' => 'groups',
                'per_page' => 0,
            );
            if ( bp_has_groups( $groups_args ) ) :
                while ( bp_groups() ) : bp_the_group();
                    $group_id = bp_get_group_id();
                    $get_settings = groups_get_groupmeta($group_id, 'aj_new_registrations', true);
                    if($get_settings == 'all_members'){
                        // add as member
                        groups_accept_invite($user_id, $group_id);
                    }else{
                        $get_mt = groups_get_groupmeta($group_id, 'aj_new_registrations_mt', true);
                        $user_member_type = bp_get_member_type( $user_id );
                        if( in_array($user_member_type, $get_mt) ){
                            // add as member
                            groups_accept_invite($user_id, $group_id);
                        }
                    }
                endwhile;
            endif;
        }

        function auto_group_join_new_user($user_id){
            if( !isset($user_id) || empty($user_id) ) return;
            $groups_args = array(
                'object' => 'groups',
                'per_page' => 0,
            );
            if ( bp_has_groups( $groups_args ) ) :
                while ( bp_groups() ) : bp_the_group();
                    $group_id = bp_get_group_id();
                    $get_settings = groups_get_groupmeta($group_id, 'aj_new_registrations', true);
                    if($get_settings == 'all_members'){
                        // add as member
                        groups_accept_invite($user_id, $group_id);
                    }else{
                        $get_mt = groups_get_groupmeta($group_id, 'aj_new_registrations_mt', true);
                        $user_member_type = bp_get_member_type( $user_id );
                        if( in_array($user_member_type, $get_mt) ){
                            // add as member
                            groups_accept_invite($user_id, $group_id);
                        }
                    }
                endwhile;
            endif;
        }

        /**
         * Convenince method for getting main plugin options.
         *
         * @since BP Auto Group Join (1.0.0)
         */
        public function option( $key ) {
            return bp_auto_group_join()->option( $key );
        }

        /**
         * SETUP BUDDYPRESS GLOBAL OPTIONS
         *
         * @since	BP Auto Group Join (1.0.0)
         */
        public function setup_globals( $args = array() ) {

        }

        /**
         * SETUP ACTIONS
         *
         * @since  BP Auto Group Join (1.0.0)
         */
        public function setup_actions() {
            // Add body class
            //add_filter( 'body_class', array( $this, 'body_class' ) );

            // Front End Assets
            if ( ! is_admin() && ! is_network_admin() ) {
                add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
            }

            // Back End Assets
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
        }

        /**
         * Add active BP Auto Group Join class
         *
         * @since BP Auto Group Join (1.0.0)
         */
        public function body_class( $classes ) {
            $classes[] = apply_filters( 'bp-auto-group-join_class', 'bp-auto-group-join' );
            return $classes;
        }

        /**
         * Load CSS/JS
         * @return void
         */
        public function assets() {

            // Scripts
            wp_enqueue_script( 'bp-auto-group-join-main', bp_auto_group_join()->assets_url . '/js/bp-auto-group-join.js', array( 'jquery' ), '1.0.0', true );
        }

        /**
         * Load Admin Script
         * @return void
         */
        public function admin_assets() {
            
            // CSS
            wp_enqueue_style( 'bp-auto-group-join-main-admin', bp_auto_group_join()->assets_url . '/css/bp-auto-group-join-admin.css', array(), '1.0.0', 'all' );

            // Scripts
            wp_enqueue_script( 'bp-auto-group-join-main-admin', bp_auto_group_join()->assets_url . '/js/bp-auto-group-join-admin.js', array( 'jquery' ), '1.0.0', true );
        }


    }
	 //End of class BP_Auto_Group_Join_Hooks
	

endif;

