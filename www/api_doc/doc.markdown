# Core concepts #
## Response structure ##
    {
      'code'   => <http code>
      'status' => <http status>,
      'result' => <mixed>,
      'errors' => [ <string>, <string>, ... ]
    }

Code and Status fields are for outdated clients that cant understand HTTP error codes and messages.

If there are 'fake' field in response, than this API call should be ignored as not-implemented. Its common to get data from local config in this cases.

## Authorization flow ##
To regiser in our application you need to obtain Facebook <a href="https://developers.facebook.com/docs/authentication/server-side/">access token</a> (we prefer to use <a href="https://developers.facebook.com/roadmap/offline-access-removal/">Long-Time Access Token</a>). It used as main user credential in authorization and authentification flows.

Access token should be sent to /auth/login API call, that returns session id key (SESSID). All future request should be done with using of this key, you can send it in cookie or as HTTP request paramether.

Data flow diagramm:
![Sequence diagramm](http://www.websequencediagrams.com/cgi-bin/cdraw?lz=dGl0bGUgQXV0aG9yaXphdGlvbiBmbG93CgpBcHAtPkZiOiBBY3F1aXJlIGFjY2VzcyB0b2tlbiAoQVQpCkZiLT5BcHA6IEFUACUKRXhjaGFuZ2UgQVQgZm9yIExvbmctVGVybSBBVAAoCgAJDQBmBQBEBVNldAAkDSBhcwAXClBJOiAvYXV0aC9sb2dpbiArAHMFUEkANAhFU1NJRApub3RlIG92ZXIgQXBwLAAwBVdhaXQAgQcFdXNlci1hYwCBYQV0aGF0IHNob3VsZCBiZSBzZW50IHRvIHNlcnZlcgBnC0FQSSBjYWxsAF8LSFRUUCAyMDAgKyBKU09OIGRhdGE&s=omegapple)
