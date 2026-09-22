<?php 

// application/libraries/csv.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Csv {

    public function __construct() {
        $this->ci = &get_instance();
    }

    public function exportToCsv($header='',$data, $filename = 'lead_data.csv') {
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Create a file handle
        $output = fopen('php://output', 'w');

        // Write CSV header row

        fputcsv($output, $header);

        // Write data to CSV
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
    }
}
