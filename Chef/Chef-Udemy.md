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
