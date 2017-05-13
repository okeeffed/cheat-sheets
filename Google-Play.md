# Google Play

## Virtual Devices 

Genymotion is useful to grab a bunch of different emulators for Android and come with a personal use or paid license. 

The device version and Genymotion may need to be aligned, so to do so, create a new Virtual Device.

This can be easily done by selecting `Create`, choosing a device and then naming it to something useable like `reactnative`.

## Testing the app on the emulator

To do so, first run the emulator. After the emulator is up and running, use `react-native run-android` on the CLI to start the app. The CLI will respond if there are any errors.

## Uploading to the Google Play Store

## Debugging 

**General Notes**

Running a build from the IDE will generally give better support for debugging issues and auto-updating code.

Some errors I've come across:

| Error							| Resolution								|
| ---							| ---										|
| `error: could not install *smartsocket* listener: Address already in use` | Ensure socket not in use eg no `gulp watch` |
| Component Install error		| Update your install for `android/build.gradle` (look for buildToolsVersion) - Android Studio can automate this for you |
| `Could not get BatchedBridge, make sure your nundle is packaged correctly` | Run `react-native start` from the CLI and reload app |
| UNMET PEER DEPENDENCY			| `rm -rf node-modules/ && npm cache clear && npm install` |
| `protected boolean getUseDeveloperSupport()` issue 	| Change `protected` to `public` (Java Error) |
| `@providesModule naming collision` | If caused by react-native-router-flux -> update or search Github |
| Full cache reset | watchman watch-del-all && rm -rf node_modules/ && npm cache clean && npm install && npm start -- --reset-cache |

**react-native-router-flux issues**

This one was a bit tricky - some useful Github pages:

https://github.com/aksonov/react-native-router-flux/issues/1803
https://github.com/facebook/react-native/issues/13390
https://github.com/react-community/react-navigation/issues/923
https://github.com/aksonov/react-native-router-flux/issues/1816

**General React Native Commands**

- `react-native upgrade` - upgrade the files being used 
- `react-native-git-upgrade` - newer upgrade (needs to be install globally first)

**Issues with React/ build path in Xcode?**

https://github.com/oblador/react-native-vector-icons/issues/373

**Other issues**

- Ensure Cocoapods is up to date `sudo gem install cocoapods`