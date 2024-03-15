<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<?php
$lodge_id = isset($lodgeId) && $lodgeId != "" ? $lodgeId : "";
$lodge_name = isset($lodge_data[0]["name"]) && $lodge_data[0]["name"] != "" ? $lodge_data[0]["name"] : "";
?>
<div class="container home-block">
    <div class="row tab-v3">
        <div class="col-md-3 md-margin-bottom-40">
            <ul class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="/lodge-reservations/location"><i class="fa fa-arrow"></i> 1. Location</a>
                </li>
                <li class="active">
                    <a href="#"><i class="fa fa-calendar"></i> 2. Available Dates</a>
                </li>
                <li class="disabled">
                    <a href="#"><i class="fa fa-book"></i> 3. Book</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="tag-box tag-box-v3">
                <div class="headline"><h2>Available Dates</h2></div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Please select the date you wish to start your reservation on below.</h5>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-check color-green"></i> <strong>Location:</strong>
                                <?= $lodge_name ?>
                            </li>
                        </ul>
                        <hr class="devider devider-db" />
                        <div id="calendar" style="background-color: white;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="viewDate" tabindex="-1" role="dialog" aria-labelledby="viewDateLabel" aria-hidden="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="viewDateLabel" class="modal-title">Select Number of Days</h4>
            </div>
            <!-- Model Body -->
            <div class="modal-body">
                <div class="row margin-bottom-20">
                    <div class="col-md-12">
                        <p>Please select the number of days you wish this reservation to be made for. We will then find the best available beds for those dates.</p>
                    </div>
                </div>

                <div class="row margin-bottom-10">
                    <div class="col-md-4">
                        <h4>Start Date</h4>
                    </div>
                    <div class="col-md-8">
                        <h4><span id="startDate"></span></h4>
                    </div>
                </div>

                <hr />

                <div class="row margin-bottom-10">
                    <div class="col-md-4">
                        <h4>Length</h4>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-unstyled">
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(1)" class="btn-u btn-u-default">1 Day</a></li>
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(2)" class="btn-u btn-u-default">2 Days</a></li>
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(3)" class="btn-u btn-u-default">3 Days</a></li>
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(4)" class="btn-u btn-u-default">4 Days</a></li>
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(5)" class="btn-u btn-u-default">5 Days</a></li>
                            <li class="margin-bottom-10"><a href="javascript:void(0);" onclick="selectDay(6)" class="btn-u btn-u-default">6 Days</a></li>
                        </ul>
                    </div>
                </div>

                <a id="dayUrl" href="" style="display: none;">Select</a>
            </div>
            <!-- End Model Body -->
        </div>
    </div>
</div>

<div class="modal-backdrop fade in"></div>

<script type="text/javascript">
        //<!--
        $(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: '',
                right: 'prev,next'
            },
            events: {
                url: '/lodge-reservations/get_lodge_dates',
                data: {
                    lodge: <?= $lodge_id ?>
                }
            },
            eventRender: function(event, element) {
                element.attr('href', 'javascript:void(0);');
                element.attr('onclick', 'openModal("' + event.dateText + '","' + event.url + '");');
            }
        });
    });
     $('#viewDate').modal('hide');
     $('.modal-backdrop').hide();

     function openModal(date, url) {
        $("#dayUrl").attr('href', url);
        $("#startDate").html(date);
        $('#viewDate').modal('show');
    }
    function selectDay(day) {
        var url = $("#dayUrl").attr('href');
        url = url + '/' + day;
        location.href = url;
        return false;
    }
        //-->
</script>