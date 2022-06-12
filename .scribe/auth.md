# Authenticating requests

Authenticate requests to this API's endpoints by sending an **`Authorization`** header with the value **`"Bearer {YOUR_AUTH_KEY}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Currently, the only way to procure the JWT Bearer is by providing user credentials in <a href="#authentication-endpoints-POSTlogin">login</a> endpoint.