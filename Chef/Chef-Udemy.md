# Chef - Udemy Course

## Configuration Management

Maintaining consistency for server integrity.

The process of configuration can be automated by some extent. When you reach scale, this automation is at the heart of configuration management (IT orchetration).

Imagine we are deploying a web server. If we have a config management solution, this could take minutes instead of hours.

System auditing will also be a hassle for disaster recovery too.

Revision control systems can also be version controlled with `infrastructure as code` by having these environments scripted.

## Infrastructure as Code

Examples:

- version control
- testing

These all helps to validate infrastructure code.

You can manage multiple cloud platforms etc.

The three things covered:

- chef development kit
- chef client
- chef server

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
- Specifiy resources to use and in which order they are applied
- Attribute values
- File distributions
- Templates
- Extensions to Chef (lib, definitions and custom resources)
- Version Control

Cookbook components:
- README
- metadata
- recipes
- testing directories (spec + test)

### Cookbook Components

We can create cookbooks by using `chef generate [cookbook|other]`.

When we generate a cookbook, we should give the cookbook a relevant name. Example `chef generate cookbooks/workstation` to create a `workstation` book in the `cookbooks` folder.

