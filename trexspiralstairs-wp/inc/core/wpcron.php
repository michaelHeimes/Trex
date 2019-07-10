<?php
function dg_cron_schedules( $schedules ) {
 
	// Avoid conflict with other cron jobs.
	$prefix                      = 'cron_';// Example Reference: cron_30_mins
	$schedule_options            = array();

	$schedule_options['1_mins'] = array(
		'display'  => '1 Minute',
		'interval' => '60'
	);
	
	$schedule_options['30_mins'] = array(
		'display'  => '30 Minutes',
		'interval' => '1800'
	);
	
	$schedule_options['1_hours'] = array(
		'display'  => 'Hour',
		'interval' => '3600'
	);
	
	$schedule_options['2_hours'] = array(
		'display'  => '2 Hours',
		'interval' => '7200'
	);

	$schedule_options['4_hours'] = array(
		'display'  => '4 Hours',
		'interval' => '14400'
	);
	
	// Add each custom schedule into the cron job system.
	foreach ( $schedule_options as $schedule_key => $schedule ) {
		$schedules[ $prefix . $schedule_key ] = array(
			'interval' => $schedule['interval'],
			'display'  => __( 'Every ' . $schedule['display'] )
		);
	}

	return $schedules;
	
}
add_filter( 'cron_schedules', 'dg_cron_schedules' );

function dg_schedule_task( $task ) {

	// Must have task information.
	if ( ! $task ) {
		return false;
	}
	
	// Set list of required task keys.
	$required_keys = array(
		'timestamp',
		'recurrence',
		'hook'
	);
	
	// Verify the necessary task information exists.
	$missing_keys = array();
	foreach ( $required_keys as $key ) {
		if ( ! array_key_exists( $key, $task ) ) {
			$missing_keys[] = $key;
		}
	}
	
	// Check for missing keys.
	if ( ! empty( $missing_keys ) ) {
		return false;
	}
	
	// Task must not already be scheduled.
	if ( wp_next_scheduled( $task['hook'] ) ) {
		wp_clear_scheduled_hook( $task['hook'] );
	}
	
	// Schedule the task to run.
	wp_schedule_event( $task['timestamp'], $task['recurrence'], $task['hook'] );

	return true;
	
}