# How to make a video game

How are games made?

- Game designers
- Game artists
- Game developers

These roles can be between one or thousands of people.

Game artists deal with what you see and hear in the game.

### What is a game engine?

Game engines help deal with things like the physics and rendering graphics.

A game engine is a framework for building games that helps coordinate things like assets and gives you all the tools you need to start coding.

A game engine is not a 3D art engine.

We are Unity as it is easier to learn when you are just getting started.

## Part 2

### Unity Interface

Create a `_Scenes` folder.

Game assets are `a piece of media for the game`. This could be sounds, scripts or models etc.

#### Prefabs

Stores several objects together. An example `prefab` is the frog which contains the 3d model, the texture and the animation together.

### Setup the project

Games use `real time rendering` where it is drawn at the frame rate. Generally you want to aim for 60fps or higher. This will make is look as smooth as possible.

We can go to `Window > Lighting > Settings` to adjust things about how the scene is lit.

To adjust the player settings go to `Edit > Project Settings > Player`.

For quality, go to `Edit > Project Settings > Quality`.

### Navigating the Scene View

The `environment` prefab links a bunch of Maya elements and groups them as a prefab.

Our environment prefab already has a light associated with it. Ensure after adding that you re-generate the light in the settings.

Anything with a green square is outlining a game object.

After selecting an object, you can use the 3d axis to change the transform of the axis.

On the top left, we can change the tools from position to rotation etc and with similar methods to before, we can rotate the axis.

We can also just use the `qwer` keys to change between tools.

We can also switch between `global` and `local` space to help move things around.

### Position the camera

The scenes looks good so far, but it we need to update the camera.

At the top of the scene window, we have `scene`, `game` tabs. If we select `game`, we get to see how the game will look when we play it. We can either write code to control to camera or change the transform.

### Image effects and asset stores

An image effect can change things like colours etc.

Once we click on the asset store, we can build or share models to use.

Unity is component based so we can add things that way. We can now create a post processing profile to use.
