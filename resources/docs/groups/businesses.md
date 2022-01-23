# Businesses


## Update

<small class="badge badge-darkred">requires authentication</small>

Update business by ID.

> Example request:

```bash
curl -X POST \
    "http://hairsalon.test/api/business/1/update" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar" \
    -d '{"name":"myname","intro":"my intro","about":"my about","address":"haifa","working_days":"all days","logo":"8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg","cover":"8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg","facebook":"https:\/\/facebook.com\/username","whatsapp":"https:\/\/whatsapp.com\/username","instagram":"https:\/\/instagram.com\/username","website":"https:\/\/website.com\/username"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://hairsalon.test/api/business/1/update',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Language' => 'ar',
        ],
        'json' => [
            'name' => 'myname',
            'intro' => 'my intro',
            'about' => 'my about',
            'address' => 'haifa',
            'working_days' => 'all days',
            'logo' => '8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg',
            'cover' => '8JOtGx4oaOXvW3GeDEQcBhaXtR4sUv2cVeHtvCiJ.jpg',
            'facebook' => 'https://facebook.com/username',
            'whatsapp' => 'https://whatsapp.com/username',
            'instagram' => 'https://instagram.com/username',
            'website' => 'https://website.com/username',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
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
}
```
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


## Get


Get business by ID.

> Example request:

```bash
curl -X GET \
    -G "http://hairsalon.test/api/business/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Accept-Language: ar"
```

```javascript
const url = new URL(
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
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://hairsalon.test/api/business/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Accept-Language' => 'ar',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
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
}
```
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
</form>



