<?php
/**
 * Advanced Custom Fields (ACF) Function Stubs
 * 
 * This file provides function stubs for Intelephense to recognize ACF functions.
 * These are not actual implementations - they are just type hints for the IDE.
 * 
 * @package kis2026_base
 */

if (!function_exists('get_field')) {
    /**
     * Get a field value from the database.
     *
     * @param string $selector The field name or field key.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @param bool $format_value Whether to format the value. Default true.
     * @return mixed The field value.
     */
    function get_field($selector, $post_id = false, $format_value = true) {
        return null;
    }
}

if (!function_exists('the_field')) {
    /**
     * Display a field value.
     *
     * @param string $selector The field name or field key.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @param bool $format_value Whether to format the value. Default true.
     * @return void
     */
    function the_field($selector, $post_id = false, $format_value = true) {
        // Stub function
    }
}

if (!function_exists('get_field_object')) {
    /**
     * Get a field object.
     *
     * @param string $selector The field name or field key.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @param bool $format_value Whether to format the value. Default true.
     * @param bool $load_value Whether to load the value. Default true.
     * @return array|false The field object array or false on failure.
     */
    function get_field_object($selector, $post_id = false, $format_value = true, $load_value = true) {
        return false;
    }
}

if (!function_exists('have_rows')) {
    /**
     * Check if a repeater or flexible content field has rows.
     *
     * @param string $selector The field name or field key.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @return bool True if rows exist, false otherwise.
     */
    function have_rows($selector, $post_id = false) {
        return false;
    }
}

if (!function_exists('the_row')) {
    /**
     * Set up the current row in a repeater or flexible content field loop.
     *
     * @return array|false The current row array or false on failure.
     */
    function the_row() {
        return false;
    }
}

if (!function_exists('get_sub_field')) {
    /**
     * Get a sub field value.
     *
     * @param string $selector The sub field name or field key.
     * @param bool $format_value Whether to format the value. Default true.
     * @return mixed The sub field value.
     */
    function get_sub_field($selector, $format_value = true) {
        return null;
    }
}

if (!function_exists('the_sub_field')) {
    /**
     * Display a sub field value.
     *
     * @param string $selector The sub field name or field key.
     * @param bool $format_value Whether to format the value. Default true.
     * @return void
     */
    function the_sub_field($selector, $format_value = true) {
        // Stub function
    }
}

if (!function_exists('update_field')) {
    /**
     * Update a field value.
     *
     * @param string $selector The field name or field key.
     * @param mixed $value The new field value.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @return bool True on success, false on failure.
     */
    function update_field($selector, $value, $post_id = false) {
        return false;
    }
}

if (!function_exists('delete_field')) {
    /**
     * Delete a field value.
     *
     * @param string $selector The field name or field key.
     * @param int|string|false $post_id The post ID. Defaults to current post.
     * @return bool True on success, false on failure.
     */
    function delete_field($selector, $post_id = false) {
        return false;
    }
}
