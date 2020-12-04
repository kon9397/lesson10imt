<?php

function visualize($query) {
    echo '<br><br>';

    foreach($query as $row) {
        print_r($row);
    }
}