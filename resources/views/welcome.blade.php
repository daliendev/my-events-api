@extends('layouts.master')

@section('title', 'Info')

@section('grid')
<div class="menu">
    <a href="#top">Top <i class="far fa-hand-point-up"></i></a>
    <a href="#routes">Routes <i class="fas fa-th-list"></i></a>
    <a href="#info">Details <i class="fas fa-info-circle"></i></a>
</div>
<div id="top" class="row">
    <div class="col doc">
        <p align="center">
            <a href="https://laravel.com" target="_blank">
                <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg">
            </a>
        </p>
        <p>
            Welcome on this Event's Managment API's home page.
            <br>
            Extern Data is used from <a href="https://developers.openagenda.com/">Open Agenda</a>.
        </p>
        <p>
            Differents routes and their response / errors are detailed just under that message. If route is a LINK don't hesitate, CLICK on and see more DETAILS about what DATA is EXPECTED. Complete OpenSource Code is on our Github Page.
        </p>
        <p>
            If current User is an Admin he can Update / Delete everything, if not he only can Update / Delete hiw own Data (account & invites but messages can be deleted only by Admin).
        </p>
        <p>
            This API is working principally with 3 models:
        </p> 
        <ul>
            <li>USER</li>
            <li>EVENT</li>
            <li>HANG OUT (list of participants for an event)</li>
            <li>CHAT (group discussion / hang out page)</li>
            <li>MESSAGE (linked by chat_id)</li>
        </ul>
        <div class="social">
            <a href="#"><i class="fab fa-github-alt"></i></a>
            <a href="https://www.linkedin.com/in/daniel-cadeau-dev/"><i class="fab fa-linkedin"></i></a>
        </div>
        <p style="text-align:center; margin-top: 10px; text-decoration: underline; width: 100%;">
        <i class="fas fa-exclamation-triangle"></i> THIS API NEEDS BEARER TOKEN FOR ALL SECURED ROUTES <i class="fas fa-exclamation-triangle"></i><br>
    </p>
    </div>
</div>
<div id="routes" class="row info">
    <div class="col">
        <h1>API ROUTES</h1>
    </div>
</div>
<div class="row info">
    <div class="col col-1">
        <h2>Model</h2>
    </div>
    <div class="col col-1">
        <h2>Method</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">Routes</h2>
    </div>
    <div class="col col-3">
        <h2>Response (Success)</h2>
    </div>
    <div class="col col-2">
        <h2>Response (Failure)</h2>
    </div>
</div>
<!-- [ USER ] ROUTES -->
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/register"><i class="fas fa-lock-open"></i> /api/register</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (token) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/login"><i class="fas fa-lock-open"></i> /api/login</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (token) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/google/sign-in"><i class="fas fa-lock-open"></i> /api/google/sign-in</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (token) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            /api/logout
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            /api/users/me
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (user) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            /api/users/{user_id}
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (user) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            /api/users
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (users) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method put">
        <h2>PUT</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/users/{id}">/api/users/{user_id}</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (user) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>User</h2>
    </div>
    <div class="col col-1 method delete">
        <h2>DELETE</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            /api/users/{user_id}
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>Email</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/email/resend/{id}"><i class="fas fa-lock-open"></i> /api/email/resend/{user_id}</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>Password</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/forgot-password"><i class="fas fa-lock-open"></i> /api/forgot-password</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row register">
    <div class="col col-1">
        <h2>Password</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/reset-password">/api/reset-password</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<!-- [END USER] -->
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<!-- [ EVENT ] ROUTES -->
<div class="row createEvent">
    <div class="col col-1">
        <h2>Event</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">
            <a href="#/api/events"><i class="fas fa-lock-open"></i>  /api/events</a>
        </h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<!-- [END EVENT] -->
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<!-- [ HANGOUT ] ROUTES -->
<div class="row createHangout">
    <div class="col col-1">
        <h2>Hangout</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <a href="#/api/hangouts"><h2 class="alignLeft">/api/hangouts</h2></a>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangout) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row readHangout">
    <div class="col col-1">
        <h2>Hangout</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/hangouts/{hangout_id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangout) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row updateHangouts">
    <div class="col col-1">
        <h2>Hangout</h2>
    </div>
    <div class="col col-1 method put">
        <h2>PUT</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/hangouts/{hangout_id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangout) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row deleteHangout">
    <div class="col col-1">
        <h2>Hangout</h2>
    </div>
    <div class="col col-1 method delete">
        <h2>DELETE</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/hangouts/{hangout_id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<div class="row joinHangout">
    <div class="col col-1">
        <h2>Join</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">api/hangouts/{hangout_id}/join</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangout) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row inviteHangout">
    <div class="col col-1">
        <h2>Invite</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">api/hangouts/{hangout_id}/invite/{user_id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangout) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row leaveHangout">
    <div class="col col-1">
        <h2>Leave</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">api/hangouts/{hangout_id}/leave</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<div class="row readAllHangouts">
    <div class="col col-1">
        <h2>Hangouts</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/hangouts</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangouts) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row readAllHangouts">
    <div class="col col-1">
        <h2>Hangouts</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/user/{user_id}/hangouts</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (hangouts) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row readUsersByHangout">
    <div class="col col-1">
        <h2>Users</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/hangouts/{hangout_id}/users</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (users) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<!-- [END HANGOUT] -->
<div class="row delimiter">
    <div class="col">
    </div>
</div>
<!-- [ CHAT ] ROUTES -->
<div class="row createChat opacity">
    <div class="col col-1">
        <h2>Chat</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/chats</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (chat_id) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row createMessage opacity">
    <div class="col col-1">
        <h2>Message</h2>
    </div>
    <div class="col col-1 method post">
        <h2>POST</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/chats</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (message_id) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row readChat opacity">
    <div class="col col-1">
        <h2>Chat</h2>
    </div>
    <div class="col col-1 method get">
        <h2>GET</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/chats/{id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + data (messages) + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<div class="row deleteChat opacity">
    <div class="col col-1">
        <h2>Chat</h2>
    </div>
    <div class="col col-1 method delete">
        <h2>DELETE</h2>
    </div>
    <div class="col col-3">
        <h2 class="alignLeft">/api/chats/{id}</h2>
    </div>
    <div class="col col-3">
        <h2 class="success">200 + message</h2>
    </div>
    <div class="col col-2">
        <h2 class="error">Error message + code</h2>
    </div>
</div>
<!-- [END CHAT] -->
@stop
@section('info')
<!-- EXPLANATION -->
<div id="info" class="row info">
    <div class="col">
        <h2>
            MORE DETAILS ABOUT ROUTES WHEN IT'S NEEDED.
        </h2>
    </div>
</div>
<div id="/api/register" class="row routeExpects">
    <div class="col">
        <span class="route">/api/register</span>
        <h2>Expected data:</h2>
        <ul class="post">
            <li>name (required)</li>
            <li>picture (nullable)</li>
            <li>bio (nullable)</li>
            <li>email (required)</li>
            <li>password (required)</li>
            <li>confirm_password (required, same as password)</li>
        </ul>
    </div>
</div>
<div id="/api/login" class="row routeExpects">
    <div class="col">
        <span class="route">/api/login</span>    
        <h2>Expected data:</h2>
        <ul class="post">
            <li>email (required)</li>
            <li>password (required)</li>
            <li>remember (not required, value = 0 OR 1)</li>
        </ul>
    </div>
</div>
<div id="/api/google/sign-in" class="row routeExpects">
    <div class="col">
        <span class="route">/api/google/sign-in</span>    
        <h2>Expected data:</h2>
        <ul class="post">
            <li>id_token (required)</li>
        </ul>
        <p>
            You don't have to do alternative fetch for LogIn and Register process. This route automatically detects if the user already had an account or not (if is not a user account will be created especialy for that user, and if yes the user will be authentificate).
            Access Token is returned in both cases, but the message will differ.
        </p>
        <p>There is an example of fetch request for this route:</p>
        <img class="infoImg" src={{ URL::asset('img/GoogleSignInFetch.PNG'); }} />
    </div>
</div>
<div id="/api/users/{id}" class="row routeExpects">
    <div class="col">
        <span class="route">/api/users/{id}</span>    
        <h2>Expected data send by RAW in JSON (not by FormData):</h2>
        <ul class="put">
            <li>email (required)</li>
            <li>password (required)</li>
        </ul>
    </div>
</div>
<div id="/api/email/resend/{id}" class="row routeExpects">
    <div class="col">
        <span class="route">/api/email/resend/{id}</span>  
        <h2>If user with requested ID already has verified his email:</h2>  
        <ul class="get">
            <li>nothing is send</li>
        </ul>
        <h2>Else:</h2>  
        <ul class="get">
            <li>a new email is send</li>
        </ul>
        <p>An automatic verification email is send at the registration, but if you need a new link, you can use that route (after expiration for example).</p>
    </div>
</div>
<div id="/api/forgot-password" class="row routeExpects">
    <div class="col">
        <span class="route">/api/forgot-password</span>  
        <h2>Expected data:</h2>  
        <ul class="post">
            <li>email (required)</li>
        </ul>
        <p>A reset password notification is send at this email address.</p>
    </div>
</div>
<div id="/api/reset-password" class="row routeExpects">
    <div class="col">
        <span class="route">/api/reset-password</span>  
        <h2>Expected data:</h2>  
        <ul class="post">
            <li>token (required)</li>
            <li>email (required)</li>
            <li>password (required)</li>
            <li>confirm password (required | same as password)</li>
        </ul>
        <p>After user's click at the email the TOKEN is send in URL at</p>
        <p style="color: darkblue;">http://localhost:3000/reset-password/{token}</p>
        <p>So you need to prepare a reset password form page.</p>
    </div>
</div>
<div id="/api/events" class="row routeExpects">
    <div class="col">
        <span class="route">/api/events</span>  
        <h2>Expected data:</h2>  
        <ul class="post">
            <li>url (required)</li>
        </ul>
        <p>This route return data from <a href="https://developers.openagenda.com/">Open Agenda</a> API.</p>
    </div>
</div>
<div id="/api/hangouts" class="row routeExpects">
    <div class="col">
        <span class="route">/api/hangouts</span>  
        <h2>Expected data:</h2>  
        <ul class="post">
            <li>extern_agenda_id (required)</li>
            <li>extern_event_id (required)</li>
            <li>public (required)</li>
        </ul>
        <p>Return stored hangout.</p>
    </div>
</div>
@stop