# Chef Cheat Sheet

## Chef Terms

action :periodic
action :delete
action :create 		// default
action :install		// also default
action [:enable, :start]
action [:stop, :disable]

Verify apache is running:
curl -I localhost

## Online learn.chef.io

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

In a production environment, you might run Chef periodically to ensure your systems are kept up to date. As an example, you might run Chef multiple times in a day. However, you likely don't need to update the apt cache every time you run Chef. The frequency property specifies how often to update the apt cache (in seconds.) Here, we specify 86,400 seconds to update the cache once every 24 hours. (The _ notation is a Ruby convention that helps make numeric values more readable.)

The :periodic action means that the update occurs periodically. Another option would be to use the :update action to update the apt cache each time Chef runs.

## 2. Install the Apache package

Now let's install the Apache package, apache2. Modify webserver.rb to look like this.

** webserver.rb **

apt_update 'Update the apt cache daily' do
	frequency 86_400
	action :periodic
end

package 'apache2'

To apply the recipe...

sudo chef-client --local-mode webserver.rb

- if you run it a second time it will know it is not time to update etc

## 3. Start and enable the Apache service

Now let's first enable the Apache service when the server boots and then start the service. Modify webserver.rb to look like this.

** webserver.rb **

apt_update 'Update the apt cache daily' do
	frequency 86_400
	action :periodic
end

package 'apache2'

service 'apache2' do
	supports :status => true
	action [:enable, :start]
end

Ubuntu 14.04 provides two init systems. The supports :status => true part tells Chef that the apache2 init script supports the status message. This information helps Chef use the appropriate strategy to determine if the apache2 service is running. If you're interested, read [this blog post](https://blog.chef.io/2014/09/18/chef-where-is-my-ubuntu-14-04-service-support/) for more information.

Apply it with main command.

The package will already be installed, so there will be nothing to do.

## 4. Add a home page

** webserver.rb **

apt_update 'Update the apt cache daily' do
	frequency 86_400
	action :periodic
end

package 'apache2'

service 'apache2' do
	supports :status => true
	action [:enable, :start]
end

file '/var/www/html/index.html' do
	content '<html
	<body>
		<h1>hello world</h1>
	</body>
end

- from here, the website should be running

## 5. Confirm your web site is running

curl localhost
// shows the data back

### Summary

You saw how to work with the package and service resources. You now know how to work with four types of resources: file, apt_update, package, and service.

You also saw how to apply multiple actions. But how does Chef know what order to apply resources and actions?

** Chef works in the order you specify**

# Make your recipe more manageable

A cookbook provides structure to your recipes and enables you to more easily reference external files, such as our web server's home page. In essence, a cookbook helps you stay organized.

Let's create a cookbook to make our web server recipe easier to manage.

## 1. Create a cookbook

First, from ~/chef-repo

mkdir cookbooks
cd cookbooks

chef generate cookbook learn_chef_apache2

Note the default recipe, named default.rb. This is where we'll move our Apache recipe in a moment.

## 2. Create a template

chef generate template learn_chef_apache2 index.html

The file index.html.erb get created under learn_chef_apache2/templates/default

We can now move our html files to here

*** NOTE *** Here, you're adding the web site content directly to your cookbook for learning purposes. In practice, your web site content would more likely be some build artifact, for example a .zip file on your build server. With Chef, you could pull updated web content from your build server and deploy it to your web server.

** Write our default.rb **

apt_update 'Update the apt cache daily' do
	frequency 86_400
	action :periodic
end

package 'apache2'

service 'apache2' do
	supports :status => true
	action [:enable, :start]
end

template '/var/www/html/index.html' do
	source 'index.html.erb'
end

## 4. Run the cookbook

sudo chef-client --local-mode --runlist 'recipe[learn_chef_apache2]'


in this example, recipe[learn_chef_apache2] is the same as specifying recipe[learn_chef_apache2::default], meaning we want to run the learn_chef_apache2 cookbook's default recipe, default.rb

curl localhost
- again this will confirm our website

** Summary **

Your web server is shaping up! With a cookbook you're now better organized. A cookbook adds structure to your work. You can now author your HTML code in its own file and use a template resource to reference it from your recipe.

You also saw the run-list. The run-list lets you specify which recipes to run, and the order in which to run them. This is handy once you have lots of cookbooks, and the order in which they run is important.

Keep in mind that the web server cookbook you wrote in this lesson likely won't be the one you'd use in production. Only you know the specific needs for your infrastructure. You bring your requirements and Chef provides the tools that help you meet them.

# Managing a node

## Manage a Ubuntu node

Chef is comprised of 3 elements:

1. Your Workstation
2. A Chef server
3. Nodes

Chef server acts as a central repository for your cookbooks as well as for information about every node it manages. For example, the Chef server knows a node's fully qualified domain name (FQDN) and its platform.

A node is any computer that is managed by a Chef server. Every node has the Chef client installed on it. The Chef client talks to the Chef server. A node can be any physical or virtual machine in your network

## Set up your Chef Server

Chef server acts as a central repository for your cookbooks as well as for information about every node it manages.
The knife command enables you to communicate with the Chef server from your workstation.

There are two ways to work with a Chef server.

1. Install an instance on your own infrastructure.
2. Sign up for hosted Chef and let us host it for you

In production, the decision to use hosted Chef or manage your own Chef server depends on your organization's requirements and preferences. If you're interested in setting up your own Chef server, we recommend that you first complete this tutorial using hosted Chef. Then you can follow the [Install and manage your own Chef server](https://learn.chef.io/install-and-manage-your-own-chef-server/linux/) tutorial to set up a Chef server in your environment..

## Configure your workstation to communicate with the Chef server

knife is the command-line tool that provides an interface between your workstation and the Chef server. knife enables you to upload your cookbooks to the Chef server and work with nodes, the servers that you manage.

knife requires two files to communicate with the Chef server – an RSA private key and a configuration file.

The configuration file is typically named knife.rb. It contains information such as the Chef server's URL, the location of your RSA private key, and the default location of your cookbooks.

Both of these files are typically located in a directory named .chef. Every time knife runs, it looks in the current working directory for the .chef directory. If the .chef directory does not exist, knife searches up the directory tree for a .chef directory. This process is similar to how tools such as Git work.

The next step is to create the ~/learn-chef/.chef directory and add your RSA private key and knife configuration files.

** Generate your knife configuration file **

1. Sign in to https://manage.chef.io/.
2. From the Administration tab, select your organization.
3. From the menu on the left, select Generate Knife Config and save the file.

## (Future) Wrapper Cookbooks

That is essentially "forking" an upstream cookbook eg one from the supermarket. If we add the upstream recipe to the `metadata.rb` we can add `depends 'haproxy'` to install the latest version of that dependency eg the supermarket here. We can all define the versions.

What we can now do is add an attribute to our cookbook.

We can then override the recipe in `default.rb` using the following:

```ruby
node.default['haproxy']['member'] = [{
	"this_is_a_var_from_the_video"
}]
```
