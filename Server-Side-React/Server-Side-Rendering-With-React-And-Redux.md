# Server side Rendering with React and Redux

## How do tradition React apps work?

In relation to the index `html` file, we end up with a root div that React targets onto.

The webpage makes the request to the server, then we fetch the JS file, then app boots and we make some requests - all before any content is visible.

Using server side React, the goal is to make one request. The impact of this means that after the browser requests the page, the return info is the content being visible.

## Serverside - What happens

1. Receive the request
2. Load up React app in memory
3. Fetch any required data
4. Render app
5. Send back to the HTML

Back on the browser side, the React application still ensure it fetches the bundle for the client-side interactivity.

## Serverside Architecture

- Run two back end server. One for the API, the other for rendering.
