<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>HairSalon Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
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
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: February 23 2021</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<pre><code>    This documentation aims to provide all the information you need to work with our API.

    &lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
    You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<script>
    var baseUrl = "http://hairsalon.test";
</script>
<script src="{{ asset("vendor/scribe/js/tryitout-2.4.2.js") }}"></script>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://hairsalon.test</code></pre><h1>Authenticating requests</h1>
<p>This API is authenticated by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can also set the api language by sending <code>&quot;Accept-Language: ar&quot; </code></p><h1>Authentication</h1>
<h2>Register</h2>
<p>Register and send verification code to user phone number. use 12345 to test</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1,"first_name":"Jon","last_name":"Snow","phone":"0501234567"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "business_id": 1,
    "first_name": "Jon",
    "last_name": "Snow",
    "phone": "0501234567"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/register',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'business_id' =&gt; 1,
            'first_name' =&gt; 'Jon',
            'last_name' =&gt; 'Snow',
            'phone' =&gt; '0501234567',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
       "message": "Verification code sent",
       "user": {
           "first_name": "Jon",
           "last_name": "Snow",
           "phone": "0501234567",
           "role": "Business client",
           "updated_at": "2021-01-07T14:41:57.000000Z",
           "created_at": "2021-01-07T14:41:57.000000Z",
           "id": 1
       }
   }
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "phone": [
            "The phone has already been taken."
        ]
    }
}</code></pre>
<div id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"></code></pre>
</div>
<div id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register"></code></pre>
</div>
<form id="form-POSTapi-register" data-method="POST" data-path="api/register" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-register" onclick="tryItOut('POSTapi-register');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-register" onclick="cancelTryOut('POSTapi-register');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-register" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/register</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>business_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="business_id" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
business ID.</p>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
User fist name.</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
User last name.</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
User phone number.</p>

</form>
<h2>Login</h2>
<p>Send verification code to user phone.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1,"phone":"0501234567"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "business_id": 1,
    "phone": "0501234567"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/login',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'business_id' =&gt; 1,
            'phone' =&gt; '0501234567',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
    "message": "Verification code sent.",
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "The given data was invalid.",
    "errors": {
        "phone": [
            "The phone has already been taken."
        ]
    }
}</code></pre>
<div id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"></code></pre>
</div>
<div id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login"></code></pre>
</div>
<form id="form-POSTapi-login" data-method="POST" data-path="api/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-login" onclick="tryItOut('POSTapi-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-login" onclick="cancelTryOut('POSTapi-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>business_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="business_id" data-endpoint="POSTapi-login" data-component="body" required  hidden>
<br>
business ID.</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone" data-endpoint="POSTapi-login" data-component="body" required  hidden>
<br>
User phone number.</p>

</form>
<h2>Verify code</h2>
<p>Verify the verification code and return token.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/verify" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"phone":"0501234567","code":"123456"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/verify"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "phone": "0501234567",
    "code": "123456"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/verify',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'phone' =&gt; '0501234567',
            'code' =&gt; '123456',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Code verified",
    "api_token": "yQi6wk53fWRxSpsRQn5k7E8Bp3gRspVlmEfOfeqVBaD9o0FIWdYFsATRo1Fb"
}</code></pre>
<div id="execution-results-POSTapi-verify" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-verify"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-verify"></code></pre>
</div>
<div id="execution-error-POSTapi-verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-verify"></code></pre>
</div>
<form id="form-POSTapi-verify" data-method="POST" data-path="api/verify" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-verify', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-verify" onclick="tryItOut('POSTapi-verify');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-verify" onclick="cancelTryOut('POSTapi-verify');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-verify" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/verify</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone" data-endpoint="POSTapi-verify" data-component="body" required  hidden>
<br>
User phone number.</p>
<p>
<b><code>code</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="code" data-endpoint="POSTapi-verify" data-component="body" required  hidden>
<br>
Code sent with sms, use 11111 to test.</p>

</form><h1>Businesses</h1>
<h2>Update</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Update business by ID.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/business/1/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"name":"myname","intro":"my intro","about":"my about","address":"haifa","working_days":"all days","logo":"8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg","cover":"8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg","facebook":"https:\/\/facebook.com\/username","whatsapp":"https:\/\/whatsapp.com\/username","instagram":"https:\/\/instagram.com\/username","website":"https:\/\/website.com\/username"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/business/1/update"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "name": "myname",
    "intro": "my intro",
    "about": "my about",
    "address": "haifa",
    "working_days": "all days",
    "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
    "cover": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
    "facebook": "https:\/\/facebook.com\/username",
    "whatsapp": "https:\/\/whatsapp.com\/username",
    "instagram": "https:\/\/instagram.com\/username",
    "website": "https:\/\/website.com\/username"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/business/1/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'name' =&gt; 'myname',
            'intro' =&gt; 'my intro',
            'about' =&gt; 'my about',
            'address' =&gt; 'haifa',
            'working_days' =&gt; 'all days',
            'logo' =&gt; '8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg',
            'cover' =&gt; '8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg',
            'facebook' =&gt; 'https://facebook.com/username',
            'whatsapp' =&gt; 'https://whatsapp.com/username',
            'instagram' =&gt; 'https://instagram.com/username',
            'website' =&gt; 'https://website.com/username',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Business updated successfully",
    "business": {
        "id": 1,
        "name": "صالون الزعيم",
        "intro": "اهلا بك في صالون الزعيم",
        "about": "",
        "address": "Nazareth",
        "working_days": "",
        "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
        "created_at": "2021-01-22T00:39:20.000000Z",
        "updated_at": "2021-01-22T00:39:47.000000Z"
    }
}</code></pre>
<div id="execution-results-POSTapi-business--id--update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-business--id--update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-business--id--update"></code></pre>
</div>
<div id="execution-error-POSTapi-business--id--update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-business--id--update"></code></pre>
</div>
<form id="form-POSTapi-business--id--update" data-method="POST" data-path="api/business/{id}/update" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-business--id--update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-business--id--update" onclick="tryItOut('POSTapi-business--id--update');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-business--id--update" onclick="cancelTryOut('POSTapi-business--id--update');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-business--id--update" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/business/{id}/update</code></b>
</p>
<p>
<label id="auth-POSTapi-business--id--update" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-business--id--update" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="POSTapi-business--id--update" data-component="url" required  hidden>
<br>
The ID of the business.</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>intro</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="intro" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>about</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="about" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>address</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="address" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>working_days</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="working_days" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>logo</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="logo" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>cover</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="cover" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>facebook</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="facebook" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>whatsapp</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="whatsapp" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>instagram</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="instagram" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>website</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="website" data-endpoint="POSTapi-business--id--update" data-component="body"  hidden>
<br>
</p>

</form>
<h2>Get</h2>
<p>Get business by ID.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://hairsalon.test/api/business/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/business/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://hairsalon.test/api/business/1',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "business": {
        "id": 1,
        "name": "صالون الزعيم",
        "intro": "اهلا بك في صالون الزعيم",
        "about": "",
        "address": "Nazareth",
        "working_days": "",
        "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
        "cover": null,
        "primary_color": "#E91E63",
        "social_links": null,
        "order_min_days": 0,
        "user_id": null,
        "created_at": "2021-01-22T00:39:20.000000Z",
        "updated_at": "2021-01-22T00:39:47.000000Z"
    }
}</code></pre>
<div id="execution-results-GETapi-business--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-business--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-business--id-"></code></pre>
</div>
<div id="execution-error-GETapi-business--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-business--id-"></code></pre>
</div>
<form id="form-GETapi-business--id-" data-method="GET" data-path="api/business/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-business--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-business--id-" onclick="tryItOut('GETapi-business--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-business--id-" onclick="cancelTryOut('GETapi-business--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-business--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/business/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-business--id-" data-component="url" required  hidden>
<br>
The ID of the business.</p>
</form><h1>Contact</h1>
<h2>Send message</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Send message</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/contact-messages" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"content":"my message"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/contact-messages"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "content": "my message"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/contact-messages',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'content' =&gt; 'my message',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
"status": "success",
}</code></pre>
<div id="execution-results-POSTapi-contact-messages" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-contact-messages"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-contact-messages"></code></pre>
</div>
<div id="execution-error-POSTapi-contact-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-contact-messages"></code></pre>
</div>
<form id="form-POSTapi-contact-messages" data-method="POST" data-path="api/contact-messages" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-contact-messages', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-contact-messages" onclick="tryItOut('POSTapi-contact-messages');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-contact-messages" onclick="cancelTryOut('POSTapi-contact-messages');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-contact-messages" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/contact-messages</code></b>
</p>
<p>
<label id="auth-POSTapi-contact-messages" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-contact-messages" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>content</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="content" data-endpoint="POSTapi-contact-messages" data-component="body" required  hidden>
<br>
content.</p>

</form><h1>Create Order</h1>
<h2>Submit services and get employees</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Submit service and get employees list</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/create-order/submit-services" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/create-order/submit-services"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ]
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/create-order/submit-services',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-create-order-submit-services" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-create-order-submit-services"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-order-submit-services"></code></pre>
</div>
<div id="execution-error-POSTapi-create-order-submit-services" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-order-submit-services"></code></pre>
</div>
<form id="form-POSTapi-create-order-submit-services" data-method="POST" data-path="api/create-order/submit-services" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-order-submit-services', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-create-order-submit-services" onclick="tryItOut('POSTapi-create-order-submit-services');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-create-order-submit-services" onclick="cancelTryOut('POSTapi-create-order-submit-services');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-create-order-submit-services" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/create-order/submit-services</code></b>
</p>
<p>
<label id="auth-POSTapi-create-order-submit-services" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-create-order-submit-services" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-create-order-submit-services" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-create-order-submit-services" data-component="body" hidden>
<br>
services ids.</p>

</form>
<h2>Submit employee</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Submit employee and get dates and times that this employee is available</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/create-order/submit-employee" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2],"employee_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/create-order/submit-employee"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ],
    "employee_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/create-order/submit-employee',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
            'employee_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-create-order-submit-employee" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-create-order-submit-employee"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-order-submit-employee"></code></pre>
</div>
<div id="execution-error-POSTapi-create-order-submit-employee" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-order-submit-employee"></code></pre>
</div>
<form id="form-POSTapi-create-order-submit-employee" data-method="POST" data-path="api/create-order/submit-employee" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-order-submit-employee', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-create-order-submit-employee" onclick="tryItOut('POSTapi-create-order-submit-employee');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-create-order-submit-employee" onclick="cancelTryOut('POSTapi-create-order-submit-employee');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-create-order-submit-employee" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/create-order/submit-employee</code></b>
</p>
<p>
<label id="auth-POSTapi-create-order-submit-employee" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-create-order-submit-employee" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-create-order-submit-employee" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-create-order-submit-employee" data-component="body" hidden>
<br>
services ids.</p>
<p>
<b><code>employee_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="employee_id" data-endpoint="POSTapi-create-order-submit-employee" data-component="body" required  hidden>
<br>
employee id.</p>

</form>
<h2>Submit day</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Submit day and get available times</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/create-order/submit-day" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2],"employee_id":1,"date":"2021-02-01"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/create-order/submit-day"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ],
    "employee_id": 1,
    "date": "2021-02-01"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/create-order/submit-day',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
            'employee_id' =&gt; 1,
            'date' =&gt; '2021-02-01',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-create-order-submit-day" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-create-order-submit-day"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-order-submit-day"></code></pre>
</div>
<div id="execution-error-POSTapi-create-order-submit-day" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-order-submit-day"></code></pre>
</div>
<form id="form-POSTapi-create-order-submit-day" data-method="POST" data-path="api/create-order/submit-day" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-order-submit-day', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-create-order-submit-day" onclick="tryItOut('POSTapi-create-order-submit-day');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-create-order-submit-day" onclick="cancelTryOut('POSTapi-create-order-submit-day');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-create-order-submit-day" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/create-order/submit-day</code></b>
</p>
<p>
<label id="auth-POSTapi-create-order-submit-day" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-create-order-submit-day" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-create-order-submit-day" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-create-order-submit-day" data-component="body" hidden>
<br>
services ids.</p>
<p>
<b><code>employee_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="employee_id" data-endpoint="POSTapi-create-order-submit-day" data-component="body" required  hidden>
<br>
employee id.</p>
<p>
<b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="date" data-endpoint="POSTapi-create-order-submit-day" data-component="body" required  hidden>
<br>
order date.</p>

</form>
<h2>Submit time</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Send time that neede to be appointed</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/create-order/submit-time" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2],"employee_id":1,"date":"2021-02-01","time":"10:00"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/create-order/submit-time"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ],
    "employee_id": 1,
    "date": "2021-02-01",
    "time": "10:00"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/create-order/submit-time',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
            'employee_id' =&gt; 1,
            'date' =&gt; '2021-02-01',
            'time' =&gt; '10:00',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-create-order-submit-time" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-create-order-submit-time"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-order-submit-time"></code></pre>
</div>
<div id="execution-error-POSTapi-create-order-submit-time" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-order-submit-time"></code></pre>
</div>
<form id="form-POSTapi-create-order-submit-time" data-method="POST" data-path="api/create-order/submit-time" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-order-submit-time', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-create-order-submit-time" onclick="tryItOut('POSTapi-create-order-submit-time');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-create-order-submit-time" onclick="cancelTryOut('POSTapi-create-order-submit-time');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-create-order-submit-time" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/create-order/submit-time</code></b>
</p>
<p>
<label id="auth-POSTapi-create-order-submit-time" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-create-order-submit-time" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-create-order-submit-time" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-create-order-submit-time" data-component="body" hidden>
<br>
services ids.</p>
<p>
<b><code>employee_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="employee_id" data-endpoint="POSTapi-create-order-submit-time" data-component="body" required  hidden>
<br>
employee id.</p>
<p>
<b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="date" data-endpoint="POSTapi-create-order-submit-time" data-component="body" required  hidden>
<br>
order date.</p>
<p>
<b><code>time</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="time" data-endpoint="POSTapi-create-order-submit-time" data-component="body" required  hidden>
<br>
order time.</p>

</form>
<h2>Submit order</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Send time that neede to be appointed</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/create-order/submit-order" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2],"employee_id":1,"date":"2021-02-01","time":"10:00"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/create-order/submit-order"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ],
    "employee_id": 1,
    "date": "2021-02-01",
    "time": "10:00"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/create-order/submit-order',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
            'employee_id' =&gt; 1,
            'date' =&gt; '2021-02-01',
            'time' =&gt; '10:00',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-create-order-submit-order" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-create-order-submit-order"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-create-order-submit-order"></code></pre>
</div>
<div id="execution-error-POSTapi-create-order-submit-order" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-create-order-submit-order"></code></pre>
</div>
<form id="form-POSTapi-create-order-submit-order" data-method="POST" data-path="api/create-order/submit-order" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-create-order-submit-order', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-create-order-submit-order" onclick="tryItOut('POSTapi-create-order-submit-order');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-create-order-submit-order" onclick="cancelTryOut('POSTapi-create-order-submit-order');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-create-order-submit-order" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/create-order/submit-order</code></b>
</p>
<p>
<label id="auth-POSTapi-create-order-submit-order" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-create-order-submit-order" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-create-order-submit-order" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-create-order-submit-order" data-component="body" hidden>
<br>
services ids.</p>
<p>
<b><code>employee_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="employee_id" data-endpoint="POSTapi-create-order-submit-order" data-component="body" required  hidden>
<br>
employee id.</p>
<p>
<b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="date" data-endpoint="POSTapi-create-order-submit-order" data-component="body" required  hidden>
<br>
order date.</p>
<p>
<b><code>time</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="time" data-endpoint="POSTapi-create-order-submit-order" data-component="body" required  hidden>
<br>
order time.</p>

</form><h1>Home</h1>
<h2>Get Home data</h2>
<p>Get home data by business ID.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/home" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "business_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/home',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'business_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "business": {
        "id": 1,
        "name": "صالون الزعيم",
        "intro": "اهلا بك في صالون الزعيم",
        "about": "",
        "address": "Nazareth",
        "working_days": "",
        "logo": "8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg",
        "cover": null,
        "primary_color": "#E91E63",
        "social_links": null,
        "order_min_days": 0,
        "user_id": null,
        "created_at": "2021-01-22T00:39:20.000000Z",
        "updated_at": "2021-01-22T00:39:47.000000Z"
    }
}</code></pre>
<div id="execution-results-POSTapi-home" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-home"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-home"></code></pre>
</div>
<div id="execution-error-POSTapi-home" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-home"></code></pre>
</div>
<form id="form-POSTapi-home" data-method="POST" data-path="api/home" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-home', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-home" onclick="tryItOut('POSTapi-home');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-home" onclick="cancelTryOut('POSTapi-home');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-home" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/home</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>business_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="business_id" data-endpoint="POSTapi-home" data-component="body" required  hidden>
<br>
business ID.</p>

</form><h1>Notifications</h1>
<h2>List</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Get user Notifications</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://hairsalon.test/api/user/notifications" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user/notifications"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://hairsalon.test/api/user/notifications',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "notifications": [
        {
            "id": "06e741b1-61aa-4bf8-900a-c19c8be47607",
            "read_at": null,
            "data": {
                "title": "Order",
                "message": "Order updated successfully.",
                "order": {
                    "id": 1,
                    "services": null,
                    "total": 22,
                    "minutes": 20,
                    "starting_at": "2021-02-07T18:25:00.000000Z",
                    "ending_at": "2021-02-07T18:45:00.000000Z",
                    "approved": 0,
                    "start_at": "20:25:00",
                    "end_at": "20:45:00"
                },
                "user": {
                    "id": 1,
                    "first_name": "Sulieman",
                    "last_name": "Shahbari",
                    "phone": null,
                    "role": "admin"
                }
            }
        }
    ]
}</code></pre>
<div id="execution-results-GETapi-user-notifications" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-user-notifications"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user-notifications"></code></pre>
</div>
<div id="execution-error-GETapi-user-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user-notifications"></code></pre>
</div>
<form id="form-GETapi-user-notifications" data-method="GET" data-path="api/user/notifications" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-user-notifications', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-user-notifications" onclick="tryItOut('GETapi-user-notifications');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-user-notifications" onclick="cancelTryOut('GETapi-user-notifications');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-user-notifications" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/user/notifications</code></b>
</p>
<p>
<label id="auth-GETapi-user-notifications" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-user-notifications" data-component="header"></label>
</p>
</form>
<h2>Order Created</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Notification order created, (this automatically fired after order submit)</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/user/notifications/create" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"order_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user/notifications/create"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "order_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/user/notifications/create',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'order_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
 {
     "id": "96e12cf2-13fc-45ef-ae96-37e9ab22666d",
     "read_at": null,
     "data": {
         "title": "Order",
         "message": "Order created successfully"
     }
 }
}</code></pre>
<div id="execution-results-POSTapi-user-notifications-create" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-user-notifications-create"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-notifications-create"></code></pre>
</div>
<div id="execution-error-POSTapi-user-notifications-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-notifications-create"></code></pre>
</div>
<form id="form-POSTapi-user-notifications-create" data-method="POST" data-path="api/user/notifications/create" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-notifications-create', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-user-notifications-create" onclick="tryItOut('POSTapi-user-notifications-create');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-user-notifications-create" onclick="cancelTryOut('POSTapi-user-notifications-create');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-user-notifications-create" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/user/notifications/create</code></b>
</p>
<p>
<label id="auth-POSTapi-user-notifications-create" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-user-notifications-create" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>order_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="order_id" data-endpoint="POSTapi-user-notifications-create" data-component="body" required  hidden>
<br>
Order ID.</p>

</form>
<h2>Update (dev only)</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Notification update</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/user/notifications/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"order_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user/notifications/update"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "order_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/user/notifications/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'order_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{}</code></pre>
<div id="execution-results-POSTapi-user-notifications-update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-user-notifications-update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-notifications-update"></code></pre>
</div>
<div id="execution-error-POSTapi-user-notifications-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-notifications-update"></code></pre>
</div>
<form id="form-POSTapi-user-notifications-update" data-method="POST" data-path="api/user/notifications/update" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-notifications-update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-user-notifications-update" onclick="tryItOut('POSTapi-user-notifications-update');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-user-notifications-update" onclick="cancelTryOut('POSTapi-user-notifications-update');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-user-notifications-update" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/user/notifications/update</code></b>
</p>
<p>
<label id="auth-POSTapi-user-notifications-update" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-user-notifications-update" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>order_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="order_id" data-endpoint="POSTapi-user-notifications-update" data-component="body" required  hidden>
<br>
Order ID.</p>

</form>
<h2>Delete</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Notification delete</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/user/notifications/delete" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"notification_id":"ee3276e6-a758-48c2-b5d5-626202b470b4"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user/notifications/delete"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "notification_id": "ee3276e6-a758-48c2-b5d5-626202b470b4"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/user/notifications/delete',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'notification_id' =&gt; 'ee3276e6-a758-48c2-b5d5-626202b470b4',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{}</code></pre>
<div id="execution-results-POSTapi-user-notifications-delete" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-user-notifications-delete"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-notifications-delete"></code></pre>
</div>
<div id="execution-error-POSTapi-user-notifications-delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-notifications-delete"></code></pre>
</div>
<form id="form-POSTapi-user-notifications-delete" data-method="POST" data-path="api/user/notifications/delete" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-notifications-delete', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-user-notifications-delete" onclick="tryItOut('POSTapi-user-notifications-delete');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-user-notifications-delete" onclick="cancelTryOut('POSTapi-user-notifications-delete');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-user-notifications-delete" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/user/notifications/delete</code></b>
</p>
<p>
<label id="auth-POSTapi-user-notifications-delete" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-user-notifications-delete" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>notification_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="notification_id" data-endpoint="POSTapi-user-notifications-delete" data-component="body" required  hidden>
<br>
Notification ID.</p>

</form>
<h2>Mark as read</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Notification mark as read</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/user/notifications/mark-as-read" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"notification_id":"9be199ca-e7d3-465e-94fc-cb74628e0b53","delete":0}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user/notifications/mark-as-read"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "notification_id": "9be199ca-e7d3-465e-94fc-cb74628e0b53",
    "delete": 0
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/user/notifications/mark-as-read',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'notification_id' =&gt; '9be199ca-e7d3-465e-94fc-cb74628e0b53',
            'delete' =&gt; 0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Notification marked as read",
    "notification": {
        "id": "bafc11ae-64da-47dd-9272-d241992ecfea",
        "type": "App\\Notifications\\OrderUpdated",
        "notifiable_type": "App\\User",
        "notifiable_id": 1,
        "data": {
            "message": "Order updated successfully."
        },
        "read_at": "2021-01-25T19:31:24.000000Z",
        "created_at": "2021-01-25T19:30:57.000000Z",
        "updated_at": "2021-01-25T19:31:24.000000Z"
    }
}</code></pre>
<div id="execution-results-POSTapi-user-notifications-mark-as-read" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-user-notifications-mark-as-read"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user-notifications-mark-as-read"></code></pre>
</div>
<div id="execution-error-POSTapi-user-notifications-mark-as-read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user-notifications-mark-as-read"></code></pre>
</div>
<form id="form-POSTapi-user-notifications-mark-as-read" data-method="POST" data-path="api/user/notifications/mark-as-read" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-notifications-mark-as-read', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-user-notifications-mark-as-read" onclick="tryItOut('POSTapi-user-notifications-mark-as-read');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-user-notifications-mark-as-read" onclick="cancelTryOut('POSTapi-user-notifications-mark-as-read');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-user-notifications-mark-as-read" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/user/notifications/mark-as-read</code></b>
</p>
<p>
<label id="auth-POSTapi-user-notifications-mark-as-read" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-user-notifications-mark-as-read" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>notification_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="notification_id" data-endpoint="POSTapi-user-notifications-mark-as-read" data-component="body" required  hidden>
<br>
Notification ID.</p>
<p>
<b><code>delete</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="delete" data-endpoint="POSTapi-user-notifications-mark-as-read" data-component="body"  hidden>
<br>
optional.</p>

</form><h1>Orders</h1>
<h2>Get active orders</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Get user's orders (active)</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/orders/active" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/orders/active"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/orders/active',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "orders": []
}</code></pre>
<div id="execution-results-POSTapi-orders-active" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-orders-active"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders-active"></code></pre>
</div>
<div id="execution-error-POSTapi-orders-active" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders-active"></code></pre>
</div>
<form id="form-POSTapi-orders-active" data-method="POST" data-path="api/orders/active" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders-active', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-orders-active" onclick="tryItOut('POSTapi-orders-active');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-orders-active" onclick="cancelTryOut('POSTapi-orders-active');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-orders-active" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/orders/active</code></b>
</p>
<p>
<label id="auth-POSTapi-orders-active" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-orders-active" data-component="header"></label>
</p>
</form>
<h2>Get archived orders</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Get user's orders (archived)</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/orders/archived" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/orders/archived"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/orders/archived',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "orders": []
}</code></pre>
<div id="execution-results-POSTapi-orders-archived" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-orders-archived"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders-archived"></code></pre>
</div>
<div id="execution-error-POSTapi-orders-archived" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders-archived"></code></pre>
</div>
<form id="form-POSTapi-orders-archived" data-method="POST" data-path="api/orders/archived" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders-archived', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-orders-archived" onclick="tryItOut('POSTapi-orders-archived');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-orders-archived" onclick="cancelTryOut('POSTapi-orders-archived');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-orders-archived" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/orders/archived</code></b>
</p>
<p>
<label id="auth-POSTapi-orders-archived" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-orders-archived" data-component="header"></label>
</p>
</form>
<h2>Edit order by id</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Send time that neede to be appointed</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/orders/modi/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"services_id":[1,2],"employee_id":1,"date":"2021-02-01","time":"10:00"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/orders/modi/update"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "services_id": [
        1,
        2
    ],
    "employee_id": 1,
    "date": "2021-02-01",
    "time": "10:00"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/orders/modi/update',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'services_id' =&gt; [
                1,
                2,
            ],
            'employee_id' =&gt; 1,
            'date' =&gt; '2021-02-01',
            'time' =&gt; '10:00',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<div id="execution-results-POSTapi-orders--id--update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-orders--id--update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders--id--update"></code></pre>
</div>
<div id="execution-error-POSTapi-orders--id--update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders--id--update"></code></pre>
</div>
<form id="form-POSTapi-orders--id--update" data-method="POST" data-path="api/orders/{id}/update" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders--id--update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-orders--id--update" onclick="tryItOut('POSTapi-orders--id--update');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-orders--id--update" onclick="cancelTryOut('POSTapi-orders--id--update');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-orders--id--update" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/orders/{id}/update</code></b>
</p>
<p>
<label id="auth-POSTapi-orders--id--update" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-orders--id--update" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="POSTapi-orders--id--update" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>services_id</code></b>&nbsp;&nbsp;<small>integer[]</small>  &nbsp;
<input type="number" name="services_id.0" data-endpoint="POSTapi-orders--id--update" data-component="body" required  hidden>
<input type="number" name="services_id.1" data-endpoint="POSTapi-orders--id--update" data-component="body" hidden>
<br>
services ids.</p>
<p>
<b><code>employee_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="employee_id" data-endpoint="POSTapi-orders--id--update" data-component="body" required  hidden>
<br>
employee id.</p>
<p>
<b><code>date</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="date" data-endpoint="POSTapi-orders--id--update" data-component="body" required  hidden>
<br>
order date.</p>
<p>
<b><code>time</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="time" data-endpoint="POSTapi-orders--id--update" data-component="body" required  hidden>
<br>
order time.</p>

</form><h1>Services</h1>
<h2>Get services list</h2>
<p>Get services by business ID.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/services" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/services"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "business_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/services',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'business_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "services": []
}</code></pre>
<div id="execution-results-POSTapi-services" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-services"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-services"></code></pre>
</div>
<div id="execution-error-POSTapi-services" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-services"></code></pre>
</div>
<form id="form-POSTapi-services" data-method="POST" data-path="api/services" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-services', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-services" onclick="tryItOut('POSTapi-services');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-services" onclick="cancelTryOut('POSTapi-services');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-services" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/services</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>business_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="business_id" data-endpoint="POSTapi-services" data-component="body" required  hidden>
<br>
business ID.</p>

</form><h1>Stories</h1>
<h2>List</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Get user Stories</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://hairsalon.test/api/sroties" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/sroties"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://hairsalon.test/api/sroties',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "stories": [
        {
            "id": 1,
            "user_id": 1,
            "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
            "views": 0,
            "created_at": "2021-01-26T09:49:43.000000Z",
            "updated_at": "2021-01-26T09:49:43.000000Z"
        }
    ]
}</code></pre>
<div id="execution-results-GETapi-sroties" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-sroties"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-sroties"></code></pre>
</div>
<div id="execution-error-GETapi-sroties" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-sroties"></code></pre>
</div>
<form id="form-GETapi-sroties" data-method="GET" data-path="api/sroties" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-sroties', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-sroties" onclick="tryItOut('GETapi-sroties');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-sroties" onclick="cancelTryOut('GETapi-sroties');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-sroties" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/sroties</code></b>
</p>
<p>
<label id="auth-GETapi-sroties" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-sroties" data-component="header"></label>
</p>
</form>
<h2>Create</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Story create</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/sroties" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -F "image=@/private/var/folders/r4/8kqcyz715t51zr4nsl5krk0c0000gn/T/phpqy69Y2" </code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/sroties"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/sroties',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'image',
                'contents' =&gt; fopen('/private/var/folders/r4/8kqcyz715t51zr4nsl5krk0c0000gn/T/phpqy69Y2', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Story created successfully",
    "story": {
        "user_id": 1,
        "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
        "views": 0,
        "updated_at": "2021-01-26T13:22:13.000000Z",
        "created_at": "2021-01-26T13:22:13.000000Z",
        "id": 3
    }
}</code></pre>
<div id="execution-results-POSTapi-sroties" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-sroties"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-sroties"></code></pre>
</div>
<div id="execution-error-POSTapi-sroties" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-sroties"></code></pre>
</div>
<form id="form-POSTapi-sroties" data-method="POST" data-path="api/sroties" data-authed="1" data-hasfiles="1" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-sroties', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-sroties" onclick="tryItOut('POSTapi-sroties');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-sroties" onclick="cancelTryOut('POSTapi-sroties');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-sroties" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/sroties</code></b>
</p>
<p>
<label id="auth-POSTapi-sroties" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-sroties" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
<input type="file" name="image" data-endpoint="POSTapi-sroties" data-component="body"  hidden>
<br>
The image.</p>

</form>
<h2>Delete</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Story delete</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/sroties/delete" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"story_id":1}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/sroties/delete"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "story_id": 1
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/sroties/delete',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'story_id' =&gt; 1,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
      "message": "Story deleted successfully",
}</code></pre>
<div id="execution-results-POSTapi-sroties-delete" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-sroties-delete"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-sroties-delete"></code></pre>
</div>
<div id="execution-error-POSTapi-sroties-delete" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-sroties-delete"></code></pre>
</div>
<form id="form-POSTapi-sroties-delete" data-method="POST" data-path="api/sroties/delete" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-sroties-delete', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-sroties-delete" onclick="tryItOut('POSTapi-sroties-delete');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-sroties-delete" onclick="cancelTryOut('POSTapi-sroties-delete');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-sroties-delete" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/sroties/delete</code></b>
</p>
<p>
<label id="auth-POSTapi-sroties-delete" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-sroties-delete" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>story_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="story_id" data-endpoint="POSTapi-sroties-delete" data-component="body" required  hidden>
<br>
Store ID.</p>

</form><h1>Upload images</h1>
<h2>Upload</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Upload images</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/upload" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: multipart/form-data" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -F "image=@/private/var/folders/r4/8kqcyz715t51zr4nsl5krk0c0000gn/T/phpywCCX8" </code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/upload"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/upload',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'image',
                'contents' =&gt; fopen('/private/var/folders/r4/8kqcyz715t51zr4nsl5krk0c0000gn/T/phpywCCX8', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">
{
      "message": "Image uploaded successfully",
         "image": "uJZoX5RTsWHGwZfkL7DmaFI2y7rb6fi4UgdadqtP.jpg",
}</code></pre>
<div id="execution-results-POSTapi-upload" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-upload"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload"></code></pre>
</div>
<div id="execution-error-POSTapi-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload"></code></pre>
</div>
<form id="form-POSTapi-upload" data-method="POST" data-path="api/upload" data-authed="1" data-hasfiles="1" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"multipart\/form-data","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-upload" onclick="tryItOut('POSTapi-upload');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-upload" onclick="cancelTryOut('POSTapi-upload');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-upload" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/upload</code></b>
</p>
<p>
<label id="auth-POSTapi-upload" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-upload" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>file</small>     <i>optional</i> &nbsp;
<input type="file" name="image" data-endpoint="POSTapi-upload" data-component="body"  hidden>
<br>
The image.</p>

</form><h1>User</h1>
<h2>Show</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Get logged in user.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://hairsalon.test/api/user" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://hairsalon.test/api/user',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "first_name": "Jon",
    "last_name": "Snow",
    "phone": "050123456",
    "role": "Client"
}</code></pre>
<div id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-user"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"></code></pre>
</div>
<div id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user"></code></pre>
</div>
<form id="form-GETapi-user" data-method="GET" data-path="api/user" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-user" onclick="tryItOut('GETapi-user');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-user" onclick="cancelTryOut('GETapi-user');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-user" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/user</code></b>
</p>
<p>
<label id="auth-GETapi-user" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-user" data-component="header"></label>
</p>
</form>
<h2>Update</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Update logged in user.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://hairsalon.test/api/user" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"first_name":"Jon","last_name":"Snow","phone":"0501234567","fcm_token":"YOUR_FCM_TOKEN","image":"'khgs87l28xnslw8dshewl3udhswl.jpg'"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://hairsalon.test/api/user"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "first_name": "Jon",
    "last_name": "Snow",
    "phone": "0501234567",
    "fcm_token": "YOUR_FCM_TOKEN",
    "image": "'khgs87l28xnslw8dshewl3udhswl.jpg'"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://hairsalon.test/api/user',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
            'Accept-Language' =&gt; 'ar',
        ],
        'json' =&gt; [
            'first_name' =&gt; 'Jon',
            'last_name' =&gt; 'Snow',
            'phone' =&gt; '0501234567',
            'fcm_token' =&gt; 'YOUR_FCM_TOKEN',
            'image' =&gt; '\'khgs87l28xnslw8dshewl3udhswl.jpg\'',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "id": 1,
    "first_name": "Jon",
    "last_name": "Snow",
    "phone": "050123456",
    "role": "Client"
}</code></pre>
<div id="execution-results-POSTapi-user" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-user"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-user"></code></pre>
</div>
<div id="execution-error-POSTapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-user"></code></pre>
</div>
<form id="form-POSTapi-user" data-method="POST" data-path="api/user" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json","Accept-Language":"ar"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-user', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-user" onclick="tryItOut('POSTapi-user');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-user" onclick="cancelTryOut('POSTapi-user');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-user" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/user</code></b>
</p>
<p>
<label id="auth-POSTapi-user" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-user" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-user" data-component="body"  hidden>
<br>
User fist name.</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-user" data-component="body"  hidden>
<br>
User last name.</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="phone" data-endpoint="POSTapi-user" data-component="body"  hidden>
<br>
User phone number.</p>
<p>
<b><code>fcm_token</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="fcm_token" data-endpoint="POSTapi-user" data-component="body"  hidden>
<br>
User FCM token.</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-user" data-component="body"  hidden>
<br>
Image path.</p>

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
        var languages = ["bash","javascript","php"];
        setupLanguages(languages);
    });
</script>
</body>
</html>