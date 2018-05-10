# Dependency Management with Gradle

<!-- TOC -->

*   [Dependency Management with Gradle](#dependency-management-with-gradle)
    *   [GR-1: Gradle the build tool](#gr-1-gradle-the-build-tool)
        *   [---- GR-1.1: build.gradle](#-----gr-11-buildgradle)
        *   [---- GR-1.2: gradlew and gradlew.bat](#-----gr-12-gradlew-and-gradlewbat)
    *   [GR-2: Adding Dependencies](#gr-2-adding-dependencies)
    *   [GR-3: Source Code](#gr-3-source-code)

<!-- /TOC -->

## GR-1: Gradle the build tool

There are a lot of tasks when you want to build your project.

Other build tools include Maven and Ant, and Gradle works well with these two.

Gradle exposes a Domain Specific Language (DSL) that is based heavily on the [Groovy Programming Language](http://groovy-lang.org/) and is very similar to Groovy.

Gradle has an opinionated way on how things should be done and laid out.

If you want to use an IDE for this, the example uses `IntelliJ` and the Gradle template.

From the main menu, select Gradle and select Java as the main language and create.

From here, you will need to fill in:

`GroupId`: General com.dennis.app
`ArtifactId`: JAR file name eg. app

Ensure you select the Java version you want to use as well - demo was 1.8.

One you are in the files have been downloaded by Gradle, open up the project structure and it'll end up creating a build script called `build.gradle`.

### ---- GR-1.1: build.gradle

This is the main file that is defining things like the structure etc.

For now, you may have this as an example

```
group 'com.dennisokeeffe.intro'
version '1.0-SNAPSHOT'

apply plugin: 'java'

sourceCompatibility = 1.5

repositories {
    mavenCentral()
}

dependencies {
    testCompile group: 'junit', name: 'junit', version: '4.11'
}
```

The `apply` is for things like folder structure etc. - you may notice that this is also the `Groovy` language.

### ---- GR-1.2: gradlew and gradlew.bat

These files are the Gradle wrappers that makes sure that everyone can build and test the project the same way.

---

## GR-2: Adding Dependencies

Transitive depencies are all handled through Gradle. This means it won't download version of dependencies it already has.

Where does it download from? This is under control that is defined in the `repositories` section and by default uses `Maven Central` - you can also change this.

```
// dependencies uses a helper function mavenCentral()
// anything in dependencies will look in the repos

repositories {
    mavenCentral()
}

dependencies {
    testCompile group: 'junit', name: 'junit', version: '4.11'
}
```

As an example, we can actually find packages that can be used as Maven depencies (XML) and add it such that Gradle can handle it. Eg Apache CSV package.

```
repositories {
    mavenCentral()
}

dependencies {
	compile group: ''org.apache.commons', name: 'commons-csv', version: '1.2'
    testCompile group: 'junit', name: 'junit', version: '4.11'
}
```

Now we want to refresh the project.

In IntelliJ, you can find the Gradle tool bar on the lefthand edge and then click on it and select refresh to rebuild.

Now, the library will show up in the External Libraries section. If you had the `Auto import` setting selected or you have right-clicked on the project name in the LH edge Gradle bar and selected `Auto-import`, it will automatically do this for you.

There is also a shorter form for writing dependencies.

compile 'org.apache.commons:commons-csv:1.2'

Transitive dependencies will also be downloaded automatically. If we want a better idea of what is going on, we can use the terminal.

To do this, we can run `./gradlew dependencies`

## GR-3: Source Code

Now, anyone who has that `gradle build` file we have, we can just insert all those depencies that we need and then from any computer we can just build that!

Then we can import the packages that we need to the Java files and then use them as we expect.

To find more packages, we can then go to something like Maven and search for packages.
