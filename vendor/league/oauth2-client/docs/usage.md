---
layout: default
permalink: /usage/
title: "Basic Usage"
---

Basic Usage
===========

> ℹ️ **NOTE** In most cases, you should use a specific [official](/providers/league/) or [third-party](/providers/thirdparty/) provider client library, rather than this base library alone.

Authorization Code Grant
------------------------

The following example uses the out-of-the-box `GenericProvider` provided by this library. If you're looking for a specific provider client (e.g., Facebook, Google, GitHub, etc.), take a look at our [list of provider client libraries](/providers/league/). **HINT: You're probably looking for a specific provider client.**

The *authorization code* grant type is the most common grant type used when authenticating users with a third-party service. This grant type utilizes a *client* (this library), a *service provider* (the server), and a *resource owner* (the account with credentials to a protected—or owned—resource) to request access to resources owned by the user. This is often referred to as _3-legged OAuth_, since there are three parties involved.

<a name="authorization-code-grant-example"></a>
```php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
    'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://my.example.com/your-redirect-url/',
    'urlAuthorize'            => 'https://service.example.com/authorize',
    'urlAccessToken'          => 'https://service.example.com/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource'
]);

// A session is required to store some session data for later usage
session_start();

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {

    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session.
    $_SESSION['oauth2state'] = $provider->getState();

    // Optional, only required when PKCE is enabled.
    // Get the PKCE code generated for you and store it to the session.
    $_SESSION['oauth2pkceCode'] = $provider->getPkceCode();

    // Redirect the user to the authorization URL.
    header('Location: ' . $authorizationUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || empty($_SESSION['oauth2state']) || $_GET['state'] !== $_SESSION['oauth2state']) {

    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }

    exit('Invalid state');

} else {

    try {
    
        // Optional, only required when PKCE is enabled.
        // Restore the PKCE code stored in the session.
        $provider->setPkceCode($_SESSION['oauth2pkceCode']);

        // Try to get an access token using the authorization code grant.
        $tokens = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // We have an access token, which we may use in authenticated
        // requests against the service provider's API.
        echo 'Access Token: ' . $tokens->getToken() . "<br>";
        echo 'Refresh Token: ' . $tokens->getRefreshToken() . "<br>";
        echo 'Expired in: ' . $tokens->getExpires() . "<br>";
        echo 'Already expired? ' . ($tokens->hasExpired() ? 'expired' : 'not expired') . "<br>";

        // Using the access token, we may look up details about the
        // resource owner.
        $resourceOwner = $provider->getResourceOwner($accessToken);

        var_export($resourceOwner->toArray());

        // The provider provides a way to get an authenticated API request for
        // the service, using the access token; it returns an object conforming
        // to Psr\Http\Message\RequestInterface.
        $request = $provider->getAuthenticatedRequest(
            'GET',
            'https://service.example.com/resource',
            $accessToken
        );

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        // Failed to get the access token or user details.
        exit($e->getMessage());

    }

}
```
### Authorization Code Grant with PKCE

To enable PKCE (Proof Key for Code Exchange) you can set the `pkceMethod` option for the provider.  
Supported methods are:
- `S256` Recommended method. The code challenge will be hashed with sha256.
- `plain` **NOT** recommended. The code challenge will be sent as plain text. Only use this if no other option is possible.

You can configure the PKCE method as follows:
```php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    // ...
    // other options
    // ...
    'pkceMethod' => \League\OAuth2\Client\Provider\GenericProvider::PKCE_METHOD_S256
]);
```
The PKCE code needs to be used between requests and therefore be saved and restored, usually via the session.
In the [example](#authorization-code-grant-example) above this is done as follows:
```php
// Store the PKCE code after the `getAuthorizationUrl()` call.
$_SESSION['oauth2pkceCode'] = $provider->getPkceCode();
// ...
// Restore the PKCE code before the `getAccessToken()` call. 
$provider->setPkceCode($_SESSION['oauth2pkceCode']);
```

Refreshing a Token
------------------

Once authorizing your application, you may refresh an expired token using a refresh token rather than going through the entire process of obtaining a new token. To do so, use the refresh token from your data store to request a new access token.

```php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
    'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://my.example.com/your-redirect-url/',
    'urlAuthorize'            => 'https://service.example.com/authorize',
    'urlAccessToken'          => 'https://service.example.com/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource'
]);

$existingAccessToken = getAccessTokenFromYourDataStore();
$existingRefreshToken = getRefreshTokenFromYourDataStore();

if ($existingAccessToken->hasExpired()) {
    $tokens = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $existingRefreshToken
    ]);

    // Purge old tokens and store new ones to your data store.
    saveNewAccessTokenToYourDataStore($tokens->getToken());
    saveNewRefreshTokenToYourDataStore($tokens->getRefreshToken());
}
```

Resource Owner Password Credentials Grant
-----------------------------------------

Some service providers allow you to skip the authorization code step to exchange a user's credentials (username and password) for an access token. This is referred to as the *resource owner password credentials* grant type.

According to [section 1.3.3](http://tools.ietf.org/html/rfc6749#section-1.3.3) of the OAuth 2.0 standard (emphasis added):

> The credentials **should only be used when there is a high degree of trust** between the resource owner and the client (e.g., the client is part of the device operating system or a highly privileged application), and when other authorization grant types are not available (such as an authorization code).

> 🛑 **DANGER!** We advise against using this grant type if the service provider supports the authorization code grant type (see above), as this reinforces the [password anti-pattern](https://agentile.com/the-password-anti-pattern), allowing users to think it's okay to trust third-party applications with their usernames and passwords.

That said, there are use-cases where the resource owner password credentials grant is acceptable and useful.

```php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
    'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://my.example.com/your-redirect-url/',
    'urlAuthorize'            => 'https://service.example.com/authorize',
    'urlAccessToken'          => 'https://service.example.com/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource'
]);

try {

    // Try to get an access token using the resource owner password credentials grant.
    $accessToken = $provider->getAccessToken('password', [
        'username' => 'myuser',
        'password' => 'mysupersecretpassword'
    ]);

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    exit($e->getMessage());

}
```

Client Credentials Grant
------------------------

When your application acts on its own behalf to access resources it controls or owns in a service provider, it may use the *client credentials* grant type.

The client credentials grant type is best when storing the credentials for your application privately and never exposing them (e.g., through the web browser, etc.) to end-users. This grant type functions like the resource owner password credentials grant type, but it does not request a user's username or password. It uses only the client ID and client secret issued to your client by the service provider.

```php
// Note: the GenericProvider requires the `urlAuthorize` option, even though
// it's not used in the OAuth 2.0 client credentials grant type.

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
    'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://my.example.com/your-redirect-url/',
    'urlAuthorize'            => 'https://service.example.com/authorize',
    'urlAccessToken'          => 'https://service.example.com/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource'
]);

try {

    // Try to get an access token using the client credentials grant.
    $accessToken = $provider->getAccessToken('client_credentials');

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

    // Failed to get the access token
    exit($e->getMessage());

}
```

Using a Proxy
-------------

It is possible to use a proxy to debug HTTP calls made to a provider.

To use a proxy, set the `proxy` and `verify` options when creating your provider client instance. Make sure you enable SSL proxying in your proxy.

```php
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'XXXXXX',    // The client ID assigned to you by the provider
    'clientSecret'            => 'XXXXXX',    // The client password assigned to you by the provider
    'redirectUri'             => 'https://my.example.com/your-redirect-url/',
    'urlAuthorize'            => 'https://service.example.com/authorize',
    'urlAccessToken'          => 'https://service.example.com/token',
    'urlResourceOwnerDetails' => 'https://service.example.com/resource',
    'proxy'                   => '192.168.0.1:8888',
    'verify'                  => false
]);
```
