<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Agile Monkeys CRM API</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">
    <script src="{{ asset("vendor/scribe/js/theme-default-3.6.3.js") }}"></script>

    <link rel="stylesheet"
          href="//unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="//unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <script src="//cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
    <script>
        var baseUrl = "http://localhost";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.6.3.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">
<a href="#" id="nav-button">
      <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                            <a href="#" data-language-name="php">php</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: August 25 2022</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>Agile Monkeys CMR API</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost:8000</code></pre>

        <h1>Authenticating requests</h1>
<p>This API is authenticated by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="auth">Auth</h1>

    <p>User Authentication</p>

            <h2 id="auth-POSTapi-v1-auth-register">User Registration</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-register">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"ab\",
    \"email\": \"perspiciatis\",
    \"password\": \"aut\",
    \"password_confirmation\": \"vel\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "ab",
    "email": "perspiciatis",
    "password": "aut",
    "password_confirmation": "vel"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/register',
    [
        'headers' =&gt; [
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'ab',
            'email' =&gt; 'perspiciatis',
            'password' =&gt; 'aut',
            'password_confirmation' =&gt; 'vel',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-auth-register">
</span>
<span id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register"></code></pre>
</span>
<form id="form-POSTapi-v1-auth-register" data-method="POST"
      data-path="api/v1/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-register"
                    onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-register" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/register</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-auth-register"
               data-component="body" required  hidden>
    <br>
<p>The name of the user.</p>        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-v1-auth-register"
               data-component="body" required  hidden>
    <br>
<p>The email address of the user.</p>        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-v1-auth-register"
               data-component="body" required  hidden>
    <br>
<p>Password.</p>        </p>
                <p>
            <b><code>password_confirmation</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password_confirmation"
               data-endpoint="POSTapi-v1-auth-register"
               data-component="body" required  hidden>
    <br>
<p>Password Confirmation</p>        </p>
    
    </form>

            <h2 id="auth-POSTapi-v1-auth-login">User Login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"email\": \"dolores\",
    \"password\": \"error\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "email": "dolores",
    "password": "error"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/login',
    [
        'headers' =&gt; [
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'email' =&gt; 'dolores',
            'password' =&gt; 'error',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login"></code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-v1-auth-login"
               data-component="body" required  hidden>
    <br>
<p>Email Address</p>        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-v1-auth-login"
               data-component="body" required  hidden>
    <br>
<p>Password</p>        </p>
    
    </form>

            <h2 id="auth-POSTapi-v1-auth-logout">User Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/auth/logout',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout"></code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-auth-logout" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-auth-logout"
                                                                data-component="header"></label>
        </p>
                </form>

        <h1 id="customers">Customers</h1>

    <p>Class CustomerController</p>

            <h2 id="customers-GETapi-v1-customers">List All Customers</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-customers">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/customers',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-customers">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-customers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-customers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-customers"></code></pre>
</span>
<span id="execution-error-GETapi-v1-customers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-customers"></code></pre>
</span>
<form id="form-GETapi-v1-customers" data-method="GET"
      data-path="api/v1/customers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-customers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-customers"
                    onclick="tryItOut('GETapi-v1-customers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-customers"
                    onclick="cancelTryOut('GETapi-v1-customers');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-customers" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/customers</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-customers" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-customers"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="customers-POSTapi-v1-customers-create">Create New Customer</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-customers-create">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/create" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --form "name=ut" \
    --form "surname=est" \
    --form "photo_url=@C:\Users\kao_g\AppData\Local\Temp\php1226.tmp" </code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/create"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

const body = new FormData();
body.append('name', 'ut');
body.append('surname', 'est');
body.append('photo_url', document.querySelector('input[name="photo_url"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/create',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'name',
                'contents' =&gt; 'ut'
            ],
            [
                'name' =&gt; 'surname',
                'contents' =&gt; 'est'
            ],
            [
                'name' =&gt; 'photo_url',
                'contents' =&gt; fopen('C:\Users\kao_g\AppData\Local\Temp\php1226.tmp', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-customers-create">
</span>
<span id="execution-results-POSTapi-v1-customers-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-customers-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-customers-create"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-customers-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-customers-create"></code></pre>
</span>
<form id="form-POSTapi-v1-customers-create" data-method="POST"
      data-path="api/v1/customers/create"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-customers-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-customers-create"
                    onclick="tryItOut('POSTapi-v1-customers-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-customers-create"
                    onclick="cancelTryOut('POSTapi-v1-customers-create');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-customers-create" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/customers/create</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-customers-create" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-customers-create"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-customers-create"
               data-component="body" required  hidden>
    <br>
<p>Customer's Name.</p>        </p>
                <p>
            <b><code>surname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="surname"
               data-endpoint="POSTapi-v1-customers-create"
               data-component="body" required  hidden>
    <br>
<p>Customer's Surname.</p>        </p>
                <p>
            <b><code>photo_url</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
                <input type="file"
               name="photo_url"
               data-endpoint="POSTapi-v1-customers-create"
               data-component="body"  hidden>
    <br>
<p>Customer's Photo</p>        </p>
    
    </form>

            <h2 id="customers-GETapi-v1-customers--id--details">Display Customer Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-customers--id--details">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/3/details" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/3/details"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/3/details',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-customers--id--details">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-customers--id--details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-customers--id--details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-customers--id--details"></code></pre>
</span>
<span id="execution-error-GETapi-v1-customers--id--details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-customers--id--details"></code></pre>
</span>
<form id="form-GETapi-v1-customers--id--details" data-method="GET"
      data-path="api/v1/customers/{id}/details"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-customers--id--details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-customers--id--details"
                    onclick="tryItOut('GETapi-v1-customers--id--details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-customers--id--details"
                    onclick="cancelTryOut('GETapi-v1-customers--id--details');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-customers--id--details" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/customers/{id}/details</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-customers--id--details" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-customers--id--details"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-v1-customers--id--details"
               data-component="url" required  hidden>
    <br>
<p>The Customer ID.</p>            </p>
                    </form>

            <h2 id="customers-PATCHapi-v1-customers--id--update">Update Customer</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-customers--id--update">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request PATCH \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/20/update" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --form "name=quia" \
    --form "surname=recusandae" \
    --form "photo_url=@C:\Users\kao_g\AppData\Local\Temp\php1228.tmp" </code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/20/update"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

const body = new FormData();
body.append('name', 'quia');
body.append('surname', 'recusandae');
body.append('photo_url', document.querySelector('input[name="photo_url"]').files[0]);

fetch(url, {
    method: "PATCH",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;patch(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/20/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'name',
                'contents' =&gt; 'quia'
            ],
            [
                'name' =&gt; 'surname',
                'contents' =&gt; 'recusandae'
            ],
            [
                'name' =&gt; 'photo_url',
                'contents' =&gt; fopen('C:\Users\kao_g\AppData\Local\Temp\php1228.tmp', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-PATCHapi-v1-customers--id--update">
</span>
<span id="execution-results-PATCHapi-v1-customers--id--update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-customers--id--update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-customers--id--update"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-customers--id--update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-customers--id--update"></code></pre>
</span>
<form id="form-PATCHapi-v1-customers--id--update" data-method="PATCH"
      data-path="api/v1/customers/{id}/update"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-customers--id--update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-customers--id--update"
                    onclick="tryItOut('PATCHapi-v1-customers--id--update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-customers--id--update"
                    onclick="cancelTryOut('PATCHapi-v1-customers--id--update');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-customers--id--update" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/customers/{id}/update</code></b>
        </p>
                <p>
            <label id="auth-PATCHapi-v1-customers--id--update" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PATCHapi-v1-customers--id--update"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PATCHapi-v1-customers--id--update"
               data-component="url" required  hidden>
    <br>
<p>Customer ID. Example 1</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PATCHapi-v1-customers--id--update"
               data-component="body" required  hidden>
    <br>
<p>.The Customer's name</p>        </p>
                <p>
            <b><code>surname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="surname"
               data-endpoint="PATCHapi-v1-customers--id--update"
               data-component="body" required  hidden>
    <br>
<p>. The Customer's surname</p>        </p>
                <p>
            <b><code>photo_url</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
                <input type="file"
               name="photo_url"
               data-endpoint="PATCHapi-v1-customers--id--update"
               data-component="body"  hidden>
    <br>
<p>The new customer's photo</p>        </p>
    
    </form>

            <h2 id="customers-DELETEapi-v1-customers--id--delete">Delete Customer</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-customers--id--delete">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request DELETE \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/1/delete" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/1/delete"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/customers/1/delete',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-DELETEapi-v1-customers--id--delete">
</span>
<span id="execution-results-DELETEapi-v1-customers--id--delete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-customers--id--delete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-customers--id--delete"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-customers--id--delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-customers--id--delete"></code></pre>
</span>
<form id="form-DELETEapi-v1-customers--id--delete" data-method="DELETE"
      data-path="api/v1/customers/{id}/delete"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-customers--id--delete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-customers--id--delete"
                    onclick="tryItOut('DELETEapi-v1-customers--id--delete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-customers--id--delete"
                    onclick="cancelTryOut('DELETEapi-v1-customers--id--delete');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-customers--id--delete" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/customers/{id}/delete</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-v1-customers--id--delete" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-v1-customers--id--delete"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-v1-customers--id--delete"
               data-component="url" required  hidden>
    <br>
<p>The Customer ID</p>            </p>
                    </form>

        <h1 id="permissions">Permissions</h1>

    <p>Class PermissionController</p>

            <h2 id="permissions-GETapi-v1-permissions">List All Permissions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-permissions">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-permissions">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-permissions"></code></pre>
</span>
<span id="execution-error-GETapi-v1-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-permissions"></code></pre>
</span>
<form id="form-GETapi-v1-permissions" data-method="GET"
      data-path="api/v1/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-permissions"
                    onclick="tryItOut('GETapi-v1-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-permissions"
                    onclick="cancelTryOut('GETapi-v1-permissions');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-permissions" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/permissions</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-permissions" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-permissions"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="permissions-POSTapi-v1-permissions">Create New Permission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-permissions">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"quasi\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "quasi"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'quasi',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-permissions">
</span>
<span id="execution-results-POSTapi-v1-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-permissions"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-permissions"></code></pre>
</span>
<form id="form-POSTapi-v1-permissions" data-method="POST"
      data-path="api/v1/permissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-permissions"
                    onclick="tryItOut('POSTapi-v1-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-permissions"
                    onclick="cancelTryOut('POSTapi-v1-permissions');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-permissions" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/permissions</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-permissions" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-permissions"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-permissions"
               data-component="body" required  hidden>
    <br>
<p>The Permission Name</p>        </p>
    
    </form>

            <h2 id="permissions-GETapi-v1-permissions--id-">Display Permission Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-permissions--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/10" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/10"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/10',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-permissions--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-permissions--id-"></code></pre>
</span>
<span id="execution-error-GETapi-v1-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-permissions--id-"></code></pre>
</span>
<form id="form-GETapi-v1-permissions--id-" data-method="GET"
      data-path="api/v1/permissions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-permissions--id-"
                    onclick="tryItOut('GETapi-v1-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-permissions--id-"
                    onclick="cancelTryOut('GETapi-v1-permissions--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-permissions--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/permissions/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-permissions--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-permissions--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-v1-permissions--id-"
               data-component="url" required  hidden>
    <br>
<p>The Permission ID</p>            </p>
                    </form>

            <h2 id="permissions-PUTapi-v1-permissions--id-">Update Permission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-permissions--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request PUT \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/5" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"corrupti\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/5"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "corrupti"
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/5',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'corrupti',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-PUTapi-v1-permissions--id-">
</span>
<span id="execution-results-PUTapi-v1-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-permissions--id-"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-permissions--id-"></code></pre>
</span>
<form id="form-PUTapi-v1-permissions--id-" data-method="PUT"
      data-path="api/v1/permissions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-permissions--id-"
                    onclick="tryItOut('PUTapi-v1-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-permissions--id-"
                    onclick="cancelTryOut('PUTapi-v1-permissions--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-permissions--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/permissions/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/permissions/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTapi-v1-permissions--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTapi-v1-permissions--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTapi-v1-permissions--id-"
               data-component="url" required  hidden>
    <br>
<p>The Permission ID</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTapi-v1-permissions--id-"
               data-component="body" required  hidden>
    <br>
<p>The Permission Name</p>        </p>
    
    </form>

            <h2 id="permissions-DELETEapi-v1-permissions--id-">Delete Permission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-permissions--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request DELETE \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/9" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/9"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/permissions/9',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-DELETEapi-v1-permissions--id-">
</span>
<span id="execution-results-DELETEapi-v1-permissions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-permissions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-permissions--id-"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-permissions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-permissions--id-"></code></pre>
</span>
<form id="form-DELETEapi-v1-permissions--id-" data-method="DELETE"
      data-path="api/v1/permissions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-permissions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-permissions--id-"
                    onclick="tryItOut('DELETEapi-v1-permissions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-permissions--id-"
                    onclick="cancelTryOut('DELETEapi-v1-permissions--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-permissions--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/permissions/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-v1-permissions--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-v1-permissions--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-v1-permissions--id-"
               data-component="url" required  hidden>
    <br>
<p>The Permission ID.</p>            </p>
                    </form>

        <h1 id="profile">Profile</h1>

    <p>Class ProfileController</p>

            <h2 id="profile-GETapi-v1-user-profile">Display User Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-user-profile">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-user-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-user-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-user-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-user-profile"></code></pre>
</span>
<span id="execution-error-GETapi-v1-user-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-user-profile"></code></pre>
</span>
<form id="form-GETapi-v1-user-profile" data-method="GET"
      data-path="api/v1/user/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-user-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-user-profile"
                    onclick="tryItOut('GETapi-v1-user-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-user-profile"
                    onclick="cancelTryOut('GETapi-v1-user-profile');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-user-profile" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/user/profile</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-user-profile" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-user-profile"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="profile-PATCHapi-v1-user-profile-update">Update Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-user-profile-update">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request PATCH \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile/update" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"facilis\",
    \"email\": \"rerum\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile/update"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "facilis",
    "email": "rerum"
}

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;patch(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/user/profile/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'facilis',
            'email' =&gt; 'rerum',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-PATCHapi-v1-user-profile-update">
</span>
<span id="execution-results-PATCHapi-v1-user-profile-update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-user-profile-update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-user-profile-update"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-user-profile-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-user-profile-update"></code></pre>
</span>
<form id="form-PATCHapi-v1-user-profile-update" data-method="PATCH"
      data-path="api/v1/user/profile/update"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-user-profile-update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-user-profile-update"
                    onclick="tryItOut('PATCHapi-v1-user-profile-update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-user-profile-update"
                    onclick="cancelTryOut('PATCHapi-v1-user-profile-update');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-user-profile-update" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/user/profile/update</code></b>
        </p>
                <p>
            <label id="auth-PATCHapi-v1-user-profile-update" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PATCHapi-v1-user-profile-update"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PATCHapi-v1-user-profile-update"
               data-component="body" required  hidden>
    <br>
<p>User Name</p>        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PATCHapi-v1-user-profile-update"
               data-component="body" required  hidden>
    <br>
<p>User Email</p>        </p>
    
    </form>

        <h1 id="roles">Roles</h1>

    <p>Class RoleController</p>

            <h2 id="roles-GETapi-v1-roles">List All Roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-roles">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/roles',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-roles"></code></pre>
</span>
<span id="execution-error-GETapi-v1-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-roles"></code></pre>
</span>
<form id="form-GETapi-v1-roles" data-method="GET"
      data-path="api/v1/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-roles"
                    onclick="tryItOut('GETapi-v1-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-roles"
                    onclick="cancelTryOut('GETapi-v1-roles');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/roles</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-roles"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="roles-POSTapi-v1-roles">Create New Role</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-roles">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"aperiam\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "aperiam"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/roles',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'aperiam',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-roles">
</span>
<span id="execution-results-POSTapi-v1-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-roles"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-roles"></code></pre>
</span>
<form id="form-POSTapi-v1-roles" data-method="POST"
      data-path="api/v1/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-roles"
                    onclick="tryItOut('POSTapi-v1-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-roles"
                    onclick="cancelTryOut('POSTapi-v1-roles');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/roles</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-roles"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-roles"
               data-component="body" required  hidden>
    <br>
<p>Role Name.</p>        </p>
    
    </form>

            <h2 id="roles-GETapi-v1-roles--id-">Display Role Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-roles--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/2" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/2"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/2',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-roles--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-roles--id-"></code></pre>
</span>
<span id="execution-error-GETapi-v1-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-roles--id-"></code></pre>
</span>
<form id="form-GETapi-v1-roles--id-" data-method="GET"
      data-path="api/v1/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-roles--id-"
                    onclick="tryItOut('GETapi-v1-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-roles--id-"
                    onclick="cancelTryOut('GETapi-v1-roles--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-roles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/roles/{id}</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-roles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-roles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-v1-roles--id-"
               data-component="url" required  hidden>
    <br>
<p>The Role ID</p>            </p>
                    </form>

            <h2 id="roles-PUTapi-v1-roles--id-">Update Role</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-roles--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request PUT \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/6" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"accusantium\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/6"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "accusantium"
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/6',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'accusantium',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-PUTapi-v1-roles--id-">
</span>
<span id="execution-results-PUTapi-v1-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-roles--id-"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-roles--id-"></code></pre>
</span>
<form id="form-PUTapi-v1-roles--id-" data-method="PUT"
      data-path="api/v1/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-roles--id-"
                    onclick="tryItOut('PUTapi-v1-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-roles--id-"
                    onclick="cancelTryOut('PUTapi-v1-roles--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-roles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/roles/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/roles/{id}</code></b>
        </p>
                <p>
            <label id="auth-PUTapi-v1-roles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PUTapi-v1-roles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTapi-v1-roles--id-"
               data-component="url" required  hidden>
    <br>
<p>The Role ID</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTapi-v1-roles--id-"
               data-component="body" required  hidden>
    <br>
<p>Role Name</p>        </p>
    
    </form>

            <h2 id="roles-DELETEapi-v1-roles--id-">Delete Role</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-roles--id-">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request DELETE \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/11" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/11"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/roles/11',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-DELETEapi-v1-roles--id-">
</span>
<span id="execution-results-DELETEapi-v1-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-roles--id-"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-roles--id-"></code></pre>
</span>
<form id="form-DELETEapi-v1-roles--id-" data-method="DELETE"
      data-path="api/v1/roles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-roles--id-"
                    onclick="tryItOut('DELETEapi-v1-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-roles--id-"
                    onclick="cancelTryOut('DELETEapi-v1-roles--id-');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-roles--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/roles/{id}</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-v1-roles--id-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-v1-roles--id-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-v1-roles--id-"
               data-component="url" required  hidden>
    <br>
<p>Role ID</p>            </p>
                    </form>

        <h1 id="users">Users</h1>

    <p>Class UserController</p>

            <h2 id="users-GETapi-v1-users">List All Users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-users">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/users" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users"></code></pre>
</span>
<form id="form-GETapi-v1-users" data-method="GET"
      data-path="api/v1/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users"
                    onclick="tryItOut('GETapi-v1-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users"
                    onclick="cancelTryOut('GETapi-v1-users');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-users" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-users"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="users-GETapi-v1-users--id--details">Display User Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-users--id--details">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/10/details" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/10/details"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/10/details',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-users--id--details">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users--id--details" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users--id--details"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--id--details"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users--id--details" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--id--details"></code></pre>
</span>
<form id="form-GETapi-v1-users--id--details" data-method="GET"
      data-path="api/v1/users/{id}/details"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--id--details', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users--id--details"
                    onclick="tryItOut('GETapi-v1-users--id--details');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users--id--details"
                    onclick="cancelTryOut('GETapi-v1-users--id--details');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users--id--details" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users/{id}/details</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-users--id--details" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-users--id--details"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-v1-users--id--details"
               data-component="url" required  hidden>
    <br>
<p>User ID</p>            </p>
                    </form>

            <h2 id="users-POSTapi-v1-users-create">Create New User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-users-create">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/create" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"autem\",
    \"email\": \"aut\",
    \"password\": \"voluptate\",
    \"password_confirmation\": \"consequatur\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/create"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "autem",
    "email": "aut",
    "password": "voluptate",
    "password_confirmation": "consequatur"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/create',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'autem',
            'email' =&gt; 'aut',
            'password' =&gt; 'voluptate',
            'password_confirmation' =&gt; 'consequatur',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-users-create">
</span>
<span id="execution-results-POSTapi-v1-users-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-users-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users-create"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-users-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users-create"></code></pre>
</span>
<form id="form-POSTapi-v1-users-create" data-method="POST"
      data-path="api/v1/users/create"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-users-create"
                    onclick="tryItOut('POSTapi-v1-users-create');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-users-create"
                    onclick="cancelTryOut('POSTapi-v1-users-create');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-users-create" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/users/create</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-users-create" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-users-create"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-v1-users-create"
               data-component="body" required  hidden>
    <br>
<p>The User Name</p>        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTapi-v1-users-create"
               data-component="body" required  hidden>
    <br>
<p>User Email</p>        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTapi-v1-users-create"
               data-component="body" required  hidden>
    <br>
<p>User Password</p>        </p>
                <p>
            <b><code>password_confirmation</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password_confirmation"
               data-endpoint="POSTapi-v1-users-create"
               data-component="body" required  hidden>
    <br>
<p>Password Confirmation</p>        </p>
    
    </form>

            <h2 id="users-PATCHapi-v1-users--id--update">Update User Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-users--id--update">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request PATCH \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/19/update" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"name\": \"perspiciatis\",
    \"email\": \"sit\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/19/update"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "name": "perspiciatis",
    "email": "sit"
}

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;patch(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/19/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'name' =&gt; 'perspiciatis',
            'email' =&gt; 'sit',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-PATCHapi-v1-users--id--update">
</span>
<span id="execution-results-PATCHapi-v1-users--id--update" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-users--id--update"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-users--id--update"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-users--id--update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-users--id--update"></code></pre>
</span>
<form id="form-PATCHapi-v1-users--id--update" data-method="PATCH"
      data-path="api/v1/users/{id}/update"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-users--id--update', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-users--id--update"
                    onclick="tryItOut('PATCHapi-v1-users--id--update');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-users--id--update"
                    onclick="cancelTryOut('PATCHapi-v1-users--id--update');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-users--id--update" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/users/{id}/update</code></b>
        </p>
                <p>
            <label id="auth-PATCHapi-v1-users--id--update" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="PATCHapi-v1-users--id--update"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PATCHapi-v1-users--id--update"
               data-component="url" required  hidden>
    <br>
<p>The User ID.</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PATCHapi-v1-users--id--update"
               data-component="body" required  hidden>
    <br>
<p>The name of the user</p>        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="PATCHapi-v1-users--id--update"
               data-component="body" required  hidden>
    <br>
<p>The email of the user</p>        </p>
    
    </form>

            <h2 id="users-DELETEapi-v1-users--id--delete">Delete User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-users--id--delete">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request DELETE \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/delete" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/delete"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/delete',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-DELETEapi-v1-users--id--delete">
</span>
<span id="execution-results-DELETEapi-v1-users--id--delete" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-users--id--delete"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-users--id--delete"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-users--id--delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-users--id--delete"></code></pre>
</span>
<form id="form-DELETEapi-v1-users--id--delete" data-method="DELETE"
      data-path="api/v1/users/{id}/delete"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-users--id--delete', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-users--id--delete"
                    onclick="tryItOut('DELETEapi-v1-users--id--delete');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-users--id--delete"
                    onclick="cancelTryOut('DELETEapi-v1-users--id--delete');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-users--id--delete" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/users/{id}/delete</code></b>
        </p>
                <p>
            <label id="auth-DELETEapi-v1-users--id--delete" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="DELETEapi-v1-users--id--delete"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-v1-users--id--delete"
               data-component="url" required  hidden>
    <br>
<p>The ID of the User</p>            </p>
                    </form>

            <h2 id="users-POSTapi-v1-users-status--id--admin">Change Admin Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-users-status--id--admin">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/status/13/admin" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/status/13/admin"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/status/13/admin',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-users-status--id--admin">
</span>
<span id="execution-results-POSTapi-v1-users-status--id--admin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-users-status--id--admin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users-status--id--admin"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-users-status--id--admin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users-status--id--admin"></code></pre>
</span>
<form id="form-POSTapi-v1-users-status--id--admin" data-method="POST"
      data-path="api/v1/users/status/{id}/admin"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users-status--id--admin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-users-status--id--admin"
                    onclick="tryItOut('POSTapi-v1-users-status--id--admin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-users-status--id--admin"
                    onclick="cancelTryOut('POSTapi-v1-users-status--id--admin');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-users-status--id--admin" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/users/status/{id}/admin</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-users-status--id--admin" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-users-status--id--admin"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTapi-v1-users-status--id--admin"
               data-component="url" required  hidden>
    <br>
<p>The User ID</p>            </p>
                    </form>

            <h2 id="users-GETapi-v1-users--id--roles">List User Specific Roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-users--id--roles">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/roles',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-v1-users--id--roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-users--id--roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-users--id--roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-users--id--roles"></code></pre>
</span>
<span id="execution-error-GETapi-v1-users--id--roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-users--id--roles"></code></pre>
</span>
<form id="form-GETapi-v1-users--id--roles" data-method="GET"
      data-path="api/v1/users/{id}/roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-users--id--roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-users--id--roles"
                    onclick="tryItOut('GETapi-v1-users--id--roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-users--id--roles"
                    onclick="cancelTryOut('GETapi-v1-users--id--roles');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-users--id--roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/users/{id}/roles</code></b>
        </p>
                <p>
            <label id="auth-GETapi-v1-users--id--roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETapi-v1-users--id--roles"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-v1-users--id--roles"
               data-component="url"  hidden>
    <br>
<p>The User ID</p>            </p>
                    </form>

            <h2 id="users-POSTapi-v1-users--id--assign-roles">Assign Role|Multiple Roles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-users--id--assign-roles">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/assign-roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"role_id\": \"et\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/assign-roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "role_id": "et"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/12/assign-roles',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'role_id' =&gt; 'et',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-users--id--assign-roles">
</span>
<span id="execution-results-POSTapi-v1-users--id--assign-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-users--id--assign-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users--id--assign-roles"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-users--id--assign-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users--id--assign-roles"></code></pre>
</span>
<form id="form-POSTapi-v1-users--id--assign-roles" data-method="POST"
      data-path="api/v1/users/{id}/assign-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users--id--assign-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-users--id--assign-roles"
                    onclick="tryItOut('POSTapi-v1-users--id--assign-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-users--id--assign-roles"
                    onclick="cancelTryOut('POSTapi-v1-users--id--assign-roles');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-users--id--assign-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/users/{id}/assign-roles</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-users--id--assign-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-users--id--assign-roles"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTapi-v1-users--id--assign-roles"
               data-component="url" required  hidden>
    <br>
<p>the User ID to be assigned roles</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>role_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="role_id"
               data-endpoint="POSTapi-v1-users--id--assign-roles"
               data-component="body"  hidden>
    <br>
<p>The Role ID</p>        </p>
    
    </form>

            <h2 id="users-POSTapi-v1-users--id--revoke-roles">Revoke Role|Roles from a user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-users--id--revoke-roles">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request POST \
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/17/revoke-roles" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Access-Control-Allow-Origin: *" \
    --data "{
    \"role_id\": \"consequatur\"
}"
</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "https://www.agilebackend.tujiajiriafrica.com/api/v1/users/17/revoke-roles"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Access-Control-Allow-Origin": "*",
};

let body = {
    "role_id": "consequatur"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://www.agilebackend.tujiajiriafrica.com/api/v1/users/17/revoke-roles',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Accept' =&gt; 'application/json',
            'Access-Control-Allow-Origin' =&gt; '*',
        ],
        'json' =&gt; [
            'role_id' =&gt; 'consequatur',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-POSTapi-v1-users--id--revoke-roles">
</span>
<span id="execution-results-POSTapi-v1-users--id--revoke-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-users--id--revoke-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-users--id--revoke-roles"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-users--id--revoke-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-users--id--revoke-roles"></code></pre>
</span>
<form id="form-POSTapi-v1-users--id--revoke-roles" data-method="POST"
      data-path="api/v1/users/{id}/revoke-roles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Access-Control-Allow-Origin":"*"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-users--id--revoke-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-users--id--revoke-roles"
                    onclick="tryItOut('POSTapi-v1-users--id--revoke-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-users--id--revoke-roles"
                    onclick="cancelTryOut('POSTapi-v1-users--id--revoke-roles');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-users--id--revoke-roles" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/users/{id}/revoke-roles</code></b>
        </p>
                <p>
            <label id="auth-POSTapi-v1-users--id--revoke-roles" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTapi-v1-users--id--revoke-roles"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTapi-v1-users--id--revoke-roles"
               data-component="url" required  hidden>
    <br>
<p>User ID</p>            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>role_id</code></b>&nbsp;&nbsp;<small>required</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="role_id"
               data-endpoint="POSTapi-v1-users--id--revoke-roles"
               data-component="body"  hidden>
    <br>
<p>The role(s) to be revoked(for many roles, use comma separated IDs)</p>        </p>
    
    </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var exampleLanguages = ["bash","javascript","php"];
        setupLanguages(exampleLanguages);
    });
</script>
</body>
</html>