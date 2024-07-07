<?php
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    header('HTTP/1.1 403 Forbidden');
    die();
}
?>
<div class="content-header">
    <div class="container-fluid">
        <!-- <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Calendar of Events</h1>
            </div>
        </div> -->
    </div>
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12"  id="LoadCalendarHere">
            </div>
        </div>
    </div>
</section>
