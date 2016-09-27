# iOS Gaming Intro

## IOSGAME-1: Ziggity Gag using SpriteKit

### ---- IOSGAME-1.1: Creating the Scene

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

### ---- IOSGAME-1.2: Adding Colors and a Person

Create a global node: `var person = SCNNode()`

Then, in `createScene()` we can add

```swift
// Create Person

let personGeo = SCNSphere(radius: 0.2)
person = SCNNode(geometry: personGeo)
let personMat = SCNMaterial()
personMat.diffuse.contents = UIColor.red
personGeo.materials = [personMat]
person.position = SCNVector3Make(0, 1.1, 0)
scene.rootNode.addChildNode(person)
```

For the actions, we can override the `touchesBegan()` function and apply some logic. Ensure that you create the appropriate global Booleans.

```swift
override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
    if goingLeft == false {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(-100, 0, 0), duration: 20)))
      goingLeft = true
    } else {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(0, 0, -100), duration: 20)))
      goingLeft = false
    }
  }
```

After adjusting the constaint of what we want the camera to look at etc. we can now start using the camera to look our "person". The code up to the end of this section looks as follows:

```swift
import UIKit
import QuartzCore
import SceneKit

class GameViewController: UIViewController {

  let scene = SCNScene()
  // where the camera is kept essentially
  let cameraNode = SCNNode()

  let firstBox = SCNNode()

  var person = SCNNode()

  var goingLeft = Bool()

  override func viewDidLoad() {
    self.createScene()
  }

  override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
    if goingLeft == false {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(-100, 0, 0), duration: 20)))
      goingLeft = true
    } else {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(0, 0, -100), duration: 20)))
      goingLeft = false
    }
  }

  func createScene() {

    self.view.backgroundColor = UIColor.white

    // adding objects onto this view that's on the storyboard
    let sceneView = self.view as! SCNView

    sceneView.scene = scene

    // Create Person

    let personGeo = SCNSphere(radius: 0.2)
    person = SCNNode(geometry: personGeo)
    let personMat = SCNMaterial()
    personMat.diffuse.contents = UIColor.red
    personGeo.materials = [personMat]
    person.position = SCNVector3Make(0, 1.1, 0)
    scene.rootNode.addChildNode(person)

    // Create Camera
    cameraNode.camera = SCNCamera()
    cameraNode.camera?.usesOrthographicProjection = true
    cameraNode.camera?.orthographicScale = 3
    cameraNode.position = SCNVector3Make(20, 20, 20)
    cameraNode.eulerAngles = SCNVector3Make(-45, 45, 0)
    let constraint = SCNLookAtConstraint(target: person)
    constraint.isGimbalLockEnabled = true
    self.cameraNode.constraints = [constraint]
    scene.rootNode.addChildNode(cameraNode)
    person.addChildNode(cameraNode)

    // Create Box
    // This will be the first box that is created
    // and every box create later will be due to this box
    // chamferRadius is for the edge pointiness
    let firstBoxGeo = SCNBox(width: 1, height: 1.5, length: 1, chamferRadius: 0)
    firstBox.geometry = firstBoxGeo
    let boxMaterial = SCNMaterial()
    boxMaterial.diffuse.contents = UIColor(red: 0.2, green: 0.8, blue: 0.9, alpha: 1.0)
    firstBoxGeo.materials = [boxMaterial]
    firstBox.position = SCNVector3Make(0, 0, 0)
    scene.rootNode.addChildNode(firstBox)

    // Create Light
    // this will be used so that we can see our box

    let light = SCNNode()
    light.light = SCNLight()
    light.light?.type = SCNLight.LightType.directional
    light.eulerAngles = SCNVector3Make(-45, 45, 0)
    scene.rootNode.addChildNode(light)

    let light2 = SCNNode()
    light2.light = SCNLight()
    light2.light?.type = SCNLight.LightType.directional
    light2.eulerAngles = SCNVector3Make(45, 45, 0)
    scene.rootNode.addChildNode(light2)
  }
}
```

### ---- IOSGAME-1.3: Creating a Path

Creating the function createBox(), we can use a new SCNNode dynamically generated along with a switch on `arc4random` in order to create new boxes.

```
func createBox() {
    tempBox = SCNNode(geometry: firstBox.geometry)
    let prevBox = scene.rootNode.childNode(withName: "\(boxNumber)", recursively: true)

    boxNumber += 1
    tempBox.name = "\(boxNumber)"

    let randomNumber = arc4random() % 2

    switch randomNumber {
      case 0:
        tempBox.position = SCNVector3Make((prevBox?.position.x)! - firstBox.scale.x, (prevBox?.position.y)!, (prevBox?.position.z)!)
        break
      case 1:
        tempBox.position = SCNVector3Make((prevBox?.position.x)!, (prevBox?.position.y)!, (prevBox?.position.z)! - firstBox.scale.z)
        break
      default:
        break
    }

    self.scene.rootNode.addChildNode(tempBox)
  }
```

By the end of this stage, you will end up having a path to follow that has 6 boxes ahead for you to see, but it will not decide whether or not you are on the box.

```swift
import UIKit
import QuartzCore
import SceneKit

class GameViewController: UIViewController, SCNSceneRendererDelegate {

  let scene = SCNScene()
  // where the camera is kept essentially
  let cameraNode = SCNNode()

  let firstBox = SCNNode()

  var person = SCNNode()

  var goingLeft = Bool()

  var tempBox = SCNNode()

  var prevBoxNumber = Int()
  var boxNumber = Int()

  override func viewDidLoad() {
    self.createScene()
  }

  // used to ensure ball is on the path
  func renderer(_ renderer: SCNSceneRenderer, updateAtTime time: TimeInterval) {
    let deleteBox = self.scene.rootNode.childNode(withName: "\(prevBoxNumber)", recursively: true)

    if (deleteBox?.position.x)! > person.position.x + 1 || (deleteBox?.position.z)! > person.position.z + 1 {
      prevBoxNumber+=1

      deleteBox?.removeFromParentNode()

      createBox()
    }
  }

  func createBox() {
    tempBox = SCNNode(geometry: firstBox.geometry)
    let prevBox = scene.rootNode.childNode(withName: "\(boxNumber)", recursively: true)

    boxNumber += 1
    tempBox.name = "\(boxNumber)"

    let randomNumber = arc4random() % 2

    switch randomNumber {
      case 0:
        tempBox.position = SCNVector3Make((prevBox?.position.x)! - firstBox.scale.x, (prevBox?.position.y)!, (prevBox?.position.z)!)
        break
      case 1:
        tempBox.position = SCNVector3Make((prevBox?.position.x)!, (prevBox?.position.y)!, (prevBox?.position.z)! - firstBox.scale.z)
        break
      default:
        break
    }

    self.scene.rootNode.addChildNode(tempBox)
  }

  override func touchesBegan(_ touches: Set<UITouch>, with event: UIEvent?) {
    if goingLeft == false {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(-100, 0, 0), duration: 20)))
      goingLeft = true
    } else {
      person.removeAllActions()
      person.runAction(SCNAction.repeatForever(SCNAction.move(by: SCNVector3Make(0, 0, -100), duration: 20)))
      goingLeft = false
    }
  }

  func createScene() {

    prevBoxNumber = 0
    boxNumber = 0

    self.view.backgroundColor = UIColor.white

    // adding objects onto this view that's on the storyboard
    let sceneView = self.view as! SCNView
    sceneView.delegate = self
    sceneView.scene = scene

    // Create Person
    let personGeo = SCNSphere(radius: 0.2)
    person = SCNNode(geometry: personGeo)
    let personMat = SCNMaterial()
    personMat.diffuse.contents = UIColor.red
    personGeo.materials = [personMat]
    person.position = SCNVector3Make(0, 1.1, 0)
    scene.rootNode.addChildNode(person)

    // Create Camera
    cameraNode.camera = SCNCamera()
    cameraNode.camera?.usesOrthographicProjection = true
    cameraNode.camera?.orthographicScale = 3
    cameraNode.position = SCNVector3Make(20, 20, 20)
    cameraNode.eulerAngles = SCNVector3Make(-45, 45, 0)
    let constraint = SCNLookAtConstraint(target: person)
    constraint.isGimbalLockEnabled = true
    self.cameraNode.constraints = [constraint]
    scene.rootNode.addChildNode(cameraNode)
    person.addChildNode(cameraNode)

    // Create Box
    // This will be the first box that is created
    // and every box create later will be due to this box
    // chamferRadius is for the edge pointiness
    let firstBoxGeo = SCNBox(width: 1, height: 1.5, length: 1, chamferRadius: 0)
    firstBox.geometry = firstBoxGeo
    let boxMaterial = SCNMaterial()
    boxMaterial.diffuse.contents = UIColor(red: 0.2, green: 0.8, blue: 0.9, alpha: 1.0)
    firstBoxGeo.materials = [boxMaterial]
    firstBox.position = SCNVector3Make(0, 0, 0)
    scene.rootNode.addChildNode(firstBox)
    firstBox.name = "\(boxNumber)"

    for i in 0...6 {
      createBox()
    }

    // Create Light
    // this will be used so that we can see our box

    let light = SCNNode()
    light.light = SCNLight()
    light.light?.type = SCNLight.LightType.directional
    light.eulerAngles = SCNVector3Make(-45, 45, 0)
    scene.rootNode.addChildNode(light)

    let light2 = SCNNode()
    light2.light = SCNLight()
    light2.light?.type = SCNLight.LightType.directional
    light2.eulerAngles = SCNVector3Make(45, 45, 0)
    scene.rootNode.addChildNode(light2)
  }
}
```

### ---- IOSGAME-1.4: Keeping a person on the path
