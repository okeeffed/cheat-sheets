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
