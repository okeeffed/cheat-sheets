# Learning Chef DevOps Deployment

<!-- TOC -->

*   [Learning Chef DevOps Deployment](#learning-chef-devops-deployment)
    *   [CHEFOPS-1: Introduction to Chef](#chefops-1-introduction-to-chef) - [---- CHEFOPS-1.1: Chef Head first! Build and Deploy a MOTD Recipe.](#-----chefops-11-chef-head-first-build-and-deploy-a-motd-recipe) - [---- CHEFOPS-1.2: What is DevOps and it's relation to Chef?](#-----chefops-12-what-is-devops-and-its-relation-to-chef) - [---- CHEFOPS-1.3: What is Chef?](#-----chefops-13-what-is-chef) - [---- CHEFOPS-1.4: Common Chef Terminology](#-----chefops-14-common-chef-terminology) - [---- CHEFOPS-1.5: Chef Server](#-----chefops-15-chef-server)
    *   [CHEFOPS-2: Building the Webserver Cookbook](#chefops-2-building-the-webserver-cookbook)
    *   [CHEFOPS-3: Node Object and Search](#chefops-3-node-object-and-search)
    *   [CHEFOPS-4: Data-Bags](#chefops-4-data-bags)
    *   [CHEFOPS-5: Chef Environments](#chefops-5-chef-environments)
    *   [CHEFOPS-6: Roles](#chefops-6-roles)
    *   [CHEFOPS-7: Extending Chef](#chefops-7-extending-chef)
    *   [CHEFOPS-8: Deploying Nodes in Production](#chefops-8-deploying-nodes-in-production)
    *   [CHEFOPS-9: Using OpenSource Chef Server](#chefops-9-using-opensource-chef-server)

<!-- /TOC -->

## CHEFOPS-1: Introduction to Chef

**After this, you should know**

1.  Understand DevOps and Chef
2.  Know the role of workstations, nodes, and Chef server
3.  Deploy and automate configurations of nodes
4.  Understanding of writing Recipes and Cookbooks
5.  Understand the Chef work flow
6.  Use Chef to automate the deployment of your infrastructure

Starting with single nodes.

Learn the concepts and then cook Cookbooks and then start bootstrapping nodes. You will also learn about the LAMP stack.

Have at least one "node" to touch base with.

You will know how to deploy out other applications and be able to use it in your own deployment environments.

#### ---- CHEFOPS-1.1: Chef Head first! Build and Deploy a MOTD Recipe.

Have a lab server set up that will be a workstation. The workstation will be where the DevOp uses this to write the scripts and send this up to Chef.

Each DevOps engineer has a Workstation that they work on (generally your computer).

In the Node

```
sudo su
cd /etc/ssh
nano sshd_config
```

Here, you can change `PermitRootLogin` to allow. To apply, you need to use `service ssh restart` (for Ubuntu -> check online for others)

We'll use the free tier with Chef to be able to learn and test.

**Chef**

In the management console, we need to create an Organisation. This will keep our policies seperate to other applications and environments.

Download the StarterKit, then you can move the files across to the workstation using a client like FileZilla.

**In FileZilla**

Connect using SFTP with the correct port if you are using NAT.

Once this is done, you can upload the ChefStarterKit to that workstation.

Move it to root and `unzip`.

Whenever you're working on policies, cookbooks etc. we will be inside of this repo in order to do work.

We want to be installing the software the workstation as well.

```
curl -L https://www.opscode.com/chef/install.sh | bash
```

This will run the bash command and install everything.

Now, let's go ahead and Bootstrap a node.

Currently for our organisation, we're going to bootstrap our first node!

We can use `knife` on the workstation to configure these things.

eg. `knife bootstrap 127.0.0.1 -p 3302 -x username -P password -N testnode`

```
knife bootstrap ADDRESS --ssh-port  PORT --ssh-user USERNAME --ssh-password 'PASSWORD' --sudo --use-sudo-password --node-name NODENAME
```

In a Production environment, we are also going to require -N to specify a Node name.

A Node can be anything that can run the Chef client. This can be linux systems like Ubuntu, Android etc.

If the Node can communicate with the Chef Server, then our Workstation will upload policies to the Chef Server and the Node will communicate with the Chef Server.

Now, in the "Node" instance, can run `chef-client` and see if we can actually communicate with the Chef Client.

**To create a cookbook**

```
knife cookbook create motd
```

you can now move into cookbooks and see motd. In `motd` we are going to jump over a lot of things and seeing how things are being done.

`cd recipes` and you will see the `default.rb` file. Edit the file.

Note: chef NEEDS to work as root, so you need to give those root details!

**In recipes/default.rb**

```ruby
// this will create a template
// set the permissions to write read read

template `/etc/motd` do
	source 'motd.erb'
	mode '0644'
end
```

Now, cd from `recipes` into `templates` and head into the `default` directory.

`nano motd.erb`

**In templates/default/motd.erb**

```
// ensure you put the = sign to say
// evaluate the attr here
// denoted by node["motd"]["author"]

This is an MOTD created by <%= node["motd"]["author"] %>
```

Head to the `attributes` folder and create `default.rb` and define an attribute. We need to set the precedence for importance.

**in attributes/default.rb**

```
default["motd"]["author"] = "Dennis"
```

After this is done, we need to upload this to the chef enterprise. We have to upload and tell the node to run it.

```
knife cookbook upload motd
```

After uploading, we can head to the Chef Enterprise and under policies we can see the motd cookbook. Under recipes, we will be able to see our recipe!

We need to tell our node to run our recipe!

```
knife node run_list add [nodename] "recipe[motd]""
```

If you use the default.rb file, we name it `motd` (we used the default file in the recipe cookbook). There can be multiple cookbooks in a recipe but we don't run all of our recipes.

We can now run `chef-client` to run a convergence. Afterwards, we can change to our /etc file and cat our `motd` file. If there was an existing `motd` file already, it would create a back up of that file.

If we head to `/var/chef`, we can find a backup file and we can find the backup file. It even creates a back up of the backup just in case we need to back it up.

#### ---- CHEFOPS-1.2: What is DevOps and it's relation to Chef?

DevOps is how well people work together and how streamlined our projects actually are.

You split the teams into Development teams and Operations teams. They are essentially in separate environments.

The Ops team are system engineers who take care of the underlying OS that these run on.

DevOps is a bridge between these two teams. A new term from over the last couple of years. Building things like automated tests etc.

If you think DevOps, think automation. Continuous integration! You can run on cycles. DevOps is Infrastructure as nodes. It runs through the entire LAMP deployment. This entire automation for Chef is working closely Infrastructure as code.

This is even more the case when you're running on AWS etc.

We can deploy all these things like ELBs, DBs etc and we work with system teams to deploy this in an optimal way.

DevOps is essentially becoming a role for everybody. Doing things like patch updates, server updates etc with just a single piece of code.

As SysAdmins it's about being able to deploy and manage infrastructures using code.

DevOps is one of the biggest requests right now.

#### ---- CHEFOPS-1.3: What is Chef?

Chef turns Infrastructure into code.

You can let the cookbook dictate things like what packages we need to download etc.

This means when you deploy, you need it to touch base with the chef enterprise.

Recipes themselves are built with the Ruby language. Chef also relies on 'resources' - the resource defined the /etc change for `motd` before. Here we can define what packages to get, what directories to make etc. What services to start and at what level.

**What is Chef?**

Chef relies on either OpenSource Chef server or Chef enterprise to host configuration recipes, cookbooks and node auth for your infrastructure.

With Chef enterprise, we don't have to configure the OpenSource server.

Nodes when performing a convergence will check in with the enterprise server and check it has everything it needs to have, download the required config and run the recipe instructions.

As we learn how to write recipes, we will learn how to automate the process so that the chef-client is run every 30 minutes.

Chef itself eventually works like so:

```
Work Station
	|
	|
Chef Server
	|
	|
  Nodes
(Web Server, Cisco Router, Varnish Server, DB Server)
```

We can have chef jump into these servers and update certain things.

#### ---- CHEFOPS-1.4: Common Chef Terminology

If you understand this, it will click quicker.

**Recipes**

These are the fundamental configuration element. They are created using the Ruby language using patterns with Ruby code. It is required to cover everything that is part of a system.

Recipes need to be added to a `run list` before being executed and run in order. This is done with the `knife node run_list` command.

**Cookbook**

Defines a scenario and is the fundamental unit of configuration and policy distribution.

It is made up of recipes. We have the ability to set attributes for reusable sets of resources and helpers using Ruby code.

We can specify things like versions, metadata and more of our data in the cookbook for our recipes.

**Chef-Client**

Agent that runs locally on the node that is registered with the chef server.

This will register and authenticate when it is first run. It will sync the cookbooks and take appropriate action to align with what the cookbook says.

**Convergence**

Occurs when chef-client configures the system/node based off the information collected from chef-server.

When we run the convergence, the node will be up to date.

**Configuration Drift**

Occurs when the node state does not reflect the updated state of polices/configurations on the chef server.

Recipes are primarily made up of resources and the CD and it configures in liason with the element.

**Resources**

A statement of configuration policay within a recipe.

Describes the desired state of an element in the infrastructure and steps needed to configure.

**Provider**

Defines the steps that are needed to bring the piece of the system from its current state to the desired state.

This works with resources and brings the piece of the system from the current state to the desired state.

**Attributes**

Specific details about the node, used by chef-client to understand current state of the node, the state of the node on the previous chef-client run, and the state of the node at the end of the client run.

**Data-bags**

A global variables stored as JSON data and is accessible from the Chef server.

We can use these when defining local users on our system.

**Workstation**

A computer configured with Knife and used to sync with chef-repo and interact with chef server.

The workstation is what we are going to work on our recipes on. We can configure out Chef server for our node state and server state from the workstation.

**Chef Server**

Chef server is the hub for all configuration data, stores cookbooks, and the policies applied to the node.

The node communicates with the Chef Server and our work to build out policies is done on the workstation and sent to the server and the Node converges with the Chef Client.

**Knife**

Command line tool which provides an interface between the local chef-repo and chef-server.

**client.rb**

Config file for chef_client located at /etc/chef/client.rb on each node.

**Ohai**

Tool used to detect attributes on a node and then provide attributes to chef-client at the start of every chef-client run.

_We will use all the above tools to automate our infrastructure._

**Node Object**

Consists of run-list and node attributes that describe states of the node.

**Chef-Repo**

Located on the workstation and installed with the starter kit, should be synchronised with a version control system and stores Cookbooks, roles, data bags, environments, and config files.

**Organisation**

Used in chef enterprise server to restrict access to objects, nodes environments, roles, data-bags etc.

An organisation is used to make sure that your Chef infrastructure or organisation is separate from others.

**Environments**

Used to organise environments (Prod/Staging/Dev/QA) generally used with cookbook _versions_

You can name things like which versions to use etc.

**Idempotence**

Means a recipe can run multiple times on the same system and the results will always be identical.

If we continue to run a recipe over and over again, it will give the same results based on our policy.

#### ---- CHEFOPS-1.5: Chef Server

**Two Types of Chef Server**

1.  OpenSource Chef-server

*   Free version of Chef
*   Each instance of the server must be configured and managed locally (includes all aspects of managing the server, updates, migrations, scalability etc.)

The limitations with this is that it is not inherently scalable by default. Organisations also cannot communicate with each other.

Enterprise, however, is scalable by design.

2.  Chef-server Enterprise (hosted)

*   Scalable by design
*   Available organisations
*   Always available
*   Resource-based access control

This is always available. It is inherently another back up of our set up.

3.  Chef-server enterprise (on-premise)

*   Scalable by design
*   Available organisations
*   Hosted on-premise behind your firewall
*   Managed yourself

Onus is on the user to deal with organisations and policies.

**Chef Enterprise**

*   Allows the creation of organisations - Organisations separate the infrastructure, policies and cookbooks - Nodes are registered in organisations - Nothing shared between organisations - Enterprise chef server can contain many different organisations - OpenSource chef the local individual server acts as an organisation and does not allow creation of organisations. - Organisations can represent different companies, department, infrastructures, applications and so forth.
*   For each organisation in order to start bootstrapping nodes you need to download the starter kit.
*   Starter kit provides security credentials (validation.pem keys) to authenticate each node to the chef server.
*   Chef enterprise scales by design to handle thousands of nodes and different organisations.

**Role of the server**

*   Stores system config information (policies for nodes)
*   Authenticates workstations and nodes
*   Delivers configurations to nodes
*   Chef server holds the config and the node check-ins to receive instructions on its desired state
*   The node downloads config instructions from the server and does all of the work

In the Chef Server website, we can see the policies of what's required and see things like content to see what files are there and what it requires.

Again, the node communicates back with the chef server to figure out how it should become configured.

Ohai will populate attributes about information for the node.

**Summary**

Everything we stored on our Chef Workstation is backed up on the Chef Server, and the Node will converge with the Chef server. When the info on the server is different to the Node, that is a convergence drift resolved by the convergence.

On the Chef Server GUI, we can actually configure things like the Run List etc without having to use the `knife` commands, even though we can.

Everytime you download a Starter Kit, it overrides the keys etc. Always download it everytime you create a new organisation.

For AWS, Chef Solo is used. Check the web or upcoming docs for how to use and its relation.

## CHEFOPS-2: Building the Webserver Cookbook

## CHEFOPS-3: Node Object and Search

## CHEFOPS-4: Data-Bags

## CHEFOPS-5: Chef Environments

## CHEFOPS-6: Roles

## CHEFOPS-7: Extending Chef

## CHEFOPS-8: Deploying Nodes in Production

## CHEFOPS-9: Using OpenSource Chef Server
