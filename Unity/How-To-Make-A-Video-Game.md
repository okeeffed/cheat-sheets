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

## Programming Games

### Programming with C# with Unity

JavaScript is also able to be used, but far less adopted by the Unity commmunity.

After creating a file, you will run into the `Start` and `Update` methods that are able to run at each frame so that we can edit the code to do specific things.

```c#
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerMovement : MonoBehaviour {
	private Animator playerAnimator;
	private float moveHorizontal;
	private float moveVertical;
	private Vector3 movement;

	// Use this for initialization
	void Start () {

	}

	// Update is called once per frame
	void Update () {

	}
}
```

Public and private are differing `accessibility levels`. The second keyword in a declaration is the `type`.

### Gather Player Input

We need to record which button they are pressing in each frame.

```c#
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerMovement : MonoBehaviour {
	private Animator playerAnimator;
	private float moveHorizontal;
	private float moveVertical;
	private Vector3 movement;

	// Use this for initialization
	void Start () {

	}

	// Update is called once per frame
	void Update () {
		moveHorizontal = Input.GetAxisRaw("Horizontal");
		moveVertical = Input.GetAxisRaw("Vertical");

		movement = new Vector3(moveHorizontal, 0.0f, moveVertical);
	}
}
```

### Moving a player with animation

After adding the script to update the script, we need to animate the frog.

The animator components with now be on the inspector for the player.

We will use the playerAnimator to access to Animator component.


```c#
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerMovement : MonoBehaviour {
	private Animator playerAnimator;
	private float moveHorizontal;
	private float moveVertical;
	private Vector3 movement;

	// Use this for initialization
	void Start () {
		// special method to get the "Animator" component
		playerAnimator = GetComponent<Animator>();
	}

	// Update is called once per frame
	void Update () {
		moveHorizontal = Input.GetAxisRaw("Horizontal");
		moveVertical = Input.GetAxisRaw("Vertical");

		movement = new Vector3(moveHorizontal, 0.0f, moveVertical);
	}

	// this is code that runs after the `update` method
	// this method doesn't run that often without
	// significant gameplay slow down
	void FixedUpdate() {
		if (movement != Vector3.zero) {
			playerAnimator.SetFloat("Speed", 3f);
		} else {
			playerAnimator.SetFloat("Speed", 0);
		}
	}
}
```

So far we haven't told the frog how to change direction or to have the camera follow the movement.

### Quaternions

Behind the scenes, Unity stores the rotational values as `Quaternions`. Most games ending will use these to solve rotational issues.

#### Target rotation

The rigid body and box collider is how the objects like `Player` can interact with the physics and turning.

```c#
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerMovement : MonoBehaviour {
	private Animator playerAnimator;
	private float moveHorizontal;
	private float moveVertical;
	private Vector3 movement;
	private float turningSpeed = 20f;
	private Rigidbody playerRigidBody;

	// Use this for initialization
	void Start () {
		// Gather components from the player object
		// special method to get the "Animator" component
		playerAnimator = GetComponent<Animator> ();
		playerRigidBody = GetComponent<Rigidbody> ();
	}

	// Update is called once per frame
	void Update () {
		moveHorizontal = Input.GetAxisRaw ("Horizontal");
		moveVertical = Input.GetAxisRaw ("Vertical");

		movement = new Vector3(moveHorizontal, 0.0f, moveVertical);
	}

	// this is code that runs after the `update` method
	// this method doesn't run that often without
	// significant gameplay slow down
	void FixedUpdate() {
		if (movement != Vector3.zero) {
			playerAnimator.SetFloat ("Speed", 3f);
		} else {
			playerAnimator.SetFloat ("Speed", 0);
		}
	}
}
```

We need to perform a `Lerp` to change the variable from one to another over time.

Unity also doesn't save any change settings when you are playing the game.

### Making a follow camera

This will have the camera to always follow the parent.

We can use `[SerializeField]` to expose fields from the code into the inspector.

```c#
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FollowCamera : MonoBehaviour {

	[SerializeField]
	private Transform player;
	[SerializeField]
	private Vector3 offset;
	private float cameraFollowSpeed = 5f;

	// Update is called once per frame
	void Update () {
		Vector3 newPosition = player.position + offset;

		// Smooth transition
		transform.position = Vector3.Lerp(transform.position, newPosition, cameraFollowSpeed + Time.deltaTime);
	}
}
```

## Section 3

### Adding the flies to the swamp


