# iOS Gaming Intro

## IOSGAME-1: Ziggity Gag using SpriteKit

### IOSGAME-1.1: Creating the Scene

As a new Xcode Project, let's select Game, name, next and create!

When beginning, you will find a `GameViewController.swift` file. Starting from scratch, remove everything such that it looks like the following:

```swift
import UIKit
import SpriteKit
import GameplayKit

class GameViewController: UIViewController {


}
```

Then, we begin by creating the scene:

```swift
import UIKit
import QuartzCore
import SceneKit

class GameViewController: UIViewController {

  let scene = SCNScene()
  // where the camera is kept essentially
  let cameraNode = SCNNode()

  let firstBox = SCNNode()

  override func viewDidLoad() {
    self.createScene()
  }

  func createScene() {
    // adding objects onto this view that's on the storyboard
    let sceneView = self.view as! SCNView

    sceneView.scene = scene

    // Create Camera
    cameraNode.camera = SCNCamera()
    cameraNode.camera?.usesOrthographicProjection = true
    cameraNode.camera?.orthographicScale = 3
    cameraNode.position = SCNVector3Make(20, 20, 20)
    cameraNode.eulerAngles = SCNVector3Make(-45, 45, 0)
    let constraint = SCNLookAtConstraint(target: firstBox)
    constraint.isGimbalLockEnabled = true
    self.cameraNode.constraints = [constraint]
    scene.rootNode.addChildNode(cameraNode)

    // Create Box
    // This will be the first box that is created
    // and every box create later will be due to this box
    // chamferRadius is for the edge pointiness
    let firstBoxGeo = SCNBox(width: 1, height: 1.5, length: 1, chamferRadius: 0)
    firstBox.geometry = firstBoxGeo
    firstBox.position = SCNVector3Make(0, 0, 0)
    scene.rootNode.addChildNode(firstBox)

    // createLight
    // this will be used so that we can see our box

    let light = SCNNode()
    light.light = SCNLight()
    light.light?.type = SCNLight.LightType.directional
    light.eulerAngles = SCNVector3Make(-45, 45, 0)
    scene.rootNode.addChildNode(light)
  }

}
```

To explore how the camera works, feel free to head to `art.scnassets > ship.scn` and throw in a camera to see how it works.

From this, you can head to position after adding a camera and chang the `Position` and `Euler` to see the changes that this makes. `Euler` essentially rotates it clockwise around the axis.

After changing this, you can select `camera` from the bottom just to see how it looks.

### IOSGAME-1.2: Adding Colors and a Person
