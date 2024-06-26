<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
          key: "AIzaSyD-cVCVLpTGVkXG1Cc13A_pqU6sMuzWkK0", v: "weekly", language: '{{ str_replace('_', '-', app()->getLocale()) }}'});</script>
    <title>Schedule</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div id="language-switcher">
                <a class = "{{ app()->getLocale() == 'lv'? 'selected': ' '}}" href="{{ route('lang.switch', 'lv') }}">LV</a>
                <a class = "{{ app()->getLocale() == 'en'? 'selected': ' '}}" href="{{ route('lang.switch', 'en') }}">EN</a>
            </div>
            <div class="profile">
                @auth
                    <p>{{__('messages.hello')}}, {{ Auth::user()->name }}!</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="">
                            {{ __('Logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        <div class = "content">
            <h2 class = "content-header">{{__('messages.Daugavpils timetable')}}</h2>
            <nav class="nav">
                <div id = 'tabs'>
                    <button id = 'all' onclick="window.location.href = 'https://ima.zvidris.lv/#all'">{{__('messages.All')}}</button>
                    <button id = 'bus' onclick="window.location.href = 'https://ima.zvidris.lv/#bus'">{{__('messages.bus')}}</button>
                    <button id = 'tram' onclick="window.location.href = 'https://ima.zvidris.lv/#tram'">{{__('messages.tram')}}</button>
                    @auth
                        <button id = 'saved' onclick="window.location.href = 'https://ima.zvidris.lv/#saved'">{{__('messages.saved')}}</button>
                    @endauth
                </div>
            </nav>
            <div class="content">
                <div id = "route-container">
                    <h2>{{ $routeNetwork->name }}</h2>
                    <select name="route" id="route">
                        @foreach ($routes as $route)
                            <option data-route-id = {{ $route['id'] }} value="{{ $route['direction'] }}">{{ $route['description'] }}</option>
                        @endforeach
                    </select>
                </div>
                @can('create', App\Models\Schedule::class)
                    <div id = 'admin-panel'>
                        <h3>{{__('messages.AdminPanel')}}</h3>
                        <div id = 'admin-tools'>
                            <div id = 'starttime-form-container'>
                                <p>{{__('messages.AddRouteStartTime')}}</p>
                                <form action="{{route ('run.store')}}" id = 'starttime-form' method="POST">
                                    @csrf
                                    <label for="start-time">{{__('messages.newStartTime')}}</label>
                                    <input type="number" name = "startTime" id = "start-time" min = 0 max = 1499 required>
                                    <label for="work-day">{{__('messages.isWorkDay')}}</label>
                                    <select name = "isWorkDay" id = "work-day2">
                                        <option value="1">{{__('messages.workDay')}}</option>
                                        <option value="0">{{__('messages.holiDay')}}</option>
                                    </select>                                    
                                    <button type = 'submit'>{{__('messages.add')}}</button>
                                    <input type="hidden" name = "routeID" id = "routeID">
                                </form>
                            </div>
                            <div id = 'timedelta-form-container'>
                                <p>{{__('messages.UpdateDeltaTime')}}</p>
                                <form action="{{route ('schedule.update')}}" id = 'timedelta-form'>
                                    @csrf
                                    @method('PUT')
                                    <label for="stop-selector">{{__('messages.stop')}}</label>
                                    <select name="stopID" id="stop-selector"></select>
                                    <label for="new-time-delta">{{__('messages.timeDelta')}}</label>
                                    <input type="number" name="newTimeDelta" id="new-time-delta" min = 0, max = 20>
                                    <label for="work-day2">{{__('messages.isWorkDay')}}</label>
                                    <select name = "isWorkDay" id = "work-day2">
                                        <option value="1">{{__('messages.workDay')}}</option>
                                        <option value="0">{{__('messages.holiDay')}}</option>
                                    </select>                                    
                                    <button type = 'submit'>{{__('messages.add')}}</button>
                                    <input type="hidden" name = "routeID" id = "routeID2">
                                </form>
                            </div>
                            <div id ='delete-starttime-form-container'>
                                <p>{{__('messages.UpdateDeltaTime')}}</p>
                                <form action="{{route ('run.delete')}}" id = 'delete-starttime-form'>
                                    @csrf
                                    @method('DELETE')
                                    <label for="work-day3">{{__('messages.isWorkDay')}}</label>
                                    <select name = "isWorkDay" id = "work-day3">
                                        <option value="1">{{__('messages.workDay')}}</option>
                                        <option value="0">{{__('messages.holiDay')}}</option>
                                    </select>
                                    <label for="starttime-selector">{{__('messages.stop')}}</label>
                                    <select name="runID" id="run-selector"></select>
                                    <button type = 'submit'>{{__('messages.delete')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
                <div id = "schedules">
                    <div id = "stop-container">
                        <table id = "stop-table">

                        </table>
                    </div>
                    <div id = "schedule-container">
                        <div class = "schedule-table-container">
                            <h3>{{__('messages.workDay')}}</h3>
                            <table class = "schedule-table" id = "workday-table">
                                
                            </table>
                        </div class = "schedule-table-container">
                        <div>
                            <h3>{{__('messages.holiDay')}}</h3>
                            <table class = "schedule-table" id = "holiday-table">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id = "map">

            </div>
            <script src = "/js/map.js"></script>
        </div>
    </main>
    <script src="/js/scheduleController.js"></script>
</body>
</html>