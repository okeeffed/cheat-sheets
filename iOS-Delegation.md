# Delegation in iOS

<!-- TOC -->

*   [Delegation in iOS](#delegation-in-ios)
    *   [IOSD-1: Intro to Design Patterns](#iosd-1-intro-to-design-patterns)
    *   [IOSD-2: Learning by example - Racing Horses](#iosd-2-learning-by-example---racing-horses)
    *   [IOSD-3: Acting as a Delegate](#iosd-3-acting-as-a-delegate)
    *   [IOSD-4: Examples - CLLocation Manager](#iosd-4-examples---cllocation-manager)
    *   [IOSD-5: Examples - UITextFieldDelegate](#iosd-5-examples---uitextfielddelegate)

<!-- /TOC -->

## IOSD-1: Intro to Design Patterns

Three common issues developers have come across:

1.  Avoiding inflexible objects
2.  Maintaining loose relationships
3.  Avoid tight coupling

We use Design Pattern as a general, reusable solution to a commonly occurring problem within a given context, regardless of the particular domain.

An example - `The Delegate Pattern`

_The Delegate Pattern_

The delegate pattern is an alteration on the decorator pattern, a structural pattern that is focused on how we can compose objects to form larger objects.

It is concerned with adding responsibilities to objects dynamically.

## IOSD-2: Learning by example - Racing Horses

_The Horse Class and Race Class_

```swift
import Foundation
import PlaygroundSupport

PlaygroundPage.current.needsIndefiniteExecution = true

class Horse {
    let name: String
    let maxSpeed: Double
    var distanceTraveled = 0.0
    var currentLap = 1

    init(name: String, maxSpeed: Double) {
        self.maxSpeed = maxSpeed
        self.name = name
    }

    var currentSpeed: Double {
        let random = Double(arc4random())
        return random.truncatingRemainder(dividingBy: maxSpeed - 13) + 13
    }
}

class Race {
    let laps: Int
    let lapLength: Double = 300
    let participants: [Horse]

    weak var delegate: HorseRaceDelegate?

    // since we want to use a delegate, we do not create instances
    // let tracker = Tracker()
    // let broadcaster = RaceBroadcaster()

    lazy var timer: Timer = Timer(timeInterval: 1, repeats: true) { timer in
        self.updateProgress()
    }

    init(laps: Int, participants: [Horse]) {
        self.laps = laps
        self.participants = participants
    }

    func start() {
        RunLoop.main.add(timer, forMode: .defaultRunLoopMode)
        // tracker.updateRaceStart(with: Date())
        delegate?.race(self, didStartAt: Date())
        print("Race in progress...")
    }

    func updateProgress() {
        print("....")
        for horse in participants {
            horse.distanceTraveled += horse.currentSpeed

            if horse.distanceTraveled >= lapLength {
                horse.distanceTraveled = 0

                delegate?.addLapLeader(horse, forLap: horse.currentLap, atTime: Date())

                // let lapKey = "\(Tracker.Keys.lapLeader) \(horse.currentLap)"
                // if !tracker.stats.keys.contains(lapKey) {
                //     tracker.updateLapLeaderWith(lapNumber: horse.currentLap, horse: horse, time: Date())
                // }

                horse.currentLap += 1

                if horse.currentLap >= laps + 1 {
                    // tracker.updateRaceEndWith(winner: horse, time: Date())
                    delegate?.raceDidEndAt(self, didEndAt: Date(), withWinner: horse)
                    stop()
                    break
                }
            }
        }
    }

    func stop() {
        print("Race complete!")
        // timer.invalidate()
        // tracker.printRaceSummary()
    }
}

let jubilee = Horse(name: "Jubilee", maxSpeed: 16)
let sonora = Horse(name: "Sonora", maxSpeed: 17)
let jasper = Horse(name: "Jasper", maxSpeed: 17)

let participants = [jubilee, sonora, jasper]

let race = Race(laps: 1, participants: participants)
race.start()
```

---

_The Tracker Class_

```swift
class Tracker: HorseRaceDelegate {

    struct Keys {
        static let raceStartTime = "raceStartTime"
        static let lapLeader = "leaderForLap"
        static let raceEndTime = "raceEndTime"
        static let winner = "winner"
    }

    var stats = [String: Any]()

    // func updateRaceStart(with time: Date) {
    //     stats.updateValue(time, forKey: Keys.raceStartTime)
    // }

    func race(_ race: Race, didStartAt time: Date) {
    	stats.updateValue(time, forKey: Keys.raceStartTime)
    }

	func addLapLeader(_ horse: Horse, forLap lap: Int, atTime time: Date) {
		let lapLead = "Horse: \(horse.name), time: \(time)"
        let lapLeadKey = "\(Keys.lapLeader) \(number)"

        stats.updateValue(lapLead, forKey: lapLeadKey)
	}

	func race(_ race: Race, didEndAt time: Date, withWinner winner: Horse) {
		stats.updateValue(winner.name, forKey: Keys.winner)
        stats.updateValue(time, forKey: Keys.raceEndTime)
	}

    // get rid of the below method
    func updateLapLeaderWith(lapNumber number: Int, horse: Horse, time: Date) {
        let lapLead = "Horse: \(horse.name), time: \(time)"
        let lapLeadKey = "\(Keys.lapLeader) \(number)"

        stats.updateValue(lapLead, forKey: lapLeadKey)
    }

    // get rid of the below method
    func updateRaceEndWith(winner: Horse, time: Date) {
        stats.updateValue(winner.name, forKey: Keys.winner)
        stats.updateValue(time, forKey: Keys.raceEndTime)
    }

    func printRaceSummary() {
        print("***********")

        let raceStartTime = stats[Keys.raceStartTime]!
        print("Race start time: \(raceStartTime)")

        for (key, value) in stats where key.contains(Keys.lapLeader) {
            print("\(key): \(value)")
        }

        let raceEndTime = stats[Keys.raceEndTime]!
        print("Race end time: \(raceEndTime)")

        let winner = stats[Keys.winner]!
        print("Winner: \(winner)")

        print("***********")
    }
}
```

In this example, we use the Tracker methods and Keys to help monitor the results of the race.

Now so far so good, but what if we want a live broadcast?

However, trackers should do more than one job.

This new class will care about the same info as Tracker, but Tracker objects are tied to a particular race. This becomes a problem since the Race also "knows" about the Tracker and Broadcast class. This coupling is too tight.

```
class RaceBroadcaster {
	// methods to try to help broadcast information on the Race object
}
```

The Race class shouldn't care about implementing the methods from the Tracker and Broadcast class. Those classes should just listen to the information that Race gives out.

How do we do this? By implementing a delegate.

We will make a "contract" that uses a protocol.

This will implement the rules that anything that wants to interact with the Race class must adhere to.

_HorseRaceDelegate Protocol_

```swift
protocol HorseRaceDelegate: class {
	// this will require any adhering class to use the didStartAt method
	func race(_ race: Race, didStartAt time: Date)
	func addLapLeader(_ horse: Horse, forLap lap: Int, atTime time: Date)
	func race(_ race: Race, didEndAt time: Date, withWinner winner: Horse)
}
```

This protocol will now govern the events that we care about. We can create a delegate instance, but since the race doesn't "need" to have to have a tracker, we will make it optional and also give it the "weak" var to prevent a reference cycle.

Since only classes can be at the end of a weak relationship, we are violating the rule, so we can make the delegate class bound.

The delegate will be used by the Race class to delegate tasks out. We don't care which object is acting as the delegate, we just know that someone might be.

Now in the methods, we can use the delegate. The class won't care about who is listening for the delegate.

Once we have a class that implements a delegate, how do we then have a another class act as a delegate?

That means that for the class (eg Tracker), it needs to conform to the delegate.

Now that we've conformed to the protocol, we can assign an instance of Tracker to that delegate property to listen in!

```swift
let tracker = Tracker();
race.delegate = tracker;
```

This now works, because within the Race class, we're already tracking the relevant information and passing them along to the delegate.

Rather than worry about the events itself, the class can delegate can pass out the information to the qualified objects.

## IOSD-3: Acting as a Delegate

So why do we need to decouple in the first place?

It will become far more manageable once you start creating Objects that focus on just one job.

Analogy:

You are the CEO of an important company and have many tasks to do, but many of them involve other side tasks that are important.

Instead of doing it all yourself, you delegate it out to an assistant.

Beforehand, you need to define what they do. Think of the requirements as the protocol.

If they have all these abilities, they conform to the protocol.

Now you hire and give the tasks to the employee - they are now your delegate.

However, if they quit - that's cool. You can look for another delegate that conforms.

Typically, you need the delegates to be weak. The reason is that it's total valid to have a circular relationship.

Example, if you have a class `RaceManager` that conforms, they can also have race of type Race as a property, we've created a strong relationship by default.

Since the Manager also conforms to the HorseRaceDelegate, you can have one that references the other. If they had a strong cycle, we couldn't get rid of the objects and it would cause a memory leak.

```swift
class RaceManager: HorseRaceDelegate {

    let race: Race

    init(race: Race) {
        self.race = race
        race.delegate = self
        race.start()
    }

    func race(_ race: Race, didStartAt time: Date) {
        // some implementation
    }

    func addLapLeader(_ horse: Horse, forLap lap: Int, atTime time: Date) {
        // some implementation
    }

    func race(_ race: Race, didEndAt time: Date, withWinner winner: Horse) {
        // some implementation
    }
}
```

## IOSD-4: Examples - CLLocation Manager

Using the CoreLocation Framework, we can create a LocationManager class.

Once we create the class, we can request for authorization.

Since we need to wait for a response, we actually use the delegate pattern to help assigned a delegate that will recieve info.

In this case here, as long as we conform the the correct protocols, the delegate has already been created for us. For this one, we need the CLLocationManagerDelegate.

To use it, we can conform to the `NSObject` class and override the init() method since there already is one for `NSObject`. This will allow us to give conformance for the `CLLocationManagerDelegate`. Swift does not have the option of optional protocols.

Then we can set the `manager.delegate = self`

This is an example of a circular dependence.

```swift
import Foundation
import CoreLocation

class LocationManager: NSObject, CLLocationManagerDelegate {
	let manager = CLLocationManager()

	override init() {
		super.init()

		manager.delegate = self
		manager.requestWhenInUseAuthorization
	}

	// this is an example of a protocol method!
	func locationManager(_ manager: CLLocationManager, didChangeAuthorization status: CLAuthorizationStatus) {
		if status == .authorizedWhenInUse {
			manager.requestLocation()
		}
	}

	func locationManager(_ manager: CLLocationManager, didFailWithError error: Error) {
		print(Error)
	}

	func locationManager(_ manager: CLLocationManager, didUpdateLocations locations: [CLLocation]) {
		print(locations.first!)
	}
}
```

## IOSD-5: Examples - UITextFieldDelegate

In case of the UITextField, we can assign the ViewController that is "listening" as the delegate to recieve the broadcasts.

Then we can implement the methods from the protocol to the class to give us the results.
