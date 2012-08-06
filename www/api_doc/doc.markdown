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

![Sequence diagramm](http://www.websequencediagrams.com/cgi-bin/cdraw?lz=dGl0bGUgQXV0aG9yaXphdGlvbiBmbG93Cgpub3RlIG92ZXIgQXBwLEFQSSxGYjogV2FpdCBmb3IgdXNlci1hYwAsBXRoYXQgbmVlZCBsb2dpbgpBcHAtPkZiOiBBY3F1aXJlIGFjY2VzcyB0b2tlbgpGYi0-QXBwOiBBAAsLIChBVCkAMwZBUEk6IFBPU1QgL2F1dGgvAE8FIHdpdGggQVQKQVBJADgHSFRUUCAyMDA7IEpTT04gZGF0YSBvZiBVc2VyAIEMMXNob3VsZCBiZSBzZW50IHRvIHNlcnZlcgCBBwtBUEkgY2FsbABkJgA5SSAoAIF1BXVudmFsaWQgAIIYDgB0IDMwNCBVbmEAg1cGZWQAgwcSQVQgYWdhaQCDCQxUAII8SgCDRQpTYW1lAIIzD25ldwCDLyE&s=omegapple)

## Addtional URI scheme (app://) ##
To send links we are using additional app URI scheme. Exmples of URIs:

    app://users/:id
    app://days/:id
    app://moments/:id


All elements can be accessed via URI fragment with ID, for example

    app://days/:id#:comment_id

should open day with `id=:id` and scroll page to comment with `id=:comment_id`. Same can be applyed to moments and other elements.

## Range-requests ##
All range requests have same simple rules, that can be described by math inequality: `from < [selected range] < to`.
Additionally you can omit one of params or even both of them, to select all items that is newer than present in application: `from < [selected range]`,
older: `[selected range] < to`. Ommiting both params will return all items in selected limit (maximum of 100), order depens on concrete method and usually the newest items will be returned.

## Known bugs ##
### API documentation bugs ###
* In-URI params are shown as <span class='label label-important'>Removed</span>
* Array-type responses are shown as <span class='label label-important'>Removed</span> and appear in params list by array keys

### API bugs ###
* API methods are not fully implemented
* No security checks on input data
