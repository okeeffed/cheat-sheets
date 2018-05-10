# Chef - Udemy Course

<!-- TOC -->

*   [Chef - Udemy Course](#chef---udemy-course)
    *   [Configuration Management](#configuration-management)
    *   [Infrastructure as Code](#infrastructure-as-code)
    *   [Your First Chef Recipe](#your-first-chef-recipe)
    *   [Chef Resources](#chef-resources)
    *   [Exploring system resources](#exploring-system-resources)
    *   [Convergence and Desired State](#convergence-and-desired-state)
    *   [Creating an "Exercise Work Station"](#creating-an-exercise-work-station)
    *   [Organising Resources with Ruby](#organising-resources-with-ruby)
    *   [Cookbooks](#cookbooks)
        *   [How do you keep track of changes to the recipes?](#how-do-you-keep-track-of-changes-to-the-recipes)
        *   [Cookbook Components](#cookbook-components)
        *   [Tracking changes to the Cookbooks](#tracking-changes-to-the-cookbooks)
        *   [Setting up an Apache Cookbook](#setting-up-an-apache-cookbook)
    *   [Chef Client](#chef-client)
        *   [include_recipe](#include_recipe)
        *   [default.rb example](#defaultrb-example)
    *   [Ohai](#ohai)
        *   [An object called 'node'](#an-object-called-node)

<!-- /TOC -->

## Configuration Management

Maintaining consistency for server integrity.

The process of configuration can be automated by some extent. When you reach scale, this automation is at the heart of configuration management (IT orchetration).

Imagine we are deploying a web server. If we have a config management solution, this could take minutes instead of hours.

System auditing will also be a hassle for disaster recovery too.

Revision control systems can also be version controlled with `infrastructure as code` by having these environments scripted.

## Infrastructure as Code

Examples:

*   version control
*   testing

These all helps to validate infrastructure code.

You can manage multiple cloud platforms etc.

The three things covered:

*   chef development kit
*   chef client
*   chef server

The Chef DK allows you to run local tools to write code and then upload it to a chef server. A node will be a server or machine managed by Chef.

You will get the desired state from the `cookbooks` or `recipes`.

## Your First Chef Recipe

Create a new file `hello.rb` and add `hello.txt` with Hello World.

First, give Chef a file.

Inside of the file:

```ruby
file '/hello.txt' do
	content 'Hello world!'
end
```

Running `sudo chef-client --client-mode hello.rb` will then build that file and update the content.

## Chef Resources

Chef Resources are the fundamental building blocks of working with Chef.

The aim is to build the load balancer.

Resources describe the smallest piece we can configure in the system.

## Exploring system resources

**Example 1: Package Resource**

```
## Install the http package
package 'httd' do
	action :install
end
```

**Example 2: Service Resource**

```
## Run the ntp service
service 'ntp' do
	action [ :enable, :start ]
end
```

**Example 3: File Resource**

```
## Create the /etc/motd file
file 'etc/motd' do
	content 'This computer is the property ...'
end
```

**Example 4: File Resource**

```
## Remove a file
file 'etc/php.ini.default' do
	action :delete
end
```

Looking back at the definition of a recipe. `hello.rb` was an example of a recipe file.

The "type" (eg file, service, package) and "name" (filename, filepath) should be action'd with "properties" (eg content 'Hello World!'). When we list a resource, we take `action` on that resource (eg `action :create`, `action :delete`, `action :enable`). The default action is taken if you do not list the action. The default is more of a `create` or `install` - it is important to know about what it is as you are writing out recipes.

## Convergence and Desired State

With the command `sudo chef-client --local-mode hello.rb`, when we run `--local-mode` we did it because the default mode is to talk to a `chef server`. Once we have a Chef server to work with, we can not use this mode.

What happens if you modify the content of the file that we create directly, what happens when Chef runs again?

Chef will then attempt to `repair` the file changes.

If we change the ownership for a file, Chef will only take action when it needs to. It will only take action if something is "out of policy".

## Creating an "Exercise Work Station"

```ruby
# creating tree and ntp
package 'tree' do
	action :install
end

package 'ntp'

# /etc/motd - content ownership
file '/etc/motd' do
	content 'This is the property of me'
	action :create
	owner 'root'
	group 'root'
end
```

You can also build an array and pass it into a package resource, but if we do that we won't have access to things like versions etc.

Then we can just run `sudo chef-client -z setup.rb`.

If we re-run the script, no actions will be taken if nothing needs to be modified.

## Organising Resources with Ruby

You can also call recipes from other recipes.

Chef also runs the Ruby files synchronously.

## Cookbooks

Ways to group recipes and put them into useful configurations.

Instead of a single recipe being sent to a server, we send a `cookbook`.

### How do you keep track of changes to the recipes?

Cookbooks allow a way to package up the recipes and give it a version number and track changes.

`A fundamental unit of configuration and policy distribution`

When creating the cookbook, is describes a config for a particular scenario.

What to use cookbooks for:

*   Specifiy resources to use and in which order they are applied
*   Attribute values
*   File distributions
*   Templates
*   Extensions to Chef (lib, definitions and custom resources)
*   Version Control

Cookbook components:

*   README
*   metadata
*   recipes
*   testing directories (spec + test)

### Cookbook Components

We can create cookbooks by using `chef generate [cookbook|other]`.

When we generate a cookbook, we should give the cookbook a relevant name. Example `chef generate cookbooks/workstation` to create a `workstation` book in the `cookbooks` folder.

### Tracking changes to the Cookbooks

Inside of a single repository, changes are generally tracked for a single cook book.

### Setting up an Apache Cookbook

First, create a new cookbook in the cookbooks foler using `chef generate cookbook cookbooks/apache`

```ruby
# Server

# 1. http package install (redhat)
package 'httpd' do
	action :install
end

# 2. configure default apache server file /var/www/html
file '/var/www/html/index.html' do
	content '<h1>Hello from Apache</h1>'
end

# 3. download apache, enable and start the apache service
package 'apache' do
	action :install
end

service 'httpd' do
	action [ :enable, :start ]
end
```

## Chef Client

How do we apply the recipes from the cookbooks from the Chef client? How do we call multiple recipes at once?

We can use a cook book to define the scenarios here.

Say we want to call a cookbook from a particular recipe.

We can also do `sudo chef-client -z --runlist "recipe[cookbook::recipe]"` to run a particular recipe.

For running multiple cookbook recipes, we could do `sudo chef-client -z --runlist "recipe[cookbook::recipe],recipe[another-cookbook::recipe]"`. This will do a `chef-client` run in order.

The runlist DOES NOT HAVE A SPACE between recipe declarations.

### include_recipe

The `include_recipe` method allows you to include a recipe from either the online cookbook stores or from one of our own cookbooks.

This is a great way to `wrap` cookbooks.

Each of the cookbooks that we generate come with a `default.rb` recipe. This default recipe can help us call other recipes.

```ruby
# in the default.rb file for a recipe

# example 'cookbook::recipe'
include_recipe 'workstation::setup'
```

If we now run `sudo chef-client -z -r "recipe[workstation]"` and omit the specific recipe, then the `default.rb` recipe will be used.

### default.rb example

Including the server recipe from the apache cookbook.

```ruby
include_recipe 'apache::server'
```

Now we can call sudo chef-client -z -r "recipe[apache]"`.

## Ohai

We need to think about distribution of the cookbooks to many different nodes.

We may need to know a bit of information about that `node`. That's where `ohai` comes in.

### An object called 'node'

We can now begin to start thinking of scale - how to deal with 100s or 1000s or similar servers.

This webserver code that we have could be distributed to thousands of nodes, but the config might need to be different on each of these nodes.

What happens if a host specific config needs to be different? Eg. hostname, memory available, IP address etc. These things may very from system to system.

`Ohai` is a system discovery tool. It's a command line tool that is required by `chef-client`.

`ohai` gives back all the node system data in JSON. Everytime `chef-client` is run, it automatically executes an `ohai` and allows this object (known as the node object) to be accessed. We call these attributes available as `node attributes`. Each `attribute` also has `sub-attributes`.
