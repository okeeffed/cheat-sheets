# Chef Cheat Sheet

Chef helps you express your infrastructure policy – how your software is delivered and maintained on your servers – as code. When infrastructure is code, it becomes more maintainable, versionable, testable, and collaborative.

A great way to get started with Chef is to log in to a server, or node, and configure it directly.

What the following should provide us:

- describe what happens when Chef runs.
- write Chef code that defines a basic policy.
- apply that policy to a server.

In the next step, you'll install the Chef tools and a text editor on your own machine, or use a virtual machine in the cloud that we provide that already has everything set up. You'll use that machine in the lessons that follow.

The normal Chef workflow involves managing servers remotely from your workstation. But in this tutorial, you'll log in to a server and manage it directly to get a feel for how Chef works.

The easiest way to get started is to use a free trial Ubuntu 14.04 virtual machine that we provide. The virtual machine runs in your browser and has the set of Chef tools, called the Chef DK, and several popular text editors pre-installed. You can also set up your own server to use with this tutorial.

[link](https://learn.chef.io/learn-the-basics/ubuntu/set-up-your-own-server/)

1. Set up a work directory after this is set up

mkdir ~/chef-repo
cd ~/chef-repo

2. Create the MOTD file

In this step, you'll first create the file and set the initial MOTD. To keep things basic, you'll configure the file in the /tmp directory.

Next, you'll write what's called a recipe to describe the desired state of the MOTD file. Then you'll run chef-client, the program that applies your Chef code to place your system in the desired state. Typically, chef-client downloads and runs the latest Chef code from the Chef server, but in this lesson, you'll run chef-client in what's called local mode to apply Chef code that exists locally on your virtual machine.

From your ~/chef-repo directory, create a file named hello.rb, add these contents, and then save the file.

// in hello.rb

file '/tmp/motd' do
	content 'hello world'
end

// from the terminal window, run the chef-client command to apply what you have written

chef-client --local-mode hello.rb

The output will tell us that a new file /tmp/motd was created
(The warnings will relate to concepts we haven't covered just yet)

Now verify that the file was written. Run the more command, which prints a file to the console.

more /tmp/motd

What happens if you run the command a second time?

chef-client --local-mode hello.rb

It gives a different response, letting us know that the file is already up to date.
This is beause Chef applies the configuration only when it needs to.

Chef looks at the current configuration state and applies the action only if the current state doesn't match the desired state. Here, Chef doesn't create or modify /tmp/motd because it already exists and its contents didn't change.
We call this approach "test and repair".

3. MODIFY THE MOTD FILE'S CONTENTS

// in hello.rb

file '/tmp/motd' do
	content 'hello chef'
end

chef-client --local-mode hello.rb

This time Chef applies the action and shows the difference because you've changed the desired state of the file

4. Ensure the MOTD file's contents are not changed by anyone else

echo 'hello robots' > /tmp/motd

chef-client --local-mode hello.rb

// the chef client ensures that the changes aren't kept and the original configuration is restored

In practice, it's common to configure chef-client to act as a service that runs periodically or in response to an event, such as a commit to source control. Running Chef through automation helps to ensure that your servers remain configured as you expect and also enables them to be reconfigured when you need them to be.

5. Delete the MOTD file

in the ~/chef-repo directory, create a new file named goodbye.rb and save the following...

// goodbye.rb

file 'tmp/motd' do
	action :delete
end

chef-client --local-mode goodbye.rb

more /tmp/motd // gives No such file or directory

Summary

You ran a few basic Chef commands and got a flavor of what Chef can do. You learned that a resource describes one part of the system and its desired state. You worked with a file, which is one kind of resource.

** Resources describe the what, not the how

A recipe is a file that holds one or more resources. Each resource declares what state a part of the system should be in, but not how to get there. Chef handles these complexities for you.

In this lesson, you declared that the file /tmp/motd must exist and what its contents are, but you didn't specify how to create or write to the file. This layer of abstraction can not only make you more productive, but it can also make your work more portable across platforms.

** Resources have actions

When you deleted the file, you saw the :delete action.

Think of an action as the process that achieves the desired configuration state. Every resource in Chef has a default action, and it's often the most common affirmative one – for example, create a file, install a package, and start a service.

When we created the file we didn't specify the :create action because :create is the default. But of course you can specify it if you want.

The documentation for each resource type, file for example, explains the type's default action.

** Recipes organize resources

In Chef, hello.rb is an example of a recipe, or an ordered series of configuration states. A recipe typically contains related states, such as everything needed to configure a web server, database server, or a load balancer.

Our recipe states everything we need to manage the MOTD file. You used chef-client in local mode to apply that recipe from the command line.

# Configure a package or service

Let's extend what you learned about file management in the previous lesson to manage the Apache HTTP Server package and its service.

Of course, you can set up one web server manually. But with Chef it'll be easier to manage your infrastructure as you scale, add complexity, and roll out new configuration policies.

## 1. Ensure the apt cache is up to date

In this part you'll configure Apache. Because we want to install the latest version of Apache, it's important to ensure that your system's package index contains the latest list of what packages are available.

You could run the apt-get update command manually when you bring up your instance. But over time, you would need to remember to periodically update the apt cache to get the latest updates. Chef provides the apt_update resource to automate the process.

From your ~/chef-repo directory, add this code to a file named webserver.rb

** webserver.rb **

apt_update 'Update the apt cache daily' do
	frequency 86_400
	action :periodic
end
