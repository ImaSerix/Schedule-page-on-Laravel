$(document).ready(function() {
    if (!window.location.hash) window.location.hash = $('#route')[0].value + '/';
    else handleHashChange(window.location.hash);
    $('#route').on('change', function(e){
        window.location.hash = e.target.value + '/';
    })
    $(window).on('hashchange', function(e) {
        const hash = window.location.hash;
        handleHashChange(hash)
    });

    $('#starttime-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/runs',
            type: 'post',
            data:$('#starttime-form').serialize(),
            success: function(){
                handleHashChange(window.location.hash);
            }
        });
    });
    $('#timedelta-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/schedule',
            type: 'put',
            data:$('#timedelta-form').serialize(),
            success: function(){
                handleHashChange(window.location.hash);
            }
        });
    });
    $('#delete-starttime-form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/runs',
            type: 'delete',
            data:$('#delete-starttime-form').serialize(),
            success: function (e){
                handleHashChange(window.location.hash);
                fillRunSelector();
            }
        });
    });
    $('#work-day3').change(function() { fillRunSelector() });
});

function fillRunSelector(){
    let isWorkDay = $('#work-day3')[0].value;
    let routeID = $('#routeID2')[0].value;
    let runSelector = $('#run-selector');
    runSelector.empty();
    $.ajax({
        url: `/api/stops/${routeID}/${isWorkDay}/startTimes`,
        type: `GET`,
        success: function(e){
            e.forEach(elem =>{
                let opt = document.createElement('option');
                opt.textContent = elem.start_time;
                opt.value = elem.id;
                runSelector.append(opt);
            })
        }
    })
}

function fillStopSelector(){
    let stopSelector = $('#stop-selector');
    let stops = [];
    $('#stop-table').children().each(function(){
        let option = document.createElement('option');
        option.value = this.dataset.stopId;
        stops.push(option.value);
        option.textContent = this.textContent;
        stopSelector.append(option);
    });
}
function handleHashChange(hash) {
    const parts = hash.split('/');
    const routeDirection = parts[0].substr(1);
    const stopId = parts[1];
    $('#route')[0].value = routeDirection;
    if ($('#stop-table').children().length > 0 && stopId){
        $('#stop-table').children(`[data-stop-id='${stopId}']`)[0].classList.add('selected');
        fetchScheduleForStop(routeDirection, 1, stopId);
        fetchScheduleForStop(routeDirection, 0, stopId);
    }
    else if($('#stop-table').children().length == 0 && stopId){
        fetchStopsForRoute(routeDirection, stopId);
    }
    else{
        fetchStopsForRoute(routeDirection);
    }
}
function fetchStopsForRoute(routeDirection, stopId){
    routeID = $("option[value='" + routeDirection + "']")[0].dataset.routeId;
    if ($('#routeID').length != 0) {
        $('#routeID')[0].value = routeID;
        $('#routeID2')[0].value = routeID;
    }
    fetch(`/api/route/${routeID}/stops`)
        .then(response => response.json())
        .then(stops => {
            updateStopsTable(stops);
            if (typeof (stopId) === "undefined" && stops.length > 0) window.location.hash = `${routeDirection}/${stops[0].id}`;
            if (typeof(stopId) !== "undefined"){
                $('#stop-table').children(`[data-stop-id='${stopId}']`)[0].classList.add('selected');
                fetchScheduleForStop(routeDirection, 1, stopId);
                fetchScheduleForStop(routeDirection, 0, stopId);
            }
        })
}
function updateStopsTable(stops){
    var stopTable = $('#stop-table');
    stopTable.empty();
    stops.forEach(stop =>{
        var li = document.createElement('li');
        li.addEventListener('click', function(e){
            $('#stop-table').children('.selected').removeClass('selected');
            e.target.classList.add('selected');
            window.location.hash = window.location.hash.substr(1, window.location.hash.indexOf('/')) + e.target.dataset.stopId;
        })
        li.setAttribute('data-stop-id', stop.id);
        li.textContent = stop.name;
        stopTable.append(li);
    })
    if ($('#routeID').length != 0){
        fillStopSelector();
        fillRunSelector();
    }
}
function updateScheduleTable(isWorkDay, startTimes, schedule, stopID){
    if (isWorkDay) var scheduleTable = $('#workday-table');
    else var scheduleTable = $('#holiday-table');
    scheduleTable.empty();
    var timeDeltaSum = 0;
    for (let i = 0; i < schedule.length; i++){
        if (i != 0) timeDeltaSum += schedule[i].time_delta;
        if(schedule[i].stop_id == stopID) break;
    }
    var hour = -1;
    startTimes.forEach(elem => {
        var time = elem.start_time + timeDeltaSum;
        var nowHour = Math.floor(time / 60);
        if (hour < nowHour){
            scheduleTable.append(document.createElement('tr'));
            var th = document.createElement('th');
            th.classList.add('hour');
            th.textContent = nowHour;
            scheduleTable.children('tr:last-child').append(th);
            hour = nowHour;
        }
        var th = document.createElement('th');
        th.textContent = time % 60;
        scheduleTable.children('tr:last-child').append(th);
    });
}
function fetchScheduleForStop(routeDirection, isWorkDay, stopID){
    routeID = $("option[value='" + routeDirection + "']")[0].dataset.routeId;
    fetch(`/api/stops/${routeID}/${isWorkDay}/startTimes`)
        .then(response => response.json())
        .then(startTimes => {
            fetch(`/api/stops/${routeID}/${isWorkDay}/schedule`)
                .then(response => response.json())
                .then(schedule => {
                    updateScheduleTable(isWorkDay, startTimes, schedule, stopID);
            });
        })
}


