# How to make a video game

<!-- TOC -->

*   [How to make a video game](#how-to-make-a-video-game) - [What is a game engine?](#what-is-a-game-engine)
    *   [Part 2](#part-2)
        *   [Unity Interface](#unity-interface)
            *   [Prefabs](#prefabs)
        *   [Setup the project](#setup-the-project)
        *   [Navigating the Scene View](#navigating-the-scene-view)
        *   [Position the camera](#position-the-camera)
        *   [Image effects and asset stores](#image-effects-and-asset-stores)
    *   [Programming Games](#programming-games)
        *   [Programming with C# with Unity](#programming-with-c-with-unity)
        *   [Gather Player Input](#gather-player-input)
        *   [Moving a player with animation](#moving-a-player-with-animation)
        *   [Quaternions](#quaternions)
            *   [Target rotation](#target-rotation)
        *   [Making a follow camera](#making-a-follow-camera)
    *   [Section 3](#section-3)
        *   [Adding the flies to the swamp](#adding-the-flies-to-the-swamp)
        *   [Adding the Fly Pickup](#adding-the-fly-pickup)
            *   [Pickup Particles](#pickup-particles)
        *   [Creating the enemy in the game](#creating-the-enemy-in-the-game)
        *   [Monitor Player Health](#monitor-player-health)
        *   [Managing the game state](#managing-the-game-state)
    *   [Adding Audio](#adding-audio)
        *   [Game audio](#game-audio)
        *   [Controlling sounds on game objects](#controlling-sounds-on-game-objects)
        *   [Audio mixing](#audio-mixing)
        *   [Exporting the game](#exporting-the-game)

<!-- /TOC -->

How are games made?

*   Game designers
*   Game artists
*   Game developers

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

```csharp
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

```csharp
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

```csharp
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

```csharp
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

```csharp
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

Let's add an objective to the game (pickup).

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FlyMovement : MonoBehaviour {
	[SerializeField]
	private Transform center;
	private float flySpeed;

	// Use this for initialization
	void Start () {
		flySpeed = Random.Range (300f, 700f);
	}

	// Update is called once per frame
	void Update () {
		transform.RotateAround (center.position, Vector3.up, flySpeed * Time.deltaTime);
	}
}
```

### Adding the Fly Pickup

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FlyPickup : MonoBehaviour {
	// Trigger
	void OnTriggerEnter(Collider other) {
		// if collider is the player, execute...
		if (other.CompareTag ("Player")) {
			Destroy (gameObject);
		}
	}
}
```

#### Pickup Particles

Particle systems are a game object which generates multiple systems.

As for their destruction:

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PickupParticlesDestruction : MonoBehaviour {

	// Use this for initialization
	void Start () {
		Destroy (gameObject, 5f);
	}
}
```

You can also create scripts that aren't attached to a 3d model in the scene view.

You can create an empty object from the left hand sidebar. Reset the transform and rename.

```csharp
// Fly Spawner
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FlyPickup : MonoBehaviour {
	[SerializeField]
	private GameObject pickupPrefab;

	// Trigger
	void OnTriggerEnter(Collider other) {
		// if collider is the player, execute...
		if (other.CompareTag ("Player")) {
			// add pickup particles
			// Quaternion.identity returns no rotation
			Instantiate (pickupPrefab, transform.position, Quaternion.identity);
			// Decrement total flies
			FlySpawner.totalFlies--;
			Destroy (gameObject);
		}
	}
}
```

```csharp
// Fly Pickup
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class FlyPickup : MonoBehaviour {
	[SerializeField]
	private GameObject pickupPrefab;

	// Trigger
	void OnTriggerEnter(Collider other) {
		// if collider is the player, execute...
		if (other.CompareTag ("Player")) {
			// add pickup particles
			// Quaternion.identity returns no rotation
			Instantiate (pickupPrefab, transform.position, Quaternion.identity);
			// Decrement total flies
			FlySpawner.totalFlies--;
			Destroy (gameObject);
		}
	}
}
```

### Creating the enemy in the game

The bird game object needs to know where the player is. It's known as path finding.

Unity makes path finding very easy.

With the `Nav Mesh Agent`, you can set the following for the bird:

```
Speed: 5
Angular Speed: 720
Stopping Distance: 5
Radius: 1
Height: 4
```

We now need to create a `Nav Mesh`. The `NavMeshAgent` allows us to set a destination target that the "enemy" can follow. It is a component that can be attached to a game object so that it can interact with the `NavMesh`.

```csharp
// BirdMovement.cs
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BirdMovement : MonoBehaviour {

	[SerializeField]
	private Transform target;
	private UnityEngine.AI.NavMeshAgent birdAgent;
	private Animator birdAnimator;

	// Use this for initialization
	void Start () {
		birdAgent = GetComponent<UnityEngine.AI.NavMeshAgent> ();
		birdAnimator = GetComponent<Animator> ();
	}

	// Update is called once per frame
	void Update () {
		// Set the bird's destination
		birdAgent.SetDestination (target.position);

		// Measure the magnitude of the NavMeshAgent's velocity
		float speed = birdAgent.velocity.magnitude;

		// Pass the velocity to the animator component
		birdAnimator.SetFloat("Speed", speed);
	}
}
```

### Monitor Player Health

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerHealth : MonoBehaviour {
	public bool alive;
	[SerializeField]
	private GameObject pickupPrefab;
	// Use this for initialization
	void Start () {
		alive = true;
	}

	void OnTriggerEnter(Collider other) {
		if (other.CompareTag ("Enemy") && alive == true) {
			alive = false;

			// Create the pickup particles
			Instantiate(pickupPrefab, transform.position, Quaternion.identity);
		}
	}
}
```

### Managing the game state

How do we know when the game has started and when we need to restart?

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class GameState : MonoBehaviour {
	private bool gameStarted = false;
	[SerializeField]
	private Text gameStateText;
	[SerializeField]
	private GameObject player;
	[SerializeField]
	private BirdMovement birdMovement;
	[SerializeField]
	private FollowCamera followCamera;
	private float restartDelay = 3f;
	private float restartTimer;
	private PlayerMovement playerMovement;
	private PlayerHealth playerHealth;

	// Use this for initialization
	void Start () {
		Cursor.visible = false;

		playerMovement = player.GetComponent<PlayerMovement> ();
		playerHealth = player.GetComponent<PlayerHealth> ();

		// do not allow player to move before the game
		playerMovement.enabled = false;
		// prevent bird
		birdMovement.enabled = false;
		// prevent follow camear
		followCamera.enabled = false;
	}

	// Update is called once per frame
	void Update () {
		// If the game is not sarted and the player presses the space bar...
		if (gameStarted == false && Input.GetKeyUp(KeyCode.Space)) {
			// ... start the game
			StartGame();
		}

		// If player is no longer alive ...
		if (playerHealth.alive == false) {
			// ...end the game
			EndGame();

			// ... increment timer to count up to restarting...
			restartTimer = restartTimer + Time.deltaTime;

			// ...and if it reaches the restart delay...
			if (restartTimer >= restartDelay) {
				// reload scene
				SceneManager.LoadScene(SceneManager.GetActiveScene().buildIndex);
			}
		}
	}

	private void StartGame() {
		gameStarted = true;

		// set main text to see through
		gameStateText.color = Color.clear;

		// allow player to move
		playerMovement.enabled = true;
		birdMovement.enabled = true;
		followCamera.enabled = true;
	}

	private void EndGame() {
		gameStarted = false;

		gameStateText.text = "Game Over";
		// set main text to see through
		gameStateText.color = Color.white;

		// remove player from game
		player.SetActive (false);
	}
}
```

## Adding Audio

### Game audio

We can add the `Audio Source` component and select the sounds.

We can also randomly generate a sound to help add something natural.

```csharp
using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class RandomSoundPlayer : MonoBehaviour {
	private AudioSource audioSource;
	[SerializeField]
	private List<AudioClip> soundClips = new List<AudioClip>();
	[SerializeField]
	private float soundTimerDelay = 3f;
	private float soundTimer;

	// Use this for initialization
	void Start () {
		audioSource = GetComponent<AudioSource>();
	}

	// Update is called once per frame
	void Update () {
		// incredment a timer to count up to restarting
		soundTimer = soundTimer + Time.deltaTime;

		// if the timer reaches the delay...
		if (soundTimer >= soundTimerDelay) {
			soundTimer = 0f;
			// choose a random sound
			AudioClip randomSound = soundClips[Random.Range(0, soundClips.Count)];
			audioSource.PlayOneShot (randomSound);
		}
	}
}
```

### Controlling sounds on game objects

Add another empty game child and add the audio but select `play on awake` off.

To make sounds 3d, we need to change the spatial blend. We also need to make sure the game camera and distance are set correctly.

We need to update the scripts to ensure that these clips play at the appropriate time.

### Audio mixing

Use the audio mixer, create groups and assign these groups via the `AudioComponent` on the hierarchy or prefab.

### Exporting the game
