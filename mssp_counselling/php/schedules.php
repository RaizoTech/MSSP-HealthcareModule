<?php

require_once 'config.php';
session_start();

$config = new config();
$connection = $config->getConnection();

$mentor_id = $_SESSION['cm_id'];
$service_id = $_SESSION['service_id'];

// Fetching data from the database
$sql = "SELECT * FROM `work_mssp_hw`.`counselling_availability_date` AS `wmssp_cad` WHERE `wmssp_cad`.`cm_id`='$mentor_id' AND `wmssp_cad`.`service_id`='$service_id' AND `wmssp_cad`.`sched_status`='Stable' GROUP BY `wmssp_cad`.`avail_date`";
$result = $connection->query($sql);

// Initialize an array to store appointments by day
$appointmentsByDay = [];

// Fetching appointments and grouping them by day
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $date_parse = new DateTime($row['avail_date']);
        $weekNumber = $date_parse->format('W'); // Get the week number
        $dayOfWeek = $date_parse->format('l'); // Get the day of the week
        $appointment = [
            'date' => $date_parse,
            'time_am' => new DateTime($row['time_am']),
            'time_pm' => new DateTime($row['time_pm']),
            'sequence_id' => $row['seq_id'],
            'slot' => $row['slot']
        ];

        // Add appointment to the respective day's array
        $appointmentsByDay[$weekNumber][$dayOfWeek][] = $appointment;
    }
}

// Define colors for each week
$weekColors = [
    'primary',      // 1st week
    'secondary', // 2nd week
    'success',   // 3rd week
    'warning',   // 4th week
];

// Output appointments grouped by week and day
foreach ($appointmentsByDay as $weekNumber => $appointments) {
    $weekColor = $weekColors[($weekNumber - 1) % count($weekColors)]; // Get the color for this week
    ?>
    <?php
    foreach ($appointments as $day => $dayAppointments) {
        foreach ($dayAppointments as $key => $appointment) {
            $cardClass = ($key === 0) ? "bg-{$weekColor} text-white" : ''; // Apply background color based on week number
            ?>
            <div class="col-lg-3">
                <div class="mb-3">
                    <div class="card <?php echo $cardClass; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $appointment['date']->format('F j, Y'); ?></h5>
                            <h6 class="card-subtitle mb-2"><?php echo $day; ?></h6>
                            <p class="card-text">Time: <?php echo $appointment['time_am']->format('g.i a').' to '.$appointment['time_pm']->format('g.i a'); ?></p>
                            <button type="button" class="btn btn-success" data-seqid1="<?php echo $appointment['sequence_id'] ?>" data-dateset="<?php echo $appointment['date']->format('Y-m-d') ?>" data-timeam="<?php echo $appointment['time_am']->format('H:i') ?>" data-timepm="<?php echo $appointment['time_pm']->format('H:i') ?>" data-slot="<?php echo $appointment['slot'] ?>" data-bs-toggle="modal" data-bs-target="#edit-schedule">Edit</button>
                            <button type="button" class="btn btn-danger" data-seqid2="<?php echo $appointment['sequence_id'] ?>" id="btn-delete-sched">Delete Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <?php
}

?>