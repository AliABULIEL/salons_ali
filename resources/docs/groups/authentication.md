# Authentication


## Register


Register and send verification code to user phone number. use 12345 to test

> Example request:

```bash
curl -X POST \
    "http://hairsalon.test/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1,"first_name":"Jon","last_name":"Snow","phone":"0501234567"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://hairsalon.test/api/register',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Language' => 'ar',
        ],
        'json' => [
            'business_id' => 1,
            'first_name' => 'Jon',
            'last_name' => 'Snow',
            'phone' => '0501234567',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json

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
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "phone": [
            "The phone has already been taken."
        ]
    }
}
```
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


## Login


Send verification code to user phone.

> Example request:

```bash
curl -X POST \
    "http://hairsalon.test/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"business_id":1,"phone":"0501234567"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://hairsalon.test/api/login',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Language' => 'ar',
        ],
        'json' => [
            'business_id' => 1,
            'phone' => '0501234567',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json

{
    "message": "Verification code sent.",
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "phone": [
            "The phone has already been taken."
        ]
    }
}
```
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


## Verify code


Verify the verification code and return token.

> Example request:

```bash
curl -X POST \
    "http://hairsalon.test/api/verify" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"phone":"0501234567","code":"123456"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://hairsalon.test/api/verify',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Language' => 'ar',
        ],
        'json' => [
            'phone' => '0501234567',
            'code' => '123456',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "message": "Code verified",
    "api_token": "yQi6wk53fWRxSpsRQn5k7E8Bp3gRspVlmEfOfeqVBaD9o0FIWdYFsATRo1Fb"
}
```
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

</form>



