# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_AUTH_KEY}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Currently, the only way to procure the JWT Bearer is by providing user credentials in <a href="#authentication-endpoints-POSTlogin">login</a> endpoint.
<br />
To test in Postman, it is recommended to put the procured token in collection settings.
